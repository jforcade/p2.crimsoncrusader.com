<?php foreach($users as $user): ?>

	<?=$user['post_id']?> <?=$user['content']?><br>
		
	<a href='/posts/update/<?=$user['post_id']?>'>Update</a>
	<a href='/posts/remove/<?=$user['post_id']?>'>Remove</a>
	
	<br>

<?php endforeach ?>