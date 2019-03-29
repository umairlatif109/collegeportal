<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){		// check for the session of the teacher if not exists
        header("location:login.php");			// redirect to the teacher/login.php
    }
	include"../includes/header.php";
	include"../php_actions/admin/singleteacher2.php";
 ?>

 	<div class="row">
		<?php include"../includes/sidebar.php"; ?>
		<div class="col-md-9">
			<ol class="breadcrumb mt-3">
			  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
			  <li class="breadcrumb-item active">Profile</li>
			</ol>

			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<img src="<?php echo $output['teacher_image']; ?>" height = "200" width="200" alt="">
						</div>
						<div class="offset-4 col-md-2">
							<a data-toggle='modal' data-target='#updateModal' class="btn btn-outline-warning btn-block float-right">Change Password</a>
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
		</div>
	</div>

<div id="updateModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Change Password</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="message">
				
			</div>
		<form method = "post" id="updateForm" action ="../php_actions/teacher/updatepassword.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="teacherId" name="teacherId" value= "<?php echo $output['teacher_id']; ?>"/>
			</div>
			<div class="form-group">
				<label for="currentPassword">Current Password</label>
				<input type="password" class="form-control" id="currentPassword" name="currentPassword"/>
			</div>
			<hr>
			<div class="form-group">
				<label for="newPassword">New Password</label>
				<input type="password" class="form-control" id="newPassword" name="newPassword"/>
			</div>
			<div class="form-group">
				<label for="confirmPassword">Confirm Password</label>
				<input type="password" class="form-control" id="confirmPassword" name="confirmPassword"/>
			</div>
			<input type="submit" = "submitBtn" class="btn btn-block btn-success " name="submitBtn" value="Update">
		</form>
		</div>
		</div>
	</div>
</div>
<div class="scripts">
     <script src="../custom/js/changepassword.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>