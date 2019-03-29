<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$class_id = $_POST['editClassId'];
		$class_name = $_POST['editClassName'];

	    $searchQuery = "select * from class_information where class_name = '$class_name'";

	    $searchResult = mysqli_query($con,$searchQuery);

	    if($searchResult){
	        if(mysqli_num_rows($searchResult) > 0){
	            $valid["success"] = false;
	            $valid["message"] = "<b>Class Name</b> already exist.";
	        }
		    else{

				$query = "UPDATE class_information set class_name = '$class_name' where class_id=$class_id";
				$result = mysqli_query($con,$query);

				if($result)
				{
					$valid['success'] = true;
					$valid['message'] = "Successfully Updated.";
				}
				else
				{
					$valid['success'] = false;
					$valid['message'] = "Failed To Save";
				}

		    }
	    }



		echo json_encode($valid);
	}
		

?> 