<?php

class Migration_2016_12_17_20_59_51 extends Migration {

	public static $description = "Add release to episode";

	public function update() {
		$this->insertIntoTemplate('episode', 'release');
	}

	public function downgrade() {
		$this->removeFromTemplate('episode', 'release');
	}

}