<?php 
	include "../php_actions/connection.php";
	global $con;

	
	if($_SESSION['parent_id']){
	$parent_id = $_SESSION['parent_id'];

	$query = "SELECT * from parent_information where parent_id = $parent_id" ;

	$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_array($result);

			$output["parent_id"] = $row['parent_id'];
			$output["parent_name"] = $row['parent_name'];
			$output["parent_address"] = $row['parent_address'];
			$output["parent_phone"] = $row['parent_phone'];
			$output["parent_gender"] = $row['parent_gender'];
			$output["parent_email"] = $row['parent_email'];
			$output["parent_username"] = $row['parent_username'];

		}
	}
	
 ?>