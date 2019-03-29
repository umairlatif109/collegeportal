<?php 
	session_start();
    if(!isset($_SESSION['student_id'])){		// check for the session of the student if not exists
        header("location:../index.php");		// redirect to the index.php
    }
	include"../includes/header.php";
	include"../php_actions/student/studentclasssubjects.php";
	include"../php_actions/student/studentattendance.php";
	$page = "attendance";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Student Attendance</li>
		</ol>
		
		<?php if(@$_GET['subjectId'] && @$_GET['subjectName']): ?>
			<div class="card">
				<div class="card-header">
					<h3>Attendance Information</h3>
				</div>
				<div class="card-body">
					<p class="text-muted"><b>Subject / <?php echo $_GET['subjectName']; ?></b></p> 

					<div class="row">
						<div class="row col-md-5 mt-3">
							<table class="table table-hover table-bordered" id ="timetable" style="color:black;background:white;">
								<tr class="table-dark">
									<th class="text-center">Attendance Status</td>
									<th class="text-center">Date</td>
								</tr>
								<?php if(@$attendances):?>
									
									<?php foreach($attendances as $attendance): ?>
										<tr>
											<td><center><b> <?php echo $attendance[0]; ?></b></center></td>
											<td><center><?php echo $attendance[1]; ?></center></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
								<tr>
									<td colspan="2"><center><h5>No Record Found</h5></center></td>
								</tr>
								<?php endif; ?>
							</table>
						</div>
						<div class="col-md-3 mt-3">
							<div class="list-group">
								<li class="list-group-item">Total Lectures: <span class="badge badge-secondary"><?php  echo count(@$attendances); ?></span></li>
								<li class="list-group-item">Total Present: <span class="badge badge-secondary"><?php  echo $count_present; ?></span></li>
								<li class="list-group-item">Percentage: <span class="badge badge-secondary"><?php  echo (count(@$attendances) > 0 ) ? $count_present*100/count($attendances)." %" : "0 %"; ?></span></li>
							</div>
						</div>
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
								<a href="?subjectId=<?php echo $subject['subject_id']; ?>&subjectName=<?php echo $subject['subject_name']; ?>" class="btn btn-lg btn-outline-secondary text-white">Attendance</a>
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
<?php include"../includes/footer.php"; ?>