<?php

class Migration_2016_12_25_17_00_17 extends TemplateMigration {

	public static $description = "Home redirect template";

	protected function getTemplateName(){ return 'home_link'; }

	protected function templateSetup(Template $t){
		$t->label = 'Home Redirect';
		$t->altFilename = 'link';
		$t->save();

		$this->insertIntoTemplate($t, 'href');
	}

}