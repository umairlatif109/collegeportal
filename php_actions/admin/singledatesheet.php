<?php 
	include "../connection.php";
	global $con;
	$datesheet_id = $_POST['editDateSheetId'];
	
	$output = array('datesheet_id' => array(), 'class_id' => array(), 'subject_id' => array(), 'room_id' => array(), 'start_time' => array(), 'end_time' => array(), 'datesheet_date' => array(), 'exam_type_id' => array());

	$query = "SELECT datesheet_id,class_id, subject_id, room_id, start_time, end_time, DATE_FORMAT(date, '%m/%d/%y'),exam_type_id from datesheet_information where datesheet_id = $datesheet_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);

		$output["datesheet_id"] = $row[0];
		$output["class_id"] = $row[1];
		$output["subject_id"] = $row[2];
		$output["room_id"] = $row[3];
		$output["start_time"] = $row[4];
		$output["end_time"] = $row[5];
		$output["datesheet_date"] = $row[6];
		$output["exam_type_id"] =$row[7]; 
	}
	echo json_encode($output);
 ?>