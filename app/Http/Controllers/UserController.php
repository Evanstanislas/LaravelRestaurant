<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class UserController extends Controller
{
    public function index(){
        return view("User.profile");
    }

    public function updateProfile(Request $request){
        $credential= [
            'username' => 'required|string|min:5|max:50',
            'email' => 'string|email|ends_with:@gmail.com|nullable',
            'phonenumber'=> 'size:12|nullable',
            'address'=> 'min:5|nullable',
            'password' => 'string|min:5|max:255|nullable',
            'profile'=> 'mimes:jpg,jpeg,png|nullable',
        ];
        $validator= Validator::make($request->all(), $credential);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('error', $errors);
        }

        $user= $request->user();
        $user->username= $request->username;
        if (!$request->has('email')|| empty($request->input('email'))) {
            $request->email = $user->getOriginal('email');
        }

        if (!$request->has('phonenumber')|| empty($request->input('phonenumber'))) {
            $request->phonenumber = $user->getOriginal('phonenumber');
        }

        if (!$request->has('address')|| empty($request->input('address'))) {
            $request->address = $user->getOriginal('address');
        }

        if (!$request->has('profile') || !$request->file('profile')->isValid()) {
            $image_url = $user->getOriginal('picture');
        }
        else{
            $file= $request->file('profile');
            $image_name= time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs("public/images", $file, $image_name);
            $image_url= $image_name;
        }
        $result= $user->id;
        $user = DB::table('users')->where('id', '=', $result)
        ->update([
            'username'=> $request->username,
            'email'=> $request->email,
            'phonenumber'=> $request->phonenumber,
            'address'=> $request->address,
            'picture'=> $image_url,
        ]);
        return redirect('/editprofile')->with('success', 'Profile Updated');
    }
}
