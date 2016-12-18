<?php

class Migration_2016_12_18_18_03_26 extends Migration {

	public static $description = "Setup media uses";

	public function update() {
		$templates = [
			$this->templates->get('media-audio'),
			$this->templates->get('media-video'),
			$this->templates->get('media-youtube'),
			$this->templates->get('media-soundcloud')
		];

		$mediaTable = $this->fields->get('media');
		$mediaTable->template_id = array_map(function ($template) {
			return $template->id;
		}, $templates);
		$mediaTable->columns = "template.label\ntitle\nhref";
		$mediaTable->save();

		$episode = $this->templates->get('episode');
		$episode->childTemplates = array_map(function ($template) {
			return $template->id;
		}, $templates);
		$episode->save();
	}

	public function downgrade() {
		$mediaTable = $this->fields->get('media');
		$mediaTable->template_id = [];
		$mediaTable->columns = '';
		$mediaTable->save();

		$episode = $this->templates->get('episode');
		$episode->childTemplates = [];
		$episode->save();
	}

}