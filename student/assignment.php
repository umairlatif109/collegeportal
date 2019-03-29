<?php 
	session_start();
    if(!isset($_SESSION['student_id'])){		// check for the session of the student if not exists
        header("location:../index.php");		// redirect to the index.php
    }
	include"../includes/header.php";
	include"../php_actions/student/studentassignment.php";

	$page = "assignment";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Upload Assignment</li>
		</ol>
	
		<div class="card text-white">
			<div class="card-header">
				<h4>Assignment Information</h4>
			</div>
			<div class="card-body">
				<div class="message col-md-4">
					
				</div>
				<table class="table table-hover table-bordered" style="color:black;background:white;">
				    <thead>
				        <tr class="table-dark">
				            <th>Subject</th>
				            <th>Uploaded Date</th>
				            <th>Assignment Date</th>
				            <th>Description</th>
				            <th>Teacher Attachment</th>
				            <th>Student Attachment</th>
				            <th>marks</th>
				        </tr>
				    </thead>
				    <tbody>
							<?php if(@$assignments): ?>
								<?php foreach ($assignments as $assignment): ?>
									<?php $link = substr($assignment[0]['assignment_file'], 3); ?>
									<tr>
										<td> <?php echo $assignment[0]['subject_name']; ?></td>
										<td> <?php echo $assignment[0]['upload_date']; ?></td>
										<td> <?php echo $assignment[0]['end_date']; ?></td>
										<td> <?php echo $assignment[0]['description']; ?></td>
										<td> <?php echo "<a class='btn btn-success ml-4' target='_blank' href='$link'><i class='glyphicon glyphicon-download'></i> Download</a>"; ?></td>
										<td> <?php echo $assignment[1]; ?></td>
										<td> <?php echo $assignment[2]; ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="7"> <h3 class="text-center">No Assignments</h3> </td>
								</tr>
							<?php endif; ?>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
    <script src="../custom/js/studentassignment.js"></script>
</div>
<?php include"../includes/footer.php"; ?>