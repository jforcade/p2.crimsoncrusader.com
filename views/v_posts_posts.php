<?php foreach($users as $user): ?>

	<?php
		echo "<pre>";
			print_r($user);
		echo "<pre>";
	?>
		
	<?=$user['post_id']?> <?=$user['content']?><br>
		
	<a href='/posts/update/<?=$user['post_id']?>'>Update</a>
	<a href='/posts/remove/<?=$user['post_id']?>'>Remove</a>
	
	<br>

<?php endforeach ?>