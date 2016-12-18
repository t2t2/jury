<?php

class Migration_2016_12_18_11_38_40 extends Migration {

	public static $description = "Add media tab";

	public function update() {
		$opener = new \ProcessWire\Field;
		$opener->type = 'FieldtypeFieldsetTabOpen';
		$opener->name = 'media_tab';
		$opener->label = 'Media';
		$opener->save();

		$closer = new \ProcessWire\Field;
		$closer->type = 'FieldtypeFieldsetClose';
		$closer->name = 'media_tab' . \ProcessWire\FieldtypeFieldsetOpen::fieldsetCloseIdentifier;
		$closer->label = 'Close an open fieldset';
		$closer->save();
	}

	public function downgrade() {
		$opener = $this->getField('media_tab');
		$closer = $this->getField('media_tab' . \ProcessWire\FieldtypeFieldsetOpen::fieldsetCloseIdentifier);

		$this->fields->delete($closer);
		$this->fields->delete($opener);
	}

}