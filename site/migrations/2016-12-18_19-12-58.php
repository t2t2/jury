<?php

class Migration_2016_12_18_19_12_58 extends Migration {

	public static $description = "Feed tabs";

	public function update() {
		$opener = new \ProcessWire\Field;
		$opener->type = 'FieldtypeFieldsetTabOpen';
		$opener->name = 'feed_tab';
		$opener->label = 'Feed';
		$opener->save();

		$closer = new \ProcessWire\Field;
		$closer->type = 'FieldtypeFieldsetClose';
		$closer->name = 'feed_tab' . \ProcessWire\FieldtypeFieldsetOpen::fieldsetCloseIdentifier;
		$closer->label = 'Close an open fieldset';
		$closer->save();
	}

	public function downgrade() {
		$opener = $this->getField('feed_tab');
		$closer = $this->getField('feed_tab' . \ProcessWire\FieldtypeFieldsetOpen::fieldsetCloseIdentifier);

		$this->fields->delete($closer);
		$this->fields->delete($opener);
	}

}