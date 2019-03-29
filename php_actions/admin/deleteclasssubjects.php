<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$cs_id = $_POST['cs_id'];
	$query = "DELETE from class_subject_information where cs_id = $cs_id";
	$result = mysqli_query($con,$query);

	if($cs_id)
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