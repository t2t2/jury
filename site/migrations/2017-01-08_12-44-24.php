<?php

class Migration_2017_01_08_12_44_24 extends Migration {

	public static $description = "Add episode collections to show home";

	public function update() {
		$this->insertIntoTemplate('home-show', 'episodes_collections');
		$this->editInTemplateContext('home-show', 'episodes_collections', function($f) {
			$f->description = "Select episodes collection(s) which to show on homepage.\nFirst collection will be used as more episodes link";
		});
	}

	public function downgrade() {
		$this->removeFromTemplate('home-show', 'episodes_collections');
	}

}