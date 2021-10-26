<?php 
	include('functions.php'); 

	if (isLoggedIn()) {
		if(isAdmin()){
			header('location: home.php');
		}else
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="styles/inputstyle.css">
</head>
<body>

	<div id="loginHeader" class="header" style>
		<h2>Login</h2>
	</div>

	<form id="logInForm" method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a class="sign" href="register.php">Sign up</a>
		</p>
	</form>


</body>
</html>