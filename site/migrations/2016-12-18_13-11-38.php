<?php

class Migration_2016_12_18_13_11_38 extends FieldMigration {

	public static $description = "url";

	protected function getFieldName(){ return 'href'; }

	protected function getFieldType(){ return 'FieldtypeURL'; }

	protected function fieldSetup(Field $f){
		$f->label = 'URL';
		$f->textformatters = ['TextformatterEntities'];
		$f->required = true;
	}

}