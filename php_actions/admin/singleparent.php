<?php 
	include "../connection.php";
	global $con;
	$parent_id = $_POST['editParentId'];
	
	$output = array("parent_id" => array(), "parent_name" => array(), "parent_address" => array(), "parent_phone" => array(), "parent_gender" => array(), "parent_email" => array(), "parent_username" => array(), "parent_password" =>array());

	$query = "SELECT * from parent_information where parent_id = $parent_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['parent_id'] = $row[0];
		$output['parent_name'] = $row[1];
		$output['parent_address'] = $row[2];
		$output['parent_phone'] = $row[3];
		$output['parent_gender'] = $row[4];
		$output['parent_email'] = $row[5];
		$output['parent_username'] = $row[6];
		$output['parent_password'] = $row[7];
	}
	echo json_encode($output);
 ?>