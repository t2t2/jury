<?php
$site = $page->rootParent;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page->title; ?></title>

	<link rel="stylesheet" href="<?= asset('/static/shared.css'); ?>">
</head>
<body>
	<section class="hero is-primary">
		<div class="hero-body">
			<div class="container">
				<a href="<?= $site->url ?>">
					<?php // <p class="subtitle is-3"></p> ?>
					<h1 class="title is-1"><?= $site->title ?></h1>
				</a>
			</div>
		</div>
		<div class="hero-foot">
			<div class="container">
				<nav class="nav">
					<div class="nav-left">
						<a href="<?= $site->url ?>" class="nav-item">Home</a>
					</div>
				</nav>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
	
		<?= $this->section('content'); ?>
		</div>
	</section>

	<?php if ($page->editable()) {
		echo "<p><a href='$page->editURL'>Edit</a></p>";
	} ?>


	<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
	<script src="<?= asset('/static/manifest.js') ?>"></script>
	<script src="<?= asset('/static/vendor.js') ?>"></script>
	<script src="<?= asset('/static/shared.js') ?>"></script>
</body>
</html>
