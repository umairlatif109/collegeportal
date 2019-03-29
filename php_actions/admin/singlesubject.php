<?php 
	include "../connection.php";
	global $con;
	$subject_id = $_POST['editSubjectId'];
	
	$output = array("subject_id" => array(),"subject_name" => array());

	$query = "SELECT * from subject_information where subject_id = $subject_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['subject_id'][] = $row[0];
		$output['subject_name'][] = $row[1];
		$output['t_marks'][] = $row[2];
		$output['p_marks'][] = $row[3];
	}
	echo json_encode($output);
 ?>