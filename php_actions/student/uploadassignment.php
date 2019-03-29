<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=> false , "message" => null );

 	if($_POST){
 		
 		
		$ta_id = $_POST['ta_id'];
		$student_id = $_POST['student_id'];

		
		$uploadFile = $_FILES['studentAssignment'];

		if($uploadFile['error'] > 0){
	   		$valid['success'] = false;
	   		$valid['message'] = "There is Error while Uploading File <b>Code: ".$uploadFile['error']."</b>";
		}
	   	else{

	   		$allowtype = array('pdf', 'docx', 'doc', 'ppt','txt'); 
	   		$exp_function = explode('.', strtolower($uploadFile['name']));
	   		$type = end($exp_function);

	   		if(!in_array($type, $allowtype)){
	   			$valid['success'] = false;
	   			$valid['message'] = "This type of file is not Allowed.";
	   		}
	   		else{
	   			$uploadFolder = "../../assets/files/assignments/";
   				$uploadAssignmentFile = $uploadFolder.rand().$uploadFile['name'];
	   				
   				if(move_uploaded_file($uploadFile['tmp_name'], $uploadAssignmentFile)){
	   					
		   			$query = "insert into student_assignment_information(ta_id,student_id,assignment_file,upload_date) values('$ta_id','$student_id','$uploadAssignmentFile',current_date)";
		   			$result = mysqli_query($con,$query);

		   			if($result){
		   				$valid['success'] = true;
		   				$valid['message'] = "Saved Successfully";
		   			}
		   			else{
		   				$valid['success'] = false;
		   				$valid['message'] = "Failed to Save to Database".mysqli_error($con);
		   			}
	   			}
	   		}
		}	
 	}

  	echo json_encode($valid);
?>