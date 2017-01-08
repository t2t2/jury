<?php
use function ProcessWire\pages;

$this->layout('layouts/main');
?>

<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
				<div class="content is-large"><?= $page->body; ?></div>
			</div>
		</div>
	</div>
</section>
<section class="section">
	<div class="container">
		<?php
		$selector = "parent={$page->episodes_collections},sort=-release,limit=6";
		$episodes = pages($selector);

		if($page->episodes_collections && $page->episodes_collections->count()): ?>
			<h2 class="title is-2">Recent Episodes</h2>

			<div class="tile is-ancestor is-vertical">
				<div class="tile">
					<?php foreach($episodes as $i => $episode): ?>
						<?php 
						if ($i > 0 && $i % 3 === 0) {
							echo '</div><div class="tile">';
						}
						?>
						<div class="tile is-parent">
							<? $this->insert('partials/episode-card', ['page' => $episode, 'classes' => 'tile is-4 is-child']); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<a class="tag is-large is-primary" href="<?= $page->episodes_collections[0]->url ?>">More episodes</a>
		<?php endif; ?>
	</div>
</section>


