<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/admin/getclasses.php";
	include"../php_actions/admin/singleteacher2.php";
	$page = "teacher";

 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Teacher</li>
	</ol>

	<?php if(@$_GET['teacherId']): ?>

		<div class="card">
			<div class="card-header"><h3>Teacher Detail</h3></div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						<img src="<?php echo $output['teacher_image']; ?>" height = "200" width="200" alt="">
					</div>
				</div>
				<div class="col-md-5">
					<hr>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Name</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_name']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Qualification</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_qualification']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Gender</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_gender']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Phone No</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_phone']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>CNIC No</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_cnic']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Email</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_email']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Username</h5></div>
					<div class="col-md-6"><h5><?php echo $output['teacher_username']; ?></h5></div>
				</div>
				<div class="row mt-3">
					<div class="col-md-2 text-muted"><h5>Hire Date</h5></div>
					<div class="col-md-6"><h5><?php echo $output['hire_date']; ?></h5></div>
				</div>
				<div class="col-md-5">
					<hr>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Teacher</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="POST" action="../php_actions/admin/teacher.php" id="saveTeacher">
					<div class="form-group">
						<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherName">
								Teacher Name </label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="teacherName" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" name="teacherName"  value="" placeholder="Enter Teacher Name" class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="teacherAddress">
										Address	
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
                          		<textarea class="form-control" id="teacherAddress" name="teacherAddress" rows="6" placeholder="Enter Teacher Address"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherQualification">
								Teacher Qualification </label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="teacherQualification" onkeyup="this.value=this.value.replace(/[^A-Za-z()-/\s]/g,'');" name="teacherQualification" value="" placeholder="Enter Teacher Qualification" class="form-control">
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
										<input type="radio" class="form-check-input" name="gender" id="gender1" value="male" required="">
									Male
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="gender" id="gender2" value="female" required="">
									Female
									</label>
								</div>
	                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherPhone">Phone No </label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="teacherPhone" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="11" minlength="11" name="teacherPhone" value="" placeholder="Enter Phone No." class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherEmail">Email</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="email" id="teacherEmail" name="teacherEmail" value="" placeholder="Enter Email" class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherCnic">CNIC </label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="teacherCnic" min="0" maxlength="13" minlength="13" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="teacherCnic" value="" placeholder="Enter CNIC No." class="form-control">
	                        </div>
						 </div>
                    </div>
					<div class="form-group">
						<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="teacherPic">Choose Image</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="file" class="form-control-file" id="teacherPic" name="teacherPic" aria-describedby="fileHelp">
	                        </div>
                        </div>
					</div>
					<div class="col-md-6">
				 		<hr>
					</div>
					<div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherUserName">Teacher Username </label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="teacherUserName" name="teacherUserName" value="" placeholder="Enter Teacher Username" class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="form-group">
                    	<div class="row">
					 		<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="teacherPassword">Password</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
								<input type="password" id="teacherPassword" name="teacherPassword" value="" placeholder="Enter Password" class="form-control">
	                        </div>
						 </div>
                    </div>
                    <div class="col-md-6">
				 		<hr>
					</div>
					<div class="form-group">
						<div class="row">
                        	<div class="col-md-2 col-sm-4 col-xs-12">
							<label class="control-label float-right pt-1" for="teacherHireDate">Hire Date</label>
					 		</div>
	                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <input type="text" readonly="readonly" id="teacherHireDate" name="teacherHireDate" class="form-control" placeholder="Enter Hire Date">
	                        </div>
                        </div>
                    </div>
			</div>
			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<button type="submit" id="btnTeacher" name="btnTeacher" class="btn btn-outline-success float-right">Save Teacher</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Teachers Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllTeachers">
				    <thead>
				        <tr class="table-dark">
				            <th>Name</th>
				            <th>Phone No</th>
				            <th>CNIC No</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				     	
				    </tbody>
				</table>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<div id="updateModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Teacher</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="../php_actions/admin/updateteacher.php" id="updateForm">
					<input type="hidden" name="editTeacherId" id="editTeacherId">
					<div class="form-group">
						<label for="editTeacherName">Teacher Name</label>
						<input type="text" id="editTeacherName" name="editTeacherName" onkeyup="this.value=this.value.replace(/[^A-Za-z\s]/g,'');" value="" placeholder="Enter Teacher Name" class="form-control">
					 </div>
                    <div class="form-group">
						<label for="editTeacherAddress">Address</label>
                  		<textarea class="form-control" id="editTeacherAddress" name="editTeacherAddress" rows="6" placeholder="Enter Teacher Address"></textarea>
					</div>
					<div class="form-group">
						<label for="editTeacherQualification">Teacher Qualification </label>
						<input type="text" id="editTeacherQualification" name="editTeacherQualification" value="" placeholder="Enter Teacher Qualification" class="form-control">						 
                    </div>
                    <div class="form-group">
							<label>Gender</label>
	                        <select name="editGender" id="editGender">
	                        	<option value="male">Male</option>
	                        	<option value="female">Female</option>
	                        </select>
                    </div>
                    <div class="form-group">
						<label for="editTeacherPhone">Phone No </label>
						<input type="text" id="editTeacherPhone" name="editTeacherPhone" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" minlength="11" maxlength= "11"  value="" placeholder="Enter Phone No." class="form-control">
                    </div>
                    <div class="form-group">
						<label for="editTeacherEmail">Email</label>
						<input type="email" id="editTeacherEmail" name="editTeacherEmail" value="" placeholder="Enter Email" class="form-control">
                    </div>
                    <div class="form-group">
						<label for="editTeacherCnic">CNIC </label>
						<input type="text" id="editTeacherCnic" maxlength="13" minlength="13" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" name="editTeacherCnic" min="0" value="" placeholder="Enter CNIC No." class="form-control">
                    </div>
					<div class="form-group">
						<img src="" id="imagePrev" alt="" height="100" width="100"><br>
						<label for="editTeacherPic">Choose Image</label>
						<div class="row">
							<input type="file" class="form-control-file col-md-5 float-left" id="editTeacherPic" name="editTeacherPic" aria-describedby="fileHelp">
							<div class="messages col-md-6 float-right"></div>
						</div>
					</div>
				 		<hr>
					<div class="form-group">
						<label for="editTeacherUserName">Teacher Username </label>
						<input type="text" id="editTeacherUserName" name="editTeacherUserName" value="" placeholder="Enter Teacher Username" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                    	<label for="editTeacherPassword">Password</label>
						<input type="password" id="editTeacherPassword" name="editTeacherPassword" value="" placeholder="Enter Password" class="form-control">
                    </div>
				 		<hr>
					<div class="form-group">
						<label for="editTeacherHireDate">Hire Date</label>
					 	<input type="text" readonly="readonly" id="editTeacherHireDate" name="editTeacherHireDate" class="form-control" placeholder="Enter Hire Date">
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Teacher</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Teacher ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>


<!-- This model will show the form to save teacher subjects detail -->
<div id="teacherSubjectModel" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-book'></i> Teacher Subjects</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="messages"></div>
		<form method = "post" id="teacherSubjectForm" action ="../php_actions/admin/teacher_subject.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="teacherId" name="teacherId"/>
			</div>
			<div class="form-group">
				<label for="classId">Select Class</label>
				<select id="classId" name="classId" class="form-control">
					<!-- Gets class_id and class_name from class_information -->
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
				<label for="subjectId">Select Subject</label>
				<select id="subjectId" name="subjectId" class="form-control">
					
				</select>
			</div>
			<input type="submit" class="btn btn-block btn-success " name="saveTeacherSubject" value="Save">
		</form>
		<hr>
			<table class="table table-hover table-bordered myTable" style="color:black;background:white;" id="tcsr"> <!--tcsr teacher class subject relation-->
			    <thead>
			        <tr class="table-dark">
			            <th>Class</th>
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
    <script src="../custom/js/teacher.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>