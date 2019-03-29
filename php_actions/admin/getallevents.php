<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT event_id,event_title,event_detail,event_status,DATE_FORMAT(event_date, '%D %M, %Y') from event_information order by event_date desc" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<div class='btn-group'><a href='http://localhost/collegeportal/admin/event.php?eventId=$row[0]' class='btn btn-info btn-sm' >
				<i class='glyphicon glyphicon-question-sign'></i> View
			</a>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editEvent($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteEvent($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div>";
			$r = ($row[3] == 'active') ? "<p class='text-success'>$row[1]</p> " : "<p class='text-danger'>$row[1]</p> " ;
			$output['data'][] = array(
					$row[0],
					"<a  class='tableLink'>".$r."</a>",
					$row[4],
					$buttons

				);
		}
	}
	echo json_encode($output);
 ?>
