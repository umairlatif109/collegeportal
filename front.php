	<!doctype html>
	<html>
	<head>
	<meta charset="utf-8">
	<title>College Portal</title>
	</head>

	<style>
		/*{
			padding: 0px;
			margin: 0px;
		}*/section
	  {
		background-image: url('assets/images/bg.jpg');
		  background-color: aqua;
		  opacity: ;
		  width: 1366px;
		  height: 672px;
		  margin: ;
	  }
		#d1{
			width: 300px;
			background-color:#000000 ;
			border-radius: 50%;
			float: left;
			margin: 50px 0 0 140px;
		}
		#d2{
			width: 300px;
			background-color:#000000 ;
			border-radius: 50%;
			float: left;
			margin: 20px 0 0 140px;

		}
		#d3{
			width: 300px;
			background-color:#000000;
			border-radius: 50%;
			float: left;
			margin: 20px 0 0 140px;

		}
		#d4{
			width: 300px;
			background-color:#000000 ;
			border-radius: 50%;
			float: left;
			margin: 20px 0 0 140px;


		}
		#l1{
			text-decoration: none;
			font-family: arial;
			color:white;
			float: left;
			margin: 25px 0 0 20px;
			font-size: 18px;
		}
		#l2{
			text-decoration: none;
			font-family: arial;
			color: white;
			float: left;
			margin: 25px 0 0 20px;
			font-size: 18px;
		}

		#main{
			width: 600px;
			height: 500px;
			margin: auto;

		}
		#h1{
			text-align: center;
			font-family: arial;
			font-size: 35px;
			color: white;
			float: left;
			padding: 60px 0 0 100px;
		}
	</style>
<body>
<section>       <!-- for back ground img-->
			<div id="main">   <!--a div for all three elements-->
				<h1 id="h1"> Welcome To College Portal</h1>
				<div id="d1">            <!--DI fir pic and background color and size of oval-->
					<img src="assets/images/Admin.png" width="70px" height="70px" style="float: left;">
					<a href="admin/login.php" id="l1" style="color:green"><em><b>Administrator Login</b></em></a>
				</div>
				<div id="d2">
					<img src="assets/images/std.png" width="70px" height="70px" style="float: left;">
					<a href="student/index.php" id="l1"   style="color:green"><em><b>Student Login</b></em></a>

				</div>
<div id="d3">
					<img src="assets/images/TL.png" width="90px" height="70px" style="float: left;">
					<a href="teacher/login.php" id="l1" style="color:green"><em><b>Teacher Login</b></em></a>

				</div>
				<div id="d4">
					<img src="assets/images/A.png" width="90px" height="70px" style="float: left;">
					<a href="parent/login.php" id="l1" style="color:green"><em><b>Parent Login</b></em></a>

				</div>







			</div>
		</section>

	</body>
	</html>
