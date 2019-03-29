<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <title>
            College Portal
        </title>
        <!-- datatables -->
        <link rel="stylesheet" href="../assets/plugin/datatables/datatables.min.css">
        <link rel="stylesheet" href="../assets/plugin/datatables/datatables.bootstrap.min.css">
        <!-- jquery ui -->
        <link rel="stylesheet" href="../assets/jquery/jquery-ui.css">
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.theme.css">
        <!-- custom css -->
        <link rel="stylesheet" href="../custom/css/custom.css">
        <!-- jquery -->
        <script src="../assets/jquery/jquery.min.js"></script>
        <!-- jquery ui -->
        <script src="../assets/jquery/jquery-ui.js"></script>
        <!-- Bootstrap js -->
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- datatables jquery -->
        <script src="../assets/plugin/datatables/datatables.min.js"></script>

    </head>
    <body>
        <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["student_id"]) || isset($_SESSION["teacher_id"]) || isset($_SESSION["parent_id"])): ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php if(@$_SESSION['teacher_id']){echo 'index.php?chat_with_teacher_parent=1';} else echo 'index.php'; ?>">College Portal</a>

            <div class="collapse navbar-collapse">

            </div>
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['user_name']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <?php if(isset($_SESSION['teacher_id'])): ?>
                        <a class="dropdown-item" href="teacherprofile.php?teacherId=<?php echo $_SESSION['teacher_id']; ?>">Profile</a>
                    <?php elseif(isset($_SESSION['student_id'])): ?>
                        <a class="dropdown-item" href="studentprofile.php?studentId=<?php echo $_SESSION['student_id']; ?>">Profile</a>
                    <?php elseif(isset($_SESSION['parent_id'])): ?>
                        <a class="dropdown-item" href="parentprofile.php">Profile</a>
                    <?php endif; ?>
                    <a class="dropdown-item" href="../php_actions/logout.php">Logout</a>
                </div>
            </div>
        </nav>
        <?php endif ?>

        <div class="fluid-container">