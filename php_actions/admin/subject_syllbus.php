<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);

    $classId = $_POST['classId'];
	$subjectId = $_POST['subjectId'];
	$subjectContents = trim(mysqli_real_escape_string($con,$_POST['subjectContents']));

    $searchQuery = "select * from subject_syllbus_information where class_id = '$classId' and subject_id ='$subjectId'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Contents</b> already exist.";
        }
        else{

                $query = "INSERT INTO subject_syllbus_information(class_id,subject_id,subject_contents) VALUES ($classId,$subjectId,'$subjectContents')";

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
 