<?php

class Migration_2017_01_08_12_27_25 extends TemplateMigration {

	public static $description = "Add show home template";

	protected function getTemplateName(){ return 'home-show'; }

	protected function templateSetup(Template $t){
		$t->label = 'Home Show';
		$root = $this->templates->get('root');
		$t->parentTemplates = [$root->id];
		$t->noShortcut = true;
		$t->save();

		$this->insertIntoTemplate($t, 'body');
	}

}