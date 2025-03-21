<?php
function increaseEnthusiasm($string): string
{
    return $string . "!";
}
echo increaseEnthusiasm("Wow"), "\n";

function repeatThreeTimes($string): string
{
    return $string . $string . $string;
}
echo repeatThreeTimes("Ha"), "\n";

echo increaseEnthusiasm(repeatThreeTimes(".exe")), "\n";

function cut($string, $length = 10): string
{
    return substr($string, 0, $length);
}

echo cut("Wise men say only fools rush in"), "\n";

function printArrayRecursively(array $array): void {
    if(empty($array)) {
        return;
    }

    echo array_shift($array), "\n";
    printArrayRecursively($array);
}
printArrayRecursively([1,2,3,4,5,6,7,8,9]);
echo "\n";

function sumDigitsOfNumber(int $number): int {
    while ($number > 9) {
        $number = array_sum(str_split((string) $number));
    }
    return $number;
}
echo sumDigitsOfNumber(555), "\n";