<?php

class Migration_2016_12_17_12_19_57 extends Migration {

	public static $description = "Install Menu Builder";

	public function update() {
		$this->modules->install('ProcessMenuBuilder');
	}

	public function downgrade() {
		$this->modules->uninstall('ProcessMenuBuilder');
	}

}