<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['team'] = [
        'name' => htmlspecialchars($_POST['team_name']),
        'sport' => htmlspecialchars($_POST['sport_type']),
        'players' => (int)$_POST['player_count']
    ];
    header('Location: Task_4_display.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Форма команды</title>
</head>
<body>
<h2>Введите данные команды</h2>

<form method="post">
    <p>
        Название команды:<br>
        <input type="text" name="team_name" required>
    </p>

    <p>
        Вид спорта:<br>
        <select name="sport_type" required>
            <option value="">Выберите</option>
            <option>Футбол</option>
            <option>Хоккей</option>
            <option>Баскетбол</option>
        </select>
    </p>

    <p>
        Игроков:<br>
        <input type="number" name="player_count" min="1" required>
    </p>

    <button type="submit">Отправить</button>
</form>
</body>
</html>