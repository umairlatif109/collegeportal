<?php 
    session_start(); 
    unset($_SESSION["student_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["parent_id"]);                           // this will start the session
    if(isset($_SESSION['teacher_id'])){         // check for the session of the teacher if exists
        header("location:index.php?chat_with_teacher_parent=1");           // redirect to the teacher/index.php
    }
    include"../includes/header.php";
 ?>
	<?php 
        // this is the teacher login form aciton link where login will perform  
        $teacherLoginUrl = "../php_actions/teacher/login.php";
     ?>
 <div class="container">
    <?php include "../includes/login_page.php"; ?>
        <div class="card-footer">
            <a href="../index.php" class="float-left ml-2">Login as Student</a>
        </div>
        </div><!-- end of card  -->
    </div><!-- end of col-md-8 -->
</div>

<div class="scripts">
     <script src="../custom/js/login.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>