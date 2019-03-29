<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$admin_id = $_POST['admin_id'];


	if($admin_id)
	{
		$query = "DELETE from admin_information where admin_id = $admin_id";
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