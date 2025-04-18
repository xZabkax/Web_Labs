<?php
$categories = ['Продукты_питания', 'Напитки', 'Деликатесы'];
foreach ($categories as $category) {
    if (!is_dir($category)) {
        mkdir($category, 0755, true);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $category = $_POST['category'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    $isValid = filter_var($email, FILTER_VALIDATE_EMAIL)
        && in_array($category, $categories)
        && !empty($title)
        && !empty($content);

    if ($isValid) {
        $filename = preg_replace('/[^a-zA-Zа-яА-Я0-9_\-]/u', '_', $title);
        $filename = substr($filename, 0, 50) . '.txt';
        $filepath = "$category/$filename";

        if (!file_exists($filepath)) {
            $handle = fopen($filepath, 'w');
            if ($handle) {
                fwrite($handle, $content);
                fclose($handle);
                $message = 'Объявление успешно добавлено!';
            } else {
                $error = 'Ошибка создания файла';
            }
        } else {
            $error = 'Объявление с таким заголовком уже существует';
        }
    } else {
        $error = 'Пожалуйста, заполните все поля корректно';
    }
}

$ads = [];
foreach ($categories as $category) {
    $dir = opendir($category);
    if ($dir) {
        while (($file = readdir($dir)) !== false) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
                $filepath = "$category/$file";

                $content = '';
                $handle = fopen($filepath, 'r');
                if ($handle) {
                    while (!feof($handle)) {
                        $content .= fgets($handle);
                    }
                    fclose($handle);
                }

                $ads[] = [
                    'category' => $category,
                    'title' => pathinfo($file, PATHINFO_FILENAME),
                    'content' => $content,
                    'created' => date("Y-m-d H:i:s", filemtime($filepath))
                ];
            }
        }
        closedir($dir);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доска объявлений</title>
    <style>
        .container { max-width: 800px; margin: 20px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
<div class="container">
    <h1>Добавить объявление</h1>

    <?php if(isset($message)): ?>
        <div style="color: green;"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
        <div style="color: red;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Категория:</label>
            <select name="category" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>">
                        <?= str_replace('_', ' ', htmlspecialchars($cat)) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Заголовок:</label>
            <input type="text" name="title" required maxlength="50">
        </div>

        <div class="form-group">
            <label>Текст объявления:</label>
            <textarea name="content" rows="4" required></textarea>
        </div>

        <button type="submit">Добавить</button>
    </form>

    <h2>Список объявлений</h2>
    <?php if(!empty($ads)): ?>
        <table>
            <thead>
            <tr>
                <th>Категория</th>
                <th>Заголовок</th>
                <th>Содержание</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><?= str_replace('_', ' ', htmlspecialchars($ad['category'])) ?></td>
                    <td><?= htmlspecialchars($ad['title']) ?></td>
                    <td><?= nl2br(htmlspecialchars($ad['content'])) ?></td>
                    <td><?= htmlspecialchars($ad['created']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет объявлений</p>
    <?php endif; ?>
</div>
</body>
</html>