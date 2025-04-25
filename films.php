<?php 
header('Content-Type: text/html; charset=utf-8');
include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Фильмы</title>
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
            <h1>Фильмы</h1>
        </div>
        
        <div class="nav">
            <a href="index.php">Главная</a>
            <a href="films.php">Фильмы</a>
            <a href="series.php">Сериалы</a>
            <a href="genres.php">Жанры</a>
        </div>
        
        <div class="content">
            <?php
            
            $dsn = "DSN=KinoDB;";
            $sql = "SELECT Films.*, Ganer.Nazvanie as Ganer_Nazvanie FROM Films LEFT JOIN Ganer ON Films.Ganer = Ganer.Kode ORDER BY Films.Yeare DESC";
            $result = executeQuery($sql);
            
            while ($row = odbc_fetch_array($result)) 
            {
                echo '<div class="item">';
                echo '<h3>'.$row['Nazvanie'].' ('.$row['Yeare'].')</h3>';
                echo '<img src="images/'.$row['постер'].'" alt="'.$row['Nazvanie'].'">';
                echo '<p>Ganer: '.$row['жанр_название'].'</p>';
                echo '<p>Рейтинг: '.$row['Rating'].'</p>';
                echo '<a href="film_details.php?id='.$row['Kode'].'">Подробнее</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>