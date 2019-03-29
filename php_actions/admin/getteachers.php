<?php 
	include "../php_actions/connection.php";
	global $con;
	
	$query = "SELECT * from teacher_information" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result)){
			$teachers[] = $row;
		}
	}
	
	
 ?>