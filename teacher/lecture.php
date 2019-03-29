<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/teacher/get_timetable_subjects.php";
	include"../php_actions/teacher/getteacherclasses.php";

	$page = "lecture";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Upload Lecture</li>
		</ol>

		<div class="card mt-3">
			<div class="card-header">
				<h4>Upload Lecture</h4>
			</div>
			<div class="card-body">
				<form method = "post" id="saveForm" action ="../php_actions/teacher/uploadlecture.php">
					<div class="message offset-2 col-md-4"></div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="teacherId" name="teacherId" value = "<?php echo $_SESSION['teacher_id']; ?> "/>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="float-right mt-1" for="teacherName">Teacher Name</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" readonly="readonly" class="form-control" id="teacherName" name="teacherName" value = "<?php echo $_SESSION['user_name']; ?> "/>
							</div>
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
								<label class="float-right mt-1" for="lectureNo">Lecture No</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="number" class="form-control" name= "lectureNo" id ="lectureNo" min='1'>
							</div>
						</div>
		            </div>
		            <div class="form-group">
		            	<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="float-right mt-1" for="description">Description</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="description" id="description">
							</div>
						</div>
		            </div>
		            <div class="form-group">
		            	<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="float-right mt-1" for="date">Date</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<input type="text" class="form-control" name= "date" id ="date" readonly ="readonly">
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
						<button type="submit" id="btnUpload" name="btnUpload" class="btn btn-outline-success float-right">Upload File</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<br>
		<div class="card text-white">
			<div class="card-header">
				<h4>Lecture Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark" id="showAllLectures">
				    <thead>
				        <tr class="table-dark">
				            <th>Class Name</th>
				            <th>Subject Name</th>
				            <th>Lecture No</th>
				            <th>Description</th>
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

<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Lecture</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Lecture ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
    <script src="../custom/js/lecture.js"></script>
</div>
<?php include"../includes/footer.php"; ?>