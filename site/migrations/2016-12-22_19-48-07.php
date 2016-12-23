<?php

class Migration_2016_12_22_19_48_07 extends Migration {

	public static $description = "Set media_template values";

	public function update() {
		$field = $this->fields->get('media_template');
		$manager = $field->type->manager;

		$manager->setOptionsString($field, "media-audio|Audio\nmedia-video|Video");
		$field->save();
	}

	public function downgrade() {
		$field = $this->fields->get('media_template');
		$manager = $field->type->manager;

		$manager->setOptionsString($field, "");
		$field->save();
	}

}