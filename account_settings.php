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
	<title>account</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"

        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/find_people.css">
</head>
<body>
	<div class="row">
		<div class="col-sm-2"></div>
		<?php
          $user=$_SESSION['user_email'];
          $get_user="select * from users where user_email='$user'";
          $run_user=mysqli_query($con,$get_user);
          $row=mysqli_fetch_array($run_user);
          
          $user_name=$row['user_name'];
          $user_pass=$row['user_pass'];
          $user_email=$row['user_email'];
          $user_profile=$row['user_profile'];
          $user_status=$row['user_status'];
          $user_ex=$row['user_ex'];

		?>
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-bordered table-hover">
					<tr align="center">
						<td colspan="6" class="active"><h2>Change Account Settings</h2></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Username</td>
						<td>
							<input type="text" name="u_name" class="form-control" required value="<?php echo $user_name;?>" />
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Profile Picture</td>
						<td><a href="upload.php" class="btn btn-default" style="text-decoration: none; font-size: 15px;"><i class="fa fa-user" area-hidden="true"></i>Profile</a></td>
					</tr>
	                <tr>
				        <td style="font-weight: bold;">Change Your email</td>
						<td>
							<input type="email" name="u_email" class="form-control" required value="<?php echo $user_email;?>" />
						</td>
					</tr>
				    <tr>
				        <td style="font-weight: bold;">Status</td>
						<td>
							<select class="form-control" name="u_status">
								<option><?php echo $user_status; ?></option>
								<option>Student</option>
								<option>Ex-student</option>
								<option>Teacher</option>
							</select>
						</td>
					</tr>
				    <tr>
				        <td style="font-weight: bold;">Change Your Expriences</td>
						<td>
							<input type="text" name="u_ex" class="form-control" required value="<?php echo $user_ex;?>" />
						</td>
					</tr>
					<!-- <tr>
						<td style="font-weight: bold;">Forgotten Password</td> -->
						<!-- <td>
							
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>


<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
                        				<form action="recovery.php?id=<?php echo $user_id;?>"
                        				method="post" id="f">
                        					<strong>Your Girl Friend Name</strong>
                        					<textarea class="form-control" cols="83" rows="4"
                        					name="content" placeholder="Girl Friend"></textarea><br>
                        					<input type="submit" name="sub" class="btn btn-success" value="Submit" style="width: 100px;">
                        					<br><br>
                        					<pre>We ask this question if you forgot yout<br>Password.</pre>
                        					<br><br>
                        				</form>
                     				<?php
                   if (isset($_POST['sub'])) {
                   	$bfn=htmlentities($_POST['content']);
                   	 if ($bfn == '') {
                   	 	echo "<script>alert('Please enter something.')</script>";
                   	 	echo "<script>window.open('account_settings.php','_self')</script>";
                   	 	exit();
                   	 }
                   	 else{
                   	 	$update="update users set forgotten_answer='$bfn' where 
                   	 	user_email='$user'";
                   	 	$run = mysqli_query($con,$update);

                   	 	if ($run) {
                   	 	echo "<script>alert('Working on it.....')</script>";
                   	 	echo "<script>window.open('account_settings.php','_self')</script>";	
                   	 	}
                   	 	else{
                   	 echo "<script>alert('Error.')</script>";
                   	 	echo "<script>window.open('account_settings.php','_self')</script>";
                   	 	}
                   	 }
                   }
                        				?> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
</td> -->
					<!-- </tr> -->
					<tr>
						<td></td>
						<td><a href="change_password.php" class="btn btn-default"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a></td>
					</tr>
					<tr align="center">
						<td colspan="6">
							<input type="submit" name="update" value="update" class="btn btn-info">
						</td>
					</tr>
				</table>
			</form>
			<?php
if (isset($_POST['update'])) {
	$user_name=htmlentities($_POST['u_name']);
	$email=htmlentities($_POST['u_email']);
	$user_status=htmlentities($_POST['u_status']);
	$user_ex=htmlentities($_POST['u_ex']);

	$update="update users set user_name = '$user_name',user_email='$email',
    user_status='$user_status',user_ex='$user_ex' where user_email='$user'";
    $run=mysqli_query($con,$update);

if ($run) {

echo "<script>window.open('account_settings.php','_self')</script>";	
}

}
			?>
		</div>
		<div class="col-sm-2"></div>
	</div>

</body>
</html>
<?php } ?>