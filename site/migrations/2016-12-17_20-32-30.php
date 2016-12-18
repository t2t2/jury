<?php

class Migration_2016_12_17_20_32_30 extends TemplateMigration {

	public static $description = "Episode template";

	protected function getTemplateName(){ return 'episode'; }

	protected function templateSetup(Template $t){
		$t->label = 'Episode';
		$t->fieldgroup->add('summary');
	}

}