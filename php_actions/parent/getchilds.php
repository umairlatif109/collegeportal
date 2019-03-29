<?php 
	include "../php_actions/connection.php";
	global $con;

	$parent_id = $_SESSION['parent_id'];

	$query = "select 
	student_information.student_id,
	student_information.roll_no,
    student_information.student_name,
    student_information.student_image,
    class_information.class_name 
from 
	student_information,
	parent_information,
	class_information 
WHERE 
	student_information.parent_id = parent_information.parent_id 
	and parent_information.parent_id = '$parent_id'
    AND class_information.class_id = student_information.class_id
    order by student_information.student_name" ;

	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) {
			$childs[] = $row;
		}
	}
 ?>

