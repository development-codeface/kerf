<?php
namespace App\Http\Controllers\Assistant\Auth;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\AssistantLogin;
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
    public $redirectTo = 'assistant';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('assistant.guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $pageTitle = "Assistant Login";
        return view('assistant.auth.login', compact('pageTitle'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('assistant');
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
            return redirect()->route('assistant.login')->withNotify($notify);
        }


        $user->save();
        $ip = getRealIP();
        $exist = AssistantLogin::where('assistant_ip', $ip)->first();

        $assistantLogin = new AssistantLogin();
        if ($exist) {
            $assistantLogin->longitude    = $exist->longitude;
            $assistantLogin->latitude     = $exist->latitude;
            $assistantLogin->city         = $exist->city;
            $assistantLogin->country_code = $exist->country_code;
            $assistantLogin->country      = $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $assistantLogin->country      = @implode(',', $info['country']);
            $assistantLogin->country_code = @implode(',', $info['code']);
            $assistantLogin->city         = @implode(',', $info['city']);
            $assistantLogin->longitude    = @implode(',', $info['long']);
            $assistantLogin->latitude     = @implode(',', $info['lat']);
        }

        $userAgent              = osBrowser();
        $assistantLogin->assistant_id = $user->id;
        $assistantLogin->assistant_ip = $ip;

        $assistantLogin->browser = @$userAgent['browser'];
        $assistantLogin->os      = @$userAgent['os_platform'];
        $assistantLogin->save();

        return to_route('assistant.dashboard');
    }



    public function logout(Request $request)
    {
        $this->guard('assistant')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/assistant');
    }
}
