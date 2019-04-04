<?php 
    $server = "localhost";
    $username = "id9074085_root";
    $password = "123456";
    $database = "id9074085_collegeportal";
    
    $con = mysqli_connect($server,$username,$password,$database);
    
    if(!$con)
    {
        echo "Error: ".mysqli_errno($con);
    }
        
 ?>