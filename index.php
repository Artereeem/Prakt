<?php 
header('Content-Type: text/html; charset=utf-8');
include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Киносайт</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
            background: #f0f0f0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        .nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
        }
        .film-list {
            max-width: 600px;
            margin: 0 auto;
        }
        .film-year {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h1>Добро пожаловать на киносайт</h1>
        </div>
        
        <div class="nav">
            <a href="index.php">Главная</a>
            <a href="films.php">Фильмы</a>
            <a href="series.php">Сериалы</a>
            <a href="genres.php">Жанры</a>
        </div>
        
        <div class="content">
            <h2>Новые фильмы</h2>
            <?php
            $sql = "SELECT TOP 3 * FROM [Films] ORDER BY [Yeare] DESC";
            $result = executeQuery($sql);
            
            while ($row = odbc_fetch_array($result)) {
                // Конвертация кодировки для русских символов
                $title = mb_convert_encoding($row['Nazvanie'], 'UTF-8', 'UTF-16LE');
                $year = $row['Yeare'];
                $poster = mb_convert_encoding($row['Poster'], 'UTF-8', 'UTF-16LE');
                $rating = $row['Rating'];
                $id = $row['Kode'];

                echo '<div class="item">';
                echo '<h3>'.$row['Nazvanie'].' ('.$row['Yeare'].')</h3>';
                echo '<img src="images/'.$row['Poster'].'" alt="'.$row['Nazvanie'].'">';
                echo '<p>Рейтинг: '.$row['Rating'].'</p>';
                echo '<a href="film_details.php?id='.$row['Kode'].'">Подробнее</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>