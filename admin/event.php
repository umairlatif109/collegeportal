<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	include "../php_actions/admin/singleevent2.php";
	$page = "event";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Event</li>
	</ol>
	<?php if(@$_GET['eventId']):?>
	<div class="card text-white">
		<div class="card-header">
			<h1>
				<?php echo ($output['event_title'][0]); ?>
				<span class="float-right <?php echo $output['event_status'][0]=='active' ? 'text-success' : 'text-danger' ; ?>" ><small><?php echo strtoupper($output['event_status'][0]); ?></small></span>
			</h1>
		</div>
		<div class="card-body">
			<h4><?php echo ($output['event_detail'][0]); ?></h4>
			<hr>
			<p class="text-muted"><?php echo ($output['event_date'][0]); ?></p>
		</div>
	</div>
	<?php else: ?>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Event</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form method="post"  action="../php_actions/admin/event.php" id="saveEvent">
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="eventTitile">
										Event Title
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="eventTitle" name="eventTitle" value="" placeholder="Enter Event Title" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="eventDetail">
										Event Detail	
									</label>
						 		</div>
							<div class="col-md-8">
                          		<textarea class="ckeditor form-control" id="eventDetail" name="eventDetail" rows="10" placeholder="Event Detail Here"></textarea>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="eventDate">
										Event Date
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="eventDate" name="eventDate" value="" placeholder="Enter Event Date" class="form-control">
							</div>
						</div>
					</div>
			</div>
			<div class="card-footer">
					<div class="form-group">
					<div class="col-md-6 col-sm-10 col-xs-12">
					<button type="submit" id="btnEvent" name="btnEvent" class="btn btn-outline-success float-right">Save Event</button>
					</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Events Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllEvents">
				    <thead>
				        <tr class="table-dark">
				            <th>Event ID</th>
				            <th>Event Title</th>
				            <!-- <th>Event Detail</th> -->
				            <th>Event Date</th>
				            <!-- <th>Event Status</th> -->
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Event</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action="../php_actions/admin/updateevent.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editEventId" name="editEventId"/>
			</div>
			<div class="form-group">
				<label for="editEventTitle">Event Title</label>
				<input type="text" class="form-control" id="editEventTitle" name="editEventTitle"/>
			</div>
			<div class="form-group">
				<label for="editEventDetail">Event Detail</label>
				<textarea class="form-control ckeditor" id="editEventDetail" name="editEventDetail" rows="10" placeholder="Event Detail Here"></textarea>
			</div>
			<div class="form-group">
				<label for="editEventStatus">Event Status</label>
  				<select style="color:black;" name="editEventStatus" id="editEventStatus" class="form-control select2">
  					<option value="">--- Select Status ---</option>
  					<option value="active">Active</option>
  					<option value="deactive">Deactive</option>
  				</select>
			</div>
			<div class="form-group">
				<label for="editEventDate">Event Date</label>
				<input type="text" id="editEventDate" name="editEventDate" class="form-control">
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Event</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Event ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
	<script src="../assets/plugin/ckeditor/ckeditor.js"></script>
	<script src="../assets/plugin/ckeditor/adapters/jquery.js"></script>
    <script src="../custom/js/event.js"></script>
</div>
<?php include"../includes/footer.php"; ?>