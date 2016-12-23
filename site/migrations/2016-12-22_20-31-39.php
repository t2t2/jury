<?php

class Migration_2016_12_22_20_31_39 extends Migration {

	public static $description = "Set up media types";

	public function update() {
		$this->insertIntoTemplate('media-type', 'media_template');
		$this->insertIntoTemplate('media-type', 'mime');
		$this->editInTemplateContext('media-type', 'mime', function ($f) {
			$f->description = 'Default MIME type.';
		});
	}

	public function downgrade() {
		$this->removeFromTemplate('media-type', 'media_template');
		$this->removeFromTemplate('media-type', 'mime');
	}

}