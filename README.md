# Test-task

Questioner: Traffic Mate LTD

# Task description

Implement a sample URL parser in PHP without the use of any built-it function.
The output of the parser need to return same of more information about the URL as the built-in function "parse_url" (https://www.php.net/manual/en/function.parse-url.php)

# Solution description

PHP's parse_url doesn't follow RFC3986 (https://tools.ietf.org/html/rfc3986), but I made my function "exactly the same as in PHP".
You can see it's code in myParseUrl.php file.

Uuups, list of used built-in functions:
* empty
* strpos
* substr
* str_split
* ctype_alnum
* in_array
* strrpos
* ctype_digit

I thought "we a not crazy to implement it too". But if you need, and if you think it is very important - just say me about that, and I will implement they too in next commit.

# How to use?

You can read code from myParseUrl.php file, or
```
git clone git@github.com:Mapteg34/traffic-mate-parser.git
cd traffic-mate-parser
php -f test.php
```