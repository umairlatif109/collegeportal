<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $roomNo = $_POST['roomNo'];
    $roomName = trim(mysqli_real_escape_string($con,$_POST['roomName']));

    $searchQuery = "select * from room_information where room_no = '$roomNo' or room_name = '$roomName'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Room No</b> - OR - <b>Room Name</b> already exist.";
        }
        else{

            $query = "insert into room_information(room_no,room_name) values ($roomNo,'$roomName')";

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