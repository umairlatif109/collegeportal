<?php 
	session_start();
    if(!isset($_SESSION['student_id'])){		// check for the session of the student if not exists
        header("location:../index.php");		// redirect to the index.php
    }
	include"../includes/header.php";
	include"../php_actions/admin/publicevent.php";
	include"../php_actions/student/studenttimetable.php";

	$page ="dashboard";
 ?>
	<div class="row">
		<?php include"../includes/sidebar.php"; ?>
		<div class="col-md-9">
			<ol class="breadcrumb mt-3">
			  <li class="breadcrumb-item active">Dashboard</li>
			</ol>

		<div class="card border-info mt-3">
			<div class="card-header bg-info">
				<h4 class="float-left">Event</h4>
				<div class="form-group mt-2 row float-right">
					<b>Limit</b>
					<select class="ml-2" name="limit" id="limit">
						<option value="5">Default</option>
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
				</div>
			</div>
			<div class="card-body" id="loadevents">
				<?php if(@$output): ?>

					<?php foreach(@$output as $o): ?>
						
						<div class="card-body bg-secondary">
							<h3 style="padding-bottom:5px;border-bottom:2px solid #3498DB;" ><?php echo $o[0]; ?></h3>
							<p class="text-justify"><?php echo $o[1]; ?></p>
							<p><span style="padding-bottom:5px;border-bottom:2px solid #3498DB;"><b><?php echo $o[2]; ?></b></span></p>
						</div>
						<br>

					<?php endforeach; ?>
				<?php else: ?>
					<h3 class="text-center">No Upcoming Event.</h3>
				<?php endif; ?>
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
			<div class="card border-secondary mt-3">
				<div class="card-header">
					<h4>Makeup Class</h4>
				</div>
				<div class="card-body">
					<table class="table table-hover table-bordered" id ="timetable" style="color:black;background:white;">
						<tr class="table-dark">
							<th>Day</th>
							<th>Subject</th>
							<th>Detail</th>
						</tr>
						<tbody>
						<?php if(@$makeups): ?>
							<?php foreach($makeups as $makeup): ?>
								<tr>
									<td><?php echo $makeup[0]; ?></td>
									<td><?php echo $makeup[1]; ?></td>
									<td><?php echo $makeup[2]; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan = "3"><center><h3>No Makeup Class</h3></center>	</td>
							</tr>
						<?php endif; ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<div class="scripts">
 	<?php include "../includes/chat.php"; ?>
    <script src="../custom/js/student_chat.js"></script> 
    <script src="../custom/js/publicevent.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>