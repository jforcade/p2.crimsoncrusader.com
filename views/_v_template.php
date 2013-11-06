<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- JS/CSS File we want on every page -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>				
										
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/crimstyle.css">
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
</head>

<body>	
	<div id="css-container">

		<div id='menu'>

			<nav>
				<menu>
						<li><a href='/'>Home</a></li>
						
					<?php if($user): ?>
						<a href='/posts/add'>Add Post</a>
						<a href='/posts/posts'>My Posts</a>
						<a href='/posts/users'>Follow Users</a>
						<a href='/posts/'>User Posts</a>
						<a href='/posts/profile'>View Profile</a>
						<a href='/users/logout'>Logout</a>
					<?php else: ?>
						<a href='/users/signup'>Sign Up</a>
						<a href='/users/login'>Log In</a>
					<?php endif; ?>
				</menu>
			</nav>

		</div>

    </div>

	<?php if($user): ?>
		You are logged in as <?=$user->first_name?> <?=$user->last_name?><br>
	<?php else: ?>
		<?php if(isset($msg)) echo $msg; ?>
	<?php endif; ?>
	
	<br><br>
	
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>