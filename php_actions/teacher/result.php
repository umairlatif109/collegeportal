<?php 
	include "../connection.php";
	global $con;


	if($_POST){
		$classId = $_POST['classId'];
		$subjectId = $_POST['subjectId'];
		$examType = $_POST['etId'];

		$students =  array("success" => false, "data" => null,'exam' => null);

		// this is the query to check whether the exam of given class is scheduled on not
		$checkExam = "SELECT
						    class_information.class_name,
						    exam_type_information.exam_type,
						    subject_information.subject_name
						FROM
						    exam_information,
						    class_information,
						    exam_type_information,
						    subject_information,
						    teacher_subject_information,
						    datesheet_information
						WHERE
						    DATE_FORMAT(start_date, '%Y') = DATE_FORMAT(CURRENT_DATE, '%Y') 
						    AND exam_information.exam_type_id = '$examType'
						    AND exam_information.class_id = '$classId' 
						    and exam_information.class_id = class_information.class_id
						    and datesheet_information.exam_type_id = exam_information.exam_type_id
						    and datesheet_information.exam_type_id = exam_type_information.et_id
						    and teacher_subject_information.subject_id = subject_information.subject_id
						    and teacher_subject_information.class_id = exam_information.class_id
						    and subject_information.subject_id = datesheet_information.subject_id
						    and datesheet_information.class_id = exam_information.class_id
						    and datesheet_information.subject_id = $subjectId";
		$checkExamResult = mysqli_query($con,$checkExam);

		if($checkExamResult){
			if(mysqli_num_rows($checkExamResult) > 0){ // if exam of given class is scheduled


				//check for result whether the result of given class and subject is exists or not
				$checkResult = "SELECT * from student_exam_marks_information where exam_type_id = '$examType' and class_id = '$classId' and subject_id = '$subjectId' and  DATE_FORMAT(marks_date, '%Y') = DATE_FORMAT(CURRENT_DATE, '%Y')";

				$checkResultResult = mysqli_query($con,$checkResult);

				if($checkResultResult){
					if(mysqli_num_rows($checkResultResult) > 0){
						$students['success'] = false;
						$students['exam'] = "Result Already Posted of Selected Exam Type of current year: ".date("Y");
					}
					else{

						// show the exam / class / subject when marks table will visible
						while($row2 = mysqli_fetch_array($checkExamResult)){
								$students['exam'] = $row2['exam_type']." / ".$row2['class_name']." / ".$row2['subject_name'];
							}

						// generating the marks table for students
						$query = "SELECT student_information.student_id,student_information.roll_no, student_information.student_name from student_information,teacher_subject_information,class_information where student_information.class_id = teacher_subject_information.class_id and teacher_subject_information.class_id = $classId and teacher_subject_information.subject_id = $subjectId and class_information.class_id = teacher_subject_information.class_id and class_information.class_id = student_information.class_id" ;

						$result = mysqli_query($con,$query);

						if(mysqli_num_rows($result) > 0)
						{

							while($row = mysqli_fetch_array($result)){

								$marks = "<input type='number' name='oMarks[]' min='0' max='40' class='form-control col-md-8 border-secondary' title='Enter Marks' placeholder='Enter Marks' required='required'>";
								
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
			else{
				$students['success'] = false;
				$students['exam'] = "No Exam is Scheduled at this Time";
			}
		}
	}

	echo json_encode($students);
	
 ?>