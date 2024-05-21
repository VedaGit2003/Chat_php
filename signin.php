<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>login Page</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="signin-form">
		<form action="" method="post">
			<div class="form-header">

				
								        <div class="navbar">
            <img src="sources/download-removebg-preview.png" class="logo">
            <ul>
            	<li><a href="index.php">Home</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="signin.php">Sign In</a></li>
                <li><a href="credit.php" target="_blank">Credits</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                
            </ul>
                      </div>

               <style type="text/css">.navbar{background-color: black; width: 100%;}
.navbar ul li{margin-top: 20px;}
           </style>


				<h2>Sign in</h2>
				<p>Login here</p>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" placeholder="Enter your email here" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="pass" placeholder="Enter your password here" autocomplete="off" required>
			</div>
			<div class="small">Forgot password?<a href="forgot_pass.php">Click Here</a></div>
			  </br>
			<div class="form-group">
			<button type="submit" class="btn btn-success" name="sign_in">Sign in</button>
			</div>
			<?php include("signin_user.php"); ?>
		</form>	
		<div class="text-center small">New user? <a href="signup.php">Create Account</a></div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>