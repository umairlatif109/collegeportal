<?php 
	include "../connection.php";
	global $con;
	$class_id = $_POST['editClassId'];
	
	$output = array("class_id" => array(),"class_name" => array());

	$query = "SELECT * from class_information where class_id = $class_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['class_id'][] = $row[0];
		$output['class_name'][] = $row[1];
	}
	echo json_encode($output);
 ?>