<?php 
	session_start();
    if(!isset($_SESSION['teacher_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include"../php_actions/teacher/getallexam_types.php";
	include"../php_actions/teacher/getteacherclasses.php";

	$page = "result";
	
 ?>
<div class="row">
<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
		<ol class="breadcrumb mt-3">
		  <li class="breadcrumb-item">Dashboard</li>
		  <li class="breadcrumb-item active">Result</li>
		</ol>

		<div class="card mt-3" id="generateResult">
			<div class="card-header">
				<h4 class="float-left">Result</h4>
				<div class="float-right"><a class="btn btn-warning text-white" href="viewresult.php">View Result</a></div>
			</div>
			<?php 

				global $con;
				$query = "SELECT * from exam_information where current_date between exam_information.start_date and exam_information.end_date";
				$result = mysqli_query($con,$query);
				if($result){
					if(mysqli_num_rows($result) == 0){
			?>


				<div class="card-body">
					<form method = "post" id="saveForm" action ="../php_actions/teacher/result.php">
						<div class="message offset-2 col-md-4"></div>
						<div class="form-group">
							<input type="hidden" class="form-control" id="teacherId" name="teacherId" value = "<?php echo $_SESSION['teacher_id']; ?> "/>
						</div>

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
									<label class="float-right mt-1" for="etId">Exam Type</label>
						 		</div>
								<div class="col-md-4 col-sm-3 col-xs-12">
									<select id="etId" name="etId" class="form-control">
										<?php if($examTypes): ?>

										<option value="0">--- Choose Exam Type ---</option>

										<?php foreach($examTypes as $examType): ?>
											<option value="<?php echo $examType['et_id']; ?>"><?php echo $examType['exam_type']; ?></option>
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
									<label class="float-right mt-1" for="classId">Class</label>
						 		</div>
								<div class="col-md-4 col-sm-3 col-xs-12">
									<select id="classId" name="classId" class="form-control">
										
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
							<button type="submit" id="generateResultBtn" name="generateResultBtn" class="btn btn-outline-success float-right">Generate Result</button>
						</div>
					</div>
					</form>
				</div>
		
		<?php 	
					}
					else{
						echo "	<h4 class=\"float-left text-center\">Upload Result After Exams...</h4>";
					}
				}
		 ?>
		 </div>
		<div class="card text-white marksCard">
			<div class="card-header">
				<h4>Save Result</h4>
			</div>
			<div class="card-body ok2">
				<h4 class="breadcrumb text-white ok"></h4>
				<div class="message col-md-4"></div>
				<form action="../php_actions/teacher/saveresult.php" method="post" id="marksForm">
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
    <script src="../custom/js/result.js"></script>
</div>
<?php include"../includes/footer.php"; ?>