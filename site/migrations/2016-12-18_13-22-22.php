<?php

class Migration_2016_12_18_13_22_22 extends Migration {

	public static $description = "Add media to episode";

	public function update() {
		$template = $this->templates->get('episode');
		$fields = $template->fields;
		$fields->add('media_tab');
		$fields->add('media');
		$fields->add('media_tab_END');
		$fields->save();
	}

	public function downgrade() {
		$template = $this->templates->get('episode');
		$fields = $template->fields;
		$fields->remove('media_tab');
		$fields->remove('media');
		$fields->remove('media_tab_END');
		$fields->save();
	}

}