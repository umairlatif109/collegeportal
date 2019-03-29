<?php 
    include"../connection.php";
    global $con;

    $exam_type_id = $_POST["exam_type_id"];
    $query = "select class_information.class_id,class_information.class_name from class_information,exam_information where exam_information.class_id = class_information.class_id and date_format(current_date,'%y') = date_format(exam_information.start_date,'%y') and exam_information.exam_type_id = '$exam_type_id'";

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