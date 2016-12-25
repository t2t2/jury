<?php

class Migration_2016_12_25_16_55_20 extends TemplateMigration {

	public static $description = "Link/Redirect template";

	protected function getTemplateName(){ return 'link'; }

	protected function templateSetup(Template $t){
		$t->label = 'Menu Link / Redirect';
		$t->save();

		$this->insertIntoTemplate($t, 'href');
	}

}