<?php 
	include "../connection.php";

	global $con;

	$classId = $_POST['classId'];
	$subjectId = $_POST['subjectId'];
	$examType = $_POST['etId'];
	$date = $_POST['date'];
                            	

	$students = array("success" => false,"data" => null);

	if($_POST)
	{
		$query = "SELECT
					    student_information.roll_no,
					    student_information.student_name,
					    student_exam_marks_information.o_marks
					FROM
					    student_information,
					    teacher_subject_information,
					    student_exam_marks_information
					WHERE
					    student_information.class_id = teacher_subject_information.class_id 
					    AND teacher_subject_information.class_id = '$classId'
					    AND teacher_subject_information.subject_id = '$subjectId'
					    AND student_exam_marks_information.exam_type_id = '$examType'
					    AND date_format(student_exam_marks_information.marks_date,'%Y') = '$date'
					    AND teacher_subject_information.class_id = student_exam_marks_information.class_id
					    AND teacher_subject_information.subject_id =  student_exam_marks_information.subject_id
					    AND student_information.class_id =  student_exam_marks_information.class_id
					    AND student_information.student_id =  student_exam_marks_information.student_id" ;

		$result = mysqli_query($con,$query);

		if($result){

			if(mysqli_num_rows($result) > 0 ){
				while($row = mysqli_fetch_assoc($result)){

								$marks = "<b>".$row['o_marks']."/40</b>";

								$students['data'][] = array(
										$row['roll_no'],
										$row['student_name'],
										$marks
									);
							}
				$students['success'] = true;
			}
			else{
				$students['data'] = "No Record Found";
				$students['success'] = false;
			}
		}
		
		echo json_encode($students);
	}

 ?>