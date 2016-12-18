<?php

class Migration_2016_12_18_13_18_26 extends FieldMigration {

	public static $description = "Media list";

	protected function getFieldName(){ return 'media'; }

	protected function getFieldType(){ return 'FieldtypePageTable'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Media';
	}

}