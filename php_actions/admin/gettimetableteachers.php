<?php 
    include"../connection.php";
    global $con;

    $class_id = $_POST["class_id"];
    $subject_id = $_POST["subject_id"];
    
    $query = "select teacher_information.teacher_name,teacher_information.teacher_id from teacher_information,teacher_subject_information where teacher_subject_information.class_id = $class_id and teacher_subject_information.subject_id = $subject_id  and teacher_information.teacher_id = teacher_subject_information.teacher_id" ;

    $result = mysqli_query($con,$query);
    $output = array("data" => array());
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result)) {

            $output['data'][] = array($row[0],$row[1]);
        }
    }
    echo json_encode($output);
 ?>