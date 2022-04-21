<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../style/login.css/">
</head>
<body>
<?php
require('config.php');
session_start();

if (isset($_POST['email'])){
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `client` WHERE email='$email' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query);
	$rows = mysqli_num_rows($result);
	if($rows==1){
	    $_SESSION['email'] = $email;
	    header("Location: ../index.php");
	}else{
		$message = "Le email ou le mot de passe est incorrect.";
	}
}
?>
<form class="box" action="" method="post" name="login">
<div class="container">
	<div class="brand-logo"></div>
	<div class="brand-title"></div>
	<div class="inputs">
		<label>EMAIL</label>
		<input type="email" class="box-input" name="email" placeholder="example@test.com">
		<label>PASSWORD</label>
		<input type="password" class="box-input" name="password" placeholder="Mot de passe">
		<button type="submit">LOGIN</button>
	</div>
	<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
</div>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>

