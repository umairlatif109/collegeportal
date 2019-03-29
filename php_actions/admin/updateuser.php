<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    


    $admin_id = $_POST["editUserId"];
    $editAdminName = trim(mysqli_real_escape_string($con,$_POST['editAdminName']));
    $editAdminUsername = trim(mysqli_real_escape_string($con,$_POST['editAdminUsername']));
    $editAdminPassword = trim(mysqli_real_escape_string($con,$_POST['editAdminPassword']));

    $query = "update admin_information set admin_name = '$editAdminName', admin_username =  '$editAdminUsername', admin_password = '$editAdminPassword' where admin_id = '$admin_id'";

    $result = mysqli_query($con,$query);

    if($result)
    {
       $valid["success"] = true;
       $valid["message"] = "Saved Successfully.";
    }

    echo json_encode($valid);
?>






