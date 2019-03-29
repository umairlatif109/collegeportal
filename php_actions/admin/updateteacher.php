<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$editTeacherId = $_POST['editTeacherId'];
		$editTeacherName = $_POST['editTeacherName'];
		$editTeacherAddress = $_POST['editTeacherAddress'];
		$editTeacherQualification = $_POST['editTeacherQualification'];
		$editGender = $_POST['editGender'];
		$editTeacherPhone = $_POST['editTeacherPhone'];
		$editTeacherEmail = $_POST['editTeacherEmail'];
		$editTeacherCnic = $_POST['editTeacherCnic'];
		$editTeacherUserName = $_POST['editTeacherUserName'];
		$editTeacherPassword = $_POST['editTeacherPassword'];
		$editTeacherHireDate = $_POST['editTeacherHireDate'];
		$editTeacherPic = $_FILES['editTeacherPic']; //teacher Pic 

		

		// if teacher pic is not null
		// if there is any image change then this if block will execute otherwise else block will execute
		if($editTeacherPic['name']!=null){

			if($editTeacherPic['error'] > 0){ // if teacher pic has any error while uploading image
		   		$valid['success'] = false;
		   		$valid['message'] = "There is Error while Uploading Image ".$editTeacherPic['error'];
		   }
		   else{

		   		$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg'); // array to check uploaded file extension

		   		$exp_function = explode('.', strtolower($editTeacherPic['name'])); // truncate file and type to array and store it to $exp_function

		   		$type = end($exp_function); // gets the extension of the uploaded file

		   		$existimage = pathinfo($editTeacherPic['name'], PATHINFO_FILENAME); // gets file name
		   		$extension = pathinfo($editTeacherPic['name'], PATHINFO_EXTENSION); // gets file type means extension

		   		if(!in_array($type, $allowtype)){ // checks the type of uploaded file whether it is image or not
		   			$valid['success'] = false;
		   			$valid['message'] = "Only Images are Allowed.";
		   		}
		   		else{// if uploaded file is an image 
		   			$uploadFolder = "../../assets/images/";// folder where images will be saved
		   			if(file_exists($uploadFolder.$existimage.".".$extension)){// checks if image with same name already exists
		   				$valid['success'] = false;	
		   				$valid['message'] = "Image with same <b>name</b> already exists.";
		   			}
		   			else{

		   				$uploadimage = $uploadFolder.$editTeacherPic['name']; // full image path

		   				// if image is uploaded to images folder
		   				if(move_uploaded_file($editTeacherPic['tmp_name'], $uploadimage)){ 

				   			$query = "UPDATE teacher_information SET teacher_name='$editTeacherName',teacher_address='$editTeacherAddress',teacher_qualification='$editTeacherQualification',teacher_gender='$editGender',teacher_phone='$editTeacherPhone',teacher_email='$editTeacherEmail',teacher_cnic='$editTeacherCnic',teacher_image='$uploadimage',teacher_username='$editTeacherUserName',teacher_password='$editTeacherPassword',hire_date= STR_TO_DATE('$editTeacherHireDate','%m/%d/%Y') WHERE teacher_id = $editTeacherId";

				   			$result = mysqli_query($con,$query);

				   			if($result){
				   				$valid['success'] = true;
				   				$valid['message'] = "Updated Successfully";
				   			}
				   			else{
				   				$valid['success'] = false;
				   				$valid['message'] = mysqli_error($con);
				   			}

				   		}
		   			}
		   		}
		   }
		}
		else // if there is no image change but change other fields...
		{
			
			$query = "UPDATE teacher_information SET teacher_name='$editTeacherName',teacher_address='$editTeacherAddress',teacher_qualification='$editTeacherQualification',teacher_gender='$editGender',teacher_phone='$editTeacherPhone',teacher_email='$editTeacherEmail',teacher_cnic='$editTeacherCnic',teacher_username='$editTeacherUserName',teacher_password='$editTeacherPassword',hire_date= STR_TO_DATE('$editTeacherHireDate','%m/%d/%Y') WHERE teacher_id = $editTeacherId";

				   			$result = mysqli_query($con,$query);

				   			if($result){
				   				$valid['success'] = true;
				   				$valid['message'] = "Updated Successfully";
				   			}
				   			else{
				   				$valid['success'] = false;
				   				$valid['message'] = mysqli_error($con);
				   			}
		}

	}
		echo json_encode($valid);

?> 