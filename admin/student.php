<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/admin/getparents.php";
	include"../php_actions/admin/getclasses.php";
	include"../php_actions/admin/singlestudent2.php";
	$page = "student";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
		  <li class="breadcrumb-item active">Student</li>
		</ol>
		<?php if(@$_GET['studentId']): ?>
		<div class="card">
			<div class="card-header"><h3>Student Detail</h3></div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						<img src="<?php echo $output['student_image']; ?>" height = "200" width="200" alt="">
					</div>
				</div>
				<div class="col-md-5">
					<hr>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Name</h5></div>
					<div class="col-md-6"><h5><?php echo $output['student_name']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Class</h5></div>
					<div class="col-md-6"><h5><?php echo $output['class_name']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Roll No</h5></div>
					<div class="col-md-6"><h5><?php echo $output['roll_no']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Gender</h5></div>
					<div class="col-md-6"><h5><?php echo $output['student_gender']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Phone No</h5></div>
					<div class="col-md-6"><h5><?php echo $output['student_phone']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>CNIC No</h5></div>
					<div class="col-md-6"><h5><?php echo $output['student_cnic']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Email</h5></div>
					<div class="col-md-6"><h5><?php echo $output['student_email']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Username</h5></div>
					<div class="col-md-6"><h5><?php echo $output['student_username']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Registration Date</h5></div>
					<div class="col-md-6"><h5><?php echo $output['registration_date']; ?></h5></div>
				</div>
				<div class="col-md-5">
					<hr>
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Student </h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="post" action="../php_actions/admin/student.php" id="saveform">
					<div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="selectClass">
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
                            <div class="col-md-4 pt-1 text-danger">Maximum number of students: 50</div>
					 	</div>
                    </div>
					<div class="form-group">
						<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="rollNo">
									Roll No
								</label>
					 		</div>
	                        <div class="col-md-2 col-sm-4 col-xs-12">
								<input type="number" id="rollNo" name="rollNo" value="0" readonly="readonly" placeholder="Roll No" class="form-control">
	                        </div>
					 	</div>
					</div>
					<div class="col-md-6">
				 		<hr>
					</div>
                    <div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="studentName">
									Student Name
								</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="studentName"  onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" name="studentName" value="" placeholder="Enter Student Name" class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="form-group">
					 	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="selectParent">
									Select Parent
								</label>
					 		</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            	<select id="parentId" name="parentId" class="form-control">
								<?php if($parents): ?>

									<option value="0">--- Choose Parent ---</option>

									<?php foreach($parents as $parent): ?>
										<option value="<?php echo $parent['parent_id']; ?>"><?php echo $parent['parent_name']." Phone: ".$parent['parent_phone']." Email: ".$parent['parent_email']." Address: ".$parent['parent_address']; ?></option>
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
									<label class="control-label float-right pt-1" for="studentAddress">
										Address	
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
                          		<textarea class="form-control" id="studentAddress" name="studentAddress" rows="6" placeholder="Enter Student Address"></textarea>
							</div>
						</div>
					</div>
                    <div class="form-group">
                        <div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="studentEmail">
								Student Email
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="email" id="studentEmail" name="studentEmail" value="" placeholder="Enter Email" class="form-control">
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
										<input type="radio" class="form-check-input" name="gender" id="male" value="male" required = "">
									Male
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="gender" id="female" value="female" required = "">
									Female
									</label>
								</div>
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="studentCnic">CNIC</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="studentCnic" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="studentCnic" minlength="13" maxlength="13" placeholder="Enter CNIC No." class="form-control">
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="studentPhone">Phone No</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="studentPhone" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="studentPhone" minlength="12" maxlength="12" placeholder="Enter Phone No." class="form-control"> <span class="text-warning">Note: format <b>923001234567</b></span>
	                        </div>
                        </div>
                    </div>
					<div class="form-group">
						<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="studentPic">Choose Image</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="file" class="form-control-file" id="studentPic" name="studentPic" aria-describedby="fileHelp">
	                        </div>
                        </div>
					</div>
					<div class="col-md-6">
				 		<hr>
					</div>
					<div class="form-group">
                        <div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="studentUserName">
								Student Username
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="studentUserName" name="studentUserName" value="" placeholder="Enter Student Username" class="form-control">
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="studentPassword">
								Password
							</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="password" id="studentPassword" name="studentPassword" value="" placeholder="Enter Password" class="form-control">
	                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
				 		<hr>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="studentRegisterDate">Registration Date</label>
							</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
                          			<input type="text" id="studentRegisterDate" name="studentRegisterDate" readonly="readonly" class="form-control" placeholder="Enter Registration Date">
	                        </div>
                        </div>
                    </div>
			</div>
			<div class="card-footer">
					<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
					<button type="submit" id="btnStudent" name="btnStudent" class="btn btn-outline-success float-right">Save Student</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Students Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllStudents">
				    <thead>
				        <tr class="">
				            <th>Roll NO</th>
				            <th>Name</th>
				            <th>Class</th>
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
				<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Student</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="../php_actions/admin/updatestudent.php" id="updateForm">
					<input type="hidden" id="editStudentId" name="editStudentId">
                    <div class="form-group">
                    	<label for="editStudentName">
							Student Name
						</label>
						<input type="text" id="editStudentName" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" name="editStudentName" value="" placeholder="Enter Student Name" class="form-control">
                    </div>
                    <div class="form-group">
						<label for="editParentId">
							Select Parent
						</label>
						<select id="editParentId" name="editParentId" class="form-control">
						<?php if($parents): ?>

							<option value="0">--- Choose Parent ---</option>

							<?php foreach($parents as $parent): ?>
								<option value="<?php echo $parent['parent_id']; ?>"><?php echo $parent['parent_name']; ?></option>
							<?php endforeach; ?>

						<?php else: ?>
							<option value="-1"> NO Parent Found. </option>	
						<?php endif; ?>
						</select>
                    </div>
                    <div class="form-group">
						<label for="editStudentAddress">
							Address	
						</label>
                  		<textarea class="form-control" id="editStudentAddress" name="editStudentAddress" rows="6" placeholder="Enter Student Address"></textarea>
					</div>
                    <div class="form-group">
                       <label for="editStudentEmail">
							Student Email
						</label>
						<input type="email" id="editStudentEmail" name="editStudentEmail" value="" placeholder="Enter Email" class="form-control">
                    </div>
                    <div class="form-group">
							<label>Gender</label>
	                        <select name="editGender" id="editGender">
	                        	<option value="male">Male</option>
	                        	<option value="female">Female</option>
	                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="editStudentCnic">CNIC</label>
						<input type="text" id="editStudentCnic" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="editStudentCnic" minlength="13" maxlength="13" placeholder="Enter CNIC No." class="form-control">
                    </div>
                    <div class="form-group">
                    	<label for="editStudentPhone">Phone No</label>
						<input type="text" id="editStudentPhone" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="editStudentPhone" minlength="11" maxlength="11" placeholder="Enter Phone No." class="form-control">
                    </div>
					<div class="form-group">
						<img src="" id="imagePrev" alt="" height="100" width="100"><br>
						<label for="editStudentPic">Choose Image</label>
						<div class="row">
							<input type="file" class="form-control-file col-md-4" id="editStudentPic" name="editStudentPic" aria-describedby="fileHelp">
							<div class="messages col-md-6 float-right"></div>
						</div>
					</div><hr>
					<div class="form-group">
                        <label for="editStudentUserName">
							Student Username
						</label>
						<input type="text" id="editStudentUserName" name="editStudentUserName" value="" placeholder="Enter Student Username" class="form-control" readonly = "readonly">
                    </div>
                    <div class="form-group">
                		<label for="editStudentPassword">
							Password
						</label>
						<input type="password" id="editStudentPassword" name="editStudentPassword" value="" placeholder="Enter Password" class="form-control">
                    </div><hr>
					<div class="form-group">
						<label for="editStudentRegisterDate">Registration Date</label>
              			<input type="text" id="editStudentRegisterDate" name="editStudentRegisterDate" readonly="readonly" class="form-control" placeholder="Enter Registration Date">
                    </div>
						<button type="submit" id="submitBtn" name="submitBtn" class="btn btn-success btn-block">Update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Student</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Student ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>

<div class="scripts">
    <script src="../custom/js/student.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>