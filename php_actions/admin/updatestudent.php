<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$editStudentId = $_POST['editStudentId'];
		$editStudentName = $_POST['editStudentName'];
		$editParentId = $_POST['editParentId'];
		$editStudentAddress = $_POST['editStudentAddress'];
		$editStudentEmail = $_POST['editStudentEmail'];
		$editGender = $_POST['editGender'];
		$editStudentCnic = $_POST['editStudentCnic'];
		$editStudentPhone = $_POST['editStudentPhone'];
		$editStudentUserName = $_POST['editStudentUserName'];
		$editStudentPassword = $_POST['editStudentPassword'];
		$editStudentRegisterDate = $_POST['editStudentRegisterDate'];

		$editStudentPic = $_FILES['editStudentPic']; //student Pic 

		

		// if student pic is not null
		// if there is any image change then this if block will execute otherwise else block will execute
		if($editStudentPic['name']!=null){

			if($editStudentPic['error'] > 0){ // if student pic has any error while uploading image
		   		$valid['success'] = false;
		   		$valid['message'] = "There is Error while Uploading Image ".$editStudentPic['error'];
		   }
		   else{

		   		$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'jpeg'); // array to check uploaded file extension

		   		$exp_function = explode('.', strtolower($editStudentPic['name'])); // truncate file and type to array and store it to $exp_function

		   		$type = end($exp_function); // gets the extension of the uploaded file

		   		$existimage = pathinfo($editStudentPic['name'], PATHINFO_FILENAME); // gets file name
		   		$extension = pathinfo($editStudentPic['name'], PATHINFO_EXTENSION); // gets file type means extension

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

		   				$uploadimage = $uploadFolder.$editStudentPic['name']; // full image path

		   				// if image is uploaded to images folder
		   				if(move_uploaded_file($editStudentPic['tmp_name'], $uploadimage)){ 

				   			$query = "UPDATE student_information SET student_name='$editStudentName',parent_id='$editParentId',student_address='$editStudentAddress',student_email='$editStudentEmail',student_gender='$editGender',student_cnic='$editStudentCnic',student_phone='$editStudentPhone',student_image='$uploadimage',student_username='$editStudentUserName',student_password='$editStudentPassword',registration_date= STR_TO_DATE('$editStudentRegisterDate','%m/%d/%Y') WHERE student_id = '$editStudentId'";

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
			
			$query = "UPDATE student_information SET student_name='$editStudentName',parent_id='$editParentId',student_address='$editStudentAddress',student_email='$editStudentEmail',student_gender='$editGender',student_cnic='$editStudentCnic',student_phone='$editStudentPhone',student_username='$editStudentUserName',student_password='$editStudentPassword',registration_date=STR_TO_DATE('$editStudentRegisterDate','%m/%d/%Y') WHERE student_id = '$editStudentId'";

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