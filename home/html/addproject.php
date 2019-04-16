<?php
$db = mysqli_connect('localhost', 'root', '', 'project');
if (isset($_POST['addproject'])){
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$category = mysqli_real_escape_string($db, $_POST['category']);
	$budget = mysqli_real_escape_string($db, $_POST['budget']);
	$owner = mysqli_real_escape_string($db, $_POST['owner']);
	$status = mysqli_real_escape_string($db, $_POST['status']);
	{
		$find_project = "SELECT * FROM projects WHERE p_name='$name' and p_owner='$owner'";
		$find_result =mysqli_query($db,$find_project);
		$find_rows = mysqli_num_rows($find_result);
		if ($find_rows >0){
			echo "the project already exists";
		}else{
			$query = "INSERT INTO projects (p_name, p_category, p_status, p_required, p_owner) 
					  VALUES('$name', '$category', '$status', '$budget', '$owner')";
			 $success = mysqli_query($db, $query);
			 if ($success){
			 	echo "successful";
			 }else{
			 	echo "failed";
			 }
		}
	}
}
?>