<?php

class Migration_2016_12_26_15_16_35 extends Migration {

	public static $description = "Enable Plates";

	public function update() {
		$this->modules->install('TemplatePlates');
	}

	public function downgrade() {
		$this->modules->uninstall('TemplatePlates');
	}

}