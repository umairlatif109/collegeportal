<?php 
	include "../connection.php";
	global $con;
	$exam_id = $_POST['exam_id'];
	
	$output = array("exam_id" => array(),"exam_type_id" => array(),"class_id" => array(),"start_date" => array(),"end_date" => array());

	$query = "SELECT exam_id,exam_type_id,class_id,date_format(start_date,'%m/%d/%Y'),date_format(end_date,'%m/%d/%Y') from exam_information where exam_id = $exam_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['exam_id'][] = $row[0];
		$output['exam_type_id'][] = $row[1];
		$output['class_id'][] = $row[2];
		$output['start_date'][] = $row[3];
		$output['end_date'][] = $row[4];
	}
	echo json_encode($output);
 ?>