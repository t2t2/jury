<?php

class Migration_2016_12_17_17_52_30 extends TemplateMigration {

	public static $description = "Make root template for /";

	protected function getTemplateName(){ return 'root'; }

	protected function templateSetup(Processwire\Template $t){
		$t->label = 'Site Root';
		$t->noParents = -1;
		$t->useRoles = true;
		$roles = $t->roles;
		$roles->add($this->roles->get('guest'));
		$t->roles = $roles;
		$t->childTemplates[] = $this->getTemplate('home')->id;
	}

}