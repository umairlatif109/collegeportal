<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $eventTitle = trim(mysqli_real_escape_string($con,$_POST['eventTitle']));
    $eventDetail = trim(mysqli_real_escape_string($con,$_POST['eventDetail']));
    $eventDate = trim(mysqli_real_escape_string($con,$_POST['eventDate']));

    $query = "insert into event_information(event_title,event_detail,event_date,event_status) values ('$eventTitle','$eventDetail',STR_TO_DATE('$eventDate','%m/%d/%Y'),'active')";

    $result = mysqli_query($con,$query);

    if($result)
    {
       $valid["success"] = true;
       $valid["message"] = "Saved Successfully.";
    }

    echo json_encode($valid);
?>