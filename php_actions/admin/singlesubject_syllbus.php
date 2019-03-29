<?php 
	include "../connection.php";
	global $con;
	$ss_id = $_POST['editContentId'];
	
	$output = array("ss_id" => array(),"class_id" => array(),"subject_id" => array(),"subject_contents" => array());

	$query = "SELECT * from subject_syllbus_information where ss_id = $ss_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['ss_id'][] = $row[0];
		$output['class_id'][] = $row[1];
		$output['subject_id'][] = $row[2];
		$output['subject_contents'][] = $row[3];
	}
	echo json_encode($output);
 ?>