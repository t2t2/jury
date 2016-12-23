<?php

class Migration_2016_12_23_21_48_53 extends Migration {

	public static $description = "Remove slashes from urls";

	public $changes = ['basic-page', 'episode', 'feed', 'media-type', 'media-audio', 'media-soundcloud', 'media-video', 'media-youtube'];

	public function update() {
		array_map(function($name) {
			$template = $this->templates->get($name);
			$template->slashUrls = 0;
			$template->save();
		}, $this->changes);
	}

	public function downgrade() {
		array_map(function($name) {
			$template = $this->templates->get($name);
			$template->slashUrls = 1;
			$template->save();
		}, $this->changes);
	}

}