<?php

class Migration_2016_12_18_15_12_53 extends TemplateMigration {

	public static $description = "Media types template";

	protected function getTemplateName(){ return 'media-type'; }

	protected function templateSetup(Template $t){
		$t->label = 'Media Type';
	}

}