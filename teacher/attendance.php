<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/teacher/get_timetable_subjects.php";

	$page = "attendance";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Student Attendance</li>
		</ol>

		<div class="card">
			<div class="card-header">
				<h4>Make Attendance</h4>
			</div>
			<div class="card-body">
				<div class="amessage offset-2 col-md-4"></div>
				<?php if(@$output): ?>
				<form action="../php_actions/teacher/get_students.php" method="post" id="makeAttendanceForm">
					<div class="form-group row mb-3">
						<div class="col-md-2">
							<label class="float-right mt-1" for="">Date</label>
						</div>
						<div class="col-md-4">
							<input type="text" readonly="readonly" name="date" id="date" class="form-control" value="<?php echo date('d/m/Y'); ?>">
						</div>
					</div>
					<div class="form-group row mb-3">
						<div class="col-md-2">
							<label class="float-right mt-1" for="selectSubject">Class</label>
						</div>
						<div class="col-md-4">
							<?php foreach($output as $r): ?>
								<input type="hidden" name="classId" id="classId" value="<?php echo $r['class_id']; ?>">
								<input type="text" readonly="readonly" class="form-control" value="<?php echo $r['class_name']; ?>">
							<?php endforeach; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label class="float-right mt-1" for="selectSubject">Select Subject</label>
						</div>
						<div class="col-md-4">
							<select class="form-control" name="selectSubject" id="selectSubject">
								<option value="-1">--- Select Subject ---</option>
								<?php foreach($output as $r): ?>
								<option value="<?php echo $r['subject_id']; ?>"><?php echo $r['subject_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group row mt-3">
						<div class="col-md-2">
							<label class="float-right mt-1" for="lectureTopic">Lecture Topic</label>
						</div>
						<div class="col-md-8">
							<input type="text" readonly="readonly" class="form-control" name="lectureTopic" id="lectureTopic" placeholder = "Enter Title here">
						</div>
					</div>
					<div class="col-md-6 mt-3">
						<button type="submit" id="makeAttendance" name="makeAttendance" class="btn btn-outline-success float-right" > Make Attendance </button>
					</div>
				</form>
				<?php else: ?>
					<div class="alert alert-danger"> No <b>Class Scheduled</b> at this time ... Sorry !!!</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="card mt-3" id="attendanceCard">
				<div class="card-header">
					<h4>Attendance</h4>
				</div>

				<div class="card-body">
					<div class="message col-md-6">
						
					</div>
					<form action="../php_actions/teacher/saveattendance.php" method="post" id="attendanceForm">
						<table class="table table-sm table-bordered table-hover" id="attendanceTable" style="color:black;background:white;">
							<thead>
								<tr class="table-dark">
									<th>Roll No</th>
									<th>Student Name</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody class="attendance-area">
								
							</tbody>
						</table>
						<button type="submit" class="btn btn-success float-right mb-5">Save Attendance</button>
					</form>	
				</div>
		</div>

	</div>
</div>
<div class="scripts">
    <script src="../custom/js/attendance.js"></script>
</div>
<?php include"../includes/footer.php"; ?>