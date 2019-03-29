<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $className = trim(mysqli_real_escape_string($con,$_POST['className']));

    $searchQuery = "select * from class_information where class_name = '$className'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Class Name</b> already exist.";
        }
        else{

            $query = "insert into class_information(class_name) values ('$className')";

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