<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $class_id = $_POST['class_id'];

    $query = "SELECT student_id,roll_no,student_name from student_information where class_id = '$class_id'";
    $result =  mysqli_query($con,$query);

    if($result){
        if(mysqli_num_rows($result) > 0){
            $valid['success'] = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $valid['message'][] = $row;
            }
        }
        else{
            $valid['success'] = false;
            $valid['message'] = "No Student Found for the selected Class";
        }
    }   
    else{
        $valid['success'] = false;
        $valid['message'] = mysqli_error($con);
    }

    echo json_encode($valid);
?>