<?php

class Migration_2016_12_31_20_14_27 extends FieldMigration {

	public static $description = "Add language field for rss feeds";

	protected function getFieldName(){ return 'language'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Language';
		$f->description = '[List of values (ISO 639-1)](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) (some modifiers like en-us allowed)';

		$this->insertIntoTemplate('feed', $f, 'explicit');
	}

}