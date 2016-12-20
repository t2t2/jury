<?php
// Make multidomain account for http/s
wire()->addHookProperty('Multisite::urlPatterns', function($event) {
	$multisite = $event->object;
	$result = [
		'replace' => [],
		'with' => []
	];

	$currentDomain = $multisite->domain;
	$protocol = wire('config')->https ? 'https' : 'http';

	foreach($multisite->domains as $key => $domain) {
		$result['replace'][] = "/{$domain['root']}" . '/';
		if ($key === $currentDomain) {
			$result['with'][] = "/";
		} else {
			$result['with'][] = "{$protocol}://{$key}/";
		}
		foreach (["http://", "https://"] as $prefix) {
			$result['replace'][] = "{$prefix}{$currentDomain}/{$domain['root']}/";
			$result['with'][] = "{$prefix}{$key}/";
		}
	}

	$event->return = $result;
});

wire()->addHook('Multisite::fixUrl', function($event) {
	$url = $event->arguments(0);
	$multisite = $event->object;

	$patterns = $multisite->urlPatterns;

	foreach ($patterns['replace'] as $key => $search) {
		if (strncmp($url, $search, strlen($search)) === 0) {
			$url = $patterns['with'][$key] . substr($url, strlen($search));
			break;
		}
	}

	$event->return = $url;
});

/*
wire()->addHookBefore('Multisite::parseLinks', function ($event) {
	$out = $event->arguments(0);
	$multisite = $event->object;

	if(!strlen($out)) return $out;

	foreach($multisite->domains as $key => $domain){
		if($key == $multisite->domain){
			// local urls
			$replace = array(
				"\"/" . $domain['root'] . "/",
				"'/" . $domain['root'] . "/",
			);
			$with = array(
				"\"/",
				"'/",
			);
		} else {
			// external urls
			$replace = array(
				"\"/" . $domain['root'] . "/",
				"'/" . $domain['root'] . "/",
				"\"http://$key/" . $domain['root'] . "/",
				"'http://$key/" . $domain['root'] . "/",
				);
			$with = array(
				"\"http://" . $key . "/",
				"'http://" . $key . "/",
				"\"http://" . $key . "/",
				"'http://" . $key . "/",
				);
		}
		$out = str_replace($replace, $with, $out);
	}

	$event->replace = true;
	$event->return = $out;
});
*/
