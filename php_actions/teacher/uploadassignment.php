<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=> false , "message" => null );

 	if($_POST){
 		
 		$date = $_POST['date'];
	    $classId = $_POST['classId'];
	    $subjectId = $_POST['subjectId'];
	    $endDate = $_POST['endDate'];

	    $description = trim(mysqli_real_escape_string($con,$_POST['description']));
		
		$uploadFile = $_FILES['uploadFile'];

		$query = "select class_id,subject_id from student_exam_marks_information where class_id = '$classId' and subject_id = '$subjectId' and exam_type_id = 2";
		$result = mysqli_query($con,$query);

		if($result){
			if(mysqli_num_rows($result) > 0){
				$valid['success'] = false;
				$valid['message'] = "Can't Upload Assignment Now, After Finals for Selected Class";
			}
			else{
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
			   					
				   			$query = "INSERT INTO teacher_assignment_information(class_id, subject_id, assignment_file,description,upload_date,end_date) VALUES ('$classId','$subjectId','$uploadAssignmentFile','$description',STR_TO_DATE('$date','%m/%d/%Y'),STR_TO_DATE('$endDate','%m/%d/%Y'))";
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
		}	
 	}

  	echo json_encode($valid);
?>