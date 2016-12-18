<?php
namespace t2t2\JuRYShow;

use Processwire\Paths;

/**
 * 
 */
class UrlPaths extends Paths {
	/**
	 * Location of wiredir to strip of any set paths
	 */
	protected $fixes = [];

	function __construct($root, $fixes) {
		parent::__construct($root);
		$this->fixes = $fixes;
	}

	/**
	 * Set the given path key
	 *
	 * Fixes value in ProcessWire\Modules::setConfigPaths call
	 *
	 * @param string $key
	 * @param mixed $value If the first character of the provided path is a slash, then that specific path will be used without modification.
	 * 	If the first character is anything other than a slash, then the 'root' variable will be prepended to the path.
	 * @return this
	 *
	 */
	public function set($key, $value) {
		foreach ($this->fixes as $search => $replace) {
			if (substr($value, 0, strlen($search)) === $search) {
				$value = $replace . substr($value, strlen($search));
			}
			break;
		}

		parent::set($key, $value);
	}
}
