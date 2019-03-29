<?php 
	include "../connection.php";
	global $con;
	$timetable_id = $_POST['editTimeTableId'];
	
	$output = array('timetable_id' => array(), 'class_id' => array(), 'subject_id' => array(), 'teacher_id' => array(), 'room_id' => array(), 'day' => array(), 'start_time' => array(), 'end_time' => array());

	$query = "SELECT * from timetable_information where timetable_id = $timetable_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['timetable_id'] = $row[0];
		$output['class_id'] = $row[1];
		$output['subject_id'] = $row[2];
		$output['teacher_id'] = $row[3];
		$output['start_time'] = $row[4];
		$output['end_time'] = $row[5];
		$output['room_id'] = $row[6];
		$output['day'] = $row[7];
	}
	echo json_encode($output);
 ?>