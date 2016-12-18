<?php

class Migration_2016_12_17_16_59_57 extends Migration {

	public static $description = "Setup Home Template admin text";

	public function update() {
		$template = $this->getTemplate('home');
		$template->pageLabelField = '{name} ({title})';
		$template->save();
	}

	public function downgrade() {
		$template = $this->getTemplate('home');
		$template->pageLabelField = '';
		$template->save();
	}

}