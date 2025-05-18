<?php
$db = new mysqli('db', 'root', 'helloworld', 'web');
if ($db->connect_error) die("Ошибка подключения: " . $db->connect_error);

if ($_POST) {
    extract(array_map([$db, 'real_escape_string'], $_POST), EXTR_SKIP);
    $db->query("INSERT INTO ad (email, title, description, category) VALUES ('$email','$title','$description','$category')");
}

$ads = $db->query('SELECT * FROM ad ORDER BY created DESC')->fetch_all(MYSQLI_ASSOC);
$db->close();
?>

<!DOCTYPE html>
<html>
<head><title>Доска</title></head>
<body>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Заголовок: <input type="text" name="title" required><br>
    Категория:
    <select name="category" required>
        <option>computers</option>
        <option>phones</option>
        <option>phototechnique</option>
    </select><br>
    Описание: <textarea name="description" required></textarea><br>
    <button>Добавить</button>
</form>

<h3>Объявления:</h3>
<table border="1">
    <tr><th>Email</th><th>Заголовок</th><th>Описание</th><th>Категория</th></tr>
    <?php foreach ($ads as $a): ?>
        <tr>
            <td><?=$a['email']?></td>
            <td><?=$a['title']?></td>
            <td><?=$a['description']?></td>
            <td><?=$a['category']?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>