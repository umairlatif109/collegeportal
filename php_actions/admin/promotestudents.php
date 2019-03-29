<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $class_id = $_POST['class_id'];
    $to_class_id = $_POST['to_class_id'];
    $student_id = $_POST['student_id'];

    $searchQuery = "SELECT * from promoted_students_information where previous_class_id = '$class_id' and promoted_class_id = '$to_class_id' and date_format(promote_date,'%Y') = date_format(current_date,'%Y')";

    $searchResult = mysqli_query($con,$searchQuery);

    if(mysqli_num_rows($searchResult) > 0){
        $valid['success'] = false;
        $valid['message'] = "Already Exists";
    }
    else{
        for ($i=0; $i < count($student_id); $i++) { 
            $query = "INSERT INTO `promoted_students_information`(`previous_class_id`, `student_id`, `promoted_class_id`, `promote_date`) VALUES ('$class_id','$student_id[$i]','$to_class_id',current_date)";

            $result =  mysqli_query($con,$query);
            if($result){
                $valid['success'] = true;
                $valid['message'] = "Student Successfully Promoted.";
            }   
            else{
                $valid['success'] = false;
                $valid['message'] = mysqli_error($con);
            }
        }
    }
    

    echo json_encode($valid);
?>