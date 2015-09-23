<?php
use Illuminate\Support\MessageBag;
class UserController extends Controller{
 
 //Method for logging user in   
    public function loginAction(){
        if (Input::server("REQUEST_METHOD") == "POST"){
            $rules = array(
            	'email' => 'required',
                'password' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);
			
            if ($validator->fails()){
            //validation failed
				if (!Input::has('email') || !Input::has('password')) {
						Session::flash('status_error', 'Sorry enter the email or password please');
						return Redirect::route('user/login');
				} 				
            } else {
            //validation passed
	            $credentials = array(
	                "email" => Input::get('email'),
	                "password" => Input::get('password'), 
	            );
	            //remeber check
	            $remeber = false;
	            if(Input::get('remember')){
	            	$remeber = true;
	            } 

	            if (Auth::attempt($credentials, $remeber)){	
	            	//if(Auth::user()->published > 0 && Auth::user()->token == ""){	
	            	if(Auth::user()->published > 0){	
						if (strcmp(strtolower(Auth::user()->permission), "student") == 0 ) {
							return Redirect::route("student/home");
						} else if (strcmp(strtolower(Auth::user()->permission), "teacher") == 0 ) {
	                		return Redirect::route("teacher/home");
						} else if (strcmp(strtolower(Auth::user()->permission), "administrator") == 0 ) {
							return Redirect::route("admin/dashboard");
						}
	            	}
					Session::flash('status_error', 'Sorry your account does not have sufficient priviledges to log in ');
					return Redirect::route('user/login');
	            } else {
		            Session::flash('status_error', 'Sorry account with provided email and password does not exist');
		            return Redirect::route('user/login');
			    }//end auth attempt 
			}//end validation 
        }
    }// end loginAction

	//Method for requesting a new password
    public function requestAction(){
	    if (Input::server("REQUEST_METHOD") == "POST"){
	        $rules = array(
	            "email" => "required"
	        );
	        $validator = Validator::make(Input::all(), $rules);
	        
	        if ($validator->fails()){
	        //validation failed
	        	Session::flash('status_error', 'Sorry, you entered an incorrect email.');
	            return Redirect::route("user/request");
	        } else {
	        //validation passed
	            $email = Input::get("email");
	            try{
		           	$userEmail = User::where('email', $email)->firstOrFail();
					$credentials = array('email' => $userEmail->email);						

		            Password::remind($credentials, function($message){
		                    $message->subject("The App password reset form");
		            });
					
		            Session::flash('status_success', 'Email has been sent to ' . Input::get('email') .'.');
	            	return Redirect::route("user/request");
		        } catch( Exception $e ) {
	                Session::flash('status_error', 'Sorry, you entered an incorrect email or user with such email does not exist.12');
	                return Redirect::route("user/request");
	            }  
	            
	        }//end validation
	    }
	}//end requestAction


//Method for reseting the password    
	public function resetAction(){
	    $token = "?token=" . Input::get("token");
	    $errors = new MessageBag();
	    if ($old = Input::old("errors")){
	        $errors = $old;
	    }
	    $data = array(
	        "token"  => $token,
	        "errors" => $errors
	    );
	    if (Input::server("REQUEST_METHOD") == "POST"){
	        $validator = Validator::make(Input::all(), array(
	            "email"                 => "required|email",
	            "password"              => "required|min:6",
	            "password_confirmation" => "same:password",
	            "token"                 => "exists:token,token"
	        ));
	        if ($validator->passes()){
	            $credentials = array(
	                "email" => Input::get("email"),
	                "password" => Input::get("password"),
	                "password_confirmation" => Input::get("password_confirmation"),
	                "token" => Input::get("token")
	            );
	            Password::reset($credentials, function($user, $password){
	                    $user->password = Hash::make($password);
	                    $user->save();
	                    Auth::login($user);
						
	            });

				if (strcmp(strtolower(Auth::user()->permission), "student") == 0 ) {
					return Redirect::route("user/home");
				} else if (strcmp(strtolower(Auth::user()->permission), "teacher") == 0 ) {
					return Redirect::route("teacher/home");
				} else if (strcmp(strtolower(Auth::user()->permission), "administrator") == 0 ) {
					return Redirect::route("admin/dashboard");
				}
	        }
	        $data["email"] = Input::get("email");
	        $data["errors"] = $validator->errors();
	        return Redirect::to(URL::route("user/reset") . $token)
	            ->withInput($data);
	    }
	    return View::make("user/reset", $data);
	}

