<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/admin/getclasses.php";
	include"../php_actions/admin/getsubjects.php";
	include"../php_actions/admin/select_subject_syllbus.php";
	$page = "subject_syllbus";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Syllbus</li>
	</ol>
	<?php if(@$_GET['ContentId']):?>
		<?php foreach($contents as $content): ?>
			<div class="card">
				<div class="card-header"><h3>Subject Contents</h3></div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-2"><h5 class="text-muted" >Class Name </h5></div>
						<div class="col-md-6"><h5> <?php echo $content['class_name']; ?></h5></div>
					</div>
					<div class="col-md-8"><hr></div>
					<div class="row">
						<div class="col-md-2"><h5 class="text-muted" >Subject Name </h5></div>
						<div class="col-md-6"><h5> <?php echo $content['subject_name']; ?></h5></div>
					</div>
					<div class="col-md-8"><hr></div>
					<div class="row">
						<div class="col-md-2"><h5 class="text-muted" >Contents </h5></div>
						<div class="col-md-6"><p> <?php echo $content['subject_contents']; ?></p></div>
					</div>
					<div class="col-md-8">
						<hr>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Contents</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="post" action="../php_actions/admin/subject_syllbus.php" class="form-horizontal" id="saveform">
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
									<?php if($subjects): ?>

									<option value="0">--- Choose Subject ---</option>

									<?php foreach($subjects as $subject): ?>
										<option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
									<?php endforeach; ?>

								<?php else: ?>
									<option value="-1"> NO Subject Found. </option>	
								<?php endif; ?>
								</select>
                            </div>
					 	</div>
                    </div>
                    <div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="subjectContents">
										Contents	
									</label>
						 		</div>
							<div class="col-md-8 col-sm-6 col-xs-12">
                          		<textarea class="form-control ckeditor" id="subjectContents" name="subjectContents" rows="10" placeholder="Enter Subject Contents"></textarea>
							</div>
						</div>
					</div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
						<button type="submit" id="btnSyllbus" name="btnSyllbus" class="btn btn-outline-success float-right">Save Syllbus</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Contents Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllContents">
				    <thead>
				        <tr class="table-dark">
				            <th>ID</th>
				            <th>Class</th>
				            <th>Subject</th>
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

<?php endif; ?>

<div id="updateModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Subject Contents</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/update_subject_syllbus.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="EditSsId" name="EditSsId"/>
			</div>
			<div class="form-group">
				<label for="editName">Select Class</label>
				<select id="editClassId" name="editClassId" class="form-control col-md-6">
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
				<label for="editSubjectId">Select Subject</label>
				<select id="editSubjectId" name="editSubjectId" class="form-control col-md-6">
					<?php if($subjects): ?>

					<option value="0">--- Choose Subject ---</option>

					<?php foreach($subjects as $subject): ?>
						<option value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
					<?php endforeach; ?>

				<?php else: ?>
					<option value="-1"> NO Subject Found. </option>	
				<?php endif; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="editSubjectContents">Select Subject</label>
				<textarea class="form-control ckeditor" id="editSubjectContents" name="editSubjectContents" rows="10" placeholder="Enter Subject Contents"></textarea>
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Content</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Content ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
	<script src="../assets/plugin/ckeditor/ckeditor.js"></script>
	<script src="../assets/plugin/ckeditor/adapters/jquery.js"></script>
	<script src="../custom/js/subject_syllbus.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>