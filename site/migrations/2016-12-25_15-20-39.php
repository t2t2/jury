<?php

class Migration_2016_12_25_15_20_39 extends FieldMigration {

	public static $description = "itunes owner name field";

	protected function getFieldName(){ return 'itunes_owner_name'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Feed Owner Name';
		$f->tags = 'feed';
		$f->save();

		$this->insertIntoTemplate('feed', $f, 'author');
	}

}