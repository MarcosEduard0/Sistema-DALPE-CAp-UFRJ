<?php if (!empty($errors)) : ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<ul style="margin-bottom: 0">
			<?php foreach ($errors as $error) : ?>
				<li><?= esc($error) ?></li>
			<?php endforeach ?>
		</ul>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php endif ?>