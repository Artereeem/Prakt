<?php
header('Content-Type: text/html; charset=utf-8');
// Настройки подключения к базе данных Access
$dbPath = "F:\OpenServer\domains\DarthAmd\блаблаблаблабла.accdb"; // или .mdb

// // Создание строки подключения
$connStr = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=" . realpath($dbPath);

//  $dsn = "DSN=KinoDB;";


// Попытка подключения
try {
    $conn = odbc_connect("KinoDB", "","");
    
    if (!$conn) 
    {
        throw new Exception("Ошибка подключения: " . odbc_errormsg());
    }
} catch (Exception $e) 
{
    die($e->getMessage());
}

// Функция для выполнения SQL-запросов
function executeQuery($sql) {
    global $conn;
    $result = odbc_exec($conn, $sql);
    if (!$result) {
        die("Ошибка выполнения запроса: " . odbc_errormsg());
    }
    return $result;
}


?>