<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\PasswordReset;
use App\Models\Student;
use App\Models\Test;
use App\Models\TestAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //

    public function loadRegister(){
        if(Auth::user() && Auth::user()->is_admin== 1){
        return view('register');
        }else{
            return redirect('/');
        }
    }

    public function adminRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'email' => '|email|required|string|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your registration has been successful');
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

    //student login codes 
    public function loadStudentLogin(){
        return view('studentLogin'); 
    }
    public function studentLogin(Request $request)
    {
        $request->validate([
            'reg_no' => 'required',
        ]);
    
        $userCredential = $request->only('reg_no');
    
        // Check if the registration number exists
        $student = Student::where('reg_no', $userCredential['reg_no'])->first();
    
        if (!$student) {
            return back()->withErrors(['reg_no' => 'User not found'])->withInput();
        }
    
        // Log in the student without requiring a password
        Auth::guard('students')->login($student);
        //dd(Auth::guard('students')->user()->firstname);
        
    
        return redirect('/dashboard');
    }

    public function loadDashboard(){
        $studentId = auth()->guard('students')->user()->id;
        //dd($student);
        $testsId = TestAssignment::where('student_id', $studentId)->where('active', true)->get();
        //dd($testsId);
        return view('students.dashboard', compact('testsId','studentId'));
    }

    public function adminDashboard(){
        $examiners = User::all()->count();
        $courses = Course::all()->count();
        $tests = Test::all()->count();
        $students = Student::all()->count();
        return view('admin.dashboard', compact('examiners', 'courses', 'tests', 'students' ));
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
