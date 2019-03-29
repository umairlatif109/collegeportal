<?php 
	include "../php_actions/connection.php";
	global $con;

	
	if($_GET){
		$teacher_id = $_GET['teacherId'];


	$query = "SELECT teacher_name, teacher_address, teacher_qualification, teacher_gender, teacher_phone, teacher_email, teacher_cnic, teacher_image, teacher_username, teacher_password, DATE_FORMAT(hire_date, '%D %M, %Y'),teacher_id from teacher_information where teacher_id = $teacher_id" ;

	$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_array($result);

			$output["teacher_name"] = $row[0];
			$output["teacher_address"] = $row[1];
			$output["teacher_qualification"] = $row[2];
			$output["teacher_gender"] = $row[3];
			$output["teacher_phone"] = $row[4];
			$output["teacher_email"] = $row[5];
			$output["teacher_cnic"] = $row[6];
			$src = substr($row[7], 3);
			$output["teacher_image"] = $src;
			$output["teacher_username"] = $row[8];
			$output["hire_date"] = $row[10];
			$output["teacher_id"] = $row[11];
		}
	}
	
 ?>