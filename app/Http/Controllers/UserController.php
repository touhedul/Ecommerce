<?php

namespace App\Http\Controllers;

use App\Model\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('users.dashboard',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::id() == $id){
            $user = User::findOrFail($id);
            $divisions = DB::table('divisions')->get();
            return view('users.edit',compact('user','divisions'));
        }else{
            return redirect('/users')->with('error','Invalid');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
           'name' => 'required|string|max:255',
           'division_id' => 'required|integer|between:1,7',
           'address' => 'required|string'
       ]);
        if(Auth::id() == $id){
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->address =$request->address;
            $user->division_id = $request->division_id;
            $user->save();
            return redirect('/users')->with('success','Profile Update Successful.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = new User();
    }
    public function changePasswordView()
    {
        return view('users.change_password');
    }
    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required|min:6',
            'password_confirmation'=>'required'
        ]);

        $user = User::find(Auth::id());
//        echo $request->old_password.'</br>';
//        echo Hash::make($request->old_password).'</br>';
//        echo $user->password.'<br>';

        if(Hash::check($request->old_password,$user->password))
        {
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
                $user->save();
                return back()->with('success','Password Change Successful.');
            }else{

                return back()->with('error','Confirmation Password Mismatch.');
            }
        }else{
            return back()->with('error','Password Mismatch.');
        }

    }
}
