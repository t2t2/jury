<?php
$image = $page->image ?: $page->parent->image;
$thumb = $image->size(320, 180);
?>
<div class="<?= isset($classes) ? $classes . ' ' : '' ?>card">
	<div class="card-image">
		<a href="<?= $page->url ?>">
			<figure class="image is-16by9">
				<img src="<?= $thumb->url; ?>" alt="<?= $page->title ?>" />
			</figure>
		</a>
	</div>
	<div class="card-content">
		<h3 class="title is-4">
			<a href="<?= $page->url ?>">
				<?= $page->title ?>
			</a>
		</h3>
		<h4 class="subtitle is-6"><?= $page->release ?></h4>
		<div class="content">
			<?= $page->summary ?>
		</div>
	</div>
</div>
