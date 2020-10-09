<?php

include_once 'compareResults.php';
include_once 'myParseUrl.php';
include_once 'generateUrls.php';

$urls = generateUrls();

printf('Prepared %d urls' . PHP_EOL, count($urls));

foreach ($urls as $url) {
    compareResults($url, parse_url($url), myParseUrl($url));
}

echo 'Check finished'.PHP_EOL;
