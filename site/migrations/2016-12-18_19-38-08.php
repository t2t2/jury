<?php

class Migration_2016_12_18_19_38_08 extends Migration {

	public static $description = "attach feed stuff to episodes";

	public function update() {
		$template = $this->templates->get('episode');
		$fields = $template->fields;
		$fields->add('feed_tab');
		$fields->add('feed_guid');
		$fields->add('feed_tab_END');
		$fields->save();
	}

	public function downgrade() {
		$template = $this->templates->get('episode');
		$fields = $template->fields;
		$fields->remove('feed_tab');
		$fields->remove('feed_guid');
		$fields->remove('feed_tab_END');
		$fields->save();
	}

}