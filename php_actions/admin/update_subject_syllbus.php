<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$ss_id = $_POST['EditSsId'];
		$class_id = $_POST['editClassId'];
		$subject_id = $_POST['editSubjectId'];
		$subject_contents = $_POST['editSubjectContents'];

	    $searchQuery = "select * from subject_syllbus_information where class_id = '$class_id' and subject_id ='$subject_id' and subject_contents = '$subject_contents'";

	    $searchResult = mysqli_query($con,$searchQuery);

	    if($searchResult){
	        if(mysqli_num_rows($searchResult) > 0){
	            $valid["success"] = false;
	            $valid["message"] = "<b>Contents</b> already exist.";
	        }
	        else{
    			$query = "UPDATE subject_syllbus_information set class_id='$class_id', subject_id='$subject_id', subject_contents = '$subject_contents' where ss_id = $ss_id";
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