<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
	public function verify($token){

		$user = User::where('remember_token', $token)->first();
		if (!is_null($user)) {
			$user->status = 1;
			$user->remember_token = NULL;
			$user->save();
			return redirect('login')->with('success','Email Verified.');
		}else {
			return redirect('/')->with('error', 'Sorry !! Your token is not matched !!');
		}
	}

	public function index(){
		return "hello";
	}
}
