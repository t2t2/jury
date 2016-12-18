<?php

class Migration_2016_12_18_12_46_41 extends Migration {

	public static $description = "Add fields to episode";

	public function update() {
		$episode = $this->getTemplate('episode');

		$this->insertIntoTemplate($episode, 'image');
		$this->insertIntoTemplate($episode, 'body');
		// Default episode image to episodes
		$this->insertIntoTemplate('episodes', 'image');

		$this->editInTemplateContext('episodes', 'image', function($field) {
			$field->label = 'Default image for new episodes';
		});
	}

	public function downgrade() {
		$episode = $this->getTemplate('episode');

		$this->removeFromTemplate($episode, 'image');
		$this->removeFromTemplate($episode, 'body');
		$this->removeFromTemplate('episodes', 'image');
	}

}