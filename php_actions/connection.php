<?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "collegeportal";
    
    $con = mysqli_connect($server,$username,$password,$database);
    
    if(!$con)
    {
        echo "Error: ".mysqli_errno($con);
    }
        
 ?>