<?php 
	include"../connection.php";
	global $con;

	$query = "SELECT teacher_id, teacher_name, teacher_address, teacher_qualification, teacher_gender, teacher_phone, teacher_email, teacher_cnic, teacher_image, teacher_username, teacher_password, DATE_FORMAT(hire_date, '%D %M, %Y')  from teacher_information" ;

	$result = mysqli_query($con,$query);
	$output = array("data" => array());
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$buttons = 
			"<center><div class='btn-group'>
			<a class='btn btn-info btn-sm' href='http://localhost/collegeportal/admin/teacher.php?teacherId=$row[0]' >
					<i class='glyphicon glyphicon-question-sign'></i> View
			</a>
			<a class='btn btn-success btn-sm' data-toggle='modal' data-target='#teacherSubjectModel' onclick='teacherSubject($row[0])' >
					<i class='glyphicon glyphicon-book'></i> Subject
			</a>
			<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal' onclick='editTeacher($row[0])' >
					<i class='glyphicon glyphicon-edit'></i> Edit
			</a>
			<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick='deleteTeacher($row[0])' >
				<i class='glyphicon glyphicon-trash'></i> Delete
			</a></div></center>";
			
			$str = substr($row[8], 3);
			$images = "<img src='$str' height='100' width='100'>";

			$profile = "<div class='offset-1 border-success'><h5>$row[1]</h5>$images</div>";
			$output['data'][] = array(
					$profile,
					$row[5],
					$row[7],
					$buttons,

				);
		}
	}
	echo json_encode($output);
 ?>

