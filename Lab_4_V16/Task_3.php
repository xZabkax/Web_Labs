<?php
if (isset($_SERVER['REQUEST_METHOD'])
    && $_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['text']))
{
    $text = $_POST['text'];
    $even = 0;
    $odd = 0;

    preg_match_all('/\b[\p{L}\'-]+\b/u', $text, $matches);

    foreach ($matches[0] as $word) {
        $length = strlen($word);
        ($length % 2 == 0) ? $even++ : $odd++;
    }

    echo "<h3>Результат:</h3>";
    echo "Слов с четным количеством букв: $even<br>";
    echo "Слов с нечетным количеством букв: $odd";
}
//Запускаем на локальном сервере
?>

<form method="post">
    <textarea name="text" placeholder="Введите текст..."><?=
        isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''
        ?></textarea>
    <br>
    <button type="submit">Посчитать</button>
</form>