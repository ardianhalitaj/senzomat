<?php

require_once "config.php";
session_Start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['login']))
	{
		require 'login.php';
	}
	elseif(isset($_POST[register]))
	{
		require 'register.php';
	}

}
?>

<body>
	<section class="loginWrapper">
	<ul class="tabs">
		<li class="active">Login</li>
		<li>Register</li>
	</ul>
	<ul class="tab__content">
		<li class="active">
			<div class="content__wrapper">
				<form method="POST" action="pharmalogger.php">
					<input type="text" name="username" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
					<input type="submit" value="Login" name="login">
				</form>
			</div>
		</li>
		<li>
			<div class="content__wrapper">
				<form method="POST" action="pharmalogger.php">
					<input type="text" name="name" placeholder="Emri">
					<input type="text" name="surname" placeholder="Mbiemri">
					<input type="text" name="business_name" placeholder="Emri i biznesit">
					<input type="number" min="1" max="99999999" name="business_number" placeholder="Numri i biznesit">
					<input type="email" name="email" placeholder="E-mail">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      <?php echo $email_err; ?>
                    </small>
                    <input type="text" name="phone" placeholder="Numri i telefonit">
					<input type="text" name="username" placeholder="Username">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      <?php echo $username_err; ?>
                    </small>
					<input type="pass" name="password_1" placeholder="Password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      <?php echo $password_err; ?>
                    </small>
					<input type="repass" name="password_2" placeholder="Perserit password-in">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                      <?php echo $confirm_password_err; ?>
                    </small>
					<input type="submit" value="Register" name="register">
				</form>
			</div>
		</li>
	</ul>
</section>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/login.js"></script>
</body>
</html>