<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$ts_id = $_POST['ts_id'];
	

	if($ts_id)
	{
		$query = "DELETE from teacher_subject_information where ts_id = $ts_id";
		$result = mysqli_query($con,$query);
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