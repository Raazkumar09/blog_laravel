<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    function login(){
        return view('user.login');
    }

    function register(){
        return view('user.register');
    }

    public function save(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|unique:users',
            'password'=>'required|max:12|min:5|confirmed'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.register')->with('success','You are Registered! Now you can Login');
    }

    public function check(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|max:12|min:5'
        ]);
        $userInfo = User::where('email',$request->email)->first();
        if(!$userInfo){
            return back()->with('fail','We dont recognize you');
        }
        if(Hash::check($request->password, $userInfo->password)){
            $request->session()->put('LoggedUser',$userInfo->id);
            return redirect('/user/dashboard');
        } else{
            return back()->with('fail','Incorrect Password');
        }
        return redirect()->route('user.register')->with('success','You are Registered! Now you can Login');
    }

    public function dashboard(){
        $LoggedUser = User::with('posts')->find(session('LoggedUser'));
        if(!$LoggedUser){
            return redirect('/user/login')->with('fail','You must be Logged In');
        }
        return view('user.dashboard',['LoggedUser'=>$LoggedUser]);
    }

    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/user/login');
        }
    }
}
