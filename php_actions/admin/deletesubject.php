<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$subject_id = $_POST['subject_id'];
	$query = "DELETE from subject_information where subject_id = $subject_id";
	$result = mysqli_query($con,$query);

	if($subject_id)
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