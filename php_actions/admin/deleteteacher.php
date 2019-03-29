<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$teacher_id = $_POST['teacher_id'];
	

	if($teacher_id)
	{
		$query = "DELETE from teacher_information where teacher_id = $teacher_id";
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