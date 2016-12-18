<?php
use Processwire\Config;
use Processwire\FilenameArray;
use Processwire\Paths;
use t2t2\JuRYShow\UrlPaths;

$config = new Config();
$config->dbName = '';

if(isset($_SERVER['HTTP_HOST'])) {
	$host = strtolower($_SERVER['HTTP_HOST']);

	// when serving pages from a web server
	$rootURL = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
	$realScriptFile = empty($_SERVER['SCRIPT_FILENAME']) ? '' : realpath($_SERVER['SCRIPT_FILENAME']);
	$realIndexFile = realpath('../public/index.php');

	// check if we're being included from another script and adjust the rootPath accordingly
	$sf = empty($realScriptFile) ? '' : dirname($realScriptFile);
	$f = dirname($realIndexFile);
	if($sf && $sf != $f && strpos($sf, $f) === 0) {
		$x = rtrim(substr($sf, strlen($f)), '/');
		$rootURL = substr($rootURL, 0, strlen($rootURL) - strlen($x));
	}
	unset($sf, $f, $x);

	// when internal is true, we are not being called by an external script
	$config->internal = $realIndexFile == $realScriptFile;

} else {
	// when included from another app or command line script
	$config->internal = false;
	$host = '';
}

$paths = require 'paths.php';

$config->urls = new UrlPaths('/', [
	$paths['paths']['wire'] => $paths['urls']['wire']
]);
foreach($paths['urls'] as $key => $value) {
	$config->urls->{$key} = $value;
}

$config->paths = new Paths('/');
foreach($paths['paths'] as $key => $value) {
	$config->paths->{$key} = $value;
}

// Styles and scripts are CSS and JS files, as used by the admin application.
// But reserved here if needed by other apps and templates.
$config->styles = new FilenameArray();
$config->scripts = new FilenameArray();

// Include system config defaults
/** @noinspection PhpIncludeInspection */
require $config->paths->wire . 'config.php';


// Git shared settings
if (file_exists($config->paths->site . 'config.php')) {
	require $config->paths->site . 'config.php';
}

// Local settings
if (file_exists($config->paths->root . 'config.php')) {
	require $config->paths->root . 'config.php';
}

return $config;