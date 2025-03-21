<?php
$temp1 = 777;
echo "{$temp1} - переменная int\n";

$temp2 = 199.999;
echo "{$temp2} - переменная float\n";

echo 4+4+4, " - раньше не встречалось в коде\n";

$last_month = 10000;
$this_month = 7850;
echo "В прошлом месяце я потратил {$last_month}, а в этом месяце я потратил {$this_month}\nВ прошлом месяце я потратил больше на ", $last_month-$this_month, ", чем в этом месяце.";
