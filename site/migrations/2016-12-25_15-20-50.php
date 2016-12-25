<?php

class Migration_2016_12_25_15_20_50 extends FieldMigration {

	public static $description = "itunes owner email field";

	protected function getFieldName(){ return 'itunes_owner_email'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Feed Owner Email';
		$f->tags = 'feed';
		$f->save();

		$this->insertIntoTemplate('feed', $f, 'itunes_owner_name');
	}

}