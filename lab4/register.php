<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<div class="container mregister">
    <div id="login">
        <h1>Registration</h1>
        <form action="register.php" id="registerform" method="post" name="registerform">
            <p><label for="user_login">Full name<br>
                    <input class="input" id="full_name" name="full_name" size="32" type="text" value=""></label></p>
            <p><label for="user_pass">E-mail<br>
                    <input class="input" id="email" name="email" size="32" type="text"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"></label>
                <?php if (isset($_POST["register"]) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    echo "<p class='error center-text'>Invalid email format</p>";
                } ?>
            </p>
            <p><label for="user_pass">Username<br>
                    <input class="input" id="username" name="username" size="20" type="text"
                           value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"></label>
            </p>
            <p><label for="user_pass">Password<br>
                    <input class="input" id="password" name="password" size="32" type="password"
                           value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>"></label>
            </p>
            <p class="submit"><input class="button" id="register" name="register" type="submit"
                                     value="Register"></p>
            <p class="regtext">Already registered? <a href="login.php">Enter username</a>!</p>
        </form>
    </div>
</div>

<?php
if (isset($_POST["register"])) {
    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $full_name = htmlspecialchars($_POST['full_name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
        $username = $_POST['username'];
        $password = htmlspecialchars($_POST['password']);

        $query = mysqli_query($con, "SELECT * FROM users WHERE username='" . $username . "'");
        $numrows = mysqli_num_rows($query);

        if ($numrows == 0) {
            $sql = "INSERT INTO users (full_name, email, username, password) VALUES('$full_name', '$email', '$username', '$password')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $message = "Account Successfully Created";
            } else {
                $message = "Failed to insert data information!";
            }
        } else {
            $message = "That username already exists! Please try another one!";
        }
    } else {
        $message = "All fields are required or invalid email format!";
    }
}
?>

<?php if (!empty($message)) {
    echo "<p class='error'>" . "MESSAGE: " . $message . "</p>";
} ?>

<?php include("includes/footer.php"); ?>
