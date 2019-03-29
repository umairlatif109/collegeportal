<?php include '../connection.php'; ?>
    
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    
    $classId = $_POST["classId"];
    $subjectId = $_POST["subjectId"];
    $roomId = $_POST["roomId"];
    $date = $_POST["date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $exam_type_id = $_POST['examId'];
    // echo $exam_type_id;
    $sDate = strtotime($date);
    $searchDate = date('Y-m-d',$sDate);

    $searchQuery = "SELECT * from exam_information where '$searchDate' between start_date and end_date and class_id = '$classId' and exam_type_id = '$exam_type_id'";
    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) < 1){
            $valid["success"] = false;
            $valid["message"] = "Date is not between scheduled exam";
        }
        else{
            $searchQuery = "SELECT * from datesheet_information where class_id = '$classId' and subject_id ='$subjectId' and exam_type_id = $exam_type_id and date_format(date,'%Y') = date_format('$searchDate','%Y')";
            
            $searchResult = mysqli_query($con,$searchQuery);

            if($searchResult){
                if(mysqli_num_rows($searchResult) > 0){
                    $valid["success"] = false;
                    $valid["message"] = "<b>Subject Datesheet</b> already scheduled for selected <b>Exam Type</b>";
                }
                else{

                    $searchQuery = "SELECT * from datesheet_information where date = '$searchDate' and start_time ='$startTime' and end_time='$endTime'";
            
                    $searchResult = mysqli_query($con,$searchQuery);

                    if($searchResult){
                        if(mysqli_num_rows($searchResult) > 0){
                            $valid["success"] = false;
                            $valid["message"] = "Some other <b>Subject</b> is scheduled at this time";
                        }
                        else{

                            $query = "INSERT INTO datesheet_information(class_id, subject_id, exam_type_id, room_id, start_time, end_time, date) VALUES ('$classId','$subjectId','$exam_type_id','$roomId','$startTime','$endTime',STR_TO_DATE('$date','%m/%d/%Y'))";

                            $result = mysqli_query($con,$query);

                            if($result)
                            {
                               $valid["success"] = true;
                               $valid["message"] = "Saved Successfully.";
                            }
                            else{
                                $valid["success"] = false;
                               $valid["message"] = "Failed to Save.";   
                            }
                        }
                    }
                }
            }
        }   
    }



    echo json_encode($valid);
?>