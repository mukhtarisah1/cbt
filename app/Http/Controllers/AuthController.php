<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Url;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    //

    public function loadRegister(){
        if(Auth::user() && Auth::user()->is_admin== 1){
            return redirect('/admin/dashboard');
        }
        else if(Auth::user() && Auth::user()->is_admin== 0){
            return redirect('/dashboard');
        }
        return view('register');
    }

    public function studentRegister(Request $request){
        $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your Registration has been succesfull');
    }

    public function loadLogin(){
        if(Auth::user() && Auth::user()->is_admin== 1){
            return redirect('/admin/dashboard');
        }
        else if(Auth::user() && Auth::user()->is_admin== 0){
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function userLogin(Request $request){
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:6'
        ]);
    
        $userCredential = $request->only('email', 'password');
    
        // Check if the email exists
        $user = User::where('email', $userCredential['email'])->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }
    
        // Check if the password is correct
        if (!Hash::check($userCredential['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }
    
        if(Auth::attempt($userCredential)){
            if(Auth::user()->is_admin == 1){
                return redirect('/admin/dashboard');
            } else {
                return redirect('/dashboard');
            }
        } else {
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }
    }

    public function loadDashboard(){
        return view('student.dashboard');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }


    public function forgetPasswordLoad(){
        return view('forget-password');
    }

    public function forgetPassword(Request $request){
        try{
            $user = User::where('email', $request->email)->get();
            if(count($user) > 0){
                $token = Str::random(40);
                $domain = Url::to('/');
                $url = $domain.'/reset-password?token='.$token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] ='Password Reset';
                $data['body'] = 'please click on below link to reset your password';
                
                Mail::send('forgetPasswordMail', ['data'=>$data], function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });


            }else{
                return back()->with('error', 'Email is not exists');
            }
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }




}
