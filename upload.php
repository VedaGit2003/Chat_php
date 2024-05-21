<!DOCTYPE html>
<?php 
session_start();
include("include/connection.php");
include("include/header.php");

if (!isset($_SESSION['user_email'])) {
	header("location: signin.php");
}
else {
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"

        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/find_people.css">
</head>
<body>
	<?php
	
          $user=$_SESSION['user_email'];
          $get_user="select * from users where user_email='$user'";
          $run_user=mysqli_query($con,$get_user);
          $row=mysqli_fetch_array($run_user);
          
          $user_name=$row['user_name'];

          $user_profile=$row['user_profile'];
		echo "
       <div class='card'>
      <img src='$user_profile'>
      <h1>$user_name</h1>

      <form method='post' enctype='multipart/form-data'>
          <label id='update_profile'><i class='fa fa-circle-o' aria-hidde='true'></i>
          Select Profile Picture
           <input type='file' name='u_image' size='60'>
          </label>
          <button id='button_profile' name='update'>&nbsp&nbsp&nbsp<i class='fa fa-heart'
          aria-hidden='true'></i>Update Profile</button>
      </form>
       </div><br><br>
		";
if (isset($_POST['update'])) {
	$u_image=$_FILES['u_image']['name'];
	$image_tmp=$_FILES['u_image']['tmp_name'];
	$random_number=rand(1,100);

	if ($u_image='') {
echo "<script>alert('please select profile')</script>";
echo "<script>window.open('upload.php','_self')</script>";
exit();
	}
	else{
		move_uploaded_file($image_tmp, "images/$u_image.$random_number");
		$update="update users set user_profile='images/$u_image.$random_number' where 
		user_email='$user'";
		$run=mysqli_query($con,$update);
		if ($run) {
		echo "<script>alert('profile pic updated')</script>";
echo "<script>window.open('upload.php','_self')</script>";
		}
	}
}

	
	?>
</body>
</html>
<?php } ?>