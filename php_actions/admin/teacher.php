<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=>false , "message" => null );

  	if($_POST){
  		$teacherName = $_POST["teacherName"];
	    $teacherAddress = $_POST["teacherAddress"];
	    $teacherQualification = $_POST["teacherQualification"];
	    $gender = $_POST["gender"];
	    $teacherPhone = $_POST["teacherPhone"];
	    $teacherEmail = $_POST["teacherEmail"];
	    $teacherCnic = $_POST["teacherCnic"];
	    $teacherUserName = strtolower($_POST["teacherUserName"]);
	    $teacherPassword = $_POST["teacherPassword"];
	    $teacherHireDate = $_POST["teacherHireDate"];
	    $teacherPic = $_FILES['teacherPic'];


	    $searchQuery = "select teacher_username from teacher_information where teacher_username = '$teacherUserName'"; // This will check if teacher username already exist
		$searchResult = mysqli_query($con,$searchQuery);
		if($searchResult){
			if(mysqli_num_rows($searchResult) > 0){ // if $searchResult has more than 0 rows it means username exists 
				$valid['success'] = false;
				$valid['message'] = "<b>Teacher Username</b> already exist.";
			}
			else{

				   if($teacherPic['error'] > 0){ // checks for the error while uploading image if greater 0 it means some error while uploading image
				   		$valid['success'] = false;
				   		$valid['message'] = "There is Error while Uploading Image Code: ".$teacherPic['error']; // show the error code here
				   }
				   else{

				   		$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg'); // array for checking the types 
				   		$exp_function = explode('.', strtolower($teacherPic['name'])); // this will convert name.type of file to array with file_name and file_extension
				   		$type = end($exp_function); // gets the last element of the array means type of the uploaded file

				   		$existimage = pathinfo($teacherPic['name'], PATHINFO_FILENAME); // gets the name of the file
				   		$extension = pathinfo($teacherPic['name'], PATHINFO_EXTENSION); // gets the extension of the file

				   		


				   		if(!in_array($type, $allowtype)){ // checks for the allowed image type
				   			$valid['success'] = false;
				   			$valid['message'] = "Only Images are Allowed.";
				   		}
				   		else{
				   			$uploadFolder = "../../assets/images/"; // path where image will be uploaded
				   			if(file_exists($uploadFolder.$existimage.".".$extension)){ // checks for the file.type if exists in the images folder
				   				$valid['success'] = false;	
				   				$valid['message'] = "Image with same <b>name</b> already exists.";
				   			}
				   			else{
				   				$uploadimage = $uploadFolder.$teacherPic['name']; // this is the path to save to database

				   				$valid['success'] = true;
				   				$valid['message'] = $uploadimage;
				   				if(move_uploaded_file($teacherPic['tmp_name'], $uploadimage)){ // this will move file to images folder
				   					// $valid['success'] = true;
						   			// $valid['message'] = "Saved Successfully";
						   			$query = "INSERT INTO teacher_information(teacher_name, teacher_address, teacher_qualification, teacher_gender, teacher_phone, teacher_email, teacher_cnic, teacher_image, teacher_username, teacher_password, hire_date) VALUES ('$teacherName','$teacherAddress','$teacherQualification','$gender','$teacherPhone','$teacherEmail',$teacherCnic,'$uploadimage','$teacherUserName','$teacherPassword',STR_TO_DATE('$teacherHireDate','%m/%d/%Y'))";

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