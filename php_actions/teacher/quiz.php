<?php 
	include "../connection.php";
	global $con;


	if($_POST){
		$classId = $_POST['classId'];
		$subjectId = $_POST['subjectId'];
		$date = $_POST['date'];
		$students =  array("success" => false, "data" => null,'quiz' => null);

		$query = "select class_id,subject_id from student_exam_marks_information where class_id = '$classId' and subject_id = '$subjectId' and exam_type_id = 2 and date_format(marks_date,'%Y') = date_format(current_date,'%Y')";
		$result = mysqli_query($con,$query);

		if($result){
			if(mysqli_num_rows($result) > 0){
				$students['success'] = false;
				$students['quiz'] = "Can't Upload Quiz Marks Now, After Finals for Selected Class";
			}
			else{

				$sdate = strtotime($date);
				$searchdate = date('Y-m-d',$sdate);
				//check for quiz whether the quiz of given class and subject is exists or not
				$checkQuizMarks = "SELECT * from student_quiz_marks_information where class_id = '$classId' and subject_id = '$subjectId' and marks_date = '$searchdate'";
				
				$checkQuizMarksResult = mysqli_query($con,$checkQuizMarks);

				if($checkQuizMarksResult){
					if(mysqli_num_rows($checkQuizMarksResult) > 0){
						$students['success'] = false;
						$students['quiz'] = "Quiz Marks are submitted at this Date";
					}
					else{
						// generating the marks table for students
						$query = "SELECT student_information.student_id,student_information.roll_no, student_information.student_name from student_information,teacher_subject_information,class_information where student_information.class_id = teacher_subject_information.class_id and teacher_subject_information.class_id = $classId and teacher_subject_information.subject_id = $subjectId and class_information.class_id = teacher_subject_information.class_id and class_information.class_id = student_information.class_id" ;

						$result = mysqli_query($con,$query);

						if(mysqli_num_rows($result) > 0)
						{

							while($row = mysqli_fetch_array($result)){

								$marks = "<input type='number' name='oMarks[]' min='0' max='10' class='form-control col-md-8 border-secondary' title='Enter Marks' placeholder='Enter Marks' required='required'>";
								
								$inputfields = "<input type='hidden' name='studentId[]' value='$row[0]'>";
								$students['data'][] = array(
										$inputfields,
										$row['roll_no'],
										$row['student_name'],
										$marks
									);
							}
							$students['success'] = true;
						}
					}
				}
			}
		}
	}

	echo json_encode($students);
	
 ?>