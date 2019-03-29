<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=> false , "message" => null );

 	if($_POST){

 		$teacherId = $_POST['teacherId'];
		$classId = $_POST['classId'];
		$subjectId = $_POST['subjectId'];
		$lectureNo = $_POST['lectureNo'];
		$description = $_POST['description'];
		$date = $_POST['date'];

		$uploadFile = $_FILES['uploadFile'];


		$query = "select class_id,subject_id from student_exam_marks_information where class_id = '$classId' and subject_id = '$subjectId' and exam_type_id = 2 and date_format(marks_date,'%Y') = date_format(current_date,'%Y')";
		$result = mysqli_query($con,$query);

		if($result){
			if(mysqli_num_rows($result) > 0){
				$valid['success'] = false;
				$valid['message'] = "Can't Upload Lecture Now, After Finals for Selected Class";
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
			   			$uploadFolder = "../../assets/files/lectures/";
		   				$uploadLectureFile = $uploadFolder.rand().$uploadFile['name'];
			   				
		   				if(move_uploaded_file($uploadFile['tmp_name'], $uploadLectureFile)){
			   					
				   			$query = "INSERT INTO teacher_lecture_information(teacher_id, class_id, subject_id,lecture_no,description,upload_date, lecture_file) VALUES ('$teacherId','$classId','$subjectId','$lectureNo','$description',STR_TO_DATE('$date','%m/%d/%Y'),'$uploadLectureFile')";

				   			$result = mysqli_query($con,$query);

				   			if($result){
				   				$valid['success'] = true;
				   				$valid['message'] = "Saved Successfully";
				   			}
				   			else{
				   				$valid['success'] = false;
				   				$valid['message'] = "Failed to Save to Database.";
				   			}
			   			}
			   		}
				}
			}
		}	
 	}

  	echo json_encode($valid);
?>