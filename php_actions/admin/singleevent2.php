<?php 
	include "../php_actions/connection.php";
	global $con;
	
	if($_GET){
		@$event_id = $_GET['eventId'];

	$output = array("event_id" => array(),"event_title" => array(),"event_detail" => array(),"event_status" => array(),"event_date" => array());

	$query = "SELECT event_id,event_title,event_detail,event_status,DATE_FORMAT(event_date, '%D %M, %Y') from event_information where event_id = $event_id" ;

	$result = mysqli_query($con,$query);

	if(@mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['event_id'][] = $row[0];
		$output['event_title'][] = $row[1];
		$output['event_detail'][] = $row[2];
		$output['event_status'][] = $row[3];
		$output['event_date'][] = $row[4];
	}
	}
	
 ?>