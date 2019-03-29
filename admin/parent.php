<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	$page = "parent";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
		  <li class="breadcrumb-item active">Parent</li>
		</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Parent</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form action="../php_actions/admin/parent.php" method="post" id="saveParent" class="">
                    <div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="parentName">
									Parent Name
								</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" id="parentName" name="parentName" value="" placeholder="Enter Parent Name" class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="parentAddress">
										Address	
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
                          		<textarea class="form-control" id="parentAddress" name="parentAddress" rows="6" placeholder="Enter Parent Address"></textarea>
							</div>
						</div>
					</div>
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="parentEmail">
								Parent Email
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="email" id="parentEmail" name="parentEmail" value="" placeholder="Enter Email" class="form-control">
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right">
								Gender
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
	                        	<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="gender" id="male" value="male" required="">
									Male
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="gender" id="female" value="female" required="">
									Female
									</label>
								</div>
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="parentPhone">Phone No</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="parentPhone" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="parentPhone" minlength="11" maxlength="11" placeholder="Enter Phone No." class="form-control">
	                        </div>
                        </div>
                    </div>
					<div class="col-md-6">
				 		<hr>
					</div>
					<div class="form-group">
                        <div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="parentUserName">
								Parent Username
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="parentUserName" name="parentUserName" value="" placeholder="Enter Parent Username" class="form-control">
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="parentPassword">
								Password
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="password" id="parentPassword" name="parentPassword" value="" placeholder="Enter Password" class="form-control">
	                        </div>
                        </div>
                    </div>
			</div>
			<div class="card-footer">
					<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
					<button type="submit" id="btnParent" name="btnParent" class="btn btn-outline-success float-right">Save Parent</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Parents Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllParents">
				    <thead>
				        <tr class="">
				            <th>Name</th>
				            <th>Phone No</th>
				            <th>Email</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Parent</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action="../php_actions/admin/updateparent.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editParentId" name="editParentId"/>
			</div>
			
			<div class="form-group">
				<label for="editParentName">Parent Name</label>
				<input type="text" id="editParentName" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" name="editParentName"  placeholder="Enter Parent Name" class="form-control">
			</div>
            <div class="form-group">
				<label for="editParentAddress">Address</label>
      			<textarea class="form-control" id="editParentAddress" name="editParentAddress" rows="6" placeholder="Enter Parent Address"></textarea>
			</div>
            <div class="form-group">
                <label  for="editParentEmail">Parent Email</label>
				<input type="email" id="editParentEmail" name="editParentEmail" value="" placeholder="Enter Email" class="form-control">
            </div>
            <div class="form-group">
				<label>Gender</label>
                <select name="editGender" id="editGender">
                	<option value="male">Male</option>
                	<option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
            	<label for="editParentPhone">Phone No</label>
				<input type="text" id="editParentPhone" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="editParentPhone" minlength="11" maxlength="11" placeholder="Enter Phone No." class="form-control">
            </div><hr>
			<div class="form-group">
                <label for="editParentUserName">Parent Username</label>
				<input type="text" id="editParentUserName" name="editParentUserName" value="" placeholder="Enter Parent Username" readonly="readonly" class="form-control">
            </div>
            <div class="form-group">
            	<label for="editParentPassword">Password</label>
				<input type="password" id="editParentPassword" name="editParentPassword" value="" placeholder="Enter Password" class="form-control">
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Parent</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Parent ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
    <script src="../custom/js/parent.js"></script>
</div>
<?php include"../includes/footer.php"; ?>