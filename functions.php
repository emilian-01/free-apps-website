<?php
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'freeapps');

	// variable declaration
	$name 		= "";
	$surname 	= "";
	$username 	= "";
	$email    	= "";
	$photo 		= "";
	$description= "";
	$link 		= "";
	$category 	= "";
	$errors   	= array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}
	// call the edituser() function if edituser_btn is clicked
	if (isset($_POST['edituser_btn'])) {
		edituser();
	}

	// call the login() function if login_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}
	if (isset($_POST['app_btn'])) {
		addApp();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: login.php");
	}
	if (isset($_POST['serch_btn'])) {
		$c_value = e($_POST['search_in']);
		setcookie('search', $c_value, time() + (86400 * 30), "/");
		header("location: search.php");
	}
	if (isset($_POST['cat_btn'])) {
		$c_value = e($_POST['select-category']);
		if($c_value != 'Categories'){
			setcookie('search', $c_value, time() + (86400 * 30), "/");
			header("location: category.php");
		}
	}
	if (isset($_POST['fav-button'])) {
		addRemvFav(e($_POST['fav-button']));
		//header("Refresh: 0");
	}
	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$name    	=  e($_POST['name']);
		$surname	=  e($_POST['surname']);
		$username	=  e($_POST['username']);
		$email    	=  e($_POST['email']);
		$password_1	=  e($_POST['password_1']);
		$password_2	=  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($name)) { 
			array_push($errors, "Name is required");
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			array_push($errors, "Only letters and white space allowed in Name");
		}
		if (empty($surname)) { 
			array_push($errors, "Surname is required"); 
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			array_push($errors, "Only letters and white space allowed in Surname");
		}
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Invalid email format");
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['usertype'])) {
				$usertype = e($_POST['usertype']);
				$query = "INSERT INTO users (name, surname, username, email, usertype, password) 
						  VALUES('$name', '$surname', '$username', '$email', '$usertype', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}else{
				$query = "INSERT INTO users (name, surname, username, email, usertype, password) 
						  VALUES('$name', '$surname', '$username', '$email', 'user', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');				
			}
		}
	}
	function edituser(){
		global $db, $errors;

		// receive all input values from the form
		$uid		=  e($_SESSION['user']['u_id']);
		$name    	=  e($_POST['name']);
		$surname	=  e($_POST['surname']);
		$email    	=  e($_POST['email']);
		$password_1	=  e($_POST['password_1']);
		$password_2	=  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($name)) { 
			array_push($errors, "Name is required");
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			array_push($errors, "Only letters and white space allowed in Name");
		}
		if (empty($surname)) { 
			array_push($errors, "Surname is required"); 
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			array_push($errors, "Only letters and white space allowed in Surname");
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Invalid email format");
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}else{
			if ($password_1 == $password_2) {
				array_push($errors, "Passwords can not be the same");
			}
			//check if old password is correct
			$password = md5($password_1);
			$query = "SELECT * FROM users WHERE u_id='$uid' LIMIT 1";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) { // user found
				$found_user = mysqli_fetch_assoc($results);
				if ($found_user['password'] != $password) {
					array_push($errors, "Old password is not correct");
				}
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			if (empty($password_2)) {
				$query = "update users set name='$name', surname='$surname', email='$email'".
					"where u_id='$uid'";
				mysqli_query($db, $query);
				$query = "SELECT * FROM users WHERE u_id='$uid' LIMIT 1";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1) {
					$logged_in_user = mysqli_fetch_assoc($results);
					$_SESSION['user'] = $logged_in_user;
				}
				if ($logged_in_user['usertype'] == 'admin') {
					$_SESSION['success']  = "Account info successfully updated!";
					header('location: home.php');		  
				}else{
					$_SESSION['success']  = "Account info successfully updated!";
					header('location: index.php');
				}	
			}else{
				$password2 = md5($password_2);
				$query = "update users set name='$name', surname='$surname', email='$email', password='$password2'".
					"where u_id='$uid'";
				mysqli_query($db, $query);
				$query = "SELECT * FROM users WHERE u_id='$uid' LIMIT 1";
				$results = mysqli_query($db, $query);
				if (mysqli_num_rows($results) == 1) {
					$logged_in_user = mysqli_fetch_assoc($results);
					$_SESSION['user'] = $logged_in_user;
				}
				if ($logged_in_user['usertype'] == 'admin') {
					$_SESSION['success']  = "Account info successfully updated! Password has been changed!";
					header('location: home.php');		  
				}else{
					$_SESSION['success']  = "Account info successfully updated! Password has been changed!";
					header('location: index.php');
				}				
			}
		}
	}
	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}
	function findUserId($uname){
		global $db;
		$query = "SELECT u_id FROM users WHERE username='$uname' limit 1";
		$result = mysqli_query($db, $query);

		$num = mysqli_fetch_assoc($result);
		return $num['u_id'];
	}
	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['usertype'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	function addApp(){
		global $db, $errors;
		
		$name			=  e($_POST['name']);
		$photo			=  e($_POST['photo']);
		$description	=  e($_POST['description']);
		$link			=  e($_POST['link']);
		$category		=  e($_POST['category']);
		
		if (empty($name)) { 
			array_push($errors, "Name is required"); 
		}
		if (empty($photo)) { 
			array_push($errors, "Photo is required"); 
		}
		if (empty($description)) { 
			array_push($errors, "Description is required"); 
		}
		if (empty($link)) { 
			array_push($errors, "Download link is required"); 
		}else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
			array_push($errors, "Invalid URL");
		}
		if (empty($category)) { 
			array_push($errors, "Category is required"); 
		}
		if (count($errors) == 0) {
			$query = "INSERT INTO apps (a_name, photo, description, link, category) 
							  VALUES('$name', '$photo', '$description', '$link', '$category')";
					mysqli_query($db, $query);
			$_SESSION['success']  = "New app successfully added!!";
					header('location: home.php');
		}
	}

	function isLoggedIn(){
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin(){
		if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
	
	function isFav($id){
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);
	}
	//this shows the users in admin page (only users not other admins)
	function showUsers(){
		$conn = new mysqli('localhost', 'root', '', 'freeapps');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT username, name, surname, usertype, email FROM users";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			echo "<table id='user-table'><tr><th class='cell-user cell-user-head'><h1>Username</h1></th>".
			"<th class='cell-user cell-user-head'><h1>Full Name</h1></th>".
			"<th class='cell-user cell-user-head'><h1>Email</h1></th></tr>";
			while($row = $result->fetch_assoc()) {
				if($row["usertype"] != "admin"){
					echo "<tr><td class='cell-user'><h3>". $row["username"].
					"</h3></td><td class='cell-user'><h3>".$row["name"]." ".$row["surname"].
					"</h3></td><td class='cell-user'><h3>".$row["email"]."</h3></td></tr>";
				}
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		$conn->close();
	}
	function addRemvFav($appid){
		$conn = new mysqli('localhost', 'root', '', 'freeapps');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		global $db;
		$uid = findUserId($_SESSION['user']['username']);
		$sql = "SELECT f_id FROM favs WHERE f_u_id='$uid' and f_a_id='$appid' limit 1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$query = "DELETE FROM favs WHERE f_u_id='$uid' and f_a_id='$appid'";
			mysqli_query($db, $query);
		}else{
			$query = "INSERT INTO favs(f_u_id, f_a_id) VALUES ('$uid','$appid')";
			mysqli_query($db, $query);
		}
	}
	function showApps(){
		$conn = new mysqli('localhost', 'root', '', 'freeapps');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//get user id and their favourites
		$id = findUserId($_SESSION['user']['username']);
		$sql = "SELECT f_a_id FROM favs WHERE f_u_id = '$id'";
		$fav_arr = $conn->query($sql);
		for($i=0; $i< $fav_arr->num_rows; $i++){
			$r = $fav_arr->fetch_assoc();
			$arr[$i] = $r['f_a_id'];
		}
		
		$sql = "SELECT a_id, a_name, photo, description, link, category FROM apps";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			while($row = $result->fetch_assoc()) {
				$test = false;
				for ($x = 0; $x < $fav_arr->num_rows; $x++) {
					if($row['a_id'] == $arr[$x]){
						$test = true;
					}
				}
				$str = "<form style='width: 90%;' method='post' action='index.php'>";
				if($test){
				$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id'].
					"><img src='images/rh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
	
				}else{
					$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/gh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";

				}
				$str .="</form>"; 
				echo $str;
			}
			
		} else {
			echo "0 results";
		}
		$conn->close();
	}
	
	function searchResults(){
		if(!empty($_COOKIE['search'])){
			$search_word = $_COOKIE['search'];
			$conn = new mysqli('localhost', 'root', '', 'freeapps');
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			//get user id and their favourites
			$id = findUserId($_SESSION['user']['username']);
			$sql = "SELECT f_a_id FROM favs WHERE f_u_id = '$id'";
			$fav_arr = $conn->query($sql);
			for($i=0; $i< $fav_arr->num_rows; $i++){
				$r = $fav_arr->fetch_assoc();
				$arr[$i] = $r['f_a_id'];
			}
			$r = $fav_arr->fetch_assoc();
			$arr[$i] = $r['f_a_id'];
		
			$sql = "SELECT a_id, a_name, photo, description, link, category FROM apps 
				WHERE a_name LIKE '%".$search_word."%' OR description LIKE '%".$search_word."%'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$test = false;
					for ($x = 0; $x < $fav_arr->num_rows; $x++) {
						if($row['a_id'] == $arr[$x]){
							$test = true;
						}
					}
					$str = "<form style='width: 90%;' method='post' action='search.php'>";
					if($test){
						$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/rh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
					}else{
						$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/gh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
	
					}
					$str .="</form>"; 
					echo $str;
				}
			} else {
				echo "0 results";
			}
			$conn->close();
		}else{
			echo "Type something in the search box!";
	}
	
	setcookie('search', '', time() - (3600), "/");
	}
	
	function showCategory(){
		if(!empty($_COOKIE['search'])){
			$cat = $_COOKIE['search'];
			$conn = new mysqli('localhost', 'root', '', 'freeapps');
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			//get user id and their favourites
			$id = findUserId($_SESSION['user']['username']);
			$sql = "SELECT f_a_id FROM favs WHERE f_u_id = '$id'";
			$fav_arr = $conn->query($sql);
			for($i=0; $i< $fav_arr->num_rows; $i++){
				$r = $fav_arr->fetch_assoc();
				$arr[$i] = $r['f_a_id'];
			}
			
			$sql = "SELECT a_id, a_name, photo, description, link, category FROM apps 
				WHERE category LIKE '%".$cat."%'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$test = false;
					for ($x = 0; $x < $fav_arr->num_rows; $x++) {
						if($row['a_id'] == $arr[$x]){
							$test = true;
						}
					}$str = "<form style='width: 90%;' method='post' action='category.php'>";
					if($test){
						$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/rh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
					}else{
						$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/gh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
	
					}
					$str .="</form>"; 
					echo $str;
				}
			} else {
				echo "0 results";
			}
			$conn->close();
		}else{
			echo "Select a category!";
		}
		setcookie('search', '', time() - (3600), "/");
	}
	
	function favApps(){
			$conn = new mysqli('localhost', 'root', '', 'freeapps');
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			//get user id and their favourites
			$id = findUserId($_SESSION['user']['username']);
			$sql = "SELECT f_a_id FROM favs WHERE f_u_id = '$id'";
			$fav_arr = $conn->query($sql);
			for($i=0; $i< $fav_arr->num_rows; $i++){
				$r = $fav_arr->fetch_assoc();
				$arr[$i] = $r['f_a_id'];
			}
			$r = $fav_arr->fetch_assoc();
			$arr[$i] = $r['f_a_id'];
		
			$sql = "SELECT * FROM apps, (select * from favs WHERE f_u_id=".$id.") ".
			"as A where A.f_a_id=a_id";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$test = false;
					for ($x = 0; $x < $fav_arr->num_rows; $x++) {
						if($row['a_id'] == $arr[$x]){
							$test = true;
						}
					}
					$str = "<form style='width: 90%;' method='post' action='fav.php'>";
					if($test){
						$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/rh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
					}else{
						$str .="<table class='table-apps'><tr>".
					"<td class='cells-apps'><img src='images/".$row['photo']."' height='100px' width='100px'>".
					" <button type='submit' class='fav-button' name='fav-button' value=".$row['a_id']."><img src='images/gh.svg' height='30px'></button></td>".
					"<td class='cells-apps'><h3>".$row['a_name']."</h3></td>".
					"<td class='cells-apps'><h3>".$row['category']."</h3><br><a download id='dnl' target='_blank'  href='".$row["link"].
					"'>Download here</a></td>".
					"</tr><tr>".
					"<td class='cells-apps' colspan=3>".$row["description"]."</td>".
					"</tr>".
				"</table><br>";
	
					}
					$str .="</form>"; 
					echo $str;
				}
			} else {
				echo "0 results";
			}
			$conn->close();
	}
	
?>