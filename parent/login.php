<?php 
    session_start();
    unset($_SESSION["student_id"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["teacher_id"]);
    if(isset($_SESSION['parent_id'])){      // check for the session of the parent if exists
        header("location:index.php");       // redirect to the parent/index.php
    }
    include"../includes/header.php";
 ?>
	<?php $parentLoginUrl = "../php_actions/parent/login.php"; ?>
 <div class="container">
    <?php include "../includes/login_page.php"; ?>
        </div><!-- end of card  -->
    </div><!-- end of col-md-8 -->
</div>

<div class="scripts">
     <script src="../custom/js/login.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>