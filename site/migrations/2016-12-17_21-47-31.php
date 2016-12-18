<?php

class Migration_2016_12_17_21_47_31 extends Migration {

	public static $description = "Install FieldtypePageTable";

	public function update() {
		$this->modules->install('FieldtypePageTable');
	}

	public function downgrade() {
	$this->modules->uninstall('FieldtypePageTable');
	}

}