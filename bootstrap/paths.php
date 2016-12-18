<?php
$basepath = realpath(__DIR__ . '/..') . '/';
$sitepath = 'site/';
$siteurl = 'site/';
$wirepath = 'vendor/processwire/processwire/wire/';
$wireurl = 'wire/';

return [
	'urls' => [
		'root' => '/',

		'adminTemplates' => is_dir($basepath . $sitepath . 'templates-admin') ? $siteurl . 'templates-admin/' : $siteurl . 'templates-admin/',
		'assets' => 'assets/',
		'cache' => 'assets/cache/',
		'core' => $wireurl . 'core/',
		'fieldTemplates' => $siteurl . 'templates/fields/',
		'files' => 'assets/files/',
		'logs' => 'assets/logs/',
		'modules' => $wireurl . 'modules/',
		'site' => $siteurl,
		'siteModules' => $siteurl . 'modules/',
		'templates' => $siteurl . 'templates/',
		'tmp' => 'assets/tmp/',
		'wire' => $wireurl,
	],
	'paths' => [
		'root' => $basepath,

		'adminTemplates' => is_dir($basepath . $sitepath . 'templates-admin') ? $sitepath . 'templates-admin/' : $wirepath . 'templates-admin/',
		'assets' => 'storage/assets/',
		'cache' => 'storage/cache/',
		'core' => $wirepath . 'core/',
		'fieldTemplates' => $sitepath . 'templates/fields/',
		'files' => 'public/assets/files/',
		'logs' => 'storage/logs/',
		'modules' => $wirepath . 'modules/',
		'public' => 'public/',
		'sessions' => 'storage/sessions/',
		'site' => 'site/',
		'siteModules' => $sitepath . 'modules/',
		'templates' => $sitepath . 'templates/',
		'tmp' => 'storage/tmp/',
		'wire' => 'vendor/processwire/processwire/wire/',
	]
];
