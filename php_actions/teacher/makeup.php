<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $teacherId = $_POST['teacherId'];
    $classId = $_POST['classId'];
    $subjectId = $_POST['subjectId'];
    $roomId = $_POST['roomId'];
    $makeupDate = $_POST['makeupDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    $sDate = strtotime($makeupDate);
    $searchDate = date('Y-m-d',$sDate);

    $searchQuery = "select * from timetable_information where subject_id = '$subjectId' and class_id = '$classId' and room_id = '$roomId' and end_time = '$endTime' and room_id = '$roomId'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
                $valid["success"] = false;
                $valid["message"] = "<b>Time Table</b> scheduled at this time.";
        }
        else{

            $searchQuery = "select * from makeup_information where makeup_date = '$searchDate' and teacher_id = '$teacherId' and subject_id = '$subjectId' and class_id = '$classId' and room_id = '$roomId'";

            $searchResult = mysqli_query($con,$searchQuery);

            if($searchResult){
                if(mysqli_num_rows($searchResult) > 0){
                    $valid["success"] = false;
                    $valid["message"] = "<b>Makeup Class</b> already exist.";
                }
                else{

                    $searchQuery = "select * from makeup_information where makeup_date = '$searchDate' and start_time ='$startTime' and end_time = '$endTime' and room_id = '$roomId'";
                    $searchResult = mysqli_query($con,$searchQuery);
                    
                    if($searchResult){
                        if(mysqli_num_rows($searchResult) > 0 ){
                            $valid["success"] = false;
                            $valid["message"] = "<b>Makeup Class</b> already scheduled at this time by other teacher";
                        }
                        else{

                            $query = "INSERT INTO makeup_information(teacher_id, class_id, subject_id, room_id, makeup_date, start_time, end_time) VALUES ('$teacherId','$classId','$subjectId','$roomId',STR_TO_DATE('$makeupDate','%m/%d/%Y'),'$startTime','$endTime')";

                            $result = mysqli_query($con,$query);

                            if($result)
                            {
                               $valid["success"] = true;
                               $valid["message"] = "Saved Successfully.";
                            }
                        }
                    }
                }
            }
        }
    }

    echo json_encode($valid);
?>