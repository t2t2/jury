<?php

class Migration_2016_12_20_18_12_38 extends FieldMigration {

	public static $description = "episode collections field";

	protected function getFieldName(){ return 'episodes_collections'; }

	protected function getFieldType(){ return 'FieldtypePage'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Episode Collections';
		$f->derefAsPage = \ProcessWire\FieldtypePage::derefAsPageArray;
		$f->inputfield = 'InputfieldPageListSelectMultiple';
	}

}