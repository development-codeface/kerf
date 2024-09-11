<?php
namespace App\Http\Controllers\Doctor\Auth;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\DoctorLogin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laramin\Utility\Onumoti;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = 'doctor';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('doctor.guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $pageTitle = "Doctor Login";
        return view('doctor.auth.login', compact('pageTitle'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('doctor');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {


        $this->validateLogin($request);

        $request->session()->regenerateToken();



        Onumoti::getData();

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }



        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status == Status::USER_BAN) {
            $this->guard()->logout();
            $notify[] = ['error','Your account has been deactivated.'];
            return to_route('doctor.login')->withNotify($notify);
        }



        $user->save();
        $ip = getRealIP();
        $exist = DoctorLogin::where('doctor_ip', $ip)->first();

        $doctorLogin = new DoctorLogin();
        if ($exist) {
            $doctorLogin->longitude    = $exist->longitude;
            $doctorLogin->latitude     = $exist->latitude;
            $doctorLogin->city         = $exist->city;
            $doctorLogin->country_code = $exist->country_code;
            $doctorLogin->country      = $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $doctorLogin->country      = @implode(',', $info['country']);
            $doctorLogin->country_code = @implode(',', $info['code']);
            $doctorLogin->city         = @implode(',', $info['city']);
            $doctorLogin->longitude    = @implode(',', $info['long']);
            $doctorLogin->latitude     = @implode(',', $info['lat']);
        }

        $userAgent              = osBrowser();
        $doctorLogin->doctor_id = $user->id;
        $doctorLogin->doctor_ip = $ip;

        $doctorLogin->browser = @$userAgent['browser'];
        $doctorLogin->os      = @$userAgent['os_platform'];
        $doctorLogin->save();

        return to_route('doctor.dashboard');
    }


    public function logout(Request $request)
    {
        $this->guard('doctor')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/doctor');
    }
}
