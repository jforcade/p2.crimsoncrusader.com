<h1>Welcome to <?=APP_NAME?>
<?php if($user): ?>

	<pre>
	<?php
	print_r($user);
	?>
	</pre>
	
	Hello <?=$user->user_name;?>
<?php else; ?>
	Welcom to my app. Please sign up or log in.
<?php endif; ?>
