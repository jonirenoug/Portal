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
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ActivePassRequest;

class AuthController extends Controller
{
    public function index(){
       return view('login');
    }
    public function loginpost(Request $request) {
        $email = $request->input('email_address');
        $password = $request->input('password');
        
        if(Auth::attempt(['email' => $email, 'password' =>$password])) {
            if(Auth::attempt(['email' => $email, 'password' =>$password, 'active' => 1])){
                $user_login = Auth::user()->id;
                Session::put('userlogin',$email);
                Session::put('userid',$user_login);
                Session::save();
                return redirect()->intended('/member-profile');
            }else{
                $errors = new MessageBag(['errorlogin' => 'Account not activated']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
            
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
        $token = md5(time() . rand());
        $name = $first_name.' '.$surname;

        // Check email
        $kt = User::checkEmail($email_address);
        
        if(isset($kt) && $kt == 1){
            // insert user and get user id
            $user_id = User::insertGetId([
                'name'=> $name,
                'email'=> $email_address,
                'password'=> $passregister,
                'active'=> 0,
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
                $send_mail = Mail::send('template_email.confirmation_email', array('first_name'=> $first_name, 'token'=>$token), function($message) use ($data_email){
                    $message->to($data_email['email_address'],$data_email['first_name'])->subject('Confirmation email');
                });               
            }
            return redirect('/login')->with('success', 'Registration email has been sent. Please check!');
        }else{
            return redirect('register')->with('error', 'Email already exists');
        }        
        return redirect()->intended('/');
    }
    public function forgot_password(){
        $meta_title = "Forgotten Password";
        return view('forgotten-password', compact('meta_title') );
    }
    public function confirmation_show(Request $request){
        $token_confir = $request->route('token');
        $userbytoken = User::getUserByToken($token_confir);
        $id_active = $userbytoken->id;
        $update_active = User::where('id',$id_active)->update([ 'active'=> 1 ]);
        if($update_active){
            return redirect('/login')->with('success', 'Registration Successfully');
        }else{
            return redirect('/login')->with('error', 'Registration failed');
        }
    }
    public function reset_password(Request $request){
        $email_address = $request->input('email_address');
        $userbyemail = User::getUserByEmail($email_address);
        if($userbyemail){
            $member = User::valueMember($userbyemail->id);
            $token = md5(time() . rand());
            $name = $member->member_name;
            $first_name = $member->first_name;
            $update_token = User::where('id',$userbyemail->id)->update(['remember_token'=>$token]);
            if($update_token){
                $data = array('email_address' => $email_address, 'name' => $name, 'first_name' => $first_name );
                Mail::send('template_email.reset', array('name'=>$name, 'token'=>$token, 'email_address' => $email_address, 'first_name' => $first_name), function($message) use ($data){
                    $message->to($data['email_address'], $data['first_name'])->subject('Reset Password');
                });
                return redirect('forgotten-password')->with('success', 'Reset password email has been sent. Please check!');
            }else{
                return redirect('forgotten-password')->with('error', 'Error');
            }
        }else{
            return redirect('forgotten-password')->with('error', 'Email does not exist. Please check again!');
        }
    }
    public function active_show(Request $request){
        Session::forget('userlogin');
        $token_pass = $request->route('token');
        $results = User::getUserByToken($token_pass);
        if (!empty($results)) {
            return view('active')->with('token', $token_pass);
        } else {
            return redirect('forgotten-password')->with('error', 'Token expired. Please check your newest email or submit your email again!');
        }
    }
    public function active_token(Request $request){
        Session::forget('userlogin');
        $password = bcrypt($request->input('password'));
        $token_pass = $request->input('token_pass');
        $results = User::getUserByToken($token_pass);
        if (!empty($results)) {
            $update_pass = User::where('id',$results->id)->update(['Password' => $password]);
            if ($update_pass) {
                $update_token = User::where('id',$results->id)->update(['remember_token' => '']);
                return redirect('login')->with('success', 'Your password has been successfully updated. Please login to continue.');
            } else {
                return redirect('reset-active/'.$token_pass)->with('error', 'Error. Please try again later!');
            }
        } else {
            return redirect('reset-active/'.$token_pass)->with('error', 'Can\'t update password. Please try again later!');
        }
    }
}
