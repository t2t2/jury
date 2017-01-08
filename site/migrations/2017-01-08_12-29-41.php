<?php

class Migration_2017_01_08_12_29_41 extends Migration {

	public static $description = "add show home to root child templates";

	public function update() {
		$root = $this->templates->get('root');
		$homeShow = $this->templates->get('home-show');
		$root->childTemplates = array_merge($root->childTemplates, [$homeShow->id]);
		$root->save();
	}

	public function downgrade() {
		$root = $this->templates->get('root');
		$homeShow = $this->templates->get('home-show');
		$root->childTemplates = array_filter($root->childTemplates, function($e) use ($homeShow) {
			return ($e !== $homeShow->id);
		});
		$root->save();
	}

}