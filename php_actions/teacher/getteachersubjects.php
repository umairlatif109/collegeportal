<?php 

	include "../connection.php";
	global $con;
	
	$teacherId = $_POST['teacherId'];
	$classId = $_POST['classId'];

	$query = "SELECT subject_information.subject_id,subject_information.subject_name from subject_information,teacher_subject_information where teacher_subject_information.teacher_id = $teacherId and teacher_subject_information.class_id = $classId and subject_information.subject_id = teacher_subject_information.subject_id order by subject_information.subject_name" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result)){
			$classes[] = $row;
		}
	}
	
	echo json_encode($classes);
 ?>