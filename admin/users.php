<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	$page = "users";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Users</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Admin</h4>
			</div>
			<div class="card-body">
				<form method="post" action="../php_actions/admin/users.php" class="form-horizontal" id="saveAdmin">
					<div class="offset-2 message col-md-4">
						
					</div>
					 <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="adminName">
									Name
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="adminName" name="adminName" value="" placeholder="Enter Admin Name" class="form-control">
                            </div>
					 	</div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="adminUsername">
									Admin Username
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="adminUsername" name="adminUsername" value="" placeholder="Enter Admin Username" class="form-control">
                            </div>
					 	</div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="adminPassword">
									Admin Password
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="password" id="adminPassword" name="adminPassword" placeholder="Enter Password" class="form-control">
                            </div>
					 	</div>
                    </div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
						<button type="submit" id="btnAdmin" name="btnAdmin" class="btn btn-outline-success float-right">Save Admin</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card">
			<div class="card-header">
				<h4>Admins Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllUsers">
				    <thead>
				        <tr class="table-dark">
				            <th>Admin Id</th>
				            <th>Admin Name</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Admin</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updateuser.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editUserId" name="editUserId"/>
			</div>
			<div class="form-group">
				<label for="editAdminName">Admin Name</label>
				<input type="text" class="form-control" id="editAdminName" name="editAdminName"/>
			</div>
			<div class="form-group">
				<label for="editAdminUsername">Admin Username</label>
				<input type="text" class="form-control" id="editAdminUsername" readonly="readonly" name="editAdminUsername"/>
			</div>
			<div class="form-group">
				<label for="editAdminPassword">Admin Password</label>
				<input type="password" class="form-control" id="editAdminPassword" name="editAdminPassword"/>
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete User</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this User ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
    <script src="../custom/js/admin.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>