<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT exam_information.exam_id,exam_type_information.exam_type,date_format(exam_information.start_date,'%d/%m/%Y'),date_format(exam_information.end_date,'%d/%m/%Y'),class_information.class_name from exam_information,class_information,exam_type_information where exam_information.class_id =  class_information.class_id and exam_type_information.et_id = exam_information.exam_type_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<div class='btn-group'>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editExam($row[0])' >
				<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteExam($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div>";
			$output['data'][] = array(
					$row[1],
					"$row[2] - $row[3]",
					$row[4],
					$buttons

				);
		}
	}
	echo json_encode($output);
 ?>