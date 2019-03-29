<?php 
    $url = "";
    $loginType = "";


    if(@$adminLoginUrl){ // this variable will get admin login url from the admin/login.php page and checks if exists
        $url = $adminLoginUrl; // assign it to $url variable
        $loginType = "Admin"; // if $adminLoginUrl exists loginType will be admin
    }
    if(@$studentLoginUrl){ // similarly admin, this variable will get student login url from collegeportal/index.php
       $url = $studentLoginUrl; // if $studentLoginUrl assign it to $url variable
       $loginType = "Student"; // if $studentLoginUrl exists loginType will be student
    }
    if(@$teacherLoginUrl){// similarly admin, this variable will get student login url from teacher/login.php
       $url = $teacherLoginUrl; // if $teacherLoginUrl assign it to $url variable
       $loginType = "Teacher"; // if $teacherLoginUrl exists loginType will be teacher
    }
    if(@$parentLoginUrl){// similarly admin, this variable will get student login url from parent/login.php
       $url = $parentLoginUrl; // if $parentLoginUrl assign it to $url variable
       $loginType = "Parent"; // if $parentLoginUrl exists loginType will be parent
    }

?>
<div class="col-md-5" style="margin: 150px auto 0;">
<div class="message" style="margin:150px 0 20px; height:50px; ">
    
</div>
<div class="card bg-light">
    <div class="card-header text-center">
        <h4>
            Login College Portal
            <small>( <?php echo $loginType; ?> )</small>
        </h4>
    </div>
    <div class="card-body">
        <form id="Login" method="post" action="<?php echo $url; ?>">
            <div class="form-group" >
                <label class="control-label" > Username </label>
                <input type="text" class="form-control col-md-12" name="username" id="username"  placeholder="Enter Username"/>
            </div>
            <div class="form-group" >
                <label class="control-label" > Password </label>
                <input type="password" class="form-control col-md-12" name="password" id="password" placeholder="Enter Password"/>
            </div>
            <input type="submit" class="btn btn-block btn-success" name="btnLogin" id="btnLogin" placeholder="Enter Username"/>
        </form>
    </div>
