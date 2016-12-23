<?php

class Migration_2016_12_23_21_18_39 extends Migration {

	public static $description = "add per_page (items to show at once) in feed";

	public function update() {
		$this->insertIntoTemplate('feed', 'per_page');
		$this->editInTemplateContext('feed', 'per_page', function($f) {
			$f->label = '# of items to show';
		});
	}

	public function downgrade() {
		$this->removeFromTemplate('feed', 'per_page');
	}

}