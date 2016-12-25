<?php

class Migration_2016_12_25_17_24_54 extends Migration {

	public static $description = "Show same page label on home_link";

	public function update() {
		$template = $this->getTemplate('home-link');
		$template->pageLabelField = '{name} ({title})';
		$template->save();
	}

	public function downgrade() {
		$template = $this->getTemplate('home-link');
		$template->pageLabelField = '';
		$template->save();
	}

}