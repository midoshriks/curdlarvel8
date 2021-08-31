<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(){
        return view('login.login');
    }

    public function login_user(Request $request){
        $this->validate($request,[
            // 'name' => 'required|min:5|max:25',
            'email' => 'required|email',
            'password' => 'required|min:6|max:30',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect('/')->with('success','Hello user in Dashbord successfully');
        }

        return redirect('/login');
    }

    public function register(){
        return view('login.register');
    }

    public function register_user(Request $request){

        $this->validate($request,[
            'name' => 'required|min:5|max:25',
            'email' => 'required|email',
            'password' => 'required|min:6|max:30',
        ]);

        $user = User::all();
        if($request->hasFile('img')){
            $request->file('img')->move('img_user/',$request->file('img')->getClientOriginalName());
            $user->img  = $request->file('img')->getClientOriginalName();
            // $user->save();
        }
        // var_dump($user->img);
        // exit;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'img' => $user->img,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),

        ]);



        return \redirect('/login');
    }

    public function logout(){
        Auth::Logout();
        return redirect('login');
    }
}
