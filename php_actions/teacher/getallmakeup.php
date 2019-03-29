<?php 
	include"../connection.php";
	global $con;
	session_start();
	$teacherId = $_SESSION['teacher_id'];

	$query = "SELECT makeup_information.mu_id,class_information.class_name,subject_information.subject_name,room_information.room_name,DATE_FORMAT(makeup_information.makeup_date, '%D %M, %Y'),start_time,end_time FROM class_information,subject_information,room_information,makeup_information WHERE class_information.class_id = makeup_information.class_id AND subject_information.subject_id = makeup_information.subject_id AND room_information.room_id = makeup_information.room_id and makeup_information.teacher_id = $teacherId" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<center><div class='btn-group mt-3'>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteMakeup($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div></center>";
			$timestamp = strtotime($row[4]);
			$day = date('l', $timestamp);
			$dayDate = "$day <br> $row[4]";

			$sTime = strtotime($row[5]);
			$startTime = date('h:i A', $sTime);

			$eTime = strtotime($row[6]);
			$endTime = date('h:i A', $eTime);

			$detail = "<div class='row'> <b>$row[2]</b> </div><div class='row'> $row[3] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
			$output['data'][] = array(
					$dayDate,
					$row[1],
					$detail,
					$buttons,

				);
		}
	}
	echo json_encode($output);
 ?>

