<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => null);

	if($_POST){

		$editTimeTableId = $_POST["editTimeTableId"];
		$editClassId = $_POST["editClassId"];
		$editSubjectId = $_POST["editSubjectId"];
		$editTeacherId = $_POST["editTeacherId"];
		$editRoomId = $_POST["editRoomId"];
		$editSelectDay = $_POST["editSelectDay"];
		$editStartTime = $_POST["editSartTime"];
		$editEndTime = $_POST["editEndTime"];


	    $searchQuery = "select * from timetable_information where room_id= '$editRoomId' and day = '$editSelectDay' and start_time = '$editStartTime' and end_time = '$editEndTime'";

	    $searchResult = mysqli_query($con,$searchQuery);

	    if($searchResult){
	        if(mysqli_num_rows($searchResult) > 0){
	            $valid["success"] = false;
	            $valid["message"] = "<b>Teacher Class</b> is already Scheduled at this time";
	        }
	        else{
	            $searchQuery = "select * from timetable_information where teacher_id ='$editTeacherId' and day = '$editSelectDay' and room_id= '$editRoomId' and '$editStartTime' BETWEEN start_time AND end_time and '$editEndTime' BETWEEN start_time AND end_time";
	            $searchResult = mysqli_query($con,$searchQuery);

	            if($searchResult){
	                if(mysqli_num_rows($searchResult) > 0){
	                    $valid["success"] = false;
	                    $valid["message"] = "<b>Teacher Class</b> is already Scheduled at this time";

	                }
	                else{
    					$query = "UPDATE timetable_information SET class_id='$editClassId',subject_id='$editSubjectId',teacher_id='$editTeacherId',start_time='$editStartTime',end_time='$editEndTime',room_id='$editRoomId',day='$editSelectDay' WHERE timetable_id = '$editTimeTableId'";
	                    $result = mysqli_query($con,$query);

	                    if($result)
	                    {
	                       $valid["success"] = true;
	                       $valid["message"] = "Saved Successfully.";
	                    }
	                }
	            }
	        }
	    }
		echo json_encode($valid);
	}
		

?> 