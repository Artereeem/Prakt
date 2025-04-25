<?php 
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT фильмы.*, жанр.название as жанр_название 
        FROM фильмы 
        LEFT JOIN жанр ON фильмы.жанр = жанр.код
        WHERE фильмы.код = $id";
$result = executeQuery($sql);
$film = odbc_fetch_array($result);

if (!$film) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $film['название']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .film-header { text-align: center; margin-bottom: 20px; }
        .film-poster { float: left; margin-right: 20px; max-width: 300px; }
        .film-info { overflow: hidden; }
        .trailer { margin-top: 20px; clear: both; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="index.php">Главная</a>
            <a href="films.php">Фильмы</a>
        </div>
        
        <div class="film-header">
            <h1><?php echo $film['название']; ?> (<?php echo $film['год']; ?>)</h1>
        </div>
        
        <div class="film-content">
            <img class="film-poster" src="images/<?php echo $film['постер']; ?>" alt="<?php echo $film['название']; ?>">
            
            <div class="film-info">
                <p><strong>Жанр:</strong> <?php echo $film['жанр_название']; ?></p>
                <p><strong>Рейтинг:</strong> <?php echo $film['рейтинг']; ?></p>
                <p><strong>Описание:</strong> <?php echo $film['описание']; ?></p>
            </div>
            
            <div class="trailer">
                <h2>Трейлер</h2>
                <iframe width="560" height="315" src="<?php echo $film['трейлер']; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</body>
</html>