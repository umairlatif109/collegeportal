<?php include '../connection.php';?>

<?php
global $con;
$valid = array("success" => false, "message" => null, "daily" => false, "shortage" => false, "sms" => null);

if ($_POST) {

	$class_id = $_POST["classId"];
	$subject_id = $_POST["selectSubject"];
	$lecture_topic = $_POST["lectureTopic"];
	$student_id = $_POST["studentId"];
	$attendance_status = $_POST['attendance_status'];
	$date = $_POST["date"];

	$searchQuery = "select * from student_attendance_information where class_id = '$class_id' and subject_id = '$subject_id' and attendance_date = current_date";

	$searchResult = mysqli_query($con, $searchQuery);

	if ($searchResult) {
		if (mysqli_num_rows($searchResult) > 0) {
			$valid['success'] = false;
			$valid['message'] = "Already Saved at <b>Date: " . date('d/m/Y') . "</b>";
		} else {

			for ($i = 0; $i < count($student_id); $i++) {

				$query = "insert into student_attendance_information(class_id,subject_id,lecture_topic,student_id,attendance_status,attendance_date) values( '$class_id','$subject_id','$lecture_topic','$student_id[$i]','$attendance_status[$i]',STR_TO_DATE('$date','%d/%m/%Y'))";
				$result = mysqli_query($con, $query);

				if ($result) {
					$valid["success"] = true;
					$valid['shortage'] = true;
					$valid['daily'] = true;
					$valid['message'] = "Saved Successfully";
				} else {
					$valid["success"] = false;
					$valid['message'] = $query . "<br>";
				}
			}
		}
	}

	

?>