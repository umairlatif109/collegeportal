<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $classId = $_POST['classId'];
    $subjectId = $_POST['subjectId'];
    $teacherId = $_POST['teacherId'];
    $roomId = $_POST['roomId'];
    $selectDay = $_POST['selectDay'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    $searchQuery = "select * from timetable_information where room_id= '$roomId' and day = '$selectDay' and start_time = '$startTime' and end_time = '$endTime'";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Teacher Class</b> is already Scheduled at this time";
        }
        else{
            $searchQuery = "select * from timetable_information where teacher_id ='$teacherId' and day = '$selectDay' and room_id= '$roomId' and '$startTime' BETWEEN start_time AND end_time and '$endTime' BETWEEN start_time AND end_time";
            $searchResult = mysqli_query($con,$searchQuery);

            if($searchResult){
                if(mysqli_num_rows($searchResult) > 0){
                    $valid["success"] = false;
                    $valid["message"] = "<b>Teacher Class</b> is already Scheduled at this time";

                }
                else{
                    $query = "INSERT INTO timetable_information(class_id, subject_id, teacher_id, room_id, day, start_time, end_time)VALUES ('$classId', '$subjectId', '$teacherId', '$roomId', '$selectDay', '$startTime', '$endTime')";

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



    echo json_encode($valid);
?>