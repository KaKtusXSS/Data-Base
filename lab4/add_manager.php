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
    // Process form data
    $man_name = $_POST["man_name"];
    $man_salary = $_POST["man_salary"];

    try {
        // Prepare SQL query
        $query = "INSERT INTO manager (man_name, man_salary) VALUES (:man_name, :man_salary)";
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':man_name', $man_name);
        $stmt->bindParam(':man_salary', $man_salary);

        // Execute the query
        $stmt->execute();

        // Redirect after successful addition
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
    <title>Add Manager - Detail Shop</title>
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
            margin-top: 50px;
        }

        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
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
            background-color: orange;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Form for entering data -->
    <h1>Add Manager</h1>
    <form method="post" action="add_manager.php">
        <label for="man_name">Manager Name:</label>
        <input type="text" name="man_name" required><br>

        <label for="man_salary">Manager Salary:</label>
        <input type="number" name="man_salary" required><br>

        <button type="submit">Add Manager</button>
    </form>

    <!-- Additional content of the page -->

</body>
</html>
