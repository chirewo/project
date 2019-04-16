 <?php
 session_start();
$db = mysqli_connect('localhost', 'root', '', 'project');

	// REGISTER USER
	if (isset($_POST['schedule'])) {
		// receive all input values from the form
		$startdate= mysqli_real_escape_string($db, $_POST['startdate']);
		$enddate = mysqli_real_escape_string($db, $_POST['enddate']);
		$description = mysqli_real_escape_string($db, $_POST['description']);
		$s_name = mysqli_real_escape_string($db, $_POST['s_name']);
		$owner = $_SESSION['username'];
		}
		$validate = "SELECT * FROM schedule WHERE s_owner='$owner' and s_name = '$s_name' and s_description ='$description'";

		$result = mysqli_query($db, $validate);
		
		if (mysqli_num_rows($result) > 0) {
			echo "You alredy created the project";
		
		}else{		
		
			$query = "INSERT INTO schedule (s_owner, s_name, s_description, s_start, s_end) 
					  VALUES('$owner', '$s_name', '$description', '$startdate', '$enddate')";
			$complete = mysqli_query($db, $query);
			if ($complete){
				header('index.php');
			}else{
				echo "failed";
			}
			
		//}

	}
?> 