<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $classId = $_POST['classId'];
    $subjectId = $_POST['subjectId'];

    $searchQuery = "select * from class_subject_information where class_id = '$classId' and subject_id = '$subjectId'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Subject</b> already exist.";
        }
        else{
            $query = "insert into class_subject_information(class_id,subject_id) values ($classId,$subjectId)";

            $result = mysqli_query($con,$query);

            if($result)
            {
               $valid["success"] = true;
               $valid["message"] = "Saved Successfully.";
            }

        }
    }

    echo json_encode($valid);
?>