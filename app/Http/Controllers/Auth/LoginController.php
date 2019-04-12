<?php

namespace App\Http\Controllers\Auth;

use App\Services\AuthenticationService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
  
    private $authenticationService;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       
    }

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);
       
    //     if ($this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);
    //         return $this->sendLockoutResponse($request);
    //     }
        
    //     if ($this->guard()->validate($this->credentials($request))) {
    //         $user = $this->guard()->getLastAttempted();
            
    //         if ($user->is_active && $this->attemptLogin($request)) {
               
    //             return $this->sendLoginResponse($request);
    //         } else {
                
    //             $this->incrementLoginAttempts($request);
    //             return redirect()
    //                 ->back()
    //                 ->withInput($request->only($this->username(), 'remember'))
    //                 ->with('error' , 'You must be active to login.');
    //         }
    //     }
       
    //     $this->incrementLoginAttempts($request);
    //     return $this->sendFailedLoginResponse($request);
    // }

    function authenticated(Request $request, $user)
        {
            $user->update([
                'last_Login' => Carbon::now()->toDateTimeString(),
                //'Last_Login_ip' => $request->getClientIp()
            ]);
        }

}
