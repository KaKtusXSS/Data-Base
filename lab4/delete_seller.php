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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["seller_id"])) {
    
    $seller_id = $_GET["seller_id"];

    try {
       
        $query = "DELETE FROM seller WHERE id = :seller_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':seller_id', $seller_id);
        $stmt->execute();

        header("Location: managers.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Seller - Detail Shop</title>
</head>
<body>
    <!-- You can add content here if needed -->
</body>
</html>
