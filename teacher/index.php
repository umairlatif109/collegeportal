<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){		// check for the session of the teacher if not exists
        header("location:login.php");			// redirect to the teacher/login.php
    }

	include"../includes/header.php";
	include"../php_actions/admin/teachertimetable.php";
	include"../php_actions/admin/publicevent.php";
	include"../php_actions/teacher/getteacherclasses.php";
	include"../php_actions/teacher/getteacherdatesheets.php";
	include"../php_actions/admin/getrooms.php";
	// include"../php_actions/admin/getsubjects.php";

	$page = "dashboard";
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

		<div class="card text-white border-secondary mt-3">
			<div class="card-header">
				<h4>Date Sheet</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered" id ="datesheet" style="color:black;background:white;">
				    <thead>
				        <tr class="table-dark">
				            <th>Class</th>
				            <th>Day & Date</th>
				            <th>Detail</th>
				        </tr>
				    </thead>
				    <tbody>
				     	<?php if(@$datesheets): ?>
				     		<?php foreach($datesheets as $d): ?>
				     		<tr>
				     			<td><?php echo $d[0]; ?></td>
				     			<td><?php echo $d[1]; ?></td>
				     			<td><?php echo $d[2]; ?></td>
				     		</tr>
				     	<?php endforeach; ?>
				     	<?php else: ?>
				     		<tr>
								<td colspan = "3"><center><h3>No Exam Scheduled.</h3></center>	</td>
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
						<th>Class</th>
						<th>Lecture</th>
					</tr>
					<tbody>
					<?php if($timetables): ?>
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
				<h4 class="float-left">Make Up Class</h4>
				<button href="" data-toggle='modal' data-target='#makeupModal' class="float-right btn btn-outline-success">Add MakeUp Class</button>
			</div>
			<div class="card-body">
				<div class="col-md-4 message">
					
				</div>
				<table class="table table-hover table-bordered" id="makeuptimetable" style="color:black;background:white;">
					<thead>
						<tr class="table-dark">
							<th>Day</th>
							<th>Class</th>
							<th>Lecture</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="makeupModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-plus'></i> Add MakeUp Class</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="saveForm" action ="../php_actions/teacher/makeup.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="teacherId" name="teacherId" value = "<?php echo $_SESSION['teacher_id']; ?> "/>
			</div>
			<div class="form-group">
				<label for="teacherName">Teacher Name</label>
				<input type="text" readonly="readonly" class="form-control" id="teacherName" name="teacherName" value = "<?php echo $_SESSION['user_name']; ?> "/>
			</div>
			<div class="form-group">
		
				<label for="classId">
									Select Class
				</label>
		    	<select id="classId" name="classId" class="form-control">
				<?php if($classes): ?>

				<option value="0">--- Choose Class ---</option>

				<?php foreach($classes as $class): ?>
					<option value="<?php echo $class['class_id']; ?>"><?php echo $class['class_name']; ?></option>
				<?php endforeach; ?>

				<?php else: ?>
					<option value="-1"> NO Class Found. </option>	
				<?php endif; ?>
				</select>						

            </div>
            <div class="form-group">
				<label for="subjectId">
					Select Subject
				</label>
            	<select id="subjectId" name="subjectId" class="form-control">
					
				</select>
            </div>
            <div class="form-group">
			 	<label for="roomId">
					Select Room
				</label>
            	<select id="roomId" name="roomId" class="form-control">
					<?php if($rooms): ?>

						<option value="0">--- Choose Room ---</option>

						<?php foreach($rooms as $room): ?>
							<option value="<?php echo $room['room_id']; ?>"><?php echo $room['room_name']." (".$room['room_no'].")" ; ?></option>
						<?php endforeach; ?>

					<?php else: ?>
						<option value="-1"> NO Room Found. </option>	
					<?php endif; ?>
				</select>
            </div>
            <div class="form-group">
				<label for="makeupDate">
						Select Date	
				</label>
          		<input type="text" id="makeupDate" name="makeupDate" placeholder = "Select Date" class="form-control" readonly="readonly">
			</div>
            <div class="form-group">
				<label for="startTime">
						Start Time	
				</label>
          		<input type="time" id="startTime" name="startTime" placeholder = "Enter Start Time" class="form-control">
			</div>
			<div class="form-group">
				<label for="endTime">
						End Time	
				</label>
          		<input type="time" id="endTime" name="endTime" placeholder = "Enter End Time" class="form-control">

			</div>
			<input type="submit" = "submitBtn" class="btn btn-block btn-success " name="submitBtn" value="Save">
		</form>
		</div>
		</div>
	</div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete MakeUp Class</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this MakeUp Class ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>

<div class="scripts">
<?php include "../includes/chat.php"; ?>

<?php if(@$_GET['chat_with_teacher_parent'] == 1): ?>
    <script src="../custom/js/chat.js"></script>
<?php elseif(@$_GET['chat_with_teacher_parent'] == 2): ?>
	<script src="../custom/js/chat_with_teacher_parent.js"></script>
<?php endif; ?>

    <script src="../custom/js/makeupclass.js" ></script>
 	<script src="../custom/js/publicevent.js" ></script>
</div>

<?php include"../includes/footer.php"; ?>