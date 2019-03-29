<?php 
    include"../connection.php";
    global $con;

    $class_id = $_POST["class_id"];
    $query = "SELECT subject_information.subject_name,subject_information.subject_id from subject_information,class_subject_information where subject_information.subject_id = class_subject_information.subject_id and class_subject_information.class_id = $class_id order by subject_information.subject_name" ;

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