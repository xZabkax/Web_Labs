<?php
echo "Работа с %\n";
$a = 10;
$b = 3;
echo "Остаток от деления a на b: ", $a % $b, "\n";

$a = 12;
$b = 4;

if ($a % $b == 0) {
    echo "a делится на b. Результат: ", $a / $b, "\n";
} else {
    echo "a делится на b с остатком. Результат: ", $a % $b, "\n";
}

echo "\nРабота со степенью и корнем\n";
$st = pow(2, 10);
$root = sqrt(245);

$array = array(4, 2, 5, 19, 13, 0, 10);
$sumRoots = 0;
foreach ($array as $value) {
    $sumRoots += $value**2;
}

echo "1) 2^10 = ", $st,
"\n2) sqrt(245) = ", $root,
"\n3) Корень из суммы квадратов элементов массива: ", sqrt($sumRoots), "\n";

echo "\nРабота с функциями округления\n";
$num1 = sqrt(379);
$sqrt0 = round($num1);
$sqrt1 = round($num1, 1);
$sqrt2 = round($num1, 2);

$num2 = sqrt(587);
$array1 = ['floor' => floor($num2), 'ceil' => ceil($num2)];

echo "Результаты округления корня из 379:\n",
"$sqrt0\n", "$sqrt1\n", "$sqrt2\n";
echo "Результат округления корня из 587 в меньшую и большую сторону: {$array1['floor']} и {$array1['ceil']}\n";

echo "\nРабота с min и max\n";
$array2 = [4, -2, 5, 19, -130, 0, 10];
echo "Минимальное число: ", min($array2),
"\nМаксимальное число: ", max($array2), "\n";

echo "\nРабота с рандомом\n";
echo rand(1, 100), "\n";

$array3 = [];
for ($i = 0; $i < 10; $i++) {
    $array3[$i] = rand(1, 100);
    echo $array3[$i], ' ';
}
echo "\n";

echo "\nРабота с модулем\n";
$a = 33;
$b = 77;
echo 'Модуль разности a и b: ', abs($a - $b), "\n";

$array4 = [1, 2, -1, -2, 3, -3];
for ($i = 0; $i < count($array4); $i++) {
    if ($array4[$i] < 0){
        $array4[$i] = abs($array4[$i]);
    }
    echo $array4[$i], ' ';
}

echo "\n\nОбщее\n";
$a = 30;

$arrayDivisor = [];
for ($d = 1; $d <= $a/2; $d++) {
    if ($a % $d == 0) {
        $arrayDivisor[] = $d;
    }
}

$arrayDivisor[] = $a;
echo "Делители числа {$a}:\n";
for ($i = 0; $i < count($arrayDivisor); $i++) {
    echo $arrayDivisor[$i], ' ';
}

$array5 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$sum = 0;
$count = 0;
foreach ($array5 as $value) {
    if ($sum <= 10) {
        $sum += $value;
        $count++;
    }
}
echo "\nЧтобы сумма получилась больше 10, надо сложить первые {$count} чисел.";