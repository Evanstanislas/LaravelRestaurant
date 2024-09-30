<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller{

    public function index(){
        return view('User.register');
    }
    public function register(Request $request){

        $validation=[
            'username' => 'required|string|min:5|max:50',
            'email' => 'required|string|email|unique:users|ends_with:@gmail.com',
            'password' => 'required|string|min:5|max:255',
            'confirm'=> 'same:password'
        ];

        $validator= Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('error', $errors);
        }

        else{
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role= 'User';
            $user->remember_token= Str::random(10);
            $user->save();

            Auth::loginUsingId($user->id, true);
            return redirect('/');
        }
    }
}
