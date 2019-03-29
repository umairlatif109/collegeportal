	<div class="msg_box">
		<div class="msg_head">
			<span id="userName" >no Name</span>
			<span class="float-right close_chat">&times;</span>
			<input type="hidden" name="chatwith" id="chatwith">
			<input type="hidden" name="chatfrom" id="chatfrom" value="<?php
if (@$_SESSION['teacher_id']) {
	echo $_SESSION['teacher_id'];
} else if (@$_SESSION['student_id']) {
	echo @$_SESSION['student_id'];
} else if (@$_SESSION['parent_id']) {
	echo @$_SESSION['parent_id'];
}

?>">
		</div>
		<div class="msg_wrapper">
			<form action="" method="get">
				<div class="msg_body pl-2 pr-2 pt-1 text-black">
				<div class="msg_insert"></div>
			</div>
			</form>
			<div class="msg_footer">
				<input type="text" name="chat_message" id="chat_message" placeholder="Type Here..." >
			</div>
		</div>
	</div>
	<div class="chat_box">
		<div class="chat_head">
			<?php if (@$_SESSION['teacher_id']): ?>
				<div class="chat pl-1 pr-5 float-left">
					Chat
				</div>
				<div class="marginclass">
					<div class="form-group row">
						<b>With</b>
						<form action="" id="chatForm">
							<select class="ml-2" name="chat_with_teacher_parent" id="chat_with_teacher_parent">
								<option value="1" <?php echo (@$_GET['chat_with_teacher_parent'] == 1) ? "selected" : "" ?> >Student</option>
								<option value="2" <?php echo (@$_GET['chat_with_teacher_parent'] == 2) ? "selected" : "" ?> >Parent</option>
							</select>
						</form>
					</div>
				</div>
			<?php else: ?>
			<?php echo "Chat"; ?>
			<?php endif;?>
		</div>
		<div class="chat_body bg-light pt-2">
			<?php if (@$_SESSION['teacher_id']): ?>

			<?php

if (@$_GET['chat_with_teacher_parent'] == 1) {
	$query = "SELECT distinct class_information.* from class_information,teacher_subject_information where class_information.class_id = teacher_subject_information.class_id and teacher_subject_information.teacher_id = {$_SESSION['teacher_id']}";
	$result = mysqli_query($con, $query);
	if ($result && mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			?>
			<div id="accordion" >
				  <div class="card">
				    <div class="card-header text-white p-1" id="headingOne">
				      <h5 class="mb-0">
				        <button class="btn btn-block btn-link text-left text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				         <?php echo $row['class_name']; ?>
				        </button>
				      </h5>
				    </div>
				    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				      <div class="card-body m-0 p-0 ml-2 mr-2 mb-2">
				      	  <div class="list-group">
					      	<?php

			$query = "SELECT student_id,student_name from student_information where class_id = {$row['class_id']}";
			$result = mysqli_query($con, $query);
			if ($result && mysqli_num_rows($result) > 0) {
				while ($rowStudent = mysqli_fetch_assoc($result)) {

					?>
						      <a class="list-group-item list-group-item-action p-2 mt-1 chat_user" onclick="student_teacher_chat(<?php echo $rowStudent['student_id'] . ",'" . $rowStudent['student_name'] . "'," . $_SESSION['teacher_id']; ?>)"><?php echo $rowStudent['student_name']; ?></a>
						    <?php
} // student while
			} // student if
			?>
						  </div>
				      </div>
				    </div>
				  </div>


			</div>
			<?php
} // while $row
	} // end if of $result
} //chat_with_teacher_parent if
if (@$_GET['chat_with_teacher_parent'] == 2) {
	$query = "SELECT DISTINCT
				    parent_information.parent_id,
				    parent_information.parent_name
				FROM
				    student_information,
				    parent_information
				WHERE
				    student_information.parent_id = parent_information.parent_id AND student_information.class_id =(
				    SELECT DISTINCT
				        teacher_subject_information.class_id
				    FROM
				        teacher_subject_information
				    WHERE
				        teacher_subject_information.teacher_id = {$_SESSION['teacher_id']}
				)";

	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {

			echo "<a class='list-group-item list-group-item-action p-2 mt-1 chat_user' onclick=\"parent_teacher_chat({$row['parent_id']},'{$row['parent_name']}',{$_SESSION['teacher_id']})\">{$row['parent_name']}</a>";

		}

	}

} //chat_with_teacher_parent if == 2
?>


		<?php elseif (@$_SESSION['student_id']): ?>
			<div class="list-group">
				<?php

$getClass = "SELECT class_id from student_information where student_id = '$student_id'";
$result = mysqli_query($con, $getClass);

if ($result && mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {

		?>

						<?php

		$query = "SELECT distinct teacher_information.teacher_id,teacher_information.teacher_name from teacher_information,teacher_subject_information where teacher_subject_information.class_id = {$row['class_id']}";
		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {
			while ($rowTeacher = mysqli_fetch_array($result)) {
				?>
			      					<a class="list-group-item list-group-item-action p-2 mt-1 chat_user" onclick="student_teacher_chat2(<?php echo $_SESSION['student_id'] . "," . $rowTeacher['teacher_id'] . ",'" . $rowTeacher['teacher_name'] . "'"; ?>)"><?php echo $rowTeacher['teacher_name']; ?></a>
						<?php
} // while $row
		} // if result
		?>
			    <?php
} // while $row
} // if result
?>

			</div>
		<?php elseif (@$_SESSION['parent_id']): ?>

			<?php
$query = "SELECT DISTINCT
							    teacher_information.teacher_id,
							    teacher_information.teacher_name
							FROM
							    teacher_subject_information,
							    teacher_information
							WHERE
							    teacher_subject_information.teacher_id = teacher_information.teacher_id AND teacher_subject_information.class_id in (
							    SELECT DISTINCT
							        student_information.class_id
							    FROM
							        student_information
							    WHERE
							        student_information.parent_id = {$_SESSION['parent_id']})";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {

		echo "<a class='list-group-item list-group-item-action p-2 mt-1 chat_user' onclick=\"parent_teacher_chat({$row['teacher_id']},'{$row['teacher_name']}',{$_SESSION['parent_id']})\">{$row['teacher_name']}</a>";

	}
} else {
	echo mysqli_error($con);
}
?>

		<?php endif;?>

		</div>
	</div>