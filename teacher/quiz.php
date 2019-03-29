<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/teacher/getteacherclasses.php";

	$page = "quiz";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Quiz</li>
		</ol>

		<div class="card mt-3" id="generateResult">
			<div class="card-header">
				<h4 class="float-left">Quiz</h4>
				<div class="float-right"><a class="btn btn-warning text-white" href="viewquiz.php">View Quiz Marks</a></div>
			</div>
			<div class="card-body">
				<form method = "post" id="saveForm" action ="../php_actions/teacher/quiz.php">
					<div class="message offset-2 col-md-4"></div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="teacherId" name="teacherId" value = "<?php echo $_SESSION['teacher_id']; ?> "/>
					</div>

					<div class="form-group row mb-3">
						<div class="col-md-2">
							<label class="float-right mt-1" for="">Date</label>
						</div>
						<div class="col-md-4">
							<input type="text" readonly="readonly" name="date" id="date" class="form-control" value="<?php echo date('m/d/Y'); ?>">
						</div>
					</div>	

		            <div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="float-right mt-1" for="classId">Class</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
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
								<label class="float-right mt-1" for="subjectId">Select Subject</label>
					 		</div>
							<div class="col-md-4 col-sm-3 col-xs-12">
								<select id="subjectId" name="subjectId" class="form-control">
							
								</select>
							</div>
						</div>
		            </div>
			</div>

			<div class="card-footer">
				<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
						<button type="submit" id="saveBtn" name="saveBtn" class="btn btn-outline-success float-right">Quiz Marks</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="card text-white marksCard">
			<div class="card-header">
				<h4>Save Quiz Marks</h4>
			</div>
			<div class="card-body ok2">
				<h4 class="breadcrumb text-white ok"></h4>
				<div class="message col-md-4"></div>
				<form action="../php_actions/teacher/savequiz.php" method="post" id="marksForm">
					<table class="table table-bordered table-hover" id="MarksTable" style="color:black;background:white;">
						<thead>
							<tr class="table-dark">
								<th>Roll No</th>
								<th>Student Name</th>
								<th>Obtained Marks</th>
							</tr>
						</thead>
						<tbody class="marks-area">
							
						</tbody>
					</table>
					<button type="submit" class="btn btn-success float-right mb-5">Save Marks</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="scripts">
    <script src="../custom/js/quiz.js"></script>
</div>
<?php include"../includes/footer.php"; ?>