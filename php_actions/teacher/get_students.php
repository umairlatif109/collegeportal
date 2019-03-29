<?php 
	include "../connection.php";
	global $con;


	if($_POST){
		$classId = $_POST['classId'];
		$subjectId = $_POST['selectSubject'];
		$students =  array("success" => false, "data" => array());


		$query = "select class_id,subject_id from student_exam_marks_information where class_id = $classId and subject_id = $subjectId and exam_type_id = 2 and date_format(marks_date,'%Y') = date_format(current_date,'%Y')";
		$result = mysqli_query($con,$query);

		if($result){
			if(mysqli_num_rows($result) > 0){
				$students['success'] = false;
				$students['data'] = "Can't Make attendance Now, After Finals, for Selected Class";
			}
			else{

				$query = "select student_information.student_id,student_information.roll_no, student_information.student_name from student_information,teacher_subject_information,class_information where student_information.class_id = teacher_subject_information.class_id and teacher_subject_information.class_id = $classId and teacher_subject_information.subject_id = $subjectId and class_information.class_id = teacher_subject_information.class_id and class_information.class_id = student_information.class_id" ;
				$result = mysqli_query($con,$query);

				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result)){

						$options = "<select class='col-md-8' id = 'attendance_status[$row[1]]' name='attendance_status[]'><option value='p'>Present</option><option value='a'>Absent</option><option value='l'>Leave</option></select>";
						
						$inputfields = "<input type='hidden' name='studentId[]' value='$row[0]'>";
						$students['data'][] = array(
								$inputfields,
								$row['roll_no'],
								$row['student_name'],
								$options
							);
					}
					$students['success'] = true;
				}
			}
		}//$result end


	}

	echo json_encode($students);
	
 ?>