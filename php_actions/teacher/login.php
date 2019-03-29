<?php include '../connection.php'; ?>
<?php 
    session_start();
    if(isset($_SESSION['teacher_id'])){
        header("location:index.php?chat_with_teacher_parent=1");
    }
 ?>
<?php
    global $con;
    
    $username = trim(mysqli_real_escape_string($con,$_POST['username']));
    $password = trim(mysqli_real_escape_string($con,$_POST['password']));

    $valid = array("success"=>false , "message" => null);

    $query = "select * from teacher_information where teacher_username = '$username' and teacher_password = '$password'";

    $result = mysqli_query($con,$query);

    if($result)
    {
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if($username == $row['teacher_username'] && $password == $row['teacher_password'])
                {
                    $_SESSION["teacher_id"] = $row["teacher_id"];
                    $_SESSION["user_name"] = $row["teacher_name"];
                    $_SESSION["teacher"] = true;
                    
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
    


