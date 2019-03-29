<?php 

include "../php_actions/connection.php";
global $con;

// $username = "923088564690";///Your Username
// $password = "password";///Your Password
// $mobile = "923035201175,923427433397";///Recepient Mobile Number
// $sender = "College Portal";
// $message = "You were absent.";

// ////sending sms

// $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
// $url = "http://sendpk.com/api/sms.php?username=923088564690&password=1463";
// $ch = curl_init();
// $timeout = 30; // set to zero for no timeout
// curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
// curl_setopt($ch, CURLOPT_URL,$url);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
// $result = curl_exec($ch); 
// /*Print Responce*/
// echo $result;

// $queryPhone = "SELECT
// 			    student_information.student_id,
// 			    student_information.student_name,
// 			    round(( sum(student_attendance_information.attendance_status = 'p') * 100 ) / count(*)),
// 			    student_information.student_phone,
// 			    ( sum(student_attendance_information.attendance_status = 'p') * 100 ) / count(*) as perc
// 			FROM
// 			    student_information,
// 			    student_attendance_information
// 			WHERE
// 			    student_information.student_id = student_attendance_information.student_id 
// 			    AND student_information.class_id = student_attendance_information.class_id 
// 			    AND student_attendance_information.class_id = 1 AND student_attendance_information.subject_id = 1
// 			    GROUP BY student_information.student_id
// 			    HAVING round(( sum(student_attendance_information.attendance_status = 'p') * 100 ) / count(*)) < 50";
// $resultPhone = mysqli_query($con,$queryPhone);

// 	$phone = null;
// while ($rowPhone = mysqli_fetch_assoc($resultPhone)){

// 	$phone .= $rowPhone['student_phone'].",";

// }

// echo $phone."<br>";

// echo substr($phone,0, strlen($phone)-1);


// echo "<script>console.log('sent')</script>";




	// $query = "SELECT * from student_attendance_information where class_id = 1 and subject_id = 1 and attendance_date = current_date and attendance_status = 'a'";

	$queryAbsent = "SELECT
						    student_information.student_id,
						    student_information.student_name,
			                subject_information.subject_name,
						    student_information.student_phone,
						    round(( sum(student_attendance_information.attendance_status = 'p') * 100 ) / count(*)) as perc
						FROM
						    student_information,
						    student_attendance_information,
			                subject_information
						WHERE
						    student_information.student_id = student_attendance_information.student_id 
						    AND student_information.class_id = student_attendance_information.class_id 
						    AND student_attendance_information.class_id = 1
			                AND subject_information.subject_id = student_attendance_information.subject_id
			                AND student_attendance_information.subject_id = 1
						    GROUP BY student_information.student_id
						    HAVING round(( sum(student_attendance_information.attendance_status = 'p') * 100 ) / count(*)) < 50";
	$resultAbsent = mysqli_query($con,$queryAbsent);
	$phone = null;
	echo mysqli_error($con);
	while ($rowAbsent = mysqli_fetch_assoc($resultAbsent)) {
		echo $rowAbsent['perc']."<br>";
		$phone .= $rowAbsent['student_phone'].",";
	}

	echo substr($phone,0, strlen($phone)-1);
	


 ?>