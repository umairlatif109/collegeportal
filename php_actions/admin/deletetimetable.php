<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$timetable_id = $_POST['timetable_id'];
	

	if($timetable_id)
	{
		$query = "DELETE from timetable_information where timetable_id = $timetable_id";
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