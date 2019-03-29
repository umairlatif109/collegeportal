<?php 
	session_start();
    if(!isset($_SESSION['student_id'])){		// check for the session of the student if not exists
        header("location:../index.php");		// redirect to the index.php
    }
	include"../includes/header.php";

	$page = "result";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Student Result</li>
		</ol>
	
		<?php include"../php_actions/student/studentresult.php"; ?>
	</div>
</div>

<?php include"../includes/footer.php"; ?>