<?php

class Migration_2016_12_20_18_19_30 extends Migration {

	public static $description = "add episodes collection to feed";

	public function update() {
		$this->insertIntoTemplate('feed', 'episodes_collections');
		$this->editInTemplateContext('feed', 'episodes_collections', function($context) {
			$context->label = 'Episodes source';
		});
	}

	public function downgrade() {
		$this->removeFromTemplate('feed', 'episodes_collections');
	}

}