	//START THE verifyAction Method
	public function verifyAction() {
		$token = Input::get("token");
		$user = User::where('token', '=', $token)->first();
		if ($user != null) {
			$user->token = "";
			$user->active = 1;
			$user->save();
			Auth::login($user);
			return Redirect::route('user/verified');
		} else {
			return Redirect::route('user/error');
		}
		
	}
	//END THE verifyAction Method

	//Method for registering the user
	public function registerAction(){
		
		$password = Input::get('password');
		$first = Input::get('firstname');
		$last = Input::get('lastname');
		$email = Input::get('email');
		$month = Input::get('month');
		$day = Input::get('day');
		$year = Input::get('year');
		$birthday = $month.'/'.$day.'/'.$year;
		$country = Input::get('country');

	    if (Input::server("REQUEST_METHOD") == "POST"){
	    	$rules = array(     
                'password' => 'required|min:5|different:email',
                'password_confirmation' => 'required|same:password',
                'firstname' => 'required|min:1',
                'lastname' => 'required|min:1',
                'email' => 'required|email|unique:users,email',
   			);
		
   			$validator = Validator::make(Input::all(), $rules);
	         if ($validator->fails()){
		       	return Redirect::route('user/signup')->withErrors($validator);
	         } else {
             // validation ok	         	
	            $data = Input::get();				
	            try {
	                //save on db
					$token = hash('sha256',Str::random(10),false);
		            $user = new User;
		            $user->password = Hash::make($password);
		            $user->first = $first;
		            $user->last = $last;
		            $user->email = $email;
		            $user->birthday = $birthday;
		            $user->country = $country;
					$user->permission = 'student';
		            $user->published = 1;
					//$user->token = $token;
					$user->save(); 
					$id = DB::getPdo()->lastInsertId();

					/*
					$data = array(
						'firstname' => $first,
						'lastname' => $last,
						'email' => $email,
						'password' => $password,
						'token' => $token
					);
					
					Mail::send('emails.welcome', $data, function($message){
						$message->to(Input::get('email'))->subject('Welcome to you!');
					});
		            */
	                return Redirect::route('student/home');
	            }  catch( Exception $ex ) {
					echo $ex;
	                Session::flash('status_error', 'An error occurred while creating a new account - please try again.');
	                return Redirect::route('user/signup');
	            } 	          
	        }
		}
	 }

	public function addUser() {
		$first = Input::get('firstname');
		$last = Input::get('lastname');
		$password = Input::get('password');
		$email = Input::get('email');
		$month = Input::get('month');
		$day = Input::get('day');
		$year = Input::get('year');
		$permission = Input::get('permission');
		$publish = Input::get('publish');
		$country = Input::get('country');
		$birthday = $month.'/'.$day.'/'.$year;

	    if (Input::server("REQUEST_METHOD") == "POST"){
	    	$rules = array(     
                'firstname' => 'required|min:1',
                'lastname' => 'required|min:1',
                'password' => 'required|min:5|different:email',
                'password_confirmation' => 'required|same:password',                
                'email' => 'required|email|unique:users,email',                
				'permission' => 'required'
   			);
   			$validator = Validator::make(Input::all(), $rules);

	         if ($validator->fails()){		
		       	return Redirect::route('admin/userAdd')->withErrors($validator);
	         } else {
             // validation ok
	            try {
	                //save on db/*
					//$token = hash('sha256',Str::random(10), false);				
		            $user = new User;
		            $user->password = Hash::make($password);
		            $user->first = $first;
		            $user->last = $last;
		            $user->email = $email;
		            $user->interval = 15;
		            $user->birthday = $birthday;
		            $user->country = $country;
					$user->permission = $permission;
		            $user->published = $publish;
					$user->token = "";
		            $user->save(); 
					$id = DB::getPdo()->lastInsertId();
					/*
					$data = array(     
						'firstname' => $first,
						'lastname' => $last,
						'email' => $email,
						'password' => $password,
						'token' => $token
					);
					
					Mail::send('emails.welcome', $data, function($message){
						$message->to(Input::get('email'))->subject('Welcome to you!');
					});
					*/
					Session::flash('status_success', 'Successfully Updated.');
					return Redirect::route('admin/users');
	            }  catch( Exception $e ) {
	                Session::flash('status_error', 'An error occurred while creating a new account - please try again.');
	                //return Redirect::route('users/user');
	            } 	          
	        }
		}
	}	
	
