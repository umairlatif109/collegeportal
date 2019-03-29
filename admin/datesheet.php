<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";

	include"../php_actions/admin/getclasses.php";
	include"../php_actions/admin/getrooms.php";
	include"../php_actions/admin/getsubjects.php";
	include"../php_actions/admin/getexamtypes.php";
	$page = "datesheet";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Date Sheet</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Date Sheet</h4>
			</div>
			<div class="card-body">
			
				<form method="post" action="../php_actions/admin/datesheet.php" id="saveDateSheet">
					<div class="offset-2 message col-md-4">
						
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="examId">
									Select Exam
								</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<select id="examId" name="examId" class="form-control">
								<?php if($types): ?>

								<option value="0">--- Choose Exam Type ---</option>

								<?php foreach($types as $type): ?>
									<option value="<?php echo $type['et_id']; ?>"><?php echo $type['exam_type']; ?></option>
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
								<label class="control-label float-right pt-1" for="selectClass">
									Select Class
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            	<select id="classId" name="classId" class="form-control" disabled="disabled">
									
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
								<label class="control-label float-right pt-1" for="selectRoom">
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
								<label class="control-label float-right pt-1" for="date">
									Select Date
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            	<input type="text" id="date" name="date" placeholder="Choose Date" readonly="readonly" class="form-control">
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
                          		<input type="time" format="12" id="startTime" name="startTime" placeholder = "Enter Start Time" class="form-control">
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
						<button type="submit" id="btnDatesheet" name="btnDatesheet" class="btn btn-outline-success float-right">Save Datesheet</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white mt-3">
			<div class="card-header">
				<h4>Date Sheet Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllDateSheets">
				    <thead>
				        <tr class="table-dark">
				            <th>Class</th>
				            <th>Day & Date</th>
				            <th>Detail</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Date Sheet</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updatedatesheet.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editDateSheetId" name="editDateSheetId"/>
			</div>
			<div class="form-group">
		
				<label for="editExamId">
									Select Exam
				</label>
		    	<select id="editExamId" name="editExamId" class="form-control">
					<?php if($types): ?>

					<option value="0">--- Choose Exam Type ---</option>

					<?php foreach($types as $type): ?>
						<option value="<?php echo $type['et_id']; ?>"><?php echo $type['exam_type']; ?></option>
					<?php endforeach; ?>

					<?php else: ?>
						<option value="-1"> NO Type Found. </option>	
				<?php endif; ?>
				</select>					

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
			 	<label for="editDate">
					Select Date
				</label>
				<input type="text" id="editDate" name="editDate" placeholder="Choose Date" readonly="readonly" class="form-control">
            </div>
            <div class="form-group">
				<label for="editStartTime">
						Start Time	
				</label>
          		<input type="time" id="editStartTime" name="editStartTime" placeholder = "Enter Start Time" class="form-control">
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete DateSheet</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this DateSheet ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
	<script src="../custom/js/datesheet.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>