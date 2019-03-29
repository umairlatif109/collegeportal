<?php 
	
	include "../php_actions/connection.php";
	global $con;
	$student_id = $_SESSION['student_id'];

	$query = "SELECT
					class_subject_information.class_id,
				    subject_information.subject_id,
				    subject_information.subject_name
				FROM
				    subject_information,
				    class_subject_information,
				    student_information
				WHERE
					student_information.class_id = class_subject_information.class_id
				    and subject_information.subject_id = class_subject_information.subject_id
				    and student_information.student_id = '$student_id' order by subject_information.subject_name";

    $result = mysqli_query($con,$query);

    if($result){
    	if(mysqli_num_rows($result) > 0){
    		while ($row = mysqli_fetch_assoc($result)) {
    			$subjects[] = $row;
    		}
    	}
    }

 ?>