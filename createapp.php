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
	<title>Add app</title>
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
	<div id="createAppHeader" class="header">
		<h2>Admin - Add app</h2>
	</div>
	
	<nav><ul>
			<li><a class="nav-a" href="home.php">Users</a></li>
			<li><a class="nav-a" href="viewapps.php">Apps</a></li>
			<li><a class="nav-a" href="createuser.php">Add Users</a></li>
			<li><a class="nav-a" href="createapp.php">Add Apps</a></li>
			<li><a class="nav-a" href="createapp.php?logout='1'" style="color: red;"><b>Log Out</b></a></li>
			<li><a class="nav-a" href="edituser.php">
				<img src="images/edit_icon.png" width="25px" height="25px">
			</a></li>
	</ul></nav>
	
	<form id="createAppForm" method="post" action="createapp.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label><b>Name</b></label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label><b>Photo</b></label>
			<input type="text" name="photo" value="<?php echo $photo; ?>">
		</div>
		<div class="input-group">
			<label><b>Description</b></label>
			<input type="textarea" name="description" value="<?php echo $description; ?>">
		</div>
		<div class="input-group">
			<label><b>Download link</b></label>
			<input type="text" name="link" value="<?php echo $link; ?>">
		</div>
		<div class="input-group">
			<label><b>Category</b></label>
			<input type="text" name="category" value="<?php echo $category; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="app_btn">Add App</button>
		</div>
	</form>
</body>
</html>