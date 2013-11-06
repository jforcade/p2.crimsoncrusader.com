<?php

class users_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	  	/*echo "users_controller construct called<br>";*/
	} 

    public function index() {
		echo "this is the index page";
	}

    public function signup() {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        # Render template
            echo $this->template;

    }

	public function p_signup() {

		//echo "<pre>";
		//	print_r($_POST);
		//echo "<pre>";
	
		# More data we want stored with the user
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();

		# Encrypt the password  
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

		# Create an encrypted token via their email address and a random string
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

		# Insert this user into the database 
		$user_id = DB::instance(DB_NAME)->insert("users", $_POST);

		# For now, just confirm they've signed up - 
		# You should eventually make a proper View for this
		
		//echo 'You\'re signed up';

		Router::redirect("/");
	}

public function login() {

	# Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

    # Render template
        echo $this->template;
}

public function p_login() {

    # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
    $_POST = DB::instance(DB_NAME)->sanitize($_POST);

    # Hash submitted password so we can compare it against one in the db
    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

    # Search the db for this email and password
    # Retrieve the token if it's available
    $q = "SELECT token 
        FROM users 
        WHERE email = '".$_POST['email']."' 
        AND password = '".$_POST['password']."'";

    $token = DB::instance(DB_NAME)->select_field($q);

    # If we didn't find a matching token in the database, it means login failed
    if(!$token) {

		# So we can use $msg in views			
		$this->template->set_global('msg', 'Login failed');

	
        //# Send them back to the login page
        //Router::redirect("/users/logfail/");

    # But if we did, login succeeded! 
    } else {

		echo 'You have logged in!';
	
        /* 
        Store this token in a cookie using setcookie()
        Important Note: *Nothing* else can echo to the page before setcookie is called
        Not even one single white space.
        param 1 = name of the cookie
        param 2 = the value of the cookie
        param 3 = when to expire
        param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        */
        setcookie("token", $token, strtotime('+1 year'), '/');

        # Send them to the main page - or whever you want them to go
        //Router::redirect("/");
		
		//  figure and enter one of those debug print statements she does.

        Router::redirect("/users/posts/");

		
    }

}

	/*-------------------------------------------------------------------------------------------------
	No view needed here, they just goto /users/logout, it logs them out and sends them
	back to the homepage.	
	-------------------------------------------------------------------------------------------------*/
    public function logout() {
       
       # Generate a new token they'll use next time they login
       $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
       
       # Update their row in the DB with the new token
       $data = Array(
       	'token' => $new_token
       );
       DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);
       
       # Delete their old token cookie by expiring it
       setcookie('token', '', strtotime('-1 year'), '/');
       
       # Send them back to the homepage
       Router::redirect('/');
       
    }

	public function posts() {

		# Setup view
			$this->template->content = View::instance('v_posts');
			$this->template->title   = "Posts";

		# Render template
			echo $this->template;

	}

	public function logfail() {

		# Setup view
			$this->template->content = View::instance('v_logfail');
			$this->template->title   = "Login Failed";

		# Render template
			echo $this->template;

	}

	public function profile($user_name = NULL) {
		
		# Only logged in users are allowed...
		if(!$this->user) {
			die('Members only. <a href="/users/login">Login</a>');
		}
		
		# Set up the View
		$this->template->content = View::instance('v_users_profile');
		$this->template->title   = "Profile";
				
		# Pass the data to the View
		$this->template->content->user_name = $user_name;
		
		# Display the view
		echo $this->template;
				
    }

	
} # End of class
