<?php include '../connection.php'; ?>
<?php 
    session_start();
    if(isset($_SESSION['parent_id'])){
        header("location:index.php");
    }
 ?>
<?php
    global $con;
    
    $username = trim(mysqli_real_escape_string($con,$_POST['username']));
    $password = trim(mysqli_real_escape_string($con,$_POST['password']));

    $valid = array("success"=>false , "message" => null);

    $query = "select * from parent_information where parent_username = '$username' and parent_password = '$password'";

    $result = mysqli_query($con,$query);

    if($result)
    {
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if($username == $row['parent_username'] && $password == $row['parent_password'])
                {
                    $_SESSION["parent_id"] = $row["parent_id"];
                    $_SESSION["user_name"] = $row["parent_name"];
                    $valid['success'] = true;
                    $valid['message'] = "Login Successfully";
                }
            }
        }
        else
        {
            $valid['success'] = false;
            $valid['message'] = "Invalid <b>Username</b> - OR - <b>Password</b>";
        }
       
    }

    echo json_encode($valid);

?>
    


