<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT
			    teacher_assignment_information.ta_id,
			    class_information.class_name,
			    subject_information.subject_name,
			    teacher_assignment_information.upload_date,
			    teacher_assignment_information.end_date,
			    teacher_assignment_information.assignment_file,
			    teacher_assignment_information.description,
			    student_assignment_information.assignment_file AS student_assignment_file,
			    student_assignment_information.student_id,
			    student_assignment_marks_information.o_marks,
			    student_information.roll_no,
			    student_information.student_name
			FROM
			    teacher_assignment_information
			LEFT JOIN 
				student_assignment_information ON teacher_assignment_information.ta_id = student_assignment_information.ta_id
			LEFT JOIN
				student_assignment_marks_information ON teacher_assignment_information.ta_id = student_assignment_marks_information.ta_id
				AND student_assignment_marks_information.student_id = student_assignment_information.student_id
			LEFT JOIN student_information on student_information.student_id = student_assignment_information.student_id ,
			    class_information,
			    subject_information
			WHERE
			    class_information.class_id = teacher_assignment_information.class_id
			    AND subject_information.subject_id = teacher_assignment_information.subject_id";

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$udate = strtotime($row[3]);
			$upload_date = date("d/m/Y",$udate);


			$edate = strtotime($row[4]);
			$end_date = date("d/m/Y",$edate);

			$buttons = 
			"<div class='btn-group'>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#marksModal' onclick='marks($row[8],$row[0])'><i class='glyphicon glyphicon-th-list'></i> Marks </a>
			</div>"; // marks btn																		  //marks(student id ,ta_id means teacher assignment id)
			$teacherAssignmentFile = substr($row[5],3); // teacher assignment link
			$studentAssignmentFile = substr($row[7],3); // student assignment link
			$teacherAssignmentLink = "<a class='btn btn-success ml-4' target='_blank' href='$teacherAssignmentFile'><i class='glyphicon glyphicon-download'></i> Download</a>"; // btn to download student assignment file
			$studentAssignmentLink = $row[8] == null ? "-":"Roll NO: $row[10]<br>Name: $row[11]<br><a class='btn btn-success ml-4' target='_blank' href='$studentAssignmentFile'><i class='glyphicon glyphicon-download'></i> Download</a>";
			//$studentAssignmentLink -> has a check that if student has uploaded a file than download btn will be visible othewise text will be shown as "No file uploaded yet" 
			$marks = null;


			if($row[8] == null){
				$marks = "-";
			}
			else if($row[7] != null && $row[9] == null){
				$marks = $buttons;
			}
				else{
					$marks = "<b>$row[9]/10</b>";// if teacher has uploaded the marks of assignment then only marks will be visible
				}

			// if(date('d/m/Y') <= $end_date){// check if the current_date is less than and equal to end_date of assignment then teacher will not able to upload marks
			// 	$marks = $buttons; // message to show if date is less than and equal to end_date
			// }	
			// else{
			// 	if($row[9] == null){ // if date passed and student_assignment_file is empty then marks btn will not be visible
			// 		$marks = "-";
			// 	}
			// 	else if($row[11] == null){ // check if o_marks is null then marks btn will be visible otherwise not
			// 		$marks = $buttons;
			// 	}
			// 	else{
			// 		$marks = "<b>$row[11]/$row[8]</b>";// if teacher has uploaded the marks of assignment then only marks will be visible
			// 	}
			// }
			$output['data'][] = array(
										$row[1],
										$row[2],
										$upload_date,
										$end_date,
										$row[6],
										$teacherAssignmentLink,
										$studentAssignmentLink,
										$marks,
										"<a  class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteAssignment($row[0])' >
											<i class='glyphicon glyphicon-trash'></i> Delete
										</a>"
									);
		}
	}
	echo json_encode($output);
 ?>