<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$lecture_id = $_POST['lecture_id'];
	$query = "DELETE from teacher_lecture_information where tl_id = $lecture_id";
	$result = mysqli_query($con,$query);

	if($lecture_id)
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