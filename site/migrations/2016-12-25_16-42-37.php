<?php

class Migration_2016_12_25_16_42_37 extends FieldMigration {

	public static $description = "itunes categories";

	protected function getFieldName(){ return 'itunes_category'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'itunes Categories';
		$f->description = <<<'NOW'
Enter categories this feed is in. For subcategories put it after the previous line with a space infront. No need to escape the characters

[List of categories](http://help.apple.com/itc/podcasts_connect/#/itc9267a2f12)
NOW;
		$f->save();

		$this->insertIntoTemplate('feed', $f, 'explicit');
	}

}