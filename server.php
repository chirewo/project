<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$address = "";
	$phone ="";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'project');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$address  = mysqli_real_escape_string($db, $_POST['address']);
		$phone  = mysqli_real_escape_string($db, $_POST['phone']);

		
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		$query1 = "SELECT * FROM users WHERE username='$username'";
		$query2 = "SELECT * FROM users WHERE email='$email'";
		$query3 = "SELECT * FROM users WHERE phone='$phone'";
		$results1 = mysqli_query($db, $query1);
		$results2 = mysqli_query($db, $query2);
		$results3 = mysqli_query($db, $query3);
		if (mysqli_num_rows($results1) > 0) {
			array_push($errors, "the user aleady exist");
			header('location: failed.php');
		}else if (mysqli_num_rows($results2) > 0) {
			array_push($errors, "the user aleady exist");
			header('location: failed.php');
		}else if (mysqli_num_rows($results3) > 0) {
			array_push($errors, "the user aleady exist");
			header('location: failed.php');
		}else{
		// register user if there are no errors in the form
		//if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			header('location: ./controller/user.php');
		//}

	}
}
	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$sess =mysqli_fetch_array($results);
				$_SESSION['username'] = $username;
				$_SESSION['username'] = $username;
				$_SESSION['role']= $sess['role'];
				//$_SESSION['success'] = "You are now logged in";
				header('location: ./home/html/index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>