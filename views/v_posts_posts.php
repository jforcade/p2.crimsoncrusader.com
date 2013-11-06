<?php foreach($users as $user): ?>

	<div id="login">

		# Contents<br>
		<?=$user['post_id']?>  <?=$user['content']?><br>
		<a href='/posts/remove/<?=$user['post_id']?>'>Remove</a>
	
	</div>

<?php endforeach ?>