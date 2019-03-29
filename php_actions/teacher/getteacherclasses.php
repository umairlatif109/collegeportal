<?php 
	include "../php_actions/connection.php";
	global $con;
	
	$teacherId = $_SESSION['teacher_id'];
	$query = "SELECT DISTINCT class_information.class_id,class_information.class_name from class_information,teacher_subject_information where class_information.class_id = teacher_subject_information.class_id and teacher_subject_information.teacher_id = $teacherId order by class_information.class_name" ;

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result)){
			$classes[] = $row;
		}
	}
	
	
 ?>