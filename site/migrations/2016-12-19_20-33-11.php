<?php

class Migration_2016_12_19_20_33_11 extends Migration {

	public static $description = "Make home attachable to site";

	public function update() {
		$root = $this->templates->get('root');
		$home = $this->templates->get('home');

		$home->noParents = 0;
		$home->parentTemplates = [$root->id];
		$home->noShortcut = true;
		$home->save();

		$root->childTemplates = [$home->id];
		$root->save();
	}

	public function downgrade() {
		$root = $this->templates->get('root');
		$home = $this->templates->get('home');

		$home->noParents = 1;
		$home->parentTemplates = [];
		$home->noShortcut = false;
		$home->save();

		$root->childTemplates = [];
		$root->save();
	}

}