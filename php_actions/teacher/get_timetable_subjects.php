<?php 
	include "../php_actions/connection.php";
	global $con;
	
	$teacherId = $_SESSION['teacher_id'];
	$query = "SELECT subject_information.subject_name,subject_information.subject_id,class_information.class_id,class_information.class_name FROM subject_information,timetable_information,class_information where timetable_information.teacher_id = $teacherId and subject_information.subject_id = timetable_information.subject_id and class_information.class_id = timetable_information.class_id and current_time between timetable_information.start_time and timetable_information.end_time and timetable_information.day = lower(dayname(current_date))" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result)){
			$output[] = $row;
		}
	}
	
	
 ?>