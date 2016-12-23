<?php
use Carbon\Carbon;

$multisite = $modules->get('Multisite');

$document = new SimpleXMLElement('<?xml version="1.0"?><rss version="2.0"></rss>');
$channel = $document->addChild('channel');
$channel->addChild('title', $page->title);
// Link to parent
$feedURL = $multisite->fixUrl($page->rootParent->httpUrl);
$channel->addChild('link', $feedURL);
$channel->addChild('description', $page->summary);

if ($page->image) {
	$imageNode = $channel->addChild('image');
	$imageNode->addChild('url', $multisite->fixUrl($page->image->httpUrl));
	$imageNode->addChild('title', $page->title);
	$imageNode->addChild('link', $feedURL);
}

$selector = "parent={$page->episodes_collections},media.media_type={$page->media_type},sort=-release,limit={$page->per_page}";
$episodes = pages($selector);

foreach($episodes as $episode) {
	$media = $episode->child("media_type={$page->media_type}");
	if (!$media) {
		continue;
	}
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
	$mediaNode = $episodeNode->addChild('enclosure');
	$mediaNode->addAttribute('url', $media->href);
	if ($media->size) {
		$mediaNode->addAttribute('length', $media->size);
	}
	$mediaNode->addAttribute('type', $media->mime ?: $media->media_type->mime);
}

echo $document->asXML();
