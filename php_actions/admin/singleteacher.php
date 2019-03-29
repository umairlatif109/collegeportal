<?php 
	include "../connection.php";
	global $con;
	$teacher_id = $_POST['editTeacherId'];
	
	$output = array( "teacher_id" => array() , "teacher_name" => array() , "teacher_address" => array(), "teacher_qualification" => array(), "teacher_gender" => array(), "teacher_phone" => array(), "teacher_email" => array(), "teacher_cnic" => array(), "teacher_image" => array(), "teacher_username" => array(), "teacher_password" => array(), "hire_date" => array());

	$query = "SELECT teacher_id, teacher_name, teacher_address, teacher_qualification, teacher_gender, teacher_phone, teacher_email, teacher_cnic, teacher_image, teacher_username, teacher_password, DATE_FORMAT(hire_date, '%m/%d/%Y')  from teacher_information where teacher_id = $teacher_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['teacher_id'] = $row[0];
		$output['teacher_name'] = $row[1];
		$output['teacher_address'] = $row[2];
		$output['teacher_qualification'] = $row[3];
		$output['teacher_gender'] = $row[4];
		$output['teacher_phone'] = $row[5];
		$output['teacher_email'] = $row[6];
		$output['teacher_cnic'] = $row[7];
		$src = substr($row[8], 3);
		$output['teacher_image'] = $src;
		$output['teacher_username'] = $row[9];
		$output['teacher_password'] = $row[10];
		$output['hire_date'] = $row[11];
	}
	echo json_encode($output);
 ?>