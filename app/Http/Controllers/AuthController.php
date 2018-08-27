<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\MessageBag;
use App\Mail\ResetMail;
use Session;
use Mail;

class AuthController extends Controller
{
    public function index(){
       return view('login');
    }
    public function loginpost(Request $request) {
        $email = $request->input('email_address');
        $password = $request->input('password');       
        if(Auth::attempt(['email' => $email, 'password' =>$password])) {
            Session::put('userlogin',$email);
            return redirect()->intended('/');
        } else {
            $errors = new MessageBag(['errorlogin' => 'Incorrect email']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    public function logout(){
        Session::flush();
        return redirect('login');
    }
    public function register(){
        return view('register');
    }
}
