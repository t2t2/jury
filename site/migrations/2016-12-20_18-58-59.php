<?php

class Migration_2016_12_20_18_58_59 extends Migration {

	public static $description = "Fix feed content type";

	public function update() {
		$template = $this->templates->get('feed');
		$template->contentType = 'xml';
		$template->save();
	}

	public function downgrade() {
		$template = $this->templates->get('feed');
		$template->contentType = null;
		$template->save();
	}

}