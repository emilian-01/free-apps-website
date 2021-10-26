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
	<title>Search Results</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/opt-select-style.css">
	<meta name="referrer" content="no-referrer" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	</style>
</head>
<body>
	<div class="header">
		<a href="index.php"><img class="back" src="images/back.png" height="25px" width="25px"></a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<h2 class="back" >Home Page</h2>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div class="content">
		<?php searchResults(); ?>
	</div>
	
</body>
</html>