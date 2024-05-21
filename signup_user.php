<?php 
include("include/connection.php");
if (isset($_REQUEST['sign_up'])) {
	$name = htmlentities(mysqli_real_escape_string($con,$_REQUEST['user_name']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_REQUEST['user_pass']));
	$email = htmlentities(mysqli_real_escape_string($con,$_REQUEST['user_email']));
	$status = htmlentities(mysqli_real_escape_string($con,$_REQUEST['user_status']));
	$expri = htmlentities(mysqli_real_escape_string($con,$_REQUEST['user_ex']));
	$rand = rand(1, 2); 

	if ($name=='') {
	echo "<script>alert('we cannot verify your name')</script>";
}
    if (strlen($pass)<8) {
    	echo "<script>alert('password should not be less than 8')</script>";
    	exit();
	}
	$check_email="select * from users where user_email='$email'";
	$run_email=mysqli_query($con,$check_email);
	$check=mysqli_num_rows($run_email);
	if ($check==1) {
		echo "<script>alert('email already exist!')</script>";
		echo "<script>window.open('signup.php','_self')</script>";
		exit();
	}
	if($rand == 1){
		$profile_pic = "images/veda1.png";}
		else if ($rand == 2) {
		$profile_pic = "images/veda2.png";
		}
	$insert = "insert into users(user_name,user_pass,user_email,user_status,user_ex,user_profile)
	 values ('$name','$pass','$email','$status','$expri','$profile_pic')";

	 $query = mysqli_query($con,$insert);
	 if ($query) {
	 	echo "<script>alert('congratulation $name, your account is created successfully')</script>";
	 	echo "<script>window.open('signin.php','_self')</script>";
	 }
	 else{
	 	echo "<script>alert('Registration failed!')</script>";
	 	echo "<script>window.open('signup.php','_self')</script>";
	 }
}
?>