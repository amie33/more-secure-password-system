<!doctype html> 
<html lang="en"> 
<head>
	<title>Sorta Secure Password Site</title>
	<link rel ="stylesheet" href="css/style.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=VT323&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
</head> 
	<body> 
		<?php
		echo '<div class="pagewrap">'; 
			//check to make sure the submitt button has been pressed 
				if(!isset($_POST["form_submitted"]))
				{
				echo '<div class = "wrapper">';
					echo '<h1 class="heading">Register Account</h1>';
					echo '<form method = "post" action = "index.php">';
					echo '<input type="text" name="userN" placeholder="User Name" id="username">';
					echo '<input type="text" name="passw" placeholder="Password" id="password">';
					echo '<input type="submit" name="submit" id="submitBut">';
					echo '<input type="reset" name="reset">';
					echo '<input type="hidden" name="form_submitted" value="1">';
					echo '<button type="submit" name="createAccount" class="button" formaction ="../sort-of-secure/create-account.php">Create Account</button>';
					echo '</form>';
				echo '</div>';
				}
				else
				{
					//let the userName and passWord equal whatever the user posts in those fields 
						$userName = $_POST["userN"]; 
						$passWord = $_POST["passw"]; 
					
					//if they left a field empty send them an alert 
						if(empty($userName))
						{
							echo 'hey lady enter a username';
						}
						if(empty($passWord))
						{
							echo 'hey dummy enter a password';
						}
				
					//define constants
					//if we're on the local machine.  if the host is called local host 
						if($_SERVER['HTTP_HOST'] == "localhost")
						{
							define("HOST", "localhost");
							define("USER", "root"); 
							define("PASS", "sparky33"); 
							define("BASE", "lessinsecure");
						}
					//remote machine 
						else
						{
							define("HOST", "localhost");
							define("USER", "id10733680_poll"); 
							define("PASS", "polly"); 
							define("BASE", "id10733680_webpoll");
						}
						
						//connect to database
							$connection = mysqli_connect(HOST, USER, PASS, BASE);
							
						//write a database command select all the records from the lessinsecure userinput table 
							$sql = ("SELECT * FROM USERINPUT WHERE username = '$userName' and password = '$passWord' ");
						
						//run command
							$results = mysqli_query($connection, $sql) or die("Cannot Connect :("); 
							
						//print out resutls and set a flag to error trap 
							$rows = mysqli_fetch_array($results, MYSQLI_ASSOC);
							$flag = false; 
							
							echo '<div class = "wrap2">';	 
								if($rows['username'] == $userName && $rows['password'] == $passWord && !empty($userName) && !empty($passWord))
								{
									echo '<a class ="success" href="index.php">Access Granted Earthling!</a>';
									echo '<p class ="print">User Name: '. $rows['username']. '</p>';
									echo '<br>';
									echo '<p class ="print2">Password: '. $rows['password'], '</p>';
									#echo '<img class ="right" src="img/mulder.gif"/>';
									#echo '<audio autoplay loop src="sounds/peace.mp3"></audo>'; 
									$flag = true;
								}else
								{
									echo '<a class ="fail" id="fail" href ="index.php">Access Denied!</a>';
									#echo '<img class ="wrong" src="img/mars1.gif"/>';
									#echo '<audio autoplay loop id="evillaugh" src="sounds/evillaugh.wav"></audio>';
								}
							echo '</div>';
	
				}
		echo '</div>';
		?>
	</body> 
</html>