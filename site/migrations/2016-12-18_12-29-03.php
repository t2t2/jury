<?php

class Migration_2016_12_18_12_29_03 extends FieldMigration {

	public static $description = "Image field";

	protected function getFieldName(){ return 'image'; }

	protected function getFieldType(){ return 'FieldtypeImage'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Image';
		$f->extensions = 'gif jpg jpeg png';
		$f->maxFiles = 1;
		$f->outputFormat = \ProcessWire\FieldtypeImage::outputFormatSingle;
	}

}