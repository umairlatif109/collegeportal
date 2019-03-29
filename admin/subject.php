<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	$page = "subject";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Subject</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Subject</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="POST" action="../php_actions/admin/subject.php" id="saveSubject">
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="subjectName">
										Subject Name
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="subjectName" name="subjectName" value=""  placeholder="Enter Subject Name" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="tMarks">
										Total Marks
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="tMarks" name="tMarks" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" value=""  placeholder="Enter Total Marks" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="pMarks">
										Passing Marks
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="pMarks" name="pMarks" value="" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Enter Passing Marks" class="form-control">
							</div>
						</div>
					</div>
			</div>
			<div class="card-footer">
					<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
					<button type="submit" id="btnSubject" name="btnSubject" class="btn btn-outline-success float-right">Save Subject</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Subjects Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllSubjects">
				    <thead>
				        <tr class="table-dark">
				            <th>Subject ID</th>
				            <th>Subject Name</th>
				            <th>Total Marks</th>
				            <th>Passing Marks</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Subject</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updatesubject.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editSubjectId" name="editSubjectId"/>
			</div>
			<div class="form-group">
				<label for="editSubjectName">Subject Name</label>
				<input type="text" class="form-control" id="editSubjectName" name="editSubjectName"/>
			</div>
			<div class="form-group">
				<label for="editTmarks">Total Marks</label>
				<input type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="editTmarks" name="editTmarks"/>
			</div>
			<div class="form-group">
				<label for="editPmarks">Passing Marks</label>
				<input type="text" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="editPmarks" name="editPmarks"/>
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Subject</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Subject ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
    <script src="../custom/js/subject.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>