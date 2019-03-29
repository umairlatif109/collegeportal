<?php include '../connection.php'; ?>
<?php
    global $con;
    $valid = array("success" => false, "message" => null);

    $parentId = $_POST['parentId'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $searchQuery = "select * from parent_information where parent_id = '$parentId' and parent_password = '$currentPassword'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
    	if(mysqli_num_rows($searchResult) == 1){

    		$query = "update parent_information set parent_password = '$confirmPassword' where parent_id = '$parentId'";
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