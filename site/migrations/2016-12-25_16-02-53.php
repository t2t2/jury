<?php

class Migration_2016_12_25_16_02_53 extends FieldMigration {

	public static $description = "itunes explicit";

	protected function getFieldName(){ return 'explicit'; }

	protected function getFieldType(){ return 'FieldtypeCheckbox'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Explicit';
		$f->save();

		$this->insertIntoTemplate('feed', $f, 'itunes_owner_email');
		$this->insertIntoTemplate('episode', $f, 'feed_guid');
		$this->editInTemplateContext('episode', $f, function($field) {
			$field->description = 'Will always be true if in a feed with explicit turned on.';
		});
	}

}