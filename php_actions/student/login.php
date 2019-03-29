<?php include '../connection.php'; ?>
<?php 
    session_start();
    if(isset($_SESSION['student_id'])){
        header("location:index.php");
    }
 ?>
<?php
    global $con;
    
    $username = trim(mysqli_real_escape_string($con,$_POST['username']));
    $password = trim(mysqli_real_escape_string($con,$_POST['password']));

    $valid = array("success"=>false , "message" => null);

    $query = "select * from student_information where student_username = '$username' and student_password = '$password'";

    $result = mysqli_query($con,$query);

    if($result)
    {
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if($username == $row['student_username'] && $password == $row['student_password'])
                {
                    $_SESSION["student_id"] = $row["student_id"];
                    $_SESSION["user_name"] = $row["student_name"];
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
    


