<?php 
	include "../connection.php";
	global $con;

	$limit = $_POST['limit'];
	$query = "SELECT * FROM `event_information` where event_status = 'active' and event_date >= current_date order by event_date asc limit $limit" ;

	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$date = strtotime($row[4]);
			$event_date = date('l d F, Y', $date);

			$output[] = array($row[1],$row[2],$event_date);
		}

		echo json_encode($output);
	}
 ?>

