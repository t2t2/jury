<?php

class Migration_2016_12_18_19_14_48 extends FieldMigration {

	public static $description = "Feed guid";

	protected function getFieldName(){ return 'feed_guid'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'GUID';
		$f->collapsed = Inputfield::collapsedBlank;
		$f->description = 'When migrating from old site set this to previous guid value to avoid feedreaders marking it as new';
		$f->tags = '-feed';
	}

}