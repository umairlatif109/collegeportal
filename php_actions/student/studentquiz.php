<?php 
	include "../php_actions/connection.php";
	// include "../connection.php";
	global $con;
	// session_start();
	$student_id =  $_SESSION['student_id'];

	if($student_id){
		$getClass = "select class_id from student_information where student_id = '$student_id'";
		$result = mysqli_query($con,$getClass);

		if($result){
			if(mysqli_num_rows($result) > 0){
				while ($row = mysqli_fetch_array($result)) {
					$class = $row['class_id'];
				}

				if($class){
					$getquiz = "SELECT
								    subject_information.subject_name,
								    student_quiz_marks_information.o_marks,
								    DATE_FORMAT(
								        student_quiz_marks_information.marks_date,
								        '%d/%m/%Y'
								    ) AS 'date'
								FROM
								    subject_information,
								    student_quiz_marks_information
								WHERE
									student_quiz_marks_information.subject_id = subject_information.subject_id
								    AND student_quiz_marks_information.class_id = $class
								    AND student_quiz_marks_information.student_id = $student_id";


					$quizResult = mysqli_query($con,$getquiz);
					if($quizResult){
						if(mysqli_num_rows($quizResult) > 0){
							while ($row = mysqli_fetch_assoc($quizResult)) {
								$quizes[] = $row;
							}
						}
					}
					else{
						echo mysqli_error($con);
					}
				}
			}
		}
	}
 ?>