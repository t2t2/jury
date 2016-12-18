<?php

class Migration_2016_12_18_16_49_23 extends FieldMigration {

	public static $description = "MIME type field";

	protected function getFieldName(){ return 'mime'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'MIME type';
	}

}