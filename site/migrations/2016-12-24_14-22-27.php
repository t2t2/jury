<?php

class Migration_2016_12_24_14_22_27 extends FieldMigration {

	public static $description = "Author field";

	protected function getFieldName(){ return 'author'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Author';
		$f->save();

		$this->insertIntoTemplate('feed', $f, 'feed_tab');
		$this->editInTemplateContext('feed', $f, function($field) {
			$field->description = 'Used as artist in iTunes';
		});
	}

}