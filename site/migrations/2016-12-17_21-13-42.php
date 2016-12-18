<?php

class Migration_2016_12_17_21_13_42 extends Migration {

	public static $description = "sort order & pagination for episodes collection";

	public function update() {
		$template = $this->templates->get('episodes');
		$template->sortfield = '-release';
		$template->allowPageNum = true;
		$template->save();
	}

	public function downgrade() {
		$template = $this->templates->get('episodes');
		$template->sortfield = '';
		$template->allowPageNum = false;
		$template->save();
	}

}