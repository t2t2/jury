<?php
if (! function_exists('asset')) {
	function asset($file) {
		static $manifest = [];
		if (empty($manifest)) {
			$path = __DIR__ . '/../../public/static/rev-manifest.json';
			if (file_exists($path)) {
				$manifest = json_decode(file_get_contents($path), true);
			}
		}
		if (isset($manifest[$file])) {
			return '/'.trim($manifest[$file], '/');
		}
		return '/'.trim($file, '/');
	}
}
