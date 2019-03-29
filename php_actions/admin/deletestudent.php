<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$student_id = $_POST['student_id'];
	

	if($student_id)
	{
		$query = "DELETE from student_information where student_id = $student_id";
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