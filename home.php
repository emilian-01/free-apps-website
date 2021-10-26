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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	 <meta name="referrer" content="no-referrer" >
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
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	
	<nav><ul>
			<li><a class="nav-a" href="home.php">Users</a></li>
			<li><a class="nav-a" href="viewapps.php">Apps</a></li>
			<li><a class="nav-a" href="createuser.php">Add Users</a></li>
			<li><a class="nav-a" href="createapp.php">Add Apps</a></li>
			<li><a class="nav-a" href="home.php?logout='1'" style="color: red;"><b>Log Out</b></a></li>
			<li><a class="nav-a" href="edituser.php">
				<img src="images/edit_icon.png" width="25px" height="25px">
			</a></li>
	</ul></nav>
	
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<form id="search-form">
		<div class="profile_info">
			<img src="images/admin_profile.jfif"  >

		<strong><?php echo $_SESSION['user']['name']; ?>
				<?php echo $_SESSION['user']['surname']; ?></strong>&nbsp;&nbsp;&nbsp;
				<br>
				
			
				<small>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['usertype']); ?>)</i> 
					&nbsp;<a href="index.php?logout='1'" 
					style="color: red; text-decoration: none;"><b>Log Out</b></a>
				</small>
				</div>
				</form>
		<?php showUsers(); ?>


	</div>
		
</body>
</html>