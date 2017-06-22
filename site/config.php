<?php namespace ProcessWire;

/**
 * GLOBAL SITE CONFIGURATION
 *
 * These values are shared in git, therefore do not have any secrets here.
 */

/**
 * ProcessWire Configuration File
 *
 * Site-specific configuration for ProcessWire
 *
 * Please see the file /wire/config.php which contains all configuration options you may
 * specify here. Simply copy any of the configuration options from that file and paste
 * them into this file in order to modify them.
 * 
 * This file is licensed under the MIT license
 * https://processwire.com/about/license/mit/
 *
 * ProcessWire 3.x, Copyright 2016 by Ryan Cramer
 * https://processwire.com
 *
 */

if(!defined("PROCESSWIRE")) die();

/*** SITE CONFIG *************************************************************************/

/** @var Config $config */

/**
 * Enable core API variables to be accessed as function calls?
 *
 * Benefits are better type hinting, always in scope, and potentially shorter API calls.
 * See the file /wire/core/FunctionsAPI.php for details on these functions.
 *
 * @var bool
 *
 */
$config->useFunctionsAPI = true;

$config->httpHosts = [
	'justinryoung.tv', 'www.justinryoung.tv',
	'jurytalks.com', 'www.jurytalks.com',
	'politicspoliticspolitics.com', 'www.politicspoliticspolitics.com',
	'1900wrestling.justinryoung.tv', 'www.1900wrestling.justinryoung.tv',
	'kickstarter.justinryoung.tv', 'www.kickstarter.justinryoung.tv'
];

$config->MultisiteDomains = [
	'justinryoung.tv' => [
		'root' => 'www.justinryoung.tv',
		'http404' => 27
	],
	'jurytalks.com' => [
		'root' => 'www.jurytalks.com',
		'http404' => 27
	],
	'politicspoliticspolitics.com' => [
		'root' => 'www.politicspoliticspolitics.com',
		'http404' => 27
	],
	'1900wrestling.justinryoung.tv' => [
		'root' => '1900wrestling.justinryoung.tv',
		'http404' => 27
	],
	'kickstarter.justinryoung.tv' => [
		'root' => 'kickstarter.justinryoung.tv',
		'http404' => 27
	]
];
