<?php 
	include "../php_actions/connection.php";
	global $con;
	$ss_id = @$_GET['ContentId'];
	
	$query = "select subject_syllbus_information.ss_id,class_information.class_name,subject_information.subject_name,subject_syllbus_information.subject_contents from class_information,subject_information,subject_syllbus_information where class_information.class_id = subject_syllbus_information.class_id and subject_information.subject_id = subject_syllbus_information.subject_id and ss_id = $ss_id" ;

	$result = mysqli_query($con,$query);

	if ($ss_id){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$contents[] = $row;
			}
		}
	}
 ?>