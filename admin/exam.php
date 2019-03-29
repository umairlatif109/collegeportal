<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/admin/getexamtypes.php";
	include"../php_actions/admin/getclasses.php";
	$page = "exam";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Exam</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Exam</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form  action="../php_actions/admin/exam.php" method="post" id="saveExam">
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="examName">
									Select Exam
								</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<select id="examName" name="examName" class="form-control">
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
						</div>
					</div>
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
									<label class="control-label float-right pt-1" for="startDate">
										Start Date
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="startDate" name="startDate" readonly ="readonly" value="" placeholder="Enter Start Date" class="form-control">
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
								<input type="text" id="endDate" name="endDate" value="" readonly ="readonly" placeholder="Enter End Date" class="form-control">
							</div>
						</div>
					</div>
			</div>
			<div class="card-footer">
					<div class="form-group">
						<div class="col-md-6 col-sm-10 col-xs-12">
							<button type="submit" id="btnExam" name="btnExam" class="btn btn-outline-success float-right">Save Exam</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Exams Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllExams">
				    <thead>
				        <tr class="table-dark">
				        	<th>Exam</th>
				            <th>Date</th>
				            <th>Class Name</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Exam</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updateexam.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editExamId" name="editExamId"/>
			</div>
			<div class="form-group">
				<label for="">Exam Type</label>
					<select id="editExamName" name="editExamName" class="form-control">
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
				<label for="">Exam Type</label>
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
				<label>Start Date</label>
				<input type="text" id="editStartDate" class="form-control" name="editStartDate" readonly="readonly">
			</div>
			<div class="form-group">
				<label>End Date</label>
				<input type="text" id="editEndDate"class="form-control" name="editEndDate" readonly="readonly">
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Exam</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Exam ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
	<script src="../custom/js/exam.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>