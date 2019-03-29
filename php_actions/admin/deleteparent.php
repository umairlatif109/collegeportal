<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$parent_id = $_POST['parent_id'];
	$query = "DELETE from parent_information where parent_id = $parent_id";
	$result = mysqli_query($con,$query);

	if($parent_id)
	{
		if($result){
			$valid['success'] = true;
			$valid['message'] = "Deleted Successfully.";
		}
		else{
			$valid['success'] = false;
			$valid['message'] = "Failed To Delete"; 
		}

		echo json_encode($valid);
	}

 ?>