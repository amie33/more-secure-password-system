<!--This is my iffy sight-->
<!DOCTYPE html> 
<html lang = "en"> 
<head>
	<title>Create Account Page</title>
	<link href="css/style3.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Yeon+Sung&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=VT323&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
</head>
<body> 

<div class= "form-wrapper">
		<a class="heading" href="index.php">Register Me</a>
			<form method="post" action="create-account.php">
			<input type="text" placeholder="User Name" name="userName" id="user" required>
			<input type="password" placeholder="Password" name="firstPassword" autocomplete="new-password" id="password_one" required>
			<input type="password" placeholder="Confirm Password" name="confirmPassword" onkeyup="validate()" id="password_two">
			<div class="divy"> <span id="message" class="spanny"></span> </div>
			<input type="password" placeholder="Secret Code" name="secret" autocomplete="new-password">
			<input type="submit" name="submit" id = "subbutton" value="Create Account">
			<input type="reset">
	</form>
</div> 
	<?php 
		//establish database connection
		//define constants
		//if we're on the local machine.  if the host is called local host 
			if($_SERVER['HTTP_HOST'] == "localhost")
			{
				define("HOST", "localhost");
				define("USER", "root"); 
				define("PASS", "sparky33"); 
				define("BASE", "lessinsecure");
			}
		//remote machine (live)
			else
			{
				define("HOST", "localhost");
				define("USER", "id10733680_poll"); 
				define("PASS", "polly"); 
				define("BASE", "id10733680_webpoll");
			}
			
		//connect to database
			$connection = mysqli_connect(HOST, USER, PASS, BASE);

		if(isset($_POST['submit']))
		{
			$user = $_POST['userName'];
			$firstP = $_POST['firstPassword'];
			$secondP = $_POST['confirmPassword'];
			$secret = $_POST['secret'];
			
			//hash
			$firstP = hash("SHA512", $firstP);
			
			$sql_u = "SELECT * FROM userinput WHERE username = '$user'";
			$sql_p = "SELECT * FROM userinput WHERE password ='$firstP'";
			$sql_s = "SELECT * FROM `secret code` WHERE 1";
			
			$results_u = mysqli_query($connection, $sql_u) or die("Sorry Cant Connect");
			$results_p = mysqli_query($connection, $sql_p) or die("Sorry We can't do this");
			$results_s = mysqli_query($connection, $sql_s) or die("Sorry Sucker!"); 

		//print out resutls and set a flag to error trap 
			$rows = mysqli_fetch_array($results_s, MYSQLI_ASSOC);
			if($secret == $rows['secretCode'])
			{
				#echo $rows['secretCode'];
				echo '<div class="success">';
					echo '<p class="secretsuccess">The secret code was rawhide..good job!</p>';
				echo '</div>';
				$flag = true;
			}else{
				echo '<div class="failed">';
					echo "<p class='fail'>sorry..the secret code doesn't work</p>";
				echo '</div>';
			}

			if(mysqli_num_rows($results_u) > 0)
			{
				echo '<div class="failed">';
					echo "<p class ='fail'>Sorry that username is already taken!</p>";
				echo '</div>';

			}else{
				$query = "INSERT INTO userinput (username, password) VALUES('$user', '$firstP');";
				$results = mysqli_query($connection, $query) or die("Cant connect Miss");
				echo '<div class="success">';	
					echo "<p class ='saved'>Saved</p>"; 
				echo '</div>';
				exit();
			}
		}
?>
<script src="js/script.js"></script>
</body>
</html>