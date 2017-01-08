<?php
$image = $page->image ?: $page->parent->image;
$thumb = $image->size(320, 180);
?>
<article class="media is-episode">
	<div class="media-left">
		<a href="<?= $page->url ?>">
			<figure class="image is-16by9">
				<img src="<?= $thumb->url; ?>" alt="<?= $page->title ?>" />
			</figure>
		</a>
	</div>
	<div class="media-content">
		<h3 class="title">
			<a href="<?= $page->url ?>">
				<?= $page->title ?>
			</a>
		</h3>
		<div class="content is-medium">
			<?= $page->summary ?>
		</div>
	</div>
</article>
