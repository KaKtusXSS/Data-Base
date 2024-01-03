<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "detailshop");

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    
    $detail_id = $_GET["id"];

    try {
       
        $query = "DELETE FROM detail WHERE id = :detail_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':detail_id', $detail_id);
        $stmt->execute();

        
        header("Location: details.php");
        exit();

    } catch (PDOException $e) {
        die("Ошибка выполнения запроса: " . $e->getMessage());
    }
}

$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Delete Detail - Detail Shop</title>
</head>
<body>
 
</body>
</html>
