<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$subject_id = $_POST['editSubjectId'];
		$subject_name = $_POST['editSubjectName'];
		$t_marks = $_POST['editTmarks'];
		$p_marks = $_POST['editPmarks'];



				$query = "UPDATE subject_information set subject_name = '$subject_name',t_marks = '$t_marks',p_marks = '$p_marks' where subject_id=$subject_id";
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

		echo json_encode($valid);
		

?> 