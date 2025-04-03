<?php
$str = 'a1b2c3';
$result = preg_replace_callback('/\d+/', function($matches) {
    return (string)((int)$matches[0] + 50);
}, $str);

echo $result;