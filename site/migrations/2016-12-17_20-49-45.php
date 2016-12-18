<?php

class Migration_2016_12_17_20_49_45 extends FieldMigration {

	public static $description = "Release datetime";

	protected function getFieldName(){ return 'release'; }

	protected function getFieldType(){ return 'FieldtypeDatetime'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Release Date';
		$f->dateOutputFormat = 'l, j F Y H:i';
		$f->datepicker = InputfieldDatetime::datepickerFocus;
		$f->timeInputSelect = true;
		$f->dateInputFormat = 'd.m.Y';
		$f->timeInputFormat = 'H:i';
		$f->defaultToday = true;
	}

}