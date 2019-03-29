<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/admin/getclasses.php";
	include"../php_actions/admin/getrooms.php";
	include"../php_actions/admin/getteachers.php";
	include"../php_actions/admin/getsubjects.php";
	$page = "timetable";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Time Table</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Time Table</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="post" action="../php_actions/admin/timetable.php" class="form-horizontal" id="saveTimeTable">

					<div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="classId">
									Select Class
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
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
					 	</div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="subjectId">
									Select Subject
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            	<select id="subjectId" name="subjectId" class="form-control">

								</select>
                            </div>
					 	</div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherId">
									Select Teacher
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            	<select id="teacherId" name="teacherId" class="form-control">
 
								</select>
                            </div>
					 	</div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="roomId">
									Select Room
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
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
					 	</div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="selectDay">
									Select Day
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            	<select id="selectDay" name="selectDay" class="form-control">
									<option value="0">---Choose Day---</option>
									<option value="monday">Monday</option>
									<option value="tuesday">Tuesday</option>
									<option value="wednesday">Wednesday</option>
									<option value="thursday">Thursday</option>
									<option value="friday">Friday</option>
									<option value="saturday">Saturday</option>
									<option value="sunday">Sunday</option>
								</select>
                            </div>
					 	</div>
                    </div>
                    <div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="startTime">
										Start Time	
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
                          		<input type="time" id="startTime" name="startTime" placeholder = "Enter Start Time" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="endTime">
										End Time	
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
                          		<input type="time" id="endTime" name="endTime" placeholder = "Enter End Time" class="form-control">
							</div>
						</div>
					</div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
						<button type="submit" id="btnTimetable" name="btnTimetable" class="btn btn-outline-success float-right">Save Time Table</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Time Table Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllTimetables">
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


<div id="updateModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Time Table</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updatetimetable.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editTimeTableId" name="editTimeTableId"/>
			</div>
			<div class="form-group">
		
				<label for="editClassId">
									Select Class
				</label>
		    	<select id="editClassId" name="editClassId" class="form-control">
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
				<label for="editSubjectId">
					Select Subject
				</label>
            	<select id="editSubjectId" name="editSubjectId" class="form-control">
					<?php if($subjects): ?>

						<option value="0">--- Choose Class ---</option>

					<?php foreach($subjects as $subject): ?>
						<option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
					<?php endforeach; ?>

					<?php else: ?>
						<option value="-1"> NO Class Found. </option>	
					<?php endif; ?>
				</select>
            </div>
            <div class="form-group">
			 	<label for="editTeacherId">
							Select Teacher
				</label>
            	<select id="editTeacherId" name="editTeacherId" class="form-control">
					<?php if($teachers): ?>

						<option value="0">--- Choose Class ---</option>

					<?php foreach($teachers as $teacher): ?>
						<option value="<?php echo $teacher['teacher_id']; ?>"><?php echo $teacher['teacher_name']; ?></option>
					<?php endforeach; ?>

					<?php else: ?>
						<option value="-1"> NO Class Found. </option>	
					<?php endif; ?>
				</select>
            </div>
            <div class="form-group">
			 	<label for="editRoomId">
							Select Room
						</label>
                    	<select id="editRoomId" name="editRoomId" class="form-control">
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
			 	<label for="editSelectDay">
					Select Day
				</label>
				<select id="editSelectDay" name="editSelectDay" class="form-control">
					<option value="0">---Choose Day---</option>
					<option value="monday">Monday</option>
					<option value="tuesday">Tuesday</option>
					<option value="wednesday">Wednesday</option>
					<option value="thursday">Thursday</option>
					<option value="friday">Friday</option>
					<option value="saturday">Saturday</option>
					<option value="sunday">Sunday</option>
				</select>
            </div>
            <div class="form-group">
				<label for="editSartTime">
						Start Time	
				</label>
          		<input type="time" id="editSartTime" name="editSartTime" placeholder = "Enter Start Time" class="form-control">
			</div>
			<div class="form-group">
				<label for="editEndTime">
						End Time	
				</label>
          		<input type="time" id="editEndTime" name="editEndTime" placeholder = "Enter End Time" class="form-control">

			</div>
			<input type="submit" = "submitBtn" class="btn btn-block btn-success " name="submitBtn" value="Update">
		</form>
		</div>
		</div>
	</div>
</div>


<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Time Table</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Time Table ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
	<script src="../custom/js/timetable.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>