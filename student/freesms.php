<?php
$apikey =  "Add Your API here";  // Add your Hajana one Free API key Here


	if (isset($_POST["submit"])) {
		$number = $_POST['number'];
		$message = $_POST['message'];
		$message = urlencode($message);
		
$url = 'http://www.hajanaone.com/websms.php?api='.$apikey.'&number='.$number.'&message='.$message;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$output = curl_exec ($ch);


if (preg_match("/Successfully/", $output ))
{
$result = '<strong><font color="green">'.$output.'</font></strong>';
}else{
$result = '<strong><font color="red">'.$output.'</font></strong>';
}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bootstrap contact form with PHP example by BootstrapBay.com.">
    <meta name="author" content="BootstrapBay.com">
    <title>Send Free SMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h1 class="page-header text-center">Send Free SMS</h1>
				<form class="form-horizontal" role="form" method="post" action="">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Number</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="number" placeholder="03001234567" value="<?php echo htmlspecialchars($_POST['name']); ?>">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
					
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
							<?php echo "<p class='text-danger'>$errMessage</p>";?>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send Message" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>	
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
