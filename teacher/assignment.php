<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/teacher/getteacherclasses.php";

	$page = "assignment";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Upload Assignment</li>
		</ol>

		<div class="card mt-3">
			<div class="card-header">
				<h4>Upload Assignment</h4>
			</div>
			<div class="card-body">
				<form method = "post" id="saveForm" action ="../php_actions/teacher/uploadassignment.php">
					<div class="message offset-2 col-md-4"></div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="teacherId" name="teacherId" value = "<?php echo $_SESSION['teacher_id']; ?> "/>
					</div>

					<div class="form-group row mb-3">
						<div class="col-md-2">
							<label class="float-right mt-1" for="">Date</label>
						</div>
						<div class="col-md-4">
							<input type="text" readonly="readonly" name="date" id="date" class="form-control" value="<?php echo date('m/d/Y'); ?>">
						</div>
					</div>	

					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="float-right mt-1" for="classId">Select Class</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
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
								<label class="float-right mt-1" for="subjectId">Select Subject</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<select id="subjectId" name="subjectId" class="form-control">
							
								</select>
							</div>
						</div>
		            </div>
		            <div class="form-group">
		            	<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="float-right mt-1" for="description">Enter Description</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" id="description" name="description" placeholder="Enter description" class="form-control">
							</div>
						</div>
		            </div>
					<div class="form-group">
					<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="endDate">
										End Date
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="endDate" name="endDate" placeholder="Enter End Date" readonly="readonly" class="form-control">
							</div>
						</div>
					</div>
		            <div class="form-group">
						<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="uploadFile">Choose File</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="file" class="form-control-file" id="uploadFile" name="uploadFile">
	                        </div>
                        </div>
					</div>
			</div>

			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
						<button type="submit" id="btnUpload" name="btnUpload" class="btn btn-outline-success float-right">Upload Assignment</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<br>
		<div class="card text-white">
			<div class="card-header">
				<h4>Assignment Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark" id="showAllAssignments">
				    <thead>
				        <tr class="table-dark">
				            <th>Class</th>
				            <th>Subject</th>
				            <th>Uploaded Date</th>
				            <th>Assignment Date</th>
				            <th>Description</th>
				            <th>Uploaded File</th>
				            <th>Student Attachment</th>
				            <th>Marks</th>
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

<div id="marksModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-th-list'></i> Assignment Marks</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<div class="messages"></div>
		<form method = "post" id="marksForm" action ="../php_actions/teacher/assignmentmarks.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="ta_id" name="ta_id"/>
				<input type="hidden" class="form-control" id="student_id" name="student_id"/>
			</div>
			<div class="form-group">
				<label for="oMarks">Obtain Marks</label>
				<input type="number" min="0" max ="10" required onkeyup="this.value=this.value.replace(/[^0-9\s]/g,'');" class="form-control" id="oMarks" name="oMarks"/>
			</div>
			<input type="submit" = "submitBtn" class="btn btn-block btn-success" name="submitBtn" value="Save">
		</form>
		</div>
		</div>
	</div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Assignment</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Assignment ?</h4>
				<!-- <p class="text-warning">It may also delete the student assignment record.</p> -->
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
    <script src="../custom/js/assignment.js"></script>
</div>
<?php include"../includes/footer.php"; ?>