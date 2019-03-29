<?php 
	session_start();
    if(!isset($_SESSION['parent_id'])){		// check for the session of the parent if not exists
        header("location:login.php");		// redirect to the parent/login.php
    }
	include"../includes/header.php";
	include"../php_actions/admin/publicevent.php";
	include"../php_actions/parent/childdetail.php";

 ?>

	<div class="row">
		<div class="col-md-2 mt-3">
				
				<?php if(@$studentDetail): ?>
				<div class="card border-primary">
					<div class="card-body">
						<img width="100%" height="200" src=" <?php echo substr($studentDetail[0], 3); ?>" alt="">
					</div>
					<div class="bg-secondary card-footer">
				    	<div class="card-text text-center mt-3">
				    		<div>Name: <b><?php echo $studentDetail[1]; ?></b></div>
				    		<div>Class: <b><?php echo $studentDetail[2]; ?></b></div>
				    		<div>Roll No: <b><?php echo $studentDetail[3]; ?></b></div>
				    	</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="list-group mt-3">
			      <a href="index.php" class="list-group-item list-group-item-action <?php echo ($page=='dashboard') ? 'active' : ''; ?>">
			      	Dashboard
			      </a>
				</div>
		</div>
		<div class="col-md-9">
			<ol class="breadcrumb mt-3">
			  <li class="breadcrumb-item active">Dashboard</li>
			  <li class="breadcrumb-item active">Child Detail</li>
			</ol>
				
				<div class="card">
					<div class="card-header">
						<h4>Attendance Information</h4>
					</div>
					<div class="card-body">
						<?php include"../php_actions/parent/childattendance.php"; ?>
					</div>
				</div>

				<div class="card border-primary mt-3">
					<div class="card-header bg-primary">
						<h4>Time Table</h4>
					</div>
					<div class="card-body">
						<table class="table table-hover table-bordered" id ="timetable" style="color:black;background:white;">
							<tr class="table-dark">
								<th>Day</th>
								<th>Subject</th>
								<th>Detail</th>
							</tr>
							<tbody>
							<?php if(@$timetables): ?>
								<?php foreach($timetables as $timetable): ?>
									<tr>
										<td><?php echo $timetable[0]; ?></td>
										<td><?php echo $timetable[1]; ?></td>
										<td><?php echo $timetable[2]; ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan = "3"><center>No Record Found...</center>	</td>
								</tr>
							<?php endif; ?>
						</tbody>
						</table>
					</div>
				</div>
		
		
				<div class="card border-primary mt-3">
					<div class="card-header bg-primary">
						<h4>Exam Datesheet</h4>
					</div>
					<div class="card-body">
						<table class="table table-hover table-bordered" id ="datesheet" style="color:black;background:white;">
							<tr class="table-dark">
								<th>Day</th>
								<th>Subject</th>
								<th>Detail</th>
							</tr>
							<tbody>
							<?php if(@$datesheets): ?>
								<?php foreach($datesheets as $datesheet): ?>
									<tr>
										<td><?php echo $datesheet[0]; ?></td>
										<td><?php echo $datesheet[1]; ?></td>
										<td><?php echo $datesheet[2]; ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan = "3"><center>No Record Found...</center>	</td>
								</tr>
							<?php endif; ?>
						</tbody>
						</table>
					</div>
				</div>

				<div class="card mt-3">
					<div class="card-header">
						<h4>Result Information</h4>
					</div>
					<div class="card-body">
						<?php include"../php_actions/parent/childresult.php"; ?>
					</div>
				</div>

		</div>
	</div>
<?php include"../includes/footer.php"; ?>