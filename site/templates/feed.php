<?php
use Carbon\Carbon;

$multisite = $modules->get('Multisite');

$document = new SimpleXMLElement('<?xml version="1.0"?><rss version="2.0"></rss>');
$channel = $document->addChild('channel');
$channel->addChild('title', $page->title);
// Link to parent
$channel->addChild('link', $multisite->fixUrl($page->rootParent->httpUrl));
$channel->addChild('description', $page->summary);

$selector = "parent={$page->episodes_collections},children.template=media-audio,limit=50";
$episodes = pages($selector);

foreach($episodes as $episode) {
	$episodeNode = $channel->addChild('item');
	$episodeNode->addChild('title', $episode->title);
	$episodeNode->addChild('link', $multisite->fixUrl($episode->httpUrl));
	$episodeNode->addChild('description', $episode->summary);
	$episodeNode->addChild('pubDate', Carbon::createFromTimestamp($episode->getUnformatted('release'))->toRfc2822String());
	if ($episode->guid) {
		$episodeNode->addChild('guid', $episode->guid)->addAttribute('isPermaLink', false);
	} else {
		$episodeNode->addChild('guid', $multisite->fixUrl($episode->httpUrl));
	}
}

echo $document->asXML();
