<?php

class Migration_2016_12_18_15_14_09 extends FieldMigration {

	public static $description = "Media type template field";

	protected function getFieldName(){ return 'media_template'; }

	protected function getFieldType(){ return 'FieldtypeOptions'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Media Type';
	}

}