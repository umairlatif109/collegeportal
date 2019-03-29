<?php 
	include"../connection.php";
	global $con;

	$query = "select subject_syllbus_information.ss_id,class_information.class_name,subject_information.subject_name,subject_syllbus_information.subject_contents from class_information,subject_information,subject_syllbus_information where class_information.class_id = subject_syllbus_information.class_id and subject_information.subject_id = subject_syllbus_information.subject_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<div class='btn-group'>
			</a><a class='btn btn-info btn-sm' href='http://localhost/collegeportal/admin/subject_syllbus.php?ContentId=$row[0]' >
				<i class='glyphicon glyphicon-question-sign'></i> View
			</a>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editContents($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteContent($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</div>";
			$output['data'][] = array(
										$row[0],
										$row[1],
										$row[2],
										$buttons
									);
		}
	}
	echo json_encode($output);
 ?>