<?php
// Константи бази даних
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "detailshop");

// Підключення до бази даних
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Перевірка підключення
if ($conn->connect_error) {
  die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// Обробка форми редагування клієнта
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Отримання даних з форми
  $client_id = $_POST["client_id"];
  $client_name = $_POST["client_name"];
  $client_adress = $_POST["client_adress"];
  $client_email = $_POST["client_email"];
  $client_phone = $_POST["client_phone"];

  // Підготовка SQL-запиту для оновлення даних
  $sql = "UPDATE client SET client_name='$client_name', client_adress='$client_adress', client_email='$client_email', client_phone='$client_phone' WHERE client_id='$client_id'";

  // Виконання SQL-запиту
  if ($conn->query($sql) === TRUE) {
    header("Location: clients.php"); // Перенаправлення на сторінку clients.php
    exit();
  } else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
  }
}

// Отримання даних клієнта
$id = $_GET["id"];
$sql = "SELECT * FROM client WHERE id='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Переберіть всі рядки результату
  while ($row = $result->fetch_assoc()) {
    $client_name = $row["client_name"];
    $client_adress = $row["client_adress"];
    $client_email = $row["client_email"];
    $client_phone = $row["client_phone"];
  }
} else {
  echo "Клієнт з таким ідентифікатором не знайдений";
}

// Закриття з'єднання з базою даних
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редагування клієнта</title>
  <link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
  <style>
    body {
      text-align: center;
    }

    form {
      display: inline-block;
      text-align: left;
      margin-top: 20px;
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

<h2>Редагування клієнта</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
  <label for="client_name">Ім'я клієнта:</label>
  <input type="text" name="client_name" value="<?php echo $client_name; ?>" required><br>

  <label for="client_adress">Адреса клієнта:</label>
  <input type="text" name="client_adress" value="<?php echo $client_adress; ?>" required><br>

  <label for="client_email">Електронна пошта клієнта:</label>
  <input type="email" name="client_email" value="<?php echo $client_email; ?>" required><br>

  <label for="client_phone">Телефон клієнта:</label>
  <input type="text" name="client_phone" value="<?php echo $client_phone; ?>" required><br>

  <input type="submit" value="Окей">
</form>
</body>
</html>
