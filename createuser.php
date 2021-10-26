<?php 
	include('functions.php');
	
	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
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
		<h2>Admin - create user</h2>
	</div>
	
	<nav><ul>
			<li><a class="nav-a" href="home.php">Users</a></li>
			<li><a class="nav-a" href="viewapps.php">Apps</a></li>
			<li><a class="nav-a" href="createuser.php">Add Users</a></li>
			<li><a class="nav-a" href="createapp.php">Add Apps</a></li>
			<li><a class="nav-a" href="createuser.php?logout='1'" style="color: red;"><b>Log Out</b></a></li>
			<li><a class="nav-a" href="edituser.php">
				<img src="images/edit_icon.png" width="25px" height="25px">
			</a></li>
	</ul></nav>
	
	<form id="createUserForm" method="post" action="createuser.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label><b>Name</b></label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label><b>Surname</b></label>
			<input type="text" name="surname" value="<?php echo $surname; ?>">
		</div>
		<div class="input-group">
			<label><b>Username</b></label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label><b>Email</b></label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label><b>User type</b></label>
			<select name="usertype" id="usertype" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label><b>Password</b></label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label><b>Confirm password</b></label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn">Create user</button>
		</div>
	</form>
</body>
</html>