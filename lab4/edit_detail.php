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
        
        $query = "SELECT id, detail_name, detail_type, detail_price FROM detail WHERE id = :detail_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':detail_id', $detail_id);
        $stmt->execute();

        // Получение данных о детали
        $detail = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Ошибка выполнения запроса: " . $e->getMessage());
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    
    $detail_id = $_POST["id"];
    $detail_name = $_POST["detail_name"];
    $detail_type = $_POST["detail_type"];
    $detail_price = $_POST["detail_price"];

    try {
        
        $query = "UPDATE detail SET detail_name = :detail_name, detail_type = :detail_type, detail_price = :detail_price WHERE id = :detail_id";
        $stmt = $pdo->prepare($query);

      
        $stmt->bindParam(':detail_id', $detail_id);
        $stmt->bindParam(':detail_name', $detail_name);
        $stmt->bindParam(':detail_type', $detail_type);
        $stmt->bindParam(':detail_price', $detail_price);

        
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
    <title>Edit Detail - Detail Shop</title>
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
            background-color: orange; 
            color: white; 
            border: none; 
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>


    <h1>Edit Detail</h1>
    <form method="post" action="edit_detail.php">
        <input type="hidden" name="id" value="<?php echo $detail["id"]; ?>">
        <label for="detail_name">Detail Name:</label>
        <input type="text" name="detail_name" value="<?php echo $detail["detail_name"]; ?>" required><br>

        <label for="detail_type">Detail Type:</label>
        <input type="text" name="detail_type" value="<?php echo $detail["detail_type"]; ?>" required><br>

        <label for="detail_price">Detail Price:</label>
        <input type="number" name="detail_price" value="<?php echo $detail["detail_price"]; ?>" required><br>

        <button type="submit">Save Changes</button>
    </form>


</body>
</html>
