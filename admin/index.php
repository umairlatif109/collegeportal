<?php 
	session_start();
    if(!isset($_SESSION['user_id'])){
        header("location:login.php");
    }
	include"../includes/header.php";
 ?>
	<div class="row">
		<?php include"../includes/sidebar.php"; ?>
		<div class="col-md-9">
			<ol class="breadcrumb mt-3">
			  	<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			
		
		</div>
	</div>
<?php include"../includes/footer.php"; ?>