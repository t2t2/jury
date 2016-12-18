<?php

class Migration_2016_12_18_12_38_50 extends FieldMigration {

	public static $description = "Add body for HTML content";

	protected function getFieldName(){ return 'body'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Body';
		$f->inputfieldClass = 'InputfieldCKEditor';
		$f->contentType = \ProcessWire\FieldtypeTextarea::contentTypeHTML;
	}

}