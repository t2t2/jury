<?php

class Migration_2016_12_18_17_41_46 extends TemplateMigration {

	public static $description = "Video media template";

	protected function getTemplateName(){ return 'media-video'; }

	protected function templateSetup(Template $t){
		$t->label = 'Video';
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