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
					$getassignment = "SELECT
										    teacher_assignment_information.ta_id,
										    subject_information.subject_name,
										    DATE_FORMAT(
										        teacher_assignment_information.upload_date,
										        '%D %M, %Y'
										    ) AS upload_date,
										    DATE_FORMAT(
										        teacher_assignment_information.end_date,
										        '%d/%m/%Y'
										    ) AS end_date,
										    teacher_assignment_information.assignment_file as assignment_file,
										    teacher_assignment_information.description,
										    student_assignment_information.assignment_file as student_assignment_file,
                                            student_assignment_information.student_id,
										    DATE_FORMAT(
										        student_assignment_information.upload_date,
										        '%d/%m/%Y'
										    ) AS student_upload_date,
										    student_assignment_marks_information.o_marks
										FROM
										    teacher_assignment_information
										LEFT JOIN 
											student_assignment_information ON teacher_assignment_information.ta_id = student_assignment_information.ta_id
											 and student_assignment_information.student_id = '$student_id'
										LEFT JOIN
											student_assignment_marks_information ON teacher_assignment_information.ta_id = student_assignment_marks_information.ta_id  AND student_assignment_marks_information.student_id = student_assignment_information.student_id,
								       		class_information,
										    class_subject_information,
										    subject_information
										WHERE
										    class_information.class_id = class_subject_information.class_id
										    AND teacher_assignment_information.class_id = class_information.class_id 
										    AND class_subject_information.subject_id = subject_information.subject_id 
										    AND subject_information.subject_id = teacher_assignment_information.subject_id 
										    AND class_information.class_id = $class order by upload_date desc";


					$assignmentResult = mysqli_query($con,$getassignment);
					if($assignmentResult){
						if(mysqli_num_rows($assignmentResult) > 0){
							while ($row = mysqli_fetch_array($assignmentResult)) {

								$uploadform = "<form action='../php_actions/student/uploadassignment.php' method='post' id='uploadAssignment'>
												<input type='hidden' id='ta_id' name='ta_id' value='$row[0]'>
												<input type='hidden' id='student_id' name='student_id' value='$student_id'>
												<input type='file' id='studentAssignment' name='studentAssignment' class='form-control mb-2' name='studentAssignment' style='width:200px'>
												<button type='submit' class='btn btn-success btn-sm'>Upload Assignment</button>
											</form>";  // this is the form to upload assignment by the student


								$uploadStatus = null;

								if(date('d/m/Y') <= $row['end_date']){
									if($row['student_assignment_file'] == null){
										$uploadStatus = $uploadform;
									}
									else{
										$uploadStatus = "<span class='text-success'><b><i class='glyphicon glyphicon-ok'></i> Uploaded </b><br>".$row['student_upload_date']."</span>";
									}
								}
								else{
									if($row['student_assignment_file'] != null){
										$uploadStatus = "<span class='text-success'><b><i class='glyphicon glyphicon-ok'></i> Uploaded </b><br>".$row['student_upload_date']."</span>";
									}
									else{
										$uploadStatus = "<span class='text-danger'><b><i class='glyphicon glyphicon-exclamation-sign'></i> Date Passed - Can't Upload Now</b></span>";
									}
								}

								$marks = null;

								if($row['o_marks'] == null){
									$marks = "-";
								}
								else{
									$marks = "<b>".$row['o_marks']."/10</b>";
								}

								$assignments[] = array($row,$uploadStatus,$marks);
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