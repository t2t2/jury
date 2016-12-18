<?php

class Migration_2016_12_18_10_44_46 extends Migration {

	public static $description = "Add options field";

	public function update() {
		$this->modules->install('FieldtypeOptions');
	}

	public function downgrade() {
	$this->modules->uninstall('FieldtypeOptions');
	}

}