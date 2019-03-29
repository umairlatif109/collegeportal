<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){

		$editDateSheetId = $_POST["editDateSheetId"];
		$editClassId = $_POST["editClassId"];
		$editSubjectId = $_POST["editSubjectId"];
		$editRoomId = $_POST["editRoomId"];
		$editDate = $_POST["editDate"];
		$editStartTime = $_POST["editStartTime"];
		$editEndTime = $_POST["editEndTime"];
		$edit_exam_id = $_POST['editExamId'];
	    $sDate = strtotime($editDate);
	    $searchDate = date('Y-m-d',$sDate);

	    $searchQuery = "SELECT * from exam_information where '$searchDate' between start_date and end_date and class_id = '$editClassId' and exam_type_id = '$edit_exam_id'";
	    $searchResult = mysqli_query($con,$searchQuery);

	    if($searchResult){
	        if(mysqli_num_rows($searchResult) < 1){
	            $valid["success"] = false;
	            $valid["message"] = "No Class Scheduled or invalid date.";
	        }
	        else{

    		    $searchQuery = "select * from datesheet_information where class_id = '$editClassId' and subject_id ='$editSubjectId' and exam_type_id = $edit_exam_id and date = '$searchDate' and start_time = '$editStartTime' and end_time = '$editEndTime'";

			    $searchResult = mysqli_query($con,$searchQuery);

			    if($searchResult){
			        if(mysqli_num_rows($searchResult) > 0){
			            $valid["success"] = false;
			            $valid["message"] = "<b></b> already exist.";
			        }
			        else{
						$query = "UPDATE datesheet_information SET  class_id ='$editClassId', subject_id ='$editSubjectId', room_id ='$editRoomId', start_time ='$editStartTime', end_time ='$editEndTime', date =STR_TO_DATE('$editDate','%m/%d/%Y') WHERE datesheet_id = '$editDateSheetId'";
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

	        }
	    }




		echo json_encode($valid);
	}
		

?> 