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


$query = "SELECT id, detail_name, detail_type, detail_price FROM detail";

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
    <title>Detail Shop - Details</title>
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
            <li><a href="orders.php">Orders</a></li>
            <li><a href="managers.php">Managers</a></li>
            <li><a href="sellers.php">Sellers</a></li>
        </ul>
    </nav>

    <div>
    </div>

    <h1>Detail Shop - Details</h1>

    <!-- Вывод результатов из базы данных -->
    <table border='1'>
        <tr>
            <th>Detail name</th>
            <th>Detail type</th>
            <th>Price</th>
        </tr>

        <?php foreach ($result as $row): ?>
            <tr>
                <td style="display: none;"><?php echo $row['id']; ?></td>
                <td><?php echo $row['detail_name']; ?></td>
                <td><?php echo $row['detail_type']; ?></td>
                <td><?php echo $row['detail_price']; ?></td>
                <td>
                <a href="edit_detail.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_detail.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this detail?')">Delete</a>
            </td>
            </tr>
        <?php endforeach; ?>

    </table>
 <a href="add_detail.php" class="add-detail-button">Додати деталь</a>
    <!-- Здесь вы можете добавить остальное содержимое вашей страницы -->

</body>
</html>


