<?php 
	
	include "../php_actions/connection.php";
	global $con;
	if($_GET){

		$class_id = $_GET['classId'];
		$subject_id = $_GET['subjectId'];
		$query = "SELECT
					concat('Lecture ',teacher_lecture_information.lecture_no) as lecture,
				    teacher_lecture_information.lecture_file
				FROM
					teacher_lecture_information
				WHERE 
					class_id = '$class_id' and subject_id = '$subject_id'";

	    $result = mysqli_query($con,$query);

	    if($result){
	    	if(mysqli_num_rows($result) > 0){
	    		while ($row = mysqli_fetch_assoc($result)) {

	    			$getlink = substr($row['lecture_file'], 3);
	    			$download = "<a href='$getlink' class=' btn btn-success'><i class='glyphicon glyphicon-download-alt'></i> Download</a>";
	    			$lectures[] = array($row['lecture'],$download);
	    		}
	    	}
	    }
	    else{
	    	echo mysqli_error($con);
	    }
	}


 ?>