<?php

function generateUrls(): array
{
    $urls = [
        'host',
        'host.com',
        'sub.host.com',
        'https://sub.host.com',
        'http://sub.host.com',
        'http://sub.host.com:80',
        'http://user@sub.host.com',
        'http://pass@sub.host.com',
        'http://pass:password@sub.host.com',
        'http://pass:password@sub.host.com:80',
        'http://pass:password@sub.host.com:80/',
        'http://pass:password@sub.host.com:80/#anchor',
        'http://pass:password@sub.host.com:80/folder#anchor',
        'http://pass:password@sub.host.com:80/folder/folder#anchor',
        'http://pass:password@sub.host.com:80/folder/folder/script.php#anchor',
        'http://pass:password@sub.host.com:80/folder/folder/script.php?first=value&second=value#anchor',
        'http://pass:password@sub.host.com:80/#folder/folder/script.php?first=value&second=value#anchor',
    ];

    $baseSymbols = ['a', '#', '?', ':', '@', '/'];

    function makeRecursive($baseSymbols, $maxDepth, $str = ''): array
    {
        $urls = [$str];
        if (strlen($str) < $maxDepth) {
            foreach ($baseSymbols as $symbol) {
                $newStr = $str . $symbol;
                $urls   = array_merge($urls, makeRecursive($baseSymbols, $maxDepth, $newStr));
            }
        }

        return $urls;
    }

    $urls = array_merge($urls, makeRecursive(['a', '#', '?', ':', '@', '/'], 7));

    return $urls;
}
