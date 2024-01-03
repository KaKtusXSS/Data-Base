<?php
// Константи бази даних
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "detailshop");

// Создание подключения к базе данных
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Запрос к базе данных для получения информации из таблицы client
$query = "SELECT client_name, client_email, client_phone FROM client";

try {
    // Подготовка запроса
    $stmt = $pdo->prepare($query);

    // Выполнение запроса
    $stmt->execute();

    // Получение результатов
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Ошибка выполнения запроса: " . $e->getMessage());
}

// Закрытие подключения к базе данных
$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Shop - Clients</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
    <style>
        body {
            text-align: center;
        }

        h1 {
            margin-top: 50px; /* добавим отступ сверху для визуального центрирования */
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #f2f2f2;
            padding: 10px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 10px;
        }

        nav a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: orange;
            color: #333;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            width: 80%; /* установите ширину таблицы по вашему усмотрению */
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-client-button,
        .delete-client-button {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-client-button {
            background-color: #4CAF50;
            color: white;
        }

        
    </style>
</head>
<body>

    <h1>Detail Shop - Clients</h1>

    <nav>
        <ul>
            <li><a href="main_window.php">Main</a></li>
            <li><a href="details.php">Details</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="managers.php">Managers</a></li>
            <li><a href="sellers.php">Sellers</a></li>
        </ul>
    </nav>

    <!-- Вывод результатов из базы данных -->
   <table border='1'>
    <tr>
      <th>Name</th>
      <th>Email </th>
      <th>Phone</th>
    </tr>

    <?php foreach ($result as $row): ?>
      <tr>
        <td><?php echo $row['client_name']; ?></td>
        <td><?php echo $row['client_email']; ?></td>
        <td><?php echo $row['client_phone']; ?></td>
     
      </tr>
    <?php endforeach; ?>
  </table>
    <!-- Кнопка "Додати клієнта" -->
<a href="add_client.php" class="add-client-button">Додати клієнта</a>
    <!-- Здесь вы можете добавить остальное содержимое вашей страницы -->

</body>
</html>
