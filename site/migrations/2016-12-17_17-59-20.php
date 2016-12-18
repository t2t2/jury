<?php

class Migration_2016_12_17_17_59_20 extends Migration {

	public static $description = "Set / to use root template";

	public function update() {
		$page = $this->pages->get('/');
		$page->template = $this->getTemplate('root');
		$page->set('title', 'Sites');
		$page->save();
	}

	public function downgrade() {
        $page = $this->pages->get('/');
        $page->template = $this->getTemplate('home');
        $page->set('title', 'Home');
        $page->save();
	}

}