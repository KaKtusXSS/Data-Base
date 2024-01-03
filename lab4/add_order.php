<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "detailshop");

function addOrder($clientID, $sellerID, $orderDate)
{
    try {
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO orders (client_id, seller_id, order_date) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$clientID, $sellerID, $orderDate]);

        echo "Order added successfully!";
        header("Location: orders.php");
        exit();
    } catch (PDOException $e) {
        die("Error adding order: " . $e->getMessage());
    } finally {
        $pdo = null;
    }
}

function getDropdownOptions($tableName, $idColumn, $nameColumn)
{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT $idColumn, $nameColumn FROM $tableName";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;

    return $options;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $clientID = $_POST["client_id"];
    $sellerID = $_POST["seller_id"];
    $orderDate = $_POST["order_date"];

    addOrder($clientID, $sellerID, $orderDate);
}

// Get client and seller options for dropdowns
$clientOptions = getDropdownOptions('client', 'id', 'client_name');
$sellerOptions = getDropdownOptions('seller', 'id', 'seller_name');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Shop - Add Order</title>
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

    <h1>Detail Shop - Add Order</h1>

    <form method="post" action="">
        <label for="client_id">Client:</label>
        <select name="client_id" required>
            <?php foreach ($clientOptions as $client): ?>
                <option value="<?php echo $client['id']; ?>"><?php echo $client['client_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="seller_id">Seller:</label>
        <select name="seller_id" required>
            <?php foreach ($sellerOptions as $seller): ?>
                <option value="<?php echo $seller['id']; ?>"><?php echo $seller['seller_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="order_date">Order Date:</label>
        <input type="text" name="order_date" id="order_date" required>

        <input type="submit" value="Add Order">
    </form>

    <!-- Include jQuery UI date picker script -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#order_date").datepicker();
        });
    </script>
</body>
</html>
