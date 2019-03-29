<?php 
	session_start();
    if(!isset($_SESSION['parent_id'])){		// check for the session of the parent if not exists
        header("location:login.php");		// redirect to the parent/login.php
    }
	include"../includes/header.php";
	include"../php_actions/admin/publicevent.php";
	include"../php_actions/parent/getchilds.php";
	$page='dashboard';

 ?>
	<div class="row">
		<?php include"../includes/sidebar.php"; ?>
		<div class="col-md-9">
			<ol class="breadcrumb mt-3">
			  <li class="breadcrumb-item active">Dashboard</li>
			</ol>

		<div class="card">
			<div class="card-header">
				<h4>Children</h4>
			</div>
			<div class="card-body">
				<?php if(@$childs): ?>
					<div class="row">

						<?php foreach($childs as $child): ?>
								
							<div class="col-md-3 mt-3">
								<div class="card border-primary">
									<div class="card-body">
										<img width="100%" height="200" src="<?php echo substr($child['student_image'], 3); ?>" alt="">
									</div>
									<div class="bg-secondary card-footer">
								    	<div class="card-text text-center mt-3">
								    		<div>Name: <b><?php echo $child['student_name']; ?></b></div>
								    		<div>Class: <b><?php echo $child['class_name']; ?></b></div>
								    		<div>Roll No: <b><?php echo $child['roll_no']; ?></b></div>
								    		<hr>
								    	<form action="child.php">
								    		<input type="hidden" name="studentId" value="<?php echo $child['student_id'] ; ?>">
								    		<button type="submit" class="btn btn-info float-right">Detail</button>
								    	</form>
								    	</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				<?php else: ?>
					<h3 class="text-center">No Record Found</h3>
				<?php endif; ?>

			</div>
		</div>
		<div class="card border-info mt-3">
			<div class="card-header bg-info">
				<h4 class="float-left">Event</h4>
				<div class="form-group mt-2 row float-right">
					<b>Limit</b>
					<select class="ml-2" name="limit" id="limit">
						<option value="5">Default</option>
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
				</div>
			</div>
			<div class="card-body" id="loadevents">
				<?php if(@$output): ?>

					<?php foreach(@$output as $o): ?>
						
						<div class="card-body bg-secondary">
							<h3 style="padding-bottom:5px;border-bottom:2px solid #3498DB;" ><?php echo $o[0]; ?></h3>
							<p class="text-justify"><?php echo $o[1]; ?></p>
							<p><span style="padding-bottom:5px;border-bottom:2px solid #3498DB;"><b><?php echo $o[2]; ?></b></span></p>
						</div>
						<br>

					<?php endforeach; ?>
				<?php else: ?>
					<h3 class="text-center">No Upcoming Event.</h3>
				<?php endif; ?>
			</div>
		</div>

		</div>
	</div>
<div class="scripts">
     <script src="../custom/js/publicevent.js" ></script>
     <?php include "../includes/chat.php"; ?>
     <script src="../custom/js/parent_chat.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>