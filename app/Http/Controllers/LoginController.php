<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// @include('flash-message');

/**
 * Summary of LoginController
 */
class LoginController extends Controller{

    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view('User.login')->with('error', null);
    }
    /**
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember= $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            return redirect('/');
        }
        else{
            return back()->with('error', 'Your email and or password is incorrect');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/login');
    }

}

