<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=> false , "message" => null );

 	if($_POST){
 		
 		$ta_id = $_POST['ta_id'];	
 		$student_id = $_POST['student_id'];	
 		$o_marks = $_POST['oMarks'];
 		$t_marks = 10;
	 	if($o_marks <= $t_marks){

	 			$query = "insert into student_assignment_marks_information values ($ta_id,$student_id,$o_marks)";
	 			$result = mysqli_query($con,$query);
	 			if($result){
	 				$valid['success'] = true;
	 				$valid['message'] = "Saved Successfully";
	 			}
	 			else{
	 				$valid['success'] = false;
	 				$valid['message'] = "Failed to Query<br> ".mysqli_error($con);
	 			}

	 		}
	 		else{
	 			$valid['success'] = false;
	 				$valid['message'] = "Obtained Marks should be less than or equal to: <b>$t_marks</b>";
	 		}

 }

  	echo json_encode($valid);
?>