<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginPage(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function registerPage(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('register');
    }

    protected function dashboardPage(){
        return view('dashboard');
    }

    /**
     * userRegister method is used for user registration.
     */
    public function userRegister(Request $request){
        $request->validate([
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $result=$user->save();

        if(!is_null($result)){
            return redirect()->route('login')->with('succ','User Registered Successfuly!');
        }
    }

    /**
     * user login method is used for check valid user or not
     */
    public function userLogin(Request $request){
        $credencials=$request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(Auth::attempt($credencials)){
            return redirect()->route('dashboard')->with('succ','User Logined Successfuly!');
        }else{
            return redirect()->route('login')->with('err','Please enter valid email or password');
        }
    }

    /**
     * userLogout method is used for logout user session
     */
    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
