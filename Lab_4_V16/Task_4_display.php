<?php
session_start();

if (!isset($_SESSION['team'])) {
    header('Location: Task_4_form.php');
    exit;
}

$team = $_SESSION['team'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Данные команды</title>
</head>
<body>
<h2>Сохранённые данные:</h2>

<p>Название: <?= $team['name'] ?></p>
<p>Вид спорта: <?= $team['sport'] ?></p>
<p>Игроков: <?= $team['players'] ?></p>

<a href="Task_4_form.php">Назад</a>
</body>
</html>