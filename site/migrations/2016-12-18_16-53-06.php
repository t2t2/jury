<?php

class Migration_2016_12_18_16_53_06 extends TemplateMigration {

	public static $description = "Audio media template";

	protected function getTemplateName(){ return 'media-audio'; }

	protected function templateSetup(Template $t){
		$t->label = 'Audio';
		$t->noChildren = true;
		$t->parentTemplates = [$this->templates->get('episode')->id];
		$t->tags = '-media-type';

		$t->save();

		$fields = $t->fieldgroup;
		$fields->add($href = $this->fields->get('href'));
		$fields->add($this->fields->get('mime'));
		$fields->add($size = $this->fields->get('size'));
		$fields->save();
		$t->save();

		$this->editInTemplateContext($t, $href, function ($context) {
			$context->required = true;
		});

		$this->editInTemplateContext($t, $size, function ($context) {
			$context->label = 'Filesize';
			$context->notes = "File's size in bytes";
			$context->required = true;
		});
	}

}