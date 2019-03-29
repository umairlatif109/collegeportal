<?php 
    session_start();
    unset($_SESSION["student_id"]);
    unset($_SESSION["teacher_id"]);
    unset($_SESSION["parent_id"]);
    if(isset($_SESSION['user_id'])){
        header("location:index.php");
    }
    include"../includes/header.php";
 ?>
	<?php $adminLoginUrl = "../php_actions/admin/login.php"; ?>
 <div class="container">
    <?php include "../includes/login_page.php"; ?>
        </div><!-- end of card  -->
    </div><!-- end of col-md-8 -->
</div>

<div class="scripts">
     <script src="../custom/js/login.js" ></script>
</div>
<?php include"../includes/footer.php"; ?>