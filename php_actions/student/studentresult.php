<?php
include "../php_actions/connection.php";
// include "../connection.php";
global $con;
// session_start();
$student_id = $_SESSION['student_id'];

if ($student_id) {

    $totalPerc = 0;

    $query = "select distinct et_id,exam_type from exam_type_information,student_exam_marks_information where exam_type_information.et_id = student_exam_marks_information.exam_type_id and student_exam_marks_information.student_id = '$student_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['et_id'] == 2) {
                ?>
                <!--  -->
                <!--  -->
                <!-- final term exam -->
                <!--  -->
                <!--  -->
                <div class="card">
                    <div class="card-header">
                        <h3><?php echo $row['exam_type']; ?></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" style="color:black;background:white;">
                            <tr class="table-dark">
                                <th>Subject Name</th>
                                <th>Obtained Marks</th>
                                <th>Total Marks</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                                <th>Remarks</th>
                            </tr>
                <?php
                $getStudentResult = "SELECT subject_information.subject_name,student_exam_marks_information.o_marks,subject_information.p_marks FROM student_exam_marks_information,subject_information WHERE student_id = '$student_id' and student_exam_marks_information.subject_id = subject_information.subject_id  and student_exam_marks_information.exam_type_id = " . $row['et_id'] . " order by subject_information.subject_name";

                $studentResult = mysqli_query($con, $getStudentResult);

                if ($studentResult) {
                    if (mysqli_num_rows($studentResult)) {
                        while ($row2 = mysqli_fetch_assoc($studentResult)) {

                            $midPerc = round($row2['o_marks'] * 100 / 40);
                            ?>

                                        <tr>
                                            <td><?php echo $row2['subject_name']; ?></td>
                                            <td><?php echo $row2['o_marks']; ?></td>
                                            <td><?php echo "40" ?></td>
                                            <td><?php echo $midPerc; ?> %</td>
                                            <td>
                                        <?php
                                        if ($midPerc >= 90)
                                            echo "A+";
                                        else if ($midPerc >= 80 && $midPerc < 90)
                                            echo "A";
                                        else if ($midPerc >= 70 && $midPerc < 80)
                                            echo "B+";
                                        else if ($midPerc >= 60 && $midPerc < 70)
                                            echo "B";
                                        else if ($midPerc >= 50 && $midPerc < 60)
                                            echo "C+";
                                        else if ($midPerc >= 40 && $midPerc < 50)
                                            echo "C";
                                        else if ($midPerc < $row2['p_marks'])
                                            echo "F";
                                        else
                                            echo "Undefined";
                                        ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($midPerc >= $row2['p_marks']) {
                                                    echo "<span class='text-success' ><b>Pass</b></span>";
                                                } else {
                                                    echo "<span class='text-danger' ><b>Fail</b></span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                            <?php
                        }
                    }
                }
                ?>
                        </table>
                    </div>
                </div>
                <br>
                <!--  -->
                <!--  -->
                <!-- end of final term exam -->
                <!--  -->
                <!--  -->






                <!--  -->
                <!--  -->
                <!-- cumulative result -->
                <!--  -->
                <!--  -->
                <div class="card">
                    <div class="card-header">
                        <h3>Final Result <small><mark>Cumulative</mark></small></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" style="color:black;background:white;">
                            <tr class="table-dark">
                                <th>Subject Name</th>
                                <th>Obtained Marks</th>
                                <th>Total Marks</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                                <th>Remarks</th>
                            </tr>
                            <?php
                            $getClass = "select class_id from student_information where student_id = '$student_id'";
                            $result = mysqli_query($con, $getClass);

                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $class = $row['class_id'];
                                    }
                                    if ($class) {
                                        $getsubjects = "select subject_id from class_subject_information where class_id = $class";
                                        $result = mysqli_query($con, $getsubjects);
                                        ?>

                                        <?php
                                        if ($result) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($r = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        $getStudentResult = "SELECT 
							subject_information.subject_id,
							subject_information.subject_name,
							(sum(student_exam_marks_information.o_marks)*100)/80 as 'o_marks',
							subject_information.t_marks,
							subject_information.p_marks
						FROM
							student_exam_marks_information,
							subject_information
						WHERE
							student_exam_marks_information.student_id = '$student_id'
							and student_exam_marks_information.subject_id = subject_information.subject_id 
							AND subject_information.subject_id = " . $r['subject_id'] . "
							order by subject_information.subject_name";

                                                        $studentResult = mysqli_query($con, $getStudentResult);

                                                        if ($studentResult) {
                                                            if (mysqli_num_rows($studentResult)) {
                                                                while ($row2 = mysqli_fetch_assoc($studentResult)) {
                                                                    ?>
                                                                    <td> <?php echo $row2['subject_name']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $new = "SELECT ROUND( (SUM( student_assignment_marks_information.o_marks ) / COUNT( student_assignment_marks_information.o_marks ))*100/10 ) AS 'assignment_percentage' from teacher_assignment_information,student_assignment_marks_information WHERE student_assignment_marks_information.student_id = 1 and teacher_assignment_information.subject_id = " . $row2['subject_id'];
                                                                        $newresult = mysqli_query($con, $new);

                                                                        while ($row3 = mysqli_fetch_assoc($newresult)) {

                                                                            $new = "SELECT ROUND( (SUM( student_quiz_marks_information.o_marks ) / COUNT( student_quiz_marks_information.o_marks ))*100/10 ) AS 'quiz_percentage' from student_quiz_marks_information where student_quiz_marks_information.subject_id =" . $row2['subject_id'] . " and student_id =" . $student_id;
                                                                            $newresult = mysqli_query($con, $new);

                                                                            while ($row4 = mysqli_fetch_assoc($newresult)) {

                                                                                // echo 	'O: '.$row2['o_marks']."Ass: ".$row3['assignment_percentage']."Quiz: ".$row4['quiz_percentage'];
                                                                                echo $totalPerc = round(($row2['o_marks'] + $row3['assignment_percentage'] + $row4['quiz_percentage']) / 3);
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $row2['t_marks']; ?></td>
                                                                    <td><?php echo round($totalPerc * 100 / $row2['t_marks']); ?> %</td>
                                                                    <td>
                                                                        <?php
                                                                        if ($totalPerc >= 90)
                                                                            echo "A+";
                                                                        else if ($totalPerc >= 80 && $totalPerc < 90)
                                                                            echo "A";
                                                                        else if ($totalPerc >= 70 && $totalPerc < 80)
                                                                            echo "B+";
                                                                        else if ($totalPerc >= 60 && $totalPerc < 70)
                                                                            echo "B";
                                                                        else if ($totalPerc >= 50 && $totalPerc < 60)
                                                                            echo "C+";
                                                                        else if ($totalPerc >= 40 && $totalPerc < 50)
                                                                            echo "C";
                                                                        else if ($totalPerc < $row2['p_marks'])
                                                                            echo "F";
                                                                        else
                                                                            echo "Undefined";
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if ($totalPerc > $row2['p_marks']) {
                                                                            echo "<span class='text-success' ><b>Pass</b></span>";
                                                                        } else {
                                                                            echo "<span class='text-danger' ><b>Fail</b></span>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                        <?php
                                                                    }// end of row2 while
                                                                }// end of if student result
                                                            }// end of student result	
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>

                        </table>
                    </div>
                </div>
                <br>
                <!--  -->
                <!--  -->
                <!-- end of cumulative result -->
                <!--  -->
                <!--  -->
                            <?php
                        }// end of if et_id == 2
                        else {
                            ?>
                <!--  -->
                <!--  -->
                <!-- mid term exam -->
                <!--  -->
                <!--  -->
                <div class="card">
                    <div class="card-header">
                        <h3><?php echo $row['exam_type']; ?></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" style="color:black;background:white;">
                            <tr class="table-dark">
                                <th>Subject Name</th>
                                <th>Obtained Marks</th>
                                <th>Total Marks</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                                <th>Remarks</th>
                            </tr>
                <?php
                $getStudentResult = "SELECT subject_information.subject_name,student_exam_marks_information.o_marks,subject_information.p_marks FROM student_exam_marks_information,subject_information WHERE student_id = '$student_id' and student_exam_marks_information.subject_id = subject_information.subject_id  and student_exam_marks_information.exam_type_id = " . $row['et_id'] . " order by subject_information.subject_name";

                $studentResult = mysqli_query($con, $getStudentResult);

                if ($studentResult) {
                    if (mysqli_num_rows($studentResult)) {
                        while ($row2 = mysqli_fetch_assoc($studentResult)) {

                            $midPerc = round($row2['o_marks'] * 100 / 40);
                            ?>

                                        <tr>
                                            <td><?php echo $row2['subject_name']; ?></td>
                                            <td><?php echo $row2['o_marks']; ?></td>
                                            <td><?php echo "40" ?></td>
                                            <td><?php echo $midPerc; ?> %</td>
                                            <td>
                                        <?php
                                        if ($midPerc >= 90)
                                            echo "A+";
                                        else if ($midPerc >= 80 && $midPerc < 90)
                                            echo "A";
                                        else if ($midPerc >= 70 && $midPerc < 80)
                                            echo "B+";
                                        else if ($midPerc >= 60 && $midPerc < 70)
                                            echo "B";
                                        else if ($midPerc >= 50 && $midPerc < 60)
                                            echo "C+";
                                        else if ($midPerc >= 40 && $midPerc < 50)
                                            echo "C";
                                        else if ($midPerc < $row2['p_marks'])
                                            echo "F";
                                        else
                                            echo "Undefined";
                                        ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($midPerc >= $row2['p_marks']) {
                                                    echo "<span class='text-success' ><b>Pass</b></span>";
                                                } else {
                                                    echo "<span class='text-danger' ><b>Fail</b></span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                            <?php
                        }
                    }
                }
                ?>
                        </table>
                    </div>
                </div>
                <br>
                <!--  -->
                <!--  -->
                <!-- end of mid term exam -->
                <!--  -->
                <!--  -->
                                    <?php
                                } // end of else 
                            }
                        } else {
                            echo "<h3 class='text-center'> No Record Found </h3>";
                        }
                    }
                    ?>