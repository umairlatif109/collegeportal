<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$class_id = $_POST['class_id'];
	$query = "DELETE from class_information where class_id = $class_id";
	$result = mysqli_query($con,$query);

	if($class_id)
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