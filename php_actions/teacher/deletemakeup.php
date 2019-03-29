<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$makeup_id = $_POST['makeup_id'];

	if($makeup_id)
	{
		$query = "DELETE from makeup_information where mu_id = $makeup_id";
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