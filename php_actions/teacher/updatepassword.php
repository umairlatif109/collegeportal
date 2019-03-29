<?php include '../connection.php'; ?>
<?php
    global $con;
    $valid = array("success" => false, "message" => null);

    $teacherId = $_POST['teacherId'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $searchQuery = "select * from teacher_information where teacher_id = '$teacherId' and teacher_password = '$currentPassword'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
    	if(mysqli_num_rows($searchResult) == 1){

    		$query = "update teacher_information set teacher_password = '$confirmPassword' where teacher_id = '$teacherId'";
    		$result = mysqli_query($con,$query);
    		if($result){
    			$valid["success"] = true;
    			$valid["message"] = "Successfully Changed";
    		}
    		else{
    			$valid["success"] = true;
    			$valid["message"] = "Failed to Query";
    		}
    	}
    	else{
    		$valid["success"] = false;
    		$valid["message"] = "Your <b>Current Password</b> is wrong";
    	}
    }

    echo json_encode($valid);
    
?>