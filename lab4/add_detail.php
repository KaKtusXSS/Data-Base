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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Обработка данных из формы
    $detail_name = $_POST["detail_name"];
    $detail_type = $_POST["detail_type"];
    $detail_price = $_POST["detail_price"];

    try {
        // Подготовка SQL-запроса
        $query = "INSERT INTO detail (detail_name, detail_type, detail_price) VALUES (:detail_name, :detail_type, :detail_price)";
        $stmt = $pdo->prepare($query);

        // Привязка параметров
        $stmt->bindParam(':detail_name', $detail_name);
        $stmt->bindParam(':detail_type', $detail_type);
        $stmt->bindParam(':detail_price', $detail_price);

        // Выполнение запроса
        $stmt->execute();

        // Редирект после успешного добавления
        header("Location: main_window.php");
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
    <title>Add Detail - Detail Shop</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 50px; /* Adjust as needed */
        }

        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px; /* Adjust as needed */
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            margin-bottom: 15px;
            border-radius: 5px;
            padding: 8px;
        }

        button {
            padding: 10px;
            background-color: orange; /* Set the background color to orange */
            color: white; /* Set the text color to white for better visibility */
            border: none; /* Remove the default button border */
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Форма для ввода данных -->
    <h1>Add Detail</h1>
    <form method="post" action="add_detail.php">
        <label for="detail_name">Detail Name:</label>
        <input type="text" name="detail_name" required><br>

        <label for="detail_type">Detail Type:</label>
        <input type="text" name="detail_type" required><br>

        <label for="detail_price">Detail Price:</label>
        <input type="number" name="detail_price" required><br>

        <button type="submit">Add Detail</button>
    </form>

    <!-- Дополнительное содержимое страницы -->

</body>
</html>
