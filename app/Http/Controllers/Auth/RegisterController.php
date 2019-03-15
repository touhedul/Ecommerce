<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use App\Notifications\Verification;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }
    //Override method
    public function showRegistrationForm(){
        $divisions = DB::table('divisions')->get();
        return view('auth.register',compact('divisions'));;
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'division_id' => 'required|integer|between:1,7',
            'address' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'remember_token'=>str_random(50),
            'status' => 0,
        ]);

        $user->notify(new Verification($user));

        return back()->with('success','Please Confirm Your Email!!!');
    }
}
