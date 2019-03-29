<?php 
	include"../connection.php";
	global $con;

	$teacher_id = $_POST["teacher_id"];

	// join with class_information, subject_informatin and teacher_subject_information to get the teacher subjects detail 
	$query = "SELECT class_information.class_name,subject_information.subject_name, teacher_subject_information.ts_id from class_information,subject_information,teacher_subject_information where teacher_subject_information.class_id = class_information.class_id and teacher_subject_information.subject_id = subject_information.subject_id and teacher_subject_information.teacher_id = $teacher_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<a class='btn btn-danger btn-sm' onclick='deleteSubject($row[2])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a>";
			$output['data'][] = array(
					$row[0],
					$row[1],
					$buttons

				);
		}
	}
	echo json_encode($output);
 ?>