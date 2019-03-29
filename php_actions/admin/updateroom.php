<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$room_id = $_POST['editRoomId'];
		$room_no = $_POST['editRoomNo'];
		$room_name = $_POST['editRoomName'];


	    $searchQuery = "select * from room_information where room_no = '$room_no' and room_name = '$room_name'";

	    $searchResult = mysqli_query($con,$searchQuery);

	    if($searchResult){
	        if(mysqli_num_rows($searchResult) > 0){
	            $valid["success"] = false;
	            $valid["message"] = "<b>Room No</b> - OR - <b>Room Name</b> already exist.";
	        }
	        else{
    			$query = "UPDATE room_information set room_name = '$room_name', room_no = $room_no where room_id=$room_id";
				$result = mysqli_query($con,$query);

				if($result)
				{
					$valid['success'] = true;
					$valid['message'] = "Successfully Updated.";
				}
				else
				{
					$valid['success'] = false;
					$valid['message'] = "Failed To Save";
				}
	        }
	    }
		echo json_encode($valid);
	}
		

?> 