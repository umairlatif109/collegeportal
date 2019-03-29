<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$datesheet_id = $_POST['datesheet_id'];
	

	if($datesheet_id)
	{
		$query = "DELETE from datesheet_information where datesheet_id = $datesheet_id";
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