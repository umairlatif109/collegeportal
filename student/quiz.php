<?php 
	session_start();
    if(!isset($_SESSION['student_id'])){		// check for the session of the student if not exists
        header("location:../index.php");		// redirect to the index.php
    }
	include"../includes/header.php";
	include"../php_actions/student/studentquiz.php";

	$page = "quiz";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Quiz</li>
		</ol>
	
		<div class="card text-white">
			<div class="card-header">
				<h4>Quiz Marks Information</h4>
			</div>
			<div class="card-body">
				<div class="message col-md-4">
					
				</div>
				<table class="table table-hover table-bordered" style="color:black;background:white;">
				    <thead>
				        <tr class="table-dark">
				            <th>Subject</th>
				            <th>Quiz Marks</th>
				            <th>Quiz Date</th>
				        </tr>
				    </thead>
				    <tbody>
							<?php if(@$quizes): ?>
								<?php foreach ($quizes as $quiz): ?>
									<tr>
										<td> <?php echo $quiz['subject_name']; ?></td>
										<td><b><?php echo $quiz['o_marks']; ?>/10</b></td>
										<td> <?php echo $quiz['date']; ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="7"> <h3 class="text-center">No Quizes</h3> </td>
								</tr>
							<?php endif; ?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include"../includes/footer.php"; ?>