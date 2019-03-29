<?php include '../connection.php'; ?>
	
<?php
    global $con;
    $valid = array("success"=>false , "message" => null, "sms" => null);

	if($_POST){

		$class_id = $_POST["classId"];
		$subject_id = $_POST["subjectId"];
		$exam_type_id = $_POST["exam_type_id"];
		$teacher_id = $_POST["teacherId"];
		$student_id = $_POST["studentId"];
		$o_marks = $_POST['oMarks'];
		$date = $_POST["date"];
				

		for ($i=0; $i < count($student_id); $i++) { 
			
			$query = "insert into student_exam_marks_information(exam_type_id,class_id,subject_id,student_id,o_marks,marks_date,teacher_id) values('$exam_type_id','$class_id','$subject_id','$student_id[$i]','$o_marks[$i]',STR_TO_DATE('$date','%d/%m/%Y'),'$teacher_id')";
			$result = mysqli_query($con,$query);

			// $result = true;
			
			if($result){
				$valid["success"] = true;
				$valid['message'] = "Saved Successfully";
			}
			else{
				$valid["success"] = false;
				$valid['message'] = mysqli_error($con);
			}
		}


		if ($valid['success'] == true) {
			$pending_result_subjects = "SELECT
										    class_subject_information.class_id,
										    class_subject_information.subject_id
										FROM
										    class_subject_information
										WHERE
										    class_subject_information.class_id = '$class_id' AND class_subject_information.subject_id NOT IN(
										    SELECT DISTINCT
										        student_exam_marks_information.subject_id
										    FROM
										        student_exam_marks_information
										    WHERE
										        student_exam_marks_information.class_id = '$class_id' AND student_exam_marks_information.exam_type_id = '$exam_type_id' AND DATE_FORMAT(
										            student_exam_marks_information.marks_date,
										            '%Y'
										        ) = DATE_FORMAT(CURRENT_DATE, '%Y')
										)";

			$pending_query = mysqli_query($con,$pending_result_subjects);


			if($pending_query){
				if(mysqli_num_rows($pending_query) == 0){
					

					$get_students = "SELECT student_phone from student_information where class_id = '$class_id'";
					$get_students_result = mysqli_query($con,$get_students);

					if ($get_students_result) {
						$phone = null;
						while ($studentPhone = mysqli_fetch_assoc($get_students_result)) {
							$phone .= $studentPhone['student_phone'].",";
						}

						$final_phone = substr($phone, 0, strlen($phone)-1);
						$message = "Result has been uploaded. Please check your portal account.";

						$valid['sms'] = send_sms($final_phone,$message);
					}

				}
				else{
					$valid['sms'] = "Not send some of the subjects result";
				}
				
			}
		}
		echo json_encode($valid);
	}


			function send_sms($final_phone,$message){

			$username = "923088564690";///Your Username
			$password = "password";///Your Password
			$mobile = $final_phone;///Recepient Mobile Number
			$sender = "College Portal";
			$message = $message;

			//////////////////
			////sending sms //
			//////////////////

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
			
			// if (preg_match("/OK/", $result))
			// {
			// 	return "sent";
			// }
			// else
			// {
			// 	return $result;
			// }

		}
 ?>