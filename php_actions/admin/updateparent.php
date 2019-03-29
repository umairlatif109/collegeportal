<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    

   if($_POST){

        $editParentId = $_POST["editParentId"];
        $editParentName = trim(mysqli_real_escape_string($con, $_POST['editParentName']));
        $editParentAddress = trim(mysqli_real_escape_string($con, $_POST['editParentAddress']));
        $editParentEmail = trim(mysqli_real_escape_string($con, $_POST['editParentEmail']));
        $editGender = trim(mysqli_real_escape_string($con, $_POST['editGender']));
        $editParentPhone = $_POST['editParentPhone'];
        $editParentUserName = trim(mysqli_real_escape_string($con, $_POST['editParentUserName']));
        $editParentPassword = trim(mysqli_real_escape_string($con, $_POST['editParentPassword']));
        

        $query = "UPDATE parent_information SET parent_name= '$editParentName',parent_address='$editParentAddress',parent_phone= '$editParentPhone',parent_gender= '$editGender',parent_email= '$editParentEmail',parent_username= '$editParentUserName',parent_password= '$editParentPassword' WHERE parent_id = $editParentId";

        $result = mysqli_query($con,$query);

        if($result){
           $valid["success"] = true;
           $valid["message"] = "Saved Successfully.";
        }
        else{
          $valid["sucsess"] = false;
          $valid["message"] = "Failed to Update";
        }

   }

    echo json_encode($valid);
?>