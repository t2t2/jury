<?php

class Migration_2016_12_18_16_49_59 extends FieldMigration {

	public static $description = "Size field";

	protected function getFieldName(){ return 'size'; }

	protected function getFieldType(){ return 'FieldtypeInteger'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Size';
	}

}