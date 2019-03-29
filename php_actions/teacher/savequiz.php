<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);

	if($_POST){

		$class_id = $_POST["classId"];
		$subject_id = $_POST["subjectId"];
		$teacher_id = $_POST["teacherId"];
		$student_id = $_POST["studentId"];
		$o_marks = $_POST['oMarks'];
		$date = $_POST["date"];
				

		for ($i=0; $i < count($student_id); $i++) { 
			
			$query = "insert into student_quiz_marks_information(class_id,subject_id,student_id,o_marks,marks_date,teacher_id) values('$class_id','$subject_id','$student_id[$i]','$o_marks[$i]',STR_TO_DATE('$date','%m/%d/%Y'),'$teacher_id')";
			$result = mysqli_query($con,$query);


			
			if($result){
				$valid["success"] = true;
				$valid['message'] = "Saved Successfully";
			}
			else{
				$valid["success"] = false;
				$valid['message'] = mysqli_error($con);
			}
		}

		echo json_encode($valid);
	}
 ?>