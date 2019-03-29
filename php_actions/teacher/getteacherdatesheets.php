<?php 
	include "../php_actions/connection.php";
	global $con;
	$teacherId = $_SESSION['teacher_id'];
	$query = "SELECT datesheet_id,class_information.class_name,subject_information.subject_name,room_information.room_name,DATE_FORMAT(date, '%D %M, %Y'),start_time,end_time FROM class_information,subject_information,room_information,datesheet_information,exam_information,teacher_subject_information WHERE class_information.class_id = datesheet_information.class_id and exam_information.exam_type_id = datesheet_information.exam_type_id AND subject_information.subject_id = datesheet_information.subject_id AND room_information.room_id = datesheet_information.room_id and exam_information.class_id = datesheet_information.class_id and CURRENT_DATE BETWEEN exam_information.start_date and exam_information.end_date and teacher_subject_information.subject_id = subject_information.subject_id and teacher_subject_information.class_id = class_information.class_id and teacher_subject_information.teacher_id = $teacherId" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result)){

			$timestamp = strtotime($row[4]);
			$day = date('l', $timestamp);
			$dayDate = "$day <br> $row[4]";

			$sTime = strtotime($row[5]);
			$startTime = date('h:i A', $sTime);

			$eTime = strtotime($row[6]);
			$endTime = date('h:i A', $eTime);

			$detail = "<div class='row'> <b>$row[2]</b> </div><div class='row'> $row[3] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
			$datesheets[] = array(
					ucfirst($row[1]),
					$dayDate,
					$detail

				);
		}
	}
	
 ?>