<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

use App\Model\User;
use App\Notifications\Verification;
use Illuminate\Http\Request;


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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required',
      ]);

    //Find User by this email
        $user = User::where('email', $request->email)->first();
        if($user == null)
            return back()->with('error','User Not Exist.');
        if ($user->status == 1) {
      // login This User

          if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // Log Him Now
            return redirect()->intended(route('users.index'));
        }else{
            return back()->with('error','Username or Password Do Not Match');
        }
    }else {
      // Send him a token again
      if (!is_null($user)) {
        $user->notify(new Verification($user));

        return redirect('/login')->with('success', 'A New confirmation email has sent to you.. Please check and confirm your email');;
        }else {
        return redirect()->route('login')->with('error', 'Please login first !!');
        }
    }

    }
}
