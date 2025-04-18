<?php
// Создание папок категорий при первом запуске
$categories = ['Продукты_питания', 'Напитки', 'Деликатесы'];
foreach ($categories as $category) {
    if (!is_dir($category)) {
        mkdir($category, 0755, true);
    }
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $category = $_POST['category'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    // Валидация данных
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && in_array($category, $categories) && !empty($title) && !empty($content)) {
        // Очистка названия файла
        $filename = preg_replace('/[^a-zA-Zа-яА-Я0-9_\-]/u', '_', $title);
        $filename = mb_substr($filename, 0, 50) . '.txt';

        // Сохранение файла
        $filepath = "$category/$filename";
        if (!file_exists($filepath)) {
            file_put_contents($filepath, $content);
            $message = 'Объявление успешно добавлено!';
        } else {
            $error = 'Объявление с таким заголовком уже существует';
        }
    } else {
        $error = 'Пожалуйста, заполните все поля корректно';
    }
}

// Получение списка объявлений
$ads = [];
foreach ($categories as $category) {
    $files = glob("$category/*.txt");
    foreach ($files as $file) {
        $ads[] = [
            'category' => $category,
            'title' => basename($file, '.txt'),
            'content' => file_get_contents($file),
            'created' => date("Y-m-d H:i:s", filemtime($file))
        ];
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
        <div style="color: green;"><?= $message ?></div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
        <div style="color: red;"><?= $error ?></div>
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
                    <option value="<?= $cat ?>"><?= str_replace('_', ' ', $cat) ?></option>
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
                    <td><?= str_replace('_', ' ', $ad['category']) ?></td>
                    <td><?= $ad['title'] ?></td>
                    <td><?= nl2br(htmlspecialchars($ad['content'])) ?></td>
                    <td><?= $ad['created'] ?></td>
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