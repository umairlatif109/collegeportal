<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    



    $adminName = trim(mysqli_real_escape_string($con,$_POST['adminName']));
    $adminUsername = trim(mysqli_real_escape_string($con,$_POST['adminUsername']));
    $adminPassword = trim(mysqli_real_escape_string($con,$_POST['adminPassword']));

    $query = "select * from admin_information where admin_username = '$adminUsername'";

    $result = mysqli_query($con,$query);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Admin Username</b> Already exist.";
        }
        else{
            $query = "insert into admin_information(admin_name,admin_username,admin_password) values ('$adminName','$adminUsername','$adminPassword')";

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






