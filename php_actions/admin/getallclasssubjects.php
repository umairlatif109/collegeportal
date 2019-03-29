<?php 
	include"../connection.php";
	global $con;

	$class_id = $_POST["class_id"];
	$query = "SELECT subject_information.subject_name,class_subject_information.cs_id FROM subject_information, class_subject_information where subject_information.subject_id = class_subject_information.subject_id and class_subject_information.class_id = $class_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<a class='btn btn-danger btn-sm' onclick='deleteSubject($row[1])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a>";
			$output['data'][] = array(
					$row[0],
					$buttons

				);
		}
	}
	echo json_encode($output);
 ?>