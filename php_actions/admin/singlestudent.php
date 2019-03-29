<?php 
	include "../connection.php";
	global $con;
	$student_id = $_POST['editStudentId'];
	
	$output = array('student_id' => array(), 'student_name' => array(), 'parent_id' => array(), 'student_address' => array(), 'student_email' => array(), 'student_gender' => array(), 'student_cnic' => array(), 'student_phone' => array(), 'student_image' => array(), 'student_username' => array(), 'student_password' => array(), 'registration_date' => array());

	$query = "SELECT student_id, student_name, parent_id, student_address, student_email, student_gender, student_cnic, student_phone, student_image, student_username, student_password, DATE_FORMAT(registration_date, '%m/%d/%Y')  from student_information where student_id = $student_id" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$output['student_id'] = $row[0];
		$output['student_name'] = $row[1];
		$output['parent_id'] = $row[2];
		$output['student_address'] = $row[3];
		$output['student_email'] = $row[4];
		$output['student_gender'] = $row[5];
		$output['student_cnic'] = $row[6];
		$output['student_phone'] = $row[7];
		$src = substr($row[8], 3);
		$output['student_image'] = $src;
		$output['student_username'] = $row[9];
		$output['student_password'] = $row[10];
		$output['registration_date'] = $row[11];

	}
	echo json_encode($output);
 ?>