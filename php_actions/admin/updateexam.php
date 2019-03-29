<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$exam_id = $_POST['editExamId'];
		$exam_type_id = $_POST['editExamName'];
		$class_id = $_POST['editClassId'];
		$start_date = $_POST['editStartDate'];
		$end_date = $_POST['editEndDate'];

		$query = "UPDATE exam_information set exam_type_id='$exam_type_id', class_id='$class_id', start_date = STR_TO_DATE('$start_date','%m/%d/%Y'), end_date = STR_TO_DATE('$end_date','%m/%d/%Y') where exam_id = $exam_id";
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


		echo json_encode($valid);
	}
		

?> 