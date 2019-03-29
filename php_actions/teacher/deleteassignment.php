<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$assignment_id = $_POST['assignment_id'];
	$query = "DELETE from teacher_assignment_information where ta_id = $assignment_id";
	$result = mysqli_query($con,$query);

	if($assignment_id)
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