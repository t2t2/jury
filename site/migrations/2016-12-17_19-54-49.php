<?php

class Migration_2016_12_17_19_54_49 extends TemplateMigration {

	public static $description = "Create episodes collection template";

	protected function getTemplateName(){ return 'episodes'; }

	protected function templateSetup(\ProcessWire\Template $t){
		$t->label = 'Episodes collection';
		$t->fieldgroup->add('per_page');
	}

}