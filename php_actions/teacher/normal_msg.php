<?php 
	include "../connection.php";

	global $con;

	if(isset($_POST['teacher_id'])){
		$teacher_id = $_POST['teacher_id'];
	
		/////////////////////////////////////////////////////////////////////////////
		// This query is to update the msg status to unread = 0 which is a new msg //
		/////////////////////////////////////////////////////////////////////////////
		$query = "UPDATE student_teacher_chat_information set unread = 0 where teacher_id = $teacher_id and from_send = 1";
		$result = mysqli_query($con,$query);

		if($result){
			echo "readed";
		}
		else
		{
			echo mysqli_error($con);
		}
	}

	if(isset($_POST['student_id'])){
		$student_id = $_POST['student_id'];
	
		/////////////////////////////////////////////////////////////////////////////
		// This query is to update the msg status to unread = 0 which is a new msg //
		/////////////////////////////////////////////////////////////////////////////
		$query = "UPDATE student_teacher_chat_information set unread = 0 where student_id = $student_id and from_send = 0";
		$result = mysqli_query($con,$query);

		if($result){
			echo "readed student msg";
		}
		else
		{
			echo mysqli_error($con);
		}
	}


	if(isset($_POST['teacher_id_for_parent'])){
		$teacher_id_for_parent = $_POST['teacher_id_for_parent'];
	
		/////////////////////////////////////////////////////////////////////////////
		// This query is to update the msg status to unread = 0 which is a new msg //
		/////////////////////////////////////////////////////////////////////////////
		$query = "UPDATE parent_teacher_chat_information set unread = 0 where teacher_id = $teacher_id_for_parent and send_from = 1";
		$result = mysqli_query($con,$query);

		if($result){
			echo "readed teacher msg";
		}
		else
		{
			echo mysqli_error($con);
		}
	}


	if(isset($_POST['parent_id'])){
		$parent_id = $_POST['parent_id'];
	
		/////////////////////////////////////////////////////////////////////////////
		// This query is to update the msg status to unread = 0 which is a new msg //
		/////////////////////////////////////////////////////////////////////////////
		$query = "UPDATE parent_teacher_chat_information set unread = 0 where parent_id = $parent_id and send_from = 0";
		$result = mysqli_query($con,$query);

		if($result){
			echo "readed teacher msg";
		}
		else
		{
			echo mysqli_error($con);
		}
	}

	
?>