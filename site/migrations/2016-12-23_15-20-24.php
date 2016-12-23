<?php

class Migration_2016_12_23_15_20_24 extends Migration {

	public static $description = "Make structure and default media types";

	public function update() {
		$configPage = $this->pages->add('dummy', '/', 'config', [
			'title' => 'Site Config',
			'status' => \ProcessWire\Page::statusHidden
		]);
		$mediaTypesPage = $this->pages->add('dummy', $configPage, 'media_types', [
			'title' => 'Media Types'
		]);
		$this->pages->add('media-type', $mediaTypesPage, 'audio_episode', [
			'title' => 'Episode Audio (.mp3)',
			'media_template' => 'media-audio',
			'mime' => 'audio/mpeg'
		]);
		$this->pages->add('media-type', $mediaTypesPage, 'video_episode', [
			'title' => 'Episode Video (.mp4)',
			'media_template' => 'media-video',
			'mime' => 'video/mp4'
		]);
	}

	public function downgrade() {
		$configPage = $this->pages->get('/_config/');
		$this->pages->delete($configPage, true);
	}

}