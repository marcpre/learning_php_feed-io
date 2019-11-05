<?php
require 'vendor/autoload.php';

use FeedIo\FeedIo;

// create a simple FeedIo instance
$feedIo = \FeedIo\Factory::create()->getFeedIo();

// read a feed
$url = 'https://www.reddit.com/r/worldnews/top.rss?t=day';
$result = $feedIo->read($url);

// get title
$feedTitle = $result->getFeed()->getTitle();

// iterate through items
$html = "";
$html .= "<ul>";
$i = 0;
foreach ($result->getFeed() as $item) {
    $i++;
    $title = $item->getTitle();
    $desc = $item->getDescription();
    preg_match_all('/<a(?=\s)(?=(?:[^>"\']|"[^"]*"|\'[^\']*\')*?\shref\s*=\s*(?:([\'"])((?:(?!\1|reddit\.com)[\S\s])+)\1))\s+(?:"[\S\s]*?"|\'[\S\s]*?\'|[^>]*?)+>/', $desc, $link);
    $parsedUrl = parse_url($link[2][0]);
    $root = $parsedUrl['host'];
    $html .= "<li>" . $title . " (Source: <a href=' " . $link[2][0] . " ' target='_blank' > " . $root . "</a>)</li>";
    if ($i > 5) break;
}

$html .= "</ul>";

print_r($html);
