<?php include '../php_actions/connection.php'; ?>
	
<?php
    global $con;

    $student_id = $_SESSION['student_id'];
    $subject_id = @$_GET['subjectId'];
    $Query = "SELECT attendance_status,date_format(attendance_date,'%d/%m/%Y') as attendance_date FROM `student_attendance_information` WHERE subject_id =  '$subject_id' and student_id = '$student_id'";

    $Result = mysqli_query($con,$Query);


    $count_present = 0;
    $count_leave = 0;
    $count_abesnt = 0;

    if($Result){
        while($row = mysqli_fetch_assoc($Result)){

            if($row['attendance_status'] == "p"){
                $o = "<span class='text-success'>Present</span>";
                $count_present++;
            }
            else if($row['attendance_status'] == "a"){
                $o = "<span class='text-danger'>Absent</span>";
                $count_abesnt++;
            }
            else{
                $o = "<span class='text-warning'>Leave</span>";
                $count_leave++;
            }
            $attendances[] = array($o,$row['attendance_date']);
        }

        
    }
?>