	public function accountInfo(){
		$password = Input::get('password');
		$first = Input::get('firstname');
		$last = Input::get('lastname');

		if (Input::server("REQUEST_METHOD") == "POST"){
	    	$rules = array(     
                'password' => 'min:5',
                'password_confirmation' => 'same:password',
                'firstname' => 'min:1',
                'lastname' => 'min:1',
                'email' => 'email'
   			);
   			$validator = Validator::make(Input::all(), $rules);

	        if ($validator->fails()){
		       Session::flash('status_error', 'An error occurred while updating your account - Please try again.');
	           return Redirect::route('student/account')->withErrors($validator);
	        } else {
             // validation ok
	            try {
	                //save on db
		            $user = Auth::user();
		            if(!empty($password)){
						$user->password = Hash::make($password);
		        	}
		            $user->first = $first;
		            $user->last = $last;	
		            $user->save(); 

		            Session::flash('status_success', 'Successfully Updated.');
					return Redirect::route('student/account');
	            }  catch( Exception $e ) {
	               Session::flash('status_error', 'An error occurred while creating a new account - please try again.');
	               return Redirect::route('student/account');
	            }	          
	        }//end validator
		}
	}//end accountInfo

	//START THE updateAction Method
	public function updateAction(){
		$password = Input::get('password');
		$first = Input::get('firstname');
		$last = Input::get('lastname');
		$month = Input::get('month');
		$day = Input::get('day');
		$year = Input::get('year');
		$permission = Input::get('permission');
		$publish = Input::get('publish');
		$country = Input::get('country');
		$birthday = $month.'/'.$day.'/'.$year;

		if (Input::server("REQUEST_METHOD") == "POST") {

	    	$rules = array(     
                'password' => 'min:5',
                'password_confirmation' => 'same:password',
                'firstname' => 'min:1',
                'lastname' => 'min:1',
                'email' => 'email'
   			);
   			$validator = Validator::make(Input::all(), $rules);

	        if ($validator->fails()){
		       Session::flash('status_error', 'An error occurred while updating your account - Please try again.');
	           return Redirect::route('admin/edituser', Input::get('userId'))->withErrors($validator);
	        } else {

	        $user = User::find(Input::get('userId'));

	        $user->first = $first;
	        $user->last = $last;
	        $user->password = Hash::make($password);
	        $user->birthday = $birthday;
	        $user->permission = $permission;
	        $user->country = $country;
	        $user->published = $publish;

	        $user->save();
			
	        Session::flash('status_success', 'Successfully Updated.');
	        return Redirect::route('admin/edituser', $user->id);
	    	}
    	}
	}
	//END THE updateAction Method.

	//START THE updateAction Method
	public function updateInterval($user, $interval) {
		$user = User::find($user);

		$user->interval = $interval;

		$user->save();
	}
	//END THE updateAction Method.

	//START the deleteAction Method
	public function deleteAction(){

		$input = Input::all();
		$id = $input["id"];

		$schoolToUser = DB::table('schooluser')->where('user', $id);
		$userToStudent = DB::table('classstudent')->where('user', $id);
		
		$status = false;
		if ($schoolToUser->count() < 1 && $userToStudent->count() < 1) {
			$user = User::find($id);
			$status = $user->delete();		
			$message = "";
		} else {
			$message = "Sorry. You cannot delete this user.";
		}

		$responses = array(
			'idx'	  => $id,	
			'message' => $message,
			'status'  => $status,
		);

		return Response::json( $responses );

	}
	//END the deleteAction Method.
}

