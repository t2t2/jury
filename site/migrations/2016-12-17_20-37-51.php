<?php

class Migration_2016_12_17_20_37_51 extends Migration {

	public static $description = "Set episode and collection limits";

	public function update() {
		$collection = $this->templates->get('episodes');
		$item = $this->templates->get('episode');

		$collection->childTemplates = [$item->id];
		$item->parentTemplates = [$collection->id];

		$collection->save();
		$item->save();
	}

	public function downgrade() {
		$collection = $this->templates->get('episodes');
		$item = $this->templates->get('episode');

		$collection->childTemplates = [];
		$item->parentTemplates = [];

		$collection->save();
		$item->save();
	}

}