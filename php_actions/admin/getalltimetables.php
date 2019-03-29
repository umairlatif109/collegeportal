<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT timetable_id,class_information.class_name, subject_information.subject_name, teacher_information.teacher_name, room_information.room_name, day, start_time, end_time from class_information, subject_information, teacher_information, room_information, timetable_information where class_information.class_id = timetable_information.class_id and subject_information.subject_id = timetable_information.subject_id and teacher_information.teacher_id = timetable_information.teacher_id and room_information.room_id = timetable_information.room_id order by start_time" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<center><div class='btn-group'>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editTimeTable($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteTimeTable($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div></center>";

			$sTime = strtotime($row[6]);
			$startTime = date('h:i A', $sTime);

			$eTime = strtotime($row[7]);
			$endTime = date('h:i A', $eTime);

			$detail = "<div class='row'> <b>$row[3]</b> </div><div class='row'> $row[2] </div><div class='row'> $row[4] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
			$output['data'][] = array(
					ucfirst($row[5]),
					$row[1],
					$detail,
					$buttons,

				);
		}
	}
	echo json_encode($output);
 ?>

