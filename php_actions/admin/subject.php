<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $subjectName = trim(mysqli_real_escape_string($con,$_POST['subjectName']));
    $tMarks = $_POST['tMarks'];
    $pMarks = $_POST['pMarks'];


    $searchQuery = "select * from subject_information where subject_name = '$subjectName'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Subject Name</b> already exist.";
        }
        else{
            $query = "insert into subject_information(subject_name,t_marks,p_marks) values ('$subjectName','$tMarks','$pMarks')";

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