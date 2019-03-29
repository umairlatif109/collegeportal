<?php 
	include "../php_actions/connection.php";
	global $con;
	
	if($_GET){
		$student_id = $_GET['studentId'];


	$query = "SELECT student_name, student_address, student_gender, student_phone, student_email, student_cnic, student_image, student_username, DATE_FORMAT(registration_date, '%D %M, %Y'),roll_no,class_information.class_name from student_information,class_information where student_id = $student_id and class_information.class_id = student_information.class_id" ;

	$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_array($result);

			$output["student_name"] = $row[0];
			$output["student_address"] = $row[1];
			$output["student_gender"] = $row[2];
			$output["student_phone"] = $row[3];
			$output["student_email"] = $row[4];
			$output["student_cnic"] = $row[5];
			$src = substr($row[6], 3);
			$output["student_image"] = $src;
			$output["student_username"] = $row[7];
			$output["registration_date"] = $row[8];
			$output['roll_no'] = $row[9];
			$output['class_name'] = $row[10];
		}
	}
	
 ?>