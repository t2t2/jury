<?php

class Migration_2016_12_23_19_23_47 extends Migration {

	public static $description = "Add media type to media-* and feeds, seed media-* with type";

	public function update() {
		$this->insertIntoTemplate('media-audio', 'media_type');
		$this->insertIntoTemplate('media-video', 'media_type');
		$this->insertIntoTemplate('feed', 'media_type');

		// Preset media_type for those made before
		$audioValue = $this->pages->get('/config/media_types/audio_episode/');
		$this->pages->find('template=media-audio')->each(function ($page) use ($audioValue) {
			$page->media_type = $audioValue;
			$page->save();
		});
		$videoValue = $this->pages->get('/config/media_types/video_episode/');
		$this->pages->find('template=media-video')->each(function ($page) use ($videoValue) {
			$page->media_type = $videoValue;
			$page->save();
		});
	}

	public function downgrade() {
		$this->removeFromTemplate('media-audio', 'media_type');
		$this->removeFromTemplate('media-video', 'media_type');
		$this->removeFromTemplate('feed', 'media_type');
	}

}