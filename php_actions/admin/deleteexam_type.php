<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$et_id = $_POST['et_id'];
	$query = "DELETE from exam_type_information where et_id = $et_id";
	$result = mysqli_query($con,$query);

	if($et_id)
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