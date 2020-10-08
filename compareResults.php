<?php

function compareResults(string $url, $phpResult, $myResult): void
{
    if ($phpResult === false && $myResult !== false) {
        echo $url . PHP_EOL;
        echo 'phpResult false, myResult array'.PHP_EOL;

        return;
    }

    if ($phpResult !== false && $myResult === false) {
        echo $url . PHP_EOL;
        echo 'phpResult array, myResult false'.PHP_EOL;

        return;
    }

    if ($phpResult !== false && $myResult !== false && ! empty($diff = array_diff($phpResult, $myResult))) {
        echo $url . PHP_EOL;
        var_dump($diff);

        return;
    }
}
