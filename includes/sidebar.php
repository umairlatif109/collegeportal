<div class="col-md-2">
  <div class="list-group mt-3">
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="student.php" class="list-group-item list-group-item-action <?php echo ($page == 'student') ? 'active' : ''; ?>">Student</a>
      <a href="promotestudent.php" class="list-group-item list-group-item-action <?php echo ($page == 'promotestudent') ? 'active' : ''; ?>">Promote Student</a>

      <a href="teacher.php" class="list-group-item list-group-item-action <?php echo ($page == 'teacher') ? 'active' : ''; ?>">Teacher</a>
      <a href="parent.php" class="list-group-item list-group-item-action <?php echo ($page == 'parent') ? 'active' : ''; ?>">Parent</a>
      <a href="class.php" class="list-group-item list-group-item-action <?php echo ($page == 'class') ? 'active' : ''; ?>">Class</a>
      <a href="subject.php" class="list-group-item list-group-item-action <?php echo ($page == 'subject') ? 'active' : ''; ?>">Subject</a>
      <a href="classroom.php" class="list-group-item list-group-item-action <?php echo ($page == 'classroom') ? 'active' : ''; ?>">Class Room</a>
      <a href="timetable.php" class="list-group-item list-group-item-action <?php echo ($page == 'timetable') ? 'active' : ''; ?>">Time Table</a>
      <a href="subject_syllbus.php" class="list-group-item list-group-item-action <?php echo ($page == 'subject_syllbus') ? 'active' : ''; ?>">Syllbus</a>
      <a href="event.php" class="list-group-item list-group-item-action <?php echo ($page == 'event') ? 'active' : ''; ?>">Event</a>
      <a href="exam.php" class="list-group-item list-group-item-action <?php echo ($page == 'exam') ? 'active' : ''; ?>">Exam</a>
      <a href="datesheet.php" class="list-group-item list-group-item-action <?php echo ($page == 'datesheet') ? 'active' : ''; ?>">Datesheet</a>
      <a href="users.php" class="list-group-item list-group-item-action <?php echo ($page == 'users') ? 'active' : ''; ?>">Users</a>
    <?php elseif (isset($_SESSION['teacher_id'])): ?>
      <a href="index.php?chat_with_teacher_parent=1" class="list-group-item list-group-item-action <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
      <a href="attendance.php" class="list-group-item list-group-item-action <?php echo ($page == 'attendance') ? 'active' : ''; ?>">Attendance</a>
      <a href="assignment.php" class="list-group-item list-group-item-action <?php echo ($page == 'assignment') ? 'active' : ''; ?>">Assignment</a>
      <a href="quiz.php" class="list-group-item list-group-item-action <?php echo ($page == 'quiz') ? 'active' : ''; ?>">Quiz Marks</a>
      <a href="lecture.php" class="list-group-item list-group-item-action <?php echo ($page == 'lecture') ? 'active' : ''; ?>">Lecture</a>
      <a href="result.php" class="list-group-item list-group-item-action <?php echo ($page == 'result') ? 'active' : ''; ?>">Result</a>
    <?php elseif (isset($_SESSION['student_id'])): ?>
      <a href="index.php" class="list-group-item list-group-item-action <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
      <a href="attendance.php" class="list-group-item list-group-item-action <?php echo ($page == 'attendance') ? 'active' : ''; ?>">Attendance</a>
      <a href="assignment.php" class="list-group-item list-group-item-action <?php echo ($page == 'assignment') ? 'active' : ''; ?>">Assignment</a>
      <a href="quiz.php" class="list-group-item list-group-item-action <?php echo ($page == 'quiz') ? 'active' : ''; ?>">Quiz</a>
      <a href="lecture.php" class="list-group-item list-group-item-action <?php echo ($page == 'lecture') ? 'active' : ''; ?>">Lecture</a>
      <a href="result.php" class="list-group-item list-group-item-action <?php echo ($page == 'result') ? 'active' : ''; ?>">Result</a>
    <?php elseif (isset($_SESSION['parent_id'])): ?>
      <a href="index.php" class="list-group-item list-group-item-action <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>

    <?php endif;?>
  </div>
</div>