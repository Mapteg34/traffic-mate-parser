<?php

function myParseUrl(string $url)
{
    if (empty($url)) {
        return [
            'path' => '',
        ];
    }

    if ($url === ':' || $url === '//') {
        return false;
    }

    $result = [];

    if (($schemePos = strpos($url, ':')) !== false && $schemePos !== 0) {
        $schemeCandidate = substr($url, 0, $schemePos);
        $isOk            = true;
        foreach (str_split($schemeCandidate) as $char) {
            if (! ctype_alnum($char) && ! in_array($char, ['+', '-', '.'])) {
                $isOk = false;
                break;
            }
        }
        if ($isOk) {
            $result['scheme'] = $schemeCandidate;
            $url              = substr($url, $schemePos + 1);
        }
    }

    if (($numberSignPos = strpos($url, '#')) !== false) {
        $fragment = substr($url, $numberSignPos + 1);
        if (! empty($fragment)) {
            $result['fragment'] = $fragment;
        }
        $url = substr($url, 0, $numberSignPos);
    }

    if (($questionMarkPos = strpos($url, '?')) !== false) {
        $query = substr($url, $questionMarkPos + 1);
        if (! empty($query)) {
            $result['query'] = $query;
        }
        $url = substr($url, 0, $questionMarkPos);
    }

    if (substr($url, 0, 2) !== '//') {
        $result['path'] = $url;

        return $result;
    }

    $url = substr($url, 2);
    if (empty($url) || $url[0] === '/') {
        return false;
    }

    $authority = $url;

    if (($slashPos = strpos($url, '/')) !== false) {
        $authority      = substr($url, 0, $slashPos);
        $result['path'] = substr($url, $slashPos);
    }

    $atPos = strrpos($authority, '@');

    $hostPort = $atPos !== false ? substr($authority, $atPos + 1) : $authority;

    if (empty($hostPort)) {
        return false;
    }

    if (($colonPos = strrpos($hostPort, ':')) !== false) {
        if ($port = substr($hostPort, $colonPos + 1)) {
            if (! ctype_digit($port)) {
                return false;
            }
            $result['port'] = $port;
        }
        if (! ($host = substr($hostPort, 0, $colonPos))) {
            return false;
        }
        $result['host'] = $host;
    } else {
        $result['host'] = $hostPort;
    }

    if ($atPos !== false) {
        $userPass = substr($authority, 0, $atPos);
        if (($colonPos = strpos($userPass, ':')) !== false) {
            $result['user'] = substr($userPass, 0, $colonPos);
            $result['pass'] = substr($userPass, $colonPos + 1);
        } else {
            $result['user'] = $userPass;
        }
    }

    return $result;
}
