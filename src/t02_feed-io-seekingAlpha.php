<?php
require 'vendor/autoload.php';

use FeedIo\FeedIo;

// create a simple FeedIo instance
$feedIo = \FeedIo\Factory::create()->getFeedIo();

// read a feed
$url = 'https://www1.cbn.com/rss-cbn-news-finance.xml';
$result = $feedIo->read($url);

// iterate through items
$i = 0;
foreach ($result->getFeed() as $item) {
    $i++;
    $title = $item->getTitle();
    $desc = $item->getDescription();
    $parsedUrl = parse_url($item->getLink());
    $root = $parsedUrl['host'];
    echo "<li>" . $title . " (Source: <a href=' " . $item->getLink() . " ' target='_blank' > " . $root . "</a>)</li> \n";
    if ($i > 5) break;
}