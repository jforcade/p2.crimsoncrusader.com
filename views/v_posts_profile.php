<h3>Profile</h3>

<?php foreach($users as $user): ?>

	<div id="login">
	
		First Name: <?=$user['first_name']?> <br>
		Last Name: <?=$user['last_name']?><br>
		Email: <?=$user['email']?><br>
	
	</div>
	
<?php endforeach ?>