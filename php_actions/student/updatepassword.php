<?php include '../connection.php'; ?>
<?php
    global $con;
    $valid = array("success" => false, "message" => null);

    $studentId = $_POST['studentId'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $searchQuery = "select * from student_information where student_id = '$studentId' and student_password = '$currentPassword'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
    	if(mysqli_num_rows($searchResult) == 1){

    		$query = "update student_information set student_password = '$confirmPassword' where student_id = '$studentId'";
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