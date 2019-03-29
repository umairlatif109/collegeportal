<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null);
    

    $examName = trim(mysqli_real_escape_string($con,$_POST['examName']));
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $classId = $_POST['classId'];

    $sDate = strtotime($startDate);
    $searchStartDate = date('Y-m-d',$sDate);

    $eDate = strtotime($endDate);
    $searchEndDate = date('Y-m-d',$eDate);

   

    $searchQuery = "select * from exam_information where class_id = '$classId' and exam_type_id = '$examName' and date_format(start_date,'%y') = date_format('$searchStartDate','%y')";

    $searchResult = mysqli_query($con,$searchQuery);

    if($searchResult){
        if(mysqli_num_rows($searchResult) > 0){
            $valid["success"] = false;
            $valid["message"] = "<b>Exam</b> Already Scheduled for this year: ".date('Y',$sDate);
        }
        else{

            $query = "insert into exam_information(exam_type_id,start_date,end_date,class_id) values ('$examName',STR_TO_DATE('$startDate','%m/%d/%Y'),STR_TO_DATE('$endDate','%m/%d/%Y'),'$classId')";

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