<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT * from room_information" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<div class='btn-group'><a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editRoom($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteRoom($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div>";
			$output['data'][] = array(
					$row[0],
					$row[2],
					$row[1],
					$buttons

				);
		}
	}
	echo json_encode($output);
 ?>