<?php

class Migration_2016_12_18_17_57_57 extends TemplateMigration {

	public static $description = "Soundcloud media template";

	protected function getTemplateName(){ return 'media-soundcloud'; }

	protected function templateSetup(Template $t){
		$t->label = 'Soundcloud';
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
			$context->label = 'Soundcloud URL';
			$context->description = 'URL of the soundcloud track (https://soundcloud.com/{username}/{track})';
		});
	}

}