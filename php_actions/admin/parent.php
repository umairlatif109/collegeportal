<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    

   if($_POST){

        $parentName =trim(mysqli_real_escape_string($con, $_POST['parentName']));
        $parentAddress =trim(mysqli_real_escape_string($con, $_POST['parentAddress']));
        $parentEmail =trim(mysqli_real_escape_string($con, $_POST['parentEmail']));
        $gender =trim(mysqli_real_escape_string($con, $_POST['gender']));
        $parentPhone = $_POST['parentPhone'];
        $parentUserName =trim(mysqli_real_escape_string($con, $_POST['parentUserName']));
        $parentPassword =trim(mysqli_real_escape_string($con, $_POST['parentPassword']));
        
        $searchQuery = "select parent_username from parent_information where parent_username = '$parentUserName'"; // This will check if parent username already exist
        $searchResult = mysqli_query($con,$searchQuery);
        if($searchResult){
            if(mysqli_num_rows($searchResult) > 0){ // if $searchResult has more than 0 rows it means username exists 
              $valid['success'] = false;
              $valid['message'] = "<b>Parent Username</b> already exist.";
            }
            else{

                    $query = "INSERT INTO parent_information(parent_name, parent_address, parent_phone, parent_gender, parent_email, parent_username, parent_password) VALUES ('$parentName','$parentAddress','$parentPhone','$gender','$parentEmail','$parentUserName','$parentPassword')";

                    $result = mysqli_query($con,$query);

                    if($result){
                       $valid["success"] = true;
                       $valid["message"] = "Saved Successfully.";
                    }

            }
        }



   }

    echo json_encode($valid);
?>