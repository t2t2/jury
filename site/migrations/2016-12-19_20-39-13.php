<?php

class Migration_2016_12_19_20_39_13 extends Migration {

	public static $description = "Hide media from add new list";

	public function update() {
		$templates = [
			$this->templates->get('media-audio'),
			$this->templates->get('media-video'),
			$this->templates->get('media-youtube'),
			$this->templates->get('media-soundcloud')
		];

		foreach ($templates as $template) {
			$template->noShortcut = true;
			$template->save();
		}
	}

	public function downgrade() {
		$templates = [
			$this->templates->get('media-audio'),
			$this->templates->get('media-video'),
			$this->templates->get('media-youtube'),
			$this->templates->get('media-soundcloud')
		];

		foreach ($templates as $template) {
			$template->noShortcut = false;
			$template->save();
		}
	}

}