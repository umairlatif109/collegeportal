<?php 
session_start();

	if(isset($_SESSION['student_id'])){ // checks for the student session on the base of student id if exists
		unset($_SESSION['student_id']); // unset the session means destroy the session
		header("location:../index.php"); // redirect to student login page
	}
	if(isset($_SESSION['teacher_id'])){ // checks for the teacher session on the base of teacher id if exists
		unset($_SESSION['teacher_id']); // unset the session means destroy the session
		header("location:../teacher/login.php"); // redirect to teacher login page
	}
	if(isset($_SESSION['parent_id'])){ // checks for the parent session on the base of parent id if exists
		unset($_SESSION['parent_id']); // unset the session means destroy the session
		header("location:../parent/login.php"); // redirect to teacher login page
	}
	if(isset($_SESSION['admin']) && isset($_SESSION['user_id'])){// admin session will be destroyed
		unset($_SESSION['admin']); // unset the session means destroy the session
		unset($_SESSION['user_id']); // unset the session means destroy the session
		header("location:../admin/login.php"); // redirect to admin login page
	}
 ?>