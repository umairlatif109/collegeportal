<?php 
	include"../connection.php";
	global $con;

	$query = "select teacher_lecture_information.tl_id,class_information.class_name,subject_information.subject_name,teacher_lecture_information.lecture_no,teacher_lecture_information.lecture_file,teacher_lecture_information.description,date_format(teacher_lecture_information.upload_date,'%d/%m/%Y') from class_information,subject_information,teacher_lecture_information where class_information.class_id = teacher_lecture_information.class_id and subject_information.subject_id = teacher_lecture_information.subject_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<div class='btn-group'>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteLecture($row[0])'><i class='glyphicon glyphicon-trash'></i> Delete </a>
			</div>";
			$description = "<p>$row[5]</p><b>$row[6]</b>";
			$getlink = substr($row[4],3);
			$filelink = "<center>Lecture $row[3] <a class='btn btn-success ml-4' href='$getlink'><i class='glyphicon glyphicon-download'></i> Download</a></center>";
			$output['data'][] = array(
										$row[1],
										$row[2],
										$filelink,
										$description,
										$buttons
									);
		}
	}
	echo json_encode($output);
 ?>