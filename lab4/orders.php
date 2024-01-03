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

// Modified query to join the client and seller tables
$query = "SELECT o.id, c.client_name, s.seller_name, o.order_date
          FROM orders o
          LEFT JOIN client c ON o.client_id = c.id
          LEFT JOIN seller s ON o.seller_id = s.id";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка выполнения запроса: " . $e->getMessage());
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Shop - Orders</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
    <style>
        body {
            text-align: center;
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
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            width: 80%;
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

        h1 {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <nav>
        <ul>
            <li><a href="main_window.php">Main</a></li>
            <li><a href="clients.php">Clients</a></li>
            <li><a href="details.php">Details</a></li>
            <li><a href="managers.php">Managers</a></li>
            <li><a href="sellers.php">Sellers</a></li>
        </ul>
    </nav>

    <div>
    </div>

   <h1>Detail Shop - Orders</h1>

<table border='1'>
    <tr>
        <th>Ім'я клієнта</th>
        <th>Ім'я продавця</th>
        <th>Дата та час замовлення</th>
        <th>Дії</th>
    </tr>

    <?php foreach ($result as $row): ?>
        <tr>
            <!-- Hide the ID column -->
            <td style="display: none;"><?php echo $row['id']; ?></td>
            <td><?php echo $row['client_name']; ?></td>
            <td><?php echo $row['seller_name']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <!-- Add a delete button for each row -->
            <td>
                <a href="delete_order.php?order_id=<?php echo $row['id']; ?>" class="delete-button">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
<a href="add_order.php" class="add-order-button">Додати замовлення</a>
</body>
</html>


