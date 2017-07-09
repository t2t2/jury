<?php $this->layout('layouts/main') ?>

<?php
$image = $page->image ?: $page->parent->image;
if ($image) {
	$imageVars = $image->getVariations(['suffix' => 'episode-image']);
	if (count($imageVars)) {
		$resized = $imageVars[0];
	} else {
		$ratio = 16/9;
		$height = $image->width;
		$width = $image->width;
		$ratio = $width / $height;
		
		$targetWidth = min(1280, $width);
		$targetHeight = min(720, $height);
		$targetRatio = 16 / 9;
		if ($ratio > $targetRatio) {
			// wider than ratio
			$targetWidth = $targetHeight * $targetRatio;
		} else {
			$targetHeight = $targetWidth / $targetRatio;
		}
		$resized = $image->size($targetWidth, $targetHeight, [
			'suffix' => 'episode-image'
		]);
	}
}
?>

<section class="section">
	<div class="container">
		<h2 class="title is-2"><?= $page->title; ?></h2>
		<h4 class="subtitle"><?= $page->release ?></h4>

		<div class="content is-medium"><?= $page->summary; ?></div>

		<div class="smart-player columns">
			<div class="column is-three-quarters">
				<?php if ($image): ?>
					<div class="card-image">
						<figure class="image is-16by9">
							<img src="<?= $resized->url; ?>" alt="<?= $page->title ?>" />
						</figure>
					</div>
				<?php endif; ?>
			</div>
			<div class="column is-one-quarter">
				<nav class="panel">
					<p class="panel-heading">Watch / Download</p>
					<?php foreach($page->media as $media): ?>
						<a class="panel-block" href="<?= $media->url ?>">
							<?= $media->title ?>
						</a>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>

