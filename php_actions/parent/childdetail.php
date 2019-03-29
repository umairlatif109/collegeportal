<?php 

if (isset($_GET['studentId'])) {
	$student_id = $_GET['studentId'];

	if($student_id){

		$getClass = "SELECT 
						student_information.student_id,
					    student_information.class_id,
						student_information.roll_no,
					    student_information.student_name,
					    student_information.student_image,
					    class_information.class_name 
					from 
						student_information,
						class_information 
					WHERE 
						student_information.student_id = '$student_id' and
					    class_information.class_id = student_information.class_id
					    order by student_information.student_name LIMIT 1";
		$result = mysqli_query($con,$getClass);

		if($result){
			if(mysqli_num_rows($result) > 0){
				while ($row = mysqli_fetch_array($result)) {
					$class = $row['class_id'];
					$studentDetail = array($row['student_image'],$row['student_name'],$row['class_name'],$row['roll_no']);
				}

				if($class){
					$getTimetable = "SELECT subject_information.subject_name, teacher_information.teacher_name, room_information.room_name, timetable_information.day, timetable_information.start_time, timetable_information.end_time from class_information, subject_information, teacher_information, room_information, timetable_information where class_information.class_id = timetable_information.class_id and subject_information.subject_id = timetable_information.subject_id and teacher_information.teacher_id = timetable_information.teacher_id and room_information.room_id = timetable_information.room_id and timetable_information.class_id = '$class' order by start_time";

					$tresult = mysqli_query($con,$getTimetable);

					if($tresult){
						while ($row = mysqli_fetch_array($tresult)) {
							
							$sTime = strtotime($row['start_time']);
							$startTime = date('h:i A', $sTime);

							$eTime = strtotime($row['end_time']);
							$endTime = date('h:i A', $eTime);

							$detail = "<div class='row'> <b>$row[1]</b> </div><div class='row'> $row[2] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
							$timetables[] = array(
									ucfirst($row['day']),
									$row['subject_name'],
									$detail
								);

						}
					}


					$getMakeup = "SELECT subject_information.subject_name, teacher_information.teacher_name, room_information.room_name, makeup_information.makeup_date, makeup_information.start_time, makeup_information.end_time FROM class_information, subject_information, teacher_information, room_information, makeup_information WHERE class_information.class_id = makeup_information.class_id AND subject_information.subject_id = makeup_information.subject_id AND teacher_information.teacher_id = makeup_information.teacher_id AND room_information.room_id = makeup_information.room_id AND makeup_information.class_id = '$class' ORDER BY start_time";
					$mresult = mysqli_query($con,$getMakeup);

					if($mresult){
						while ($row = mysqli_fetch_array($mresult)) {

							$timestamp = strtotime($row[3]);
							$day = date('l', $timestamp);
							$dayDate = "$day <br>".date('d/m/Y',$timestamp);
							
							$sTime = strtotime($row['start_time']);
							$startTime = date('h:i A', $sTime);

							$eTime = strtotime($row['end_time']);
							$endTime = date('h:i A', $eTime);

							$detail = "<div class='row'> <b>$row[1]</b> </div><div class='row'> $row[2] </div><div class='row'> <small> $startTime - $endTime</small> </div>";
							$makeups[] = array(
									$dayDate,
									$row['subject_name'],
									$detail
								);

						}
					}


					$getDatesheet = "SELECT
									subject_information.subject_name,
									room_information.room_name,
									datesheet_information.start_time,
									datesheet_information.end_time,
									datesheet_information.date
									from 
									datesheet_information,
									subject_information,
									room_information,
									exam_information
									where 
									datesheet_information.class_id = '$class'
									and room_information.room_id = datesheet_information.room_id
									and subject_information.subject_id = datesheet_information.subject_id
									and exam_information.exam_type_id = datesheet_information.exam_type_id
									and current_date between exam_information.start_date and exam_information.end_date and exam_information.class_id = $class";
					$dresult = mysqli_query($con,$getDatesheet);

					if($dresult){
						while ($row = mysqli_fetch_assoc($dresult)) {

							$timestamp = strtotime($row['date']);
							$day = date('l', $timestamp);
							$dayDate = "$day <br>".date('d/m/Y',$timestamp);
							
							$sTime = strtotime($row['start_time']);
							$startTime = date('h:i A', $sTime);

							$eTime = strtotime($row['end_time']);
							$endTime = date('h:i A', $eTime);

							$detail = "<div class='row'>".$row['room_name']." </div><div class='row'> <small> $startTime - $endTime</small> </div>";
							$datesheets[] = array(
									$dayDate,
									$row['subject_name'],
									$detail
								);
						}
					}
				}
			}
		}
	}
}

else{
	header("location:index.php");
}
 ?>