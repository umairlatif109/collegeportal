<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
	$page = "classroom";
 ?>
<div class="row">
	<?php include"../includes/sidebar.php"; ?>
	<div class="col-md-9">
	<ol class="breadcrumb mt-3">
	  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
	  <li class="breadcrumb-item active">Class Room</li>
	</ol>
		<div class="card text-white">
			<div class="card-header">
				<h4>Add Room</h4>
			</div>
			<div class="card-body">
				<div class="offset-2 message col-md-4">
					
				</div>
				<form  action="../php_actions/admin/classroom.php" method="post" id="saveClassRoom">
					<div class="form-group">
						<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<label class="control-label float-right pt-1" for="roomNo">
									Room No
								</label>
					 		</div>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<input type="number" id="roomNo" name="roomNo" value="0" min="0"  placeholder="Enter Room No" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
					<div class="row">
							<div class="col-md-2 col-sm-4 col-xs-12">
									<label class="control-label float-right pt-1" for="roomName">
										Room Name
									</label>
						 		</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="text" id="roomName" name="roomName" value="" placeholder="Enter room Name" class="form-control">
							</div>
						</div>
					</div>
			</div>
			<div class="card-footer">
					<div class="form-group">
						<div class="col-md-6 col-sm-10 col-xs-12">
							<button type="submit" id="btnRoom" name="btnRooom" class="btn btn-outline-success float-right">Save Room</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<br>

		<div class="card text-white">
			<div class="card-header">
				<h4>Rooms Information</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-bordered table-dark myTable" id="showAllRooms">
				    <thead>
				        <tr class="table-dark">
				        	<th>Room Id</th>
				            <th>Room No</th>
				            <th>Room Name</th>
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
			<h4 class="modal-title"><i class='glyphicon glyphicon-edit'></i> Edit Room</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		<form method = "post" id="updateForm" action ="../php_actions/admin/updateroom.php">
			<div class="form-group">
				<input type="hidden" class="form-control" id="editRoomId" name="editRoomId"/>
			</div>
			<div class="form-group">
				<label for="editName">Room No</label>
				<input type="number" min="0" value="0" class="form-control" id="editRoomNo" name="editRoomNo"/>
			</div>
			<div class="form-group">
				<label for="editName">Room Name</label>
				<input type="text" class="form-control" id="editRoomName" name="editRoomName"/>
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
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Room</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h4>Do you want to delete this Room ?</h4>
				<button class="btn btn-danger" id="confirmDelete" ><i class="glyphicon glyphicon-ok"></i> Yes</button>
				<button class="btn btn-default" data-dismiss="modal" ><i class="glyphicon glyphicon-remove"></i> No</button>
			</div>
		</div>
	</div>
</div>
<div class="scripts">
	<script src="../custom/js/classroom.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>