<!DOCTYPE html>
<?php 
session_start();
include("find_friends_function.php");
if (!isset($_SESSION['user_email'])) {
	header("location: signin.php");
}
else {
?>
<html>
<head>
	<meta charset="utf-8">
	<title>friends</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"

        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/find_people.css">

</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark" href="#">
		<a href="" class="navbar-brand">
			<?php 
       $user = $_SESSION['user_email'];
       $get_user="select * from users where user_email='$user'";
       $run_user=mysqli_query($con,$get_user);
       $row=mysqli_fetch_array($run_user);

       $user_name=$row['user_name'];
       echo "<a class='navbar-brand' href='../home.php?user_name=$user_name'>Chat</a>";
			 ?>
		</a>
		<ul class="navbar-nav">
			<li><a style="color:white;text-decoration: none;font-size: 20px;" href="../account_settings.php">Setting</a></li>
		</ul>
	</nav>
<br>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<form class="search_form" action="">
			<input type="text" name="search_query" placeholder="search friends" autocomplete="off" required>
			<button class="btn" type="submit" name="search_btn">Search</button>
		</form>
	</div>
	<div class="col-sm-4"></div>
</div><br><br>
<?php search_user();?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>