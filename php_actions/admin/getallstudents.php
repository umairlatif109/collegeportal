<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT student_id, class_information.class_name, roll_no, student_name, parent_id, student_address, student_email, student_gender, student_cnic, student_phone, student_image, student_username, student_password, registration_date FROM student_information,class_information where student_information.class_id = class_information.class_id" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<center><div class='btn-group'>
			<a class='btn btn-info btn-sm' href='http://localhost/collegeportal/admin/student.php?studentId=$row[0]' >
					<i class='glyphicon glyphicon-question-sign'></i> View
			</a>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editStudent($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteStudent($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div></center>";
			
			$str = substr($row[10], 3);
			$images = "<img src='$str' height='100' width='100'>";

			$profile = "<div class='offset-1 border-success'><h5>$row[3]</h5>$images</div>";
			$output['data'][] = array(
					$row[2],
					$profile,
					$row[1],
					$buttons,

				);
		}
	}
	echo json_encode($output);
 ?>

