<?php

class Migration_2016_12_23_18_07_17 extends FieldMigration {

	public static $description = "create media type field";

	protected function getFieldName(){ return 'media_type'; }

	protected function getFieldType(){ return 'FieldtypePage'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Media Type';
		$f->description = 'Used for generating RSS feeds';
		$f->derefAsPage = \ProcessWire\FieldtypePage::derefAsPageOrFalse;
		$f->inputfield = 'InputfieldSelect';
		$f->findPagesCode = <<<'NOW'
if ($page->template->name === 'feed') {
	return $pages->find("template=media-type");
} else {
	return $pages->find("template=media-type,media_template.value={$page->template->name}");
}
NOW;
	}

}