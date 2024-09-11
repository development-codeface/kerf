<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Appointment;
use App\Models\Deposit;
use App\Models\Doctor;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function depositInsert(Request $request)
    {
        $request->validate([
            'amount'      => 'required|numeric|gt:0',
            'gateway' => 'required',
            'currency'    => 'required',
            'doctor_id'   => 'required|exists:doctors,id',
            'trx'         => 'required',
        ]);
        $appointment = Appointment::where('trx', $request->trx)->first();
        if (!$appointment) {
            $notify[] = ['error', 'Invalid appointment!'];
            return back()->withNotify($notify);
        }

        $doctor = Doctor::findOrFail($request->doctor_id);
        if ($doctor->fees != $request->amount) {
            $notify[] = ['error', "Sorry! Didn't permit to customize doctor fees."];
            return back()->withNotify($notify);
        }

        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('method_code', $request->gateway)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge    = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
        $payable   = $request->amount + $charge;
        $finalAmount = $payable * $gate->rate;



        $data = new Deposit();
        $data->appointment_id  = $appointment->id;
        $data->doctor_id       = $doctor->id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount          = $request->amount;
        $data->charge          = $charge;
        $data->rate            = $gate->rate;
        $data->final_amo       = $finalAmount;
        $data->btc_amo         = 0;
        $data->btc_wallet      = "";
        $data->trx             = $appointment->trx;
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('deposit.confirm');
    }


    public function appDepositConfirm($hash)
    {
        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            return "Sorry, invalid URL.";
        }
        $data = Deposit::where('id', $id)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->firstOrFail();
        $user = Doctor::findOrFail($data->doctor_id);
        auth()->login($user);
        session()->put('Track', $data->trx);
        return to_route('deposit.confirm');
    }


    public function depositConfirm()
    {
        $track   = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('deposit.manual.confirm');
        }


        $dirName = $deposit->gateway->alias;
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($deposit, $isManual = null)
    {
        if ($deposit->status == Status::PAYMENT_INITIATE || $deposit->status == Status::PAYMENT_PENDING) {
            $deposit->status = Status::PAYMENT_SUCCESS;
            $deposit->save();

            $doctor = Doctor::find($deposit->doctor_id);
            $doctor->balance += $deposit->amount;
            $doctor->save();
            $transaction             = new Transaction();
            $transaction->doctor_id    = $deposit->doctor_id;
            $transaction->amount       = $deposit->amount;
            $transaction->post_balance = $doctor->balance;
            $transaction->charge       = $deposit->charge;
            $transaction->trx_type     = '+';
            $transaction->details      = 'Deposit Via ' . $deposit->gatewayCurrency()->name;
            $transaction->trx          = $deposit->trx;
            $transaction->remark       = 'deposit';
            $transaction->save();


            if (!$isManual) {
                $adminNotification = new AdminNotification();
                $adminNotification->doctor_id = $doctor->id;
                $adminNotification->title = 'Deposit successful via ' . $deposit->gatewayCurrency()->name;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            $general = gs();
            $appointment = Appointment::where('id',$deposit->appointment_id)->first();
            $appointment->payment_status = Status::APPOINTMENT_PAID_PAYMENT;
            $appointment->site = Status::YES;
            $appointment->try  = Status::YES;
            $appointment->save();

            notify($doctor, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                'method_name'     => $deposit->gatewayCurrency()->name,
                'method_currency' => $deposit->method_currency,
                'method_amount'   => showAmount($deposit->final_amo),
                'amount'          => showAmount($deposit->amount),
                'charge'          => showAmount($deposit->charge),
                'rate'            => showAmount($deposit->rate),
                'trx'             => $deposit->trx,
                'post_balance' => showAmount($doctor->balance). ' ' . $general->cur_text . ''
            ]);

            $user = [
                'name'     => $appointment->name,
                'username' => $appointment->email,
                'fullname' => $appointment->name,
                'email'    => $appointment->email,
                'mobile'   => $appointment->mobile,
            ];

            notify( $user, 'APPOINTMENT_CONFIRMATION', [
                'booking_date' => $appointment->booking_date,
                'time_serial'  => $appointment->time_serial,
                'doctor_name'  => $doctor->name,
                'doctor_fees'  =>  showAmount($doctor->fees) . ' ' . $general->cur_text
            ]);

        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        if ($data->method_code > 999) {
            $pageTitle = 'Deposit Confirm';
            $method = $data->gatewayCurrency();
            $gateway = $method->method;
            return view($this->activeTemplate . 'user.payment.manual', compact('data', 'pageTitle', 'method', 'gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway  = $gatewayCurrency->method;
        $formData = $gateway->form->form_data;

        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = Status::PAYMENT_PENDING;
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->doctor_id = $data->doctor_id;
        $adminNotification->title = 'Deposit request to ' . $data->doctor->name;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amo),
            'amount' => showAmount($data->amount),
            'charge' => showAmount($data->charge),
            'rate' => showAmount($data->rate),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'You have payment request has been taken by authority'];
        return to_route('home')->withNotify($notify);
    }
}
