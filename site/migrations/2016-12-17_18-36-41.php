<?php

class Migration_2016_12_17_18_36_41 extends FieldMigration {

	public static $description = "Make per page field";

	protected function getFieldName(){ return 'per_page'; }

	protected function getFieldType(){ return 'FieldtypeInteger'; }

	protected function fieldSetup(\ProcessWire\Field $f){
		$f->label = 'Items Per Page';
		$f->defaultValue = $f->getConfigInputfields()->initValue = 10;
		$f->inputType = 'number';
		$f->required = true;
		$f->min = 5;
		$f->max = 100;
	}

}