<?php include '../connection.php'; ?>
	
<?php
    global $con;
    
  	$valid = array( "success"=> false , "message" => null );

 	if($_POST){
		$class_id = $_POST['class_id']; // gets the value of class id 
	
		// count no of rows with given class id
		$query = "SELECT COUNT(class_id) from student_information where class_id = $class_id"; 


		$result = mysqli_query($con,$query);

		if($result){

			$row = mysqli_fetch_array($result);
			$total = $row[0];//get value from db

			if($total >= 50){
				$valid["success"] = false;
				$valid["message"] = "Maximum Student Limit reached can't save right now";
			}
			else{
				$rollno = $total + 1; // get no of records from table and add 1 to the total 
				$valid["success"] = true;
				$valid["message"] = "$rollno"; // passing counted value
			}
			
		}

		else{

			$valid["success"] = false;
			$valid["message"] = "Failed to Query ".mysqli_error($con);
		}


 	}

  	echo json_encode($valid);
?>