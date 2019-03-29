<?php 
	include "../php_actions/connection.php";
	// include "../connection.php";
	global $con;
	// session_start();
	$student_id =  $_GET['studentId'];

	if($student_id){

		$query ="SELECT
				    subject_information.subject_id,
				    subject_information.subject_name
				FROM
				    subject_information,
				    class_subject_information,
				    student_information
				WHERE
					student_information.class_id = class_subject_information.class_id
				    and subject_information.subject_id = class_subject_information.subject_id
				    and student_information.student_id = '$student_id' order by subject_information.subject_name";
		$result = mysqli_query($con,$query);

?>
	<div class="row">
<?php
		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {

?>
			<div class="card mt-1 ml-2">
				<div class="card-header">
					<h4><?php echo $row['subject_name'] ?></h4>
				</div>

				<div class="card-body">
					<table class="table table-hover table-sm table-bordered" style="color:black;background:white;">
						<tr class="table-dark text-center">
							<th>Status</th>
							<th>Date</th>
						</tr>
						
<?php 
				$attendanceQuery = "select attendance_status,date_format(attendance_date,'%d/%m/%Y') as attendance_date from student_attendance_information where student_id = '$student_id' and subject_id = ".$row['subject_id'];
				$attendanceResult = mysqli_query($con,$attendanceQuery);
					while($rowAttendance = mysqli_fetch_assoc($attendanceResult)){
?>						
						<tr>

							<td>
								<?php 
									if($rowAttendance['attendance_status'] == 'p')
										echo "<b class='text-success text-center'>Present</b>";
									else if($rowAttendance['attendance_status'] == 'a')
										echo "<b class='text-danger text-center'>Absent</b>";
									else
										echo "<b class='text-warning text-center'>Leave</b>";
								 ?>
							</td>
							<td><?php echo $rowAttendance['attendance_date'] == null ? "-" : $rowAttendance['attendance_date'] ?></td>
					
						</tr>
<?php } ?>
					</table>
				</div>
			</div>


<?php  
				// $attendanceQuery = "select attendance_status,date_format(attendance_date,'%d/%m/%Y') as attendance_date from student_attendance_information where student_id = '$student_id' and subject_id = ".$row['subject_id'];
				// $attendanceResult = mysqli_query($con,$attendanceQuery);
				// 	while($rowAttendance = mysqli_fetch_assoc($attendanceResult)){
						
				
			}
		}
	}

	
?>			
</div>