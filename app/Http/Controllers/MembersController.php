<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Members;
use App\User;

class MembersController extends Controller
{
    public function index(){
    	if(!Session::has('userlogin')){
    		return view('login');
    	}
    	$id_user = Session::get('userid');
    	$member_login = Members::where('id_user', $id_user)->first();
    	$user = User::where('id',$id_user)->first();
    	return view('member-profile',compact('member_login','user'));
    }
    public function updateMember(Request $request){
    	
        if(Session::has('userid')){
        	$id = Session::get('userid');
        	$member_login = Members::where('id_user', $id)->first();
        	if(isset(request()->avatar)){
        		foreach (request()->avatar as $key => $value) {
		            $imageName = time().'.'.$value->getClientOriginalName();            
		            $value->move(public_path('uploads'), $imageName);
		            $link_images = url('/public/uploads').'/'.$imageName;     
		        }
        	}else{
        		if(!empty($member_login->avatar)){
					$imageName = $member_login->avatar;
        		}else{
        			$imageName = 'avatar-null.png';
        		}
        		
        	}
        	
	        
	        $first_name = $request->input('first_name');
	        $surname = $request->input('surname');
	        $member_name = $first_name.' '.$surname;
	        $phone = $request->input('phone');
	        $postal_address = $request->input('postal_address');
	        $suburb = $request->input('suburb');
	        $postal_state = $request->input('state');
	        $postcode = $request->input('postcode');

	        $update_member = Members::where('id_user',$id)->update([	
	        	'member_name' => $member_name,
	        	'first_name' => $first_name,
	        	'surname' => $surname,
	        	'phone' => $phone,
	        	'postal_street_address' => $postal_address,
	        	'postal_suburb' => $suburb,
	        	'postal_state' => $postal_state,
	        	'postal_postcode' => $postcode,
	        	'avatar' => $imageName
	        ]);
	        if($update_member){
	        	return redirect('/member-profile')->with('success', 'Update success!');
	        }else{
	        	return redirect('/member-profile')->with('error', 'Update error!');
	        }
        }
    }
}
