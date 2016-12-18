<?php

class Migration_2016_12_17_16_49_23 extends Migration {

	public static $description = "Install Multisite Module";

	public function update() {
		$this->modules->install('Multisite');
	}

	public function downgrade() {
		$this->modules->uninstall('Multisite');
	}

}