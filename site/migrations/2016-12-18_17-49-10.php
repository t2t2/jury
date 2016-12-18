<?php

class Migration_2016_12_18_17_49_10 extends TemplateMigration {

	public static $description = "Youtube media template";

	protected function getTemplateName(){ return 'media-youtube'; }

	protected function templateSetup(Template $t){
		$t->label = 'YouTube';
		$t->noChildren = true;
		$t->parentTemplates = [$this->templates->get('episode')->id];
		$t->tags = '-media-type';

		$t->save();

		$fields = $t->fieldgroup;
		$fields->add($href = $this->fields->get('href'));
		$fields->save();
		$t->save();

		$this->editInTemplateContext($t, $href, function ($context) {
			$context->required = true;
			$context->label = 'Youtube URL';
			$context->description = 'URL of the youtube video (https://www.youtube.com/watch?v={ID})';
		});
	}

}