<?php 
    session_start();                            // this will start the session

    unset($_SESSION["teacher_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["parent_id"]);
    
    if(isset($_SESSION['student_id'])){         // check for the session of the student if exists
        header("location:student/index.php");   // redirect to the student/index.php
    }                                           
    include"includes/studentheader.php";
 ?>
	<?php 
        // this is the student login form aciton link where login will perform  
        $studentLoginUrl = "php_actions/student/login.php"; 
    ?> 
 <div class="container">
    <?php include "includes/login_page.php"; ?>
		<div class="card-footer">
			<a href="teacher/" class="float-left ml-2">Login as Teacher</a>
			<a href="parent/" class="float-right mr-2">Login as Parent</a>
		</div>
    </div><!-- end of card  -->
</div><!-- end of col-md-8 -->
</div>

<div class="scripts">
     <script src="custom/js/login.js" ></script>
</div>
<?php include"includes/footer.php"; ?>