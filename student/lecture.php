<?php 
	session_start();
    if(!isset($_SESSION['student_id'])){		// check for the session of the student if not exists
        header("location:../index.php");		// redirect to the index.php
    }
	include"../includes/header.php";
	include"../php_actions/student/studentclasssubjects.php";
	include"../php_actions/student/getsubjectlectures.php";

	$page = "lecture";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Subject Lectures</li>
		</ol>
		<?php if(@$_GET['classId'] && @$_GET['subjectId']): ?>
		<div class="card">
			<div class="card-header">
				<h3>Lecture Information</h3>
			</div>
			<div class="card-body">
				<div class="row col-md-5 mt-3">
					<table class="table table-hover table-bordered" id ="timetable" style="color:black;background:white;">
						<tr class="table-dark">
							<th>Lecture No</th>
							<th>Action</th>
						</tr>
						<?php if(@$lectures): ?>

							<?php foreach($lectures as $lecture): ?>
								<tr>
									<td><center><b> <?php echo $lecture[0]; ?></b></center></td>
									<td><center><?php echo $lecture[1]; ?></center></td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
						<tr>
							<td colspan="2"><center><h5>No Lectures Uploaded</h5></center></td>
						</tr>
						<?php endif; ?>
					</table>
				</div>
			</div>
		</div>
		<?php else: ?>
				<?php if(@$subjects): ?>
					<?php foreach($subjects as $subject): ?>
							<div class="col-md-3 float-left mt-3">
								<div class="card border-secondary text-center">
									<div class="card-header">
										<h3><i class="glyphicon glyphicon-book"></i></h3>
										<h3><?php echo $subject['subject_name']; ?></h3>
									</div>
									<div class="card-body">
										<a href="?classId=<?php echo $subject['class_id']; ?>&subjectId=<?php echo $subject['subject_id']; ?>" class="btn btn-lg btn-outline-secondary text-white">Lectures</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
				<?php else: ?>
					<center><h3>No Subject Found</h3></center>
				<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>
</div>

<?php include"../includes/footer.php"; ?>