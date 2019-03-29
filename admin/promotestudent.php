<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/admin/getclasses.php";
	$page = "promotestudent";
 ?>
	<div class="row">
		<?php include"../includes/sidebar.php"; ?>
		<div class="col-md-9">
			<ol class="breadcrumb mt-3">
			  	<li class="breadcrumb-item">Dashboard</li>
			  	<li class="breadcrumb-item active">Promote Student</li>
			</ol>
			

			<div class="card">
				<div class="card-header">
					<h4>Promote Student</h4>
				</div>
				<div class="card-body">
					<div class="message offset-2 col-md-4">
						
					</div>
					<form action="" method="post" id="getStudentsForm">
						<div class="form-group row mb-3">
							<div class="col-md-2">
								<label class="float-right mt-1" for="">Date</label>
							</div>
							<div class="col-md-4">
								<input type="text" readonly="readonly" name="date" id="date" class="form-control" value="<?php echo date('d/m/Y'); ?>">
							</div>
						</div>
						<div class="form-group">
						 	<div class="row">
						 		<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="selectClass">
										From Class
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
									<label class="control-label float-right pt-1" for="selectClass">
										To Class
									</label>
						 		</div>
	                            <div class="col-md-4 col-sm-6 col-xs-12">
	                            	<select id="toClassId" name="toClassId" class="form-control">
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

						<div class="col-md-6 mt-3">
							<button type="submit" id="getStudents" name="getStudents" class="btn btn-outline-success float-right" > Get Students </button>
						</div>
					</form>
				</div>
			</div>
			

			<div class="card mt-3" id="studentCard" style = "display:none;">
				<div class="card-header">
					<h4>Students</h4>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-7">
							<form action="../php_actions/admin/promotestudents.php" method="post" id="studentsForm">
								<table class="table table-sm table-bordered table-hover" id="studentsTable" style="color:black;background:white;">
									<thead>
										<tr class="table-dark">
											<th>Roll No</th>
											<th>Student Name</th>
										</tr>
									</thead>
									<tbody class="student-area">
										
									</tbody>
								</table>
								<button type="submit" class="btn btn-success float-right mb-5">Promote</button>
							</form>	
						</div>
					</div>
				</div>
		</div>
		</div>
	</div>
<div class="scripts">
	<script src="../custom/js/promotestudent.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>