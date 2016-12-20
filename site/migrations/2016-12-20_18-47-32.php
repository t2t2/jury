<?php

class Migration_2016_12_20_18_47_32 extends Migration {

	public static $description = "Limit episode collections values";

	public function update() {
		$field = $this->fields->get('episodes_collections');
		$field->description = 'Select episodes collection(s) where all episodes of the feed are';
		$field->template_id = $this->templates->get('episodes')->id;
		$field->labelFieldName = '.';
		$field->labelFieldFormat = '{path} ({title})';
		$field->save();
	}

	public function downgrade() {
		$field = $this->fields->get('episodes_collections');
		$field->description = '';
		$field->template_id = null;
		$field->labelFieldName = 'title';
		$field->labelFieldFormat = null;
		$field->save();
	}

}