<?php

namespace App\Http\Controllers\Assistant\Auth;

use App\Models\Assistant;
use App\Models\AssistantPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('assistant.guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $pageTitle = 'Account Recovery';
        return view('assistant.auth.passwords.email', compact('pageTitle'));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('assistants');
    }

    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $assistant = Assistant::where('email', $request->email)->first();
        if (!$assistant) {
            return back()->withErrors(['Email Not Available']);
        }

        $code = verificationCode(6);
        $staffPasswordReset = new AssistantPasswordReset();
        $staffPasswordReset->email = $assistant->email;
        $staffPasswordReset->token = $code;
        $staffPasswordReset->status = 0;
        $staffPasswordReset->created_at = date("Y-m-d h:i:s");
        $staffPasswordReset->save();

        $staffIpInfo = getIpInfo();
        $staffBrowser = osBrowser();
        notify($assistant, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => $staffBrowser['os_platform'],
            'browser' => $staffBrowser['browser'],
            'ip' => $staffIpInfo['ip'],
            'time' => $staffIpInfo['time']
        ],['email'],false);

        $email = $assistant->email;
        session()->put('pass_res_mail',$email);

        return redirect()->route('assistant.password.code.verify');
    }

    public function codeVerify(){
        $pageTitle = 'Verify Code';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error','Oops! session expired'];
            return redirect()->route('assistant.password.reset')->withNotify($notify);
        }
        return view('assistant.auth.passwords.code_verify', compact('pageTitle','email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        $notify[] = ['success', 'You can change your password.'];
        $code = str_replace(' ', '', $request->code);
        return to_route('assistant.password.reset.form', $code)->withNotify($notify);
    }
}
