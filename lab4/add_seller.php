<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "detailshop");

function getManagerOptions()
{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT id, man_name FROM manager";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;

    return $options;
}

function addSeller($sellerName, $sellerPos, $sellerSalary, $manId)
{
    try {
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO seller (seller_name, seller_pos, seller_salary, man_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$sellerName, $sellerPos, $sellerSalary, $manId]);

        echo "Seller added successfully!";
        header("Location: sellers.php");
        exit();
    } catch (PDOException $e) {
        die("Error adding seller: " . $e->getMessage());
    } finally {
        $pdo = null;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sellerName = $_POST["seller_name"];
    $sellerPos = $_POST["seller_pos"];
    $sellerSalary = $_POST["seller_salary"];
    $manId = $_POST["man_id"];

    addSeller($sellerName, $sellerPos, $sellerSalary, $manId);
}

// Get manager options for dropdown
$managerOptions = getManagerOptions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Shop - Add Seller</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <!-- Add any additional styles if needed -->

    <style>
        body {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
            width: 250px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <!-- Your existing navigation menu -->
    </nav>

    <div>
        <!-- Your existing content -->
    </div>

    <h1>Detail Shop - Add Seller</h1>

    <form method="post" action="">
        <label for="seller_name">Seller Name:</label>
        <input type="text" name="seller_name" required><br>

        <label for="seller_pos">Seller Position:</label>
        <input type="text" name="seller_pos" required><br>

        <label for="seller_salary">Seller Salary:</label>
        <input type="number" name="seller_salary" required><br>

        <label for="man_id">Manager:</label>
        <select name="man_id" required>
            <?php foreach ($managerOptions as $manager): ?>
                <option value="<?php echo $manager['id']; ?>"><?php echo $manager['man_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Add Seller">
    </form>
</body>
</html>
