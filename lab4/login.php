<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
	<div class="container mlogin">
		<div id="login">
			<h1>Login</h1>
			<form action="" id="loginform" method="post"name="loginform">
				<p><label for="user_login">Username<br>
					<input class="input" id="username" name="username"size="20"
					type="text" value=""></label></p>
					<p><label for="user_pass">Password<br>
						<input class="input" id="password" name="password"size="20"
						type="password" value=""></label></p> 
						<p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
						<p class="regtext">Do not registered?<a href= "register.php">Registration</a>!</p>
					</form>
				</div>
			</div>
			<?php
	session_start();
	?>

	<?php require_once("includes/connection.php"); ?>
	<?php include("includes/header.php"); ?>	 
	<?php
	
	if(isset($_SESSION["session_username"])){
	
	header("Location: intropage.php");
	}

	if(isset($_POST["login"])){

	if(!empty($_POST['username']) && !empty($_POST['password'])) {
	$username=htmlspecialchars($_POST['username']);
	$password=htmlspecialchars($_POST['password']);
	$query =mysqli_query($con, "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
 {
while($row=mysqli_fetch_assoc($query))
 {
	$dbusername=$row['username'];
  $dbpassword=$row['password'];
 }
  if($username == $dbusername && $password == $dbpassword)
 {
	// старое место расположения
	//  session_start();
	 $_SESSION['session_username']=$username;	 
 /* Перенаправление браузера */
   header("Location: intropage.php");
	}
	} else {
	//  $message = "Invalid username or password!";
	
	echo  "Invalid username or password!";
 }
	} else {
    $message = "All fields are required!";
	}
	}
	?>


			<?php include("includes/footer.php"); ?>
		