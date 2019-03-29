<?php 
	include "../connection.php";
	global $con;
	$room_id = $_POST['editRoomId'];
	
	$output = array("room_id" => array(),"room_no" => array(),"room_name" => array());

	$query = "SELECT * from room_information where room_id = $room_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['room_id'][] = $row[0];
		$output['room_name'][] = $row[1];
		$output['room_no'][] = $row[2];
	}
	echo json_encode($output);
 ?>