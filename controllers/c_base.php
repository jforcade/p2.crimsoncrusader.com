<?php

class base_controller {
	
	public $user;
	// Added message variable to indicate situatio specific messages
	// under the navigation menu, e.g., logged out, etc. 
	public $msg;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);

		# So we can use $msg in views			
			$this->template->set_global('msg', 'You must Sign Up and Login to access Member areas');
			
	}
	
} # eoc
