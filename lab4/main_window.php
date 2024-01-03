<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Shop</title>
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
            background-color: #ddd;
            color: #333;
        }
    </style>
</head>
<body>

    <h1>Detail Shop</h1>

    <nav>
        <ul>
            <li><a href="clients.php">Clients</a></li>
            <li><a href="details.php">Details</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="managers.php">Managers</a></li>
            <li><a href="sellers.php">Sellers</a></li>
        </ul>
    </nav>

    <!-- Здесь вы можете добавить остальное содержимое вашей страницы -->

</body>
</html>
