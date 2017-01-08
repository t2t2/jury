<?php

class Migration_2017_01_08_12_33_58 extends Migration {

	public static $description = "Add site config tabs";

	public function update() {
		$opener = new \ProcessWire\Field;
		$opener->type = 'FieldtypeFieldsetTabOpen';
		$opener->name = 'site_tab';
		$opener->label = 'Site';
		$opener->save();

		$closer = new \ProcessWire\Field;
		$closer->type = 'FieldtypeFieldsetClose';
		$closer->name = 'site_tab' . \ProcessWire\FieldtypeFieldsetOpen::fieldsetCloseIdentifier;
		$closer->label = 'Close an open fieldset';
		$closer->save();
	}

	public function downgrade() {
		$opener = $this->getField('site_tab');
		$closer = $this->getField('site_tab' . \ProcessWire\FieldtypeFieldsetOpen::fieldsetCloseIdentifier);

		$this->fields->delete($closer);
		$this->fields->delete($opener);
	}

}