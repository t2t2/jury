<?php

class Migration_2017_01_08_12_17_46 extends Migration {

	public static $description = "Add page body to basic pages";

	public function update() {
		$this->insertIntoTemplate('basic-page', 'body');
		$this->insertIntoTemplate('home', 'body');
	}

	public function downgrade() {
		$this->removeFromTemplate('basic-page', 'body');
		$this->removeFromTemplate('home', 'body');
	}

}