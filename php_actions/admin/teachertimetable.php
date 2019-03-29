<?php 
	include "../php_actions/connection.php";
	global $con;
	$teacherId= $_SESSION['teacher_id'];

	$query = "SELECT class_information.class_name, subject_information.subject_name , room_information.room_name, day, start_time, end_time from class_information, subject_information, teacher_information, room_information, timetable_information where class_information.class_id = timetable_information.class_id and subject_information.subject_id = timetable_information.subject_id and teacher_information.teacher_id = timetable_information.teacher_id and room_information.room_id = timetable_information.room_id and timetable_information.teacher_id = $teacherId
ORDER BY timetable_information.day ASC" ;

	$result = mysqli_query($con,$query);
	$timetables = [];
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$sTime = strtotime($row[4]);
			$startTime = date('h:i A', $sTime);

			$eTime = strtotime($row[5]);
			$endTime = date('h:i A', $eTime);

			$detail = "<div class='row'> <b>$row[1]</b> </div><div class='row'> $row[2] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
			$timetables[] = array(
					ucfirst($row[3]),
					$row[0],
					$detail
				);
		}
	}
 ?>

