<h3>Posts</h3>

<div id="login">
	
	<?php foreach($posts as $post): ?>

		<strong><?=$post['first_name']?> posted on <?=Time::display($post['created'])?></strong><br>
		<?=$post['content']?><br><br>
		
	<?php endforeach; ?>
	
</div>