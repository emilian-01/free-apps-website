<?php 
	include('functions.php');
	
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first!";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create user</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div id="createUserHeader" class="header">
		<a href="login.php"><img class="back" src="images/back.png" height="25px" width="25px"></a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<h2 class="back" >User - Edit Account</h2>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	
	<form id="createUserForm" method="post" action="edituser.php">

		<?php echo display_error(); ?>
		
		<div class="input-group">
			<label><b>Name</b></label>
			<input type="text" name="name" value="<?php echo $_SESSION['user']['name']; ?>">
		</div>
		<div class="input-group">
			<label><b>Surname</b></label>
			<input type="text" name="surname" value="<?php echo $_SESSION['user']['surname']; ?>">
		</div>
		<div class="input-group">
			<label><b>Username</b></label>
			<input disabled type="text" name="username" value="<?php echo $_SESSION['user']['username']; ?>">
		</div>
		<div class="input-group">
			<label><b>Email</b></label>
			<input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
		</div>
		<div class="input-group">
			<label><b>Old Password</b> - <span class="pass-info">Always enter the old password to verify!</span></label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label><b>New password</b> - <span class="pass-info">only if you wnat to update the password</span></label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="edituser_btn">Update user</button>
		</div>
	</form>
</body>
</html>