<?php

class Migration_2016_12_24_14_13_17 extends Migration {

	public static $description = "Add feed tab to feed template";

	public function update() {
		$this->insertIntoTemplate('feed', 'feed_tab');
		$this->insertIntoTemplate('feed', 'feed_tab_END');
	}

	public function downgrade() {
		$this->removeFromTemplate('feed', 'feed_tab');
		$this->removeFromTemplate('feed', 'feed_tab_END');
	}

}