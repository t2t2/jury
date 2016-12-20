<?php

class Migration_2016_12_20_17_08_52 extends TemplateMigration {

	public static $description = "Feed template";

	protected function getTemplateName(){ return 'feed'; }

	protected function templateSetup(Template $t) {
		$t->label = 'RSS Feed';
		$t->fieldgroup->add('summary');
		$t->fieldgroup->add('image');
		$t->fieldgroup->save();

		$this->editInTemplateContext($t, 'summary', function ($context) {
			$t->label = 'Description';
		});
	}

}