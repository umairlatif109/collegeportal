<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	$page = "class";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Class</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Class</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="post" action="../php_actions/admin/class.php" class="form-horizontal" id="saveClass">
					 <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="className">
									Class Name
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" onkeyup="this.value=this.value.replace(/[^A-Za-z0-9\s]/g,'');" id="className" name="className" value="" placeholder="Enter Class Name" class="form-control">
                            </div>
					 	</div>
                    </div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
						<button type="submit" id="btnClass" name="btnClass" class="btn btn-outline-success float-right">Save Class</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card">
			<div class="card-header">
				<h4>Classes Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllClasses">
				    <thead>
				        <tr class="table-dark">
				            <th>Class ID</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Class</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updateclass.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editClassId" name="editClassId"/>
			</div>
			<div class="form-group">
				<label for="editName">Class Name</label>
				<input type="text" onkeyup="this.value=this.value.replace(/[^A-Za-z0-9\s]/g,'');" class="form-control" id="editClassName" name="editClassName"/>
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Class</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Class ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>

<div id="subjectModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-book'></i> Select Subjects</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			
			<div class="messages"></div>
			<form method = "post" id="subjectForm" action ="../php_actions/admin/classsubject.php">
				<div class="form-group">
					<input type="hidden" class="form-control" id="classId" name="classId"/>
				</div>
				<div class="form-group">
					<label for="subjectId">Select Subject</label>
					<select id="subjectId" name="subjectId" class="form-control">
						
					</select>
				</div>
				<input type="submit" = "submitBtn" class="btn btn-block btn-success " name="submitBtn" value="Save">
			</form>
			<hr>
			<table class="table table-hover table-bordered myTable" style="color:black;background:white;" id="csr"> <!--csr class subject relation-->
			    <thead>
			        <tr class="table-dark">
			            <th>Subject</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody class="tablebody">
			     	
			    </tbody>
			</table>
		</div>
		</div>
	</div>
</div>

<div class="scripts">
    <script src="../custom/js/class.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>