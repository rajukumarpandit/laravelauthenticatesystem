<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $task=Task::where('user_id',Auth::User()->id)->get();

        if(count($task)>0){
            return view('dashboard')->with('tasks',$task);
        }
        return view('dashboard')->with(['tasks'=>[]]);
    }

    /**
     * userRegister method is used for user registration.
     */
    public function userRegister(Request $request){
        $request->validate([
            'name' => 'required|string',
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
