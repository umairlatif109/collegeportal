<?php 
	include "../connection.php";
	global $con;
	$admin_id = $_POST['editUserId'];
	
	$output = array();

	$query = "SELECT * from admin_information where admin_id = $admin_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['admin_id'] = $row[0];
		$output['admin_name'] = $row[1];
		$output['admin_username'] = $row[2];
		$output['admin_password'] = $row[3];
	}
	echo json_encode($output);
 ?>