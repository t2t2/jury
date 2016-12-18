<?php

class Migration_2016_12_18_13_51_41 extends TemplateMigration {

	public static $description = "dummy template";

	protected function getTemplateName(){ return 'dummy'; }

	protected function templateSetup(Template $t){
		$t->label = 'Dummy';
	}

}