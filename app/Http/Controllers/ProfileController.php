<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.profile_user');
    }

    public function updata_user(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->hasFile('img')){
            $request->file('img')->move('img_user/',$request->file('img')->getClientOriginalName());
            $user->img  = $request->file('img')->getClientOriginalName();
            // $user->save();
        }
        $user->password = $request->password;

        $user->update();
        return redirect()->route('profile')->with('success','Data has been Update product successfully');


        // var_dump($user->name);
        // exit;
    }
}





