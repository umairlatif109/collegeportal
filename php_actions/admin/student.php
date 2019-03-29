<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=> false , "message" => null );

 	if($_POST){

		$classId = $_POST['classId'];
		$rollNo = $_POST['rollNo'];
		$studentName = $_POST['studentName'];
		$parentId = $_POST['parentId'];
		$studentAddress = $_POST['studentAddress'];
		$studentEmail = $_POST['studentEmail'];
		$gender = $_POST['gender'];
		$studentCnic = $_POST['studentCnic'];
		$studentPhone = $_POST['studentPhone'];
		$studentUserName = $_POST['studentUserName'];
		$studentPassword = $_POST['studentPassword'];
		$studentRegisterDate = $_POST['studentRegisterDate'];

		$studentPic = $_FILES['studentPic'];

	    $searchQuery = "select student_username from student_information where student_username = '$studentUserName'"; // This will check if student username already exist
		$searchResult = mysqli_query($con,$searchQuery);
		if($searchResult){
			if(mysqli_num_rows($searchResult) > 0){ // if $searchResult has more than 0 rows it means username exists 
				$valid['success'] = false;
				$valid['message'] = "<b>Student Username</b> already exist.";
			}
			else{
			   if($studentPic['error'] > 0){
			   		$valid['success'] = false;
			   		$valid['message'] = "There is Error while Uploading Image <b>Code: ".$studentPic['error']."</b>";
			   }
			   else{

			   		$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg'); 
			   		$exp_function = explode('.', strtolower($studentPic['name']));
			   		$existimage = pathinfo($studentPic['name'], PATHINFO_FILENAME);
			   		$extension = pathinfo($studentPic['name'], PATHINFO_EXTENSION);

			   		$type = end($exp_function);


			   		if(!in_array($type, $allowtype)){
			   			$valid['success'] = false;
			   			$valid['message'] = "Only Images are Allowed.";
			   		}
			   		else{
			   			$uploadFolder = "../../assets/images/";
			   			if(file_exists($uploadFolder.$existimage.".".$extension)){
			   				$valid['success'] = false;	
			   				$valid['message'] = "Image with same <b>name</b> already exists.";
			   			}
			   			else{
			   				$uploadimage = $uploadFolder.$studentPic['name'].rand(0,9);
			   				$valid['success'] = true;
			   				$valid['message'] = $uploadimage;
			   				if(move_uploaded_file($studentPic['tmp_name'], $uploadimage)){
			   					
					   			$query = "INSERT INTO student_information(class_id, roll_no, student_name, parent_id, student_address, student_email, student_gender, student_cnic, student_phone, student_image, student_username, student_password, registration_date) VALUES ('$classId','$rollNo','$studentName','$parentId','$studentAddress','$studentEmail','$gender','$studentCnic','$studentPhone','$uploadimage','$studentUserName','$studentPassword', STR_TO_DATE('$studentRegisterDate','%m/%d/%Y'))";

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
 	}

  	echo json_encode($valid);
?>