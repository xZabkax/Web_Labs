<?php
$str = "php ptp ppp ptt rohp gfgp plp php";
preg_match_all("/\bp.p\b/", $str, $matches);
print_r($matches[0]);