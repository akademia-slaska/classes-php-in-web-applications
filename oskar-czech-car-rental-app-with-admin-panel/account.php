<!DOCTYPE html>
<html lang="en">
<head>
	<title>Car Rental</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>

	<section class="">
		<?php
			include 'header.php';
		?>

			<section class="caption">
			<h3 style="text-align: center; padding: 20px 0; color: #323232">Client Login Area</h3>
			</section>
	</section><!--  end hero section  -->


	<section class="search">
		<div class="wrapper">
		<div id="fom">
			<form method="post">
			<table height="100" align="center" style="margin: auto auto">
					<tr>
						<td>Email Address:</td>
						<td><input type="email" name="email" placeholder="Enter Email Address" required></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="pass" placeholder="Enter ID Number" required></td>
					</tr>
					<tr>
						<td><input type="submit" name="log" value="Login Here"></td>
						<td style="text-align:right;"><a href="signup.php" style="text-decoration: none; font-weight: bold">Sigup Here</a></td>
					</tr>
				</table>
			</form>
			<?php
				if(isset($_POST['log'])){
					include 'includes/config.php';
					
					$uname = $_POST['email'];
					$pass = $_POST['pass'];
					
					$qy = "SELECT * FROM client WHERE email = '$uname' AND id_no = '$pass'";
					$log = $conn->query($qy);
					$num = $log->num_rows;
					$row = $log->fetch_assoc();
					if($num > 0){
						session_start();
						$_SESSION['email'] = $row['email'];
						$_SESSION['pass'] = $row['id_no'];
						echo "<script type = \"text/javascript\">
									alert(\"Login Successful.\");
									window.location = (\"index.php\")
									</script>";
					} else{
						echo "<script type = \"text/javascript\">
									alert(\"Login Failed. Try Again\");
									window.location = (\"account.php\")
									</script>";
					}
				}
			?>
			</div>
		</div>

	</section><!--  end search section  -->
	
</body>
</html>