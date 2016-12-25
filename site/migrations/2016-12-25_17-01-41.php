<?php

class Migration_2016_12_25_17_01_41 extends Migration {

	public static $description = "Allow home link under root";

	public function update() {
		$root = $this->templates->get('root');
		$homeLink = $this->templates->get('home_link');

		$homeLink->parentTemplates = [$root->id];
		$homeLink->noShortcut = true;
		$homeLink->save();

		$root->childTemplates = array_merge($root->childTemplates, [$homeLink->id]);
		$root->save();
	}

	public function downgrade() {
		$root = $this->templates->get('root');
		$homeLink = $this->templates->get('home_link');

		$homeLink->parentTemplates = [];
		$homeLink->noShortcut = false;
		$homeLink->save();

		$root->childTemplates = array_filter($root->childTemplates, function($e) use ($homeLink) {
			return ($e !== $homeLink->id);
		});
		$root->save();
	}

}