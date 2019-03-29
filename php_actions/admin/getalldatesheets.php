<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT datesheet_id,class_information.class_name,subject_information.subject_name,room_information.room_name,DATE_FORMAT(date, '%D %M, %Y'),start_time,end_time FROM class_information,subject_information,room_information,datesheet_information WHERE class_information.class_id = datesheet_information.class_id AND subject_information.subject_id = datesheet_information.subject_id AND room_information.room_id = datesheet_information.room_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<center><div class='btn-group'>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editDateSheet($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteDateSheet($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div></center>";
			$timestamp = strtotime($row[4]);
			$day = date('l', $timestamp);
			$dayDate = "$day <br> $row[4]";

			$sTime = strtotime($row[5]);
			$startTime = date('h:i A', $sTime);

			$eTime = strtotime($row[6]);
			$endTime = date('h:i A', $eTime);

			$detail = "<div class='row'> $row[2] </div><div class='row'> $row[3] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
			$output['data'][] = array(
					ucfirst($row[1]),
					$dayDate,
					$detail,
					$buttons,

				);
		}
	}
	echo json_encode($output);
 ?>

