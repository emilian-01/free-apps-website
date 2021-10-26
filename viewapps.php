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
	<title>Admin - Home</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/opt-select-style.css">
	<meta name="referrer" content="no-referrer" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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
			<li><a class="nav-a" href="viewapps.php?logout='1'" style="color: red;"><b>Log Out</b></a></li>
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
		<form id="search-form" method="post" action="home.php">
		<div class="profile_info">
			<img src="images/admin_profile.jfif"  >
			<div id="edit-div" >
			<strong><?php echo $_SESSION['user']['name']; ?>
				<?php echo $_SESSION['user']['surname']; ?>
				</strong>&nbsp;&nbsp;&nbsp;
				<br>
				<small>
					<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['usertype']); ?>)</i> 
					&nbsp;<a href="index.php?logout='1'" 
					style="color: red; text-decoration: none;"><b>Log Out</b></a>
				</small>
				</div>
				
				<label style="margin-left: 100px;">Search: </label>
				<div id="search-div" >
					<input name="search_in" id="search-input" type='text'>
					
				</div>
				<div>
					<button type="submit" id="search-btn" name="serch_btn">
						<img id="search-img" src="images/search-icon.png" >
					</button>
				</div>
		</div>
		<div class="custom-select" style="width:200px;" >
		<select name="select-category">
			<option selected value="Categories">Categories</option>
			<option value="Music">Music</option>
			<option value="Photo Editing">Photo Editing</option>
			<option value="Operating Systems">Operating Systems</option>
			<option value="Games">Games</option>
			<option value="Database">Database</option>
			<option value="Antivirus">Antivirus</option>
			<option value="Utilities">Utilities</option>
		</select></div>
		<div style="display: inline-block;">
			<button type="submit" id="go-btn" name="cat_btn">
				<img id="go-img" src="images/cat_go.png" >
			</button>
		</div>
		<div style="display: inline-block;">
			<button id="fa-btn" onclick="redirect()" type="button" class="fav-button" name="serch_btn">
				<img id="fav-img" src="images/rh.svg" height="40px">
			</button>
		</div>
		</form>
		
		<?php showApps(); ?>
		<script>
		function redirect() {
			location.replace("fav.php")
		}
		</script>

	</div>
		<script src="scripts/select_option.js"></script>
</body>
</html>