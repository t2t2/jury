<?php

$this->layout('layouts/main');
?>

<section class="section">
	<div class="container">
		<h2 class="title is-2"><?= $page->title ?></h2>

		<?php
		$episodes = $page->children('limit=15');

		if($episodes->count()): ?>
			<div class="tile is-ancestor is-vertical">
				<div class="tile">
					<?php foreach($episodes as $i => $episode): ?>
						<?php 
						if ($i > 0 && $i % 3 === 0) {
							echo '</div><div class="tile">';
						}
						?>
						<div class="tile is-4 is-parent">
							<?php $this->insert('partials/episode-card', ['page' => $episode, 'classes' => 'tile is-child']); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<nav class="pagination is-centered">
				<?= $episodes->renderPager([
					'listMarkup' => "\n<ul class='pagination-list'>{out}\n</ul>",
					'itemMarkup' => "\n\t<li>{out}</li>",
					'linkMarkup' => "<a href='{url}' class='pagination-link'>{out}</a>", 
					'currentLinkMarkup' => "<a href='{url}' class='pagination-link is-current'>{out}</a>", 
				]) ?>
			</nav>
		<?php endif; ?>
	</div>
</section>


