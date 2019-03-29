<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$exam_id = $_POST['exam_id'];
	$query = "DELETE from exam_information where exam_id = $exam_id";
	$result = mysqli_query($con,$query);

	if($exam_id)
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