<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$ss_id = $_POST['content_id'];
	$query = "DELETE from subject_syllbus_information where ss_id = $ss_id";
	$result = mysqli_query($con,$query);

	if($ss_id)
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