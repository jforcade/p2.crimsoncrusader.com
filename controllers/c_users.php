<?php

class users_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	  	echo "users_controller construct called<br>";
	} 

	public function signup() {
		echo "This is the signup page";
	} # eom

	public function login() {
		echo "This is the login page";
	} # eom
	
	public function logout() {
		echo "This is the logout page";
	} # eom
	
	public function profile($user_name = NULL) {
	
		#$view = View::instance('v_users_profile');
		#echo $view;
	#}
		if($user_name == NULL) {
			echo "No user specified";
		}
		else {
			echo "This is the profile for ".$user_name;
		}
	} # eom 
	
} # End of class
