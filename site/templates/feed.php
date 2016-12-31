<?php
use Carbon\Carbon;
use function ProcessWire\pages;

$multisite = $modules->get('Multisite');
$feedURL = $multisite->fixUrl($page->rootParent->httpUrl);

$xml = new DOMDocument();
$xml->formatOutput = true;

$root = $xml->appendChild($xml->createElement('rss'));
$root->setAttribute('xmlns:itunes', 'http://www.itunes.com/dtds/podcast-1.0.dtd');
$root->setAttribute('xmlns:media', 'http://search.yahoo.com/mrss/');
$root->setAttribute('xmlns:feedburner', 'http://rssnamespace.org/feedburner/ext/1.0');
$root->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
$root->setAttribute('version', '2.0');

$channel = $root->appendChild($xml->createElement('channel'));

$channel->appendChild($xml->createElement('title', $page->title));
$channel->appendChild($xml->createElement('description', $page->getUnformatted('summary')));
$channel->appendChild($xml->createElement('link', $feedURL));
//$channel->appendChild($xml->createElement('language', $page->feed_language));
$channel->appendChild($xml->createElement('generator', 'feedraptor'));
$channel->appendChild($xml->createElement('docs', 'http://cyber.law.harvard.edu/rss/rss.html'));
$self = $channel->appendChild($xml->createElement('atom:link'));
$self->setAttribute('href', $multisite->fixUrl($page->httpUrl));
$self->setAttribute('rel', 'self');
$self->setAttribute('type', 'application/rss+xml');

if ($page->language) {
	$channel->appendChild($xml->createElement('language', $page->language));
}

// itunes
$channel->appendChild($xml->createElement('itunes:summary', $page->summary));
$channel->appendChild($xml->createElement('itunes:author', $page->author));
$channel->appendChild($xml->createElement('itunes:explicit', $page->explicit ? 'yes' : 'no'));
$categories = explode("\n", $page->itunes_category);
$previous = null;

foreach ($categories as $category) {
	if(substr($category, 0, 1) == " " && $previous) {
		$element = $previous->appendChild($xml->createElement('itunes:category'));
		$text = substr($category, 1);
	} else {
		$previous = $element = $channel->appendChild($xml->createElement('itunes:category'));
		$text = $category;
	}
	$element->setAttribute('text', $text);
}

if ($page->itunes_owner_name || $page->itunes_owner_email) {
	$owner = $channel->appendChild($xml->createElement('itunes:owner'));
	if ($page->itunes_owner_name) {
		$owner->appendChild($xml->createElement('itunes:name', $page->itunes_owner_name));
	}
	if ($page->itunes_owner_email) {
		$owner->appendChild($xml->createElement('itunes:email', $page->itunes_owner_email));
	}
}

if($page->image) {
	$image = $page->image->size(3000, 3000, [
		'upscaling' => false,
		'cropping' => false,
	]);

	$imageEl = $channel->appendChild($xml->createElement('image'));
	$imageEl->appendChild($xml->createElement('url', $image->httpUrl));
	$imageEl->appendChild($xml->createElement('title', $page->title));
	$imageEl->appendChild($xml->createElement('link', $feedURL));

	$ITimageEl = $channel->appendChild($xml->createElement('itunes:image'));
	$ITimageEl->setAttribute('href', $image->httpUrl);
}

$selector = "parent={$page->episodes_collections},media.media_type={$page->media_type},sort=-release,limit={$page->per_page}";
$episodes = pages($selector);

foreach ($episodes as $episode) {
	$media = $episode->child("media_type={$page->media_type}");
	if (!$media) {
		continue;
	}

	$episodeUrl = $multisite->fixUrl($episode->httpUrl);

	// RSS 2.0
	$item = $channel->appendChild($xml->createElement('item'));
	$item->appendChild($xml->createElement('title', $episode->title));
	$item->appendChild($xml->createElement('link', $episodeUrl));
	$item->appendChild($xml->createElement('description', $episode->summary));

	$guidNode = $xml->createElement('guid', $episodeUrl);
	if ($episode->guid) {
		$guidNode->nodeValue = $episode->guid;
		$guidNode->setAttribute('isPermaLink', false);
	} else {
		$guidNode->nodeValue = $episodeUrl;
	}
	$item->appendChild($guidNode);

	$item->appendChild($xml->createElement('pubDate', Carbon::createFromTimestamp($episode->getUnformatted('release'))->toRssString()));

	// Media
	$enclosure = $item->appendChild($xml->createElement('enclosure'));
	$enclosure->setAttribute('url', $media->href);
	if ($media->size) {
		$enclosure->setAttribute('length', $media->size);
	}
	$enclosure->setAttribute('type', $media->mime ?: $media->media_type->mime);

	$enclosure = $item->appendChild($xml->createElement('media:content'));
	$enclosure->setAttribute('url', $media->href);
	if ($media->size) {
		$enclosure->setAttribute('fileSize', $media->size);
	}
	$enclosure->setAttribute('type', $media->mime ?: $media->media_type->mime);

	// iTunes
	$item->appendChild($xml->createElement('itunes:summary', $episode->summary));
	if ($episode->explicit) {
		$item->appendChild($xml->createElement('itunes:explicit', 'yes'));
	}
}

header('Content-Type: application/xml');

echo $xml->saveXML();
