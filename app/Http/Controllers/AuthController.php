<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\MessageBag;
use App\Mail\ResetMail;
use Session;
use Mail;
use App\User;
use App\Members;


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
            return redirect()->intended('/home');
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
    public function registerpost(Request $request){
        if(!empty($request->input('first_name'))){
            $first_name = $request->input('first_name');
        }else{
            $first_name = '';   
        }
        if(!empty($request->input('surname'))){
            $surname = $request->input('surname');
        }else{
             $surname = '';
        }
        
        $email_address = $request->input('email_address');
        $passregister = bcrypt($request->input('passregister'));
        $token = bcrypt(time() . rand());
        $name = $first_name.' '.$surname;

        // Check email
        $kt = User::checkEmail($email_address);

        if(isset($kt) && $kt == 1){
            // insert user and get user id
            $user_id = User::insertGetId([
                'name'=> $name,
                'email'=> $email_address,
                'password'=> $passregister,
                'remember_token'=> $token,
                'created_at' => date('Y-m-d'),
                'updated_at'=> date('Y-m-d')
            ]);

            // insert members
            $insert_member = Members::insert([
                'member_name' => $name,
                'first_name' => $first_name,
                'surname' => $surname,
                'phone' => 0,
                'postal_street_address' => '',
                'postal_suburb' =>'',
                'postal_state'=>'',
                'postal_postcode' => 0,
                'postal_country' =>'',
                'security_code' => 0,
                'fob_number' => 0,
                'avatar' => '',
                'id_user' => $user_id,
                'created_at' => date('Y-m-d'),
                'updated_at'=> date('Y-m-d')
            ]);

            if($user_id && $insert_member){

                //Send mail register
                $data_email = array('email_address' => $email_address, 'first_name' => $first_name );
                Mail::send('template_email.confirmation_email', array('first_name'=> $first_name, 'token'=>$token), function($message) use ($data_email){
                    $message->to($data_email['email_address'],$data_email['first_name'])->subject('Confirmation email');
                });
            }
        }else{
            return redirect('register')->with('error', 'Email already exists');
        }        
        return redirect()->intended('/');
    }
}
