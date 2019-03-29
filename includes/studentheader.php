<!doctype html>
<html lang="en">
 	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>
			College Portal
		</title>
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<!-- Bootstrap theme -->
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.theme.css">
		<!-- custom css -->
		<link rel="stylesheet" href="custom/css/custom.css">
		<!-- font-awesome -->
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<!-- datatables -->
		<link rel="stylesheet" href="assets/plugin/datatables/datatables.min.css">
		<!-- jquery -->
		<script src="assets/jquery/jquery.min.js"></script>
		<!-- Bootstrap js -->
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- datatables jquery -->
		<script src="assets/plugin/datatables/datatables.min.js"></script>
	</head>
	<body>
         <?php if(isset($_SESSION["student_id"])): ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Student Portal</a>

            <div class="collapse navbar-collapse" id="navbarColor02">

            </div>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['user_name']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">Setting</a>
                    <a class="dropdown-item" href="../php_actions/logout.php">Logout</a>
                </div>
            </div>
        </nav>
        <?php endif ?>
		<div class="fluid-container">