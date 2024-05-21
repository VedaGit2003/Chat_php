<!DOCTYPE html>
<?php 
session_start();
include("include/connection.php");
if (!isset($_SESSION['user_email'])) {
	header("location: signin.php");
}
else {
?>
<html>
<head>
	<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <meta http-equiv="refresh" content="10">
	<title>Chat here</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"

        crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/home.css">

</head>
<body>
	<!-- ......... -->				        <div class="navbar1">
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

               <style type="text/css">.navbar1{background-color: black; width: 100%; 
               	height: 2%;margin-bottom: 4px;}
.navbar1 ul li{margin-top: 10px; display: inline-block; margin: 10px;}
           </style>
           <!-- ................. -->
	<div class="container main-section">
		<div class="row">
			<div class="col-md-3 col-xs-12 left-sidebar">
				<div class="input-group searchbox">
					<div class="input-group-btn">
						<center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add Friend</button></a></center>
					</div>
				</div>
				<div class="left-chat">
					<ul>
						<?php include("include/get_users_data.php");?>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
				<div class="row">
					<!-- info of user -->
					<?php 
                        $user = $_SESSION['user_email'];
                        $get_user = "select * from users where user_email='$user'";
                        $run_user=mysqli_query($con,$get_user);
                        $row=mysqli_fetch_array($run_user);
                       $user_id=$row['user_id'];
                       $user_name=$row['user_name'];
					 ?>


					 <?php
                       if (isset($_GET['user_name'])) {
                       	global $con;
                       	$get_username=$_GET['user_name'];
                       	$get_user = "select * from users where user_name='$get_username'";
                       	$run_user=mysqli_query($con,$get_user);
                       	$row_user=mysqli_fetch_array($run_user);
                       	$username=$row_user['user_name'];
                       	 $user_profile_image=$row_user['user_profile'];
                       }
                       $total_messages="select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                       $run_messages = mysqli_query($con,$total_messages);
                       $total=mysqli_num_rows($run_messages);
					 ?>
					 <div class="col-md-12 right-header">
                        <div class="right-header-img">
                        	<img src="<?php echo"$user_profile_image";?>" height="50px" width="50px">
                        </div>
                        <div class="right-header-detail">
                        	<form method="post">
                        		<p><?php echo "$username";?></p>
                        		<span><?php echo $total;?>messages</span>&nbsp 
                        		<button name="logout" class="btn btn-danger">Logout</button>
                        	</form>
                        	<?php 
                                if (isset($_POST['logout'])) {
                                	$update_msg=mysqli_query($con,"UPDATE users SET log_in='offline' WHERE user_name='$user_name'");
                                	header("location: logout.php");
                                	exit();
                                }
                        	 ?>
                        </div> 	
					 </div>
				</div>
				<div class="row">
					<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
		<?php 
              $update_msg=mysqli_query($con,"UPDATE users_chat SET msg_status='read' WHERE sender_username='$username' AND receiver_username='$user_name'");
              $sel_msg="select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER by 1 ASC";
              $run_msg=mysqli_query($con,$sel_msg);
              while ($row=mysqli_fetch_array($run_msg)) {
              	$sender_username=$row['sender_username'];
              	$receiver_username=$row['receiver_username'];
              	$msg_content=$row['msg_content'];
              	$msg_date=$row['msg_date'];
              
		 ?>				
  <ul>
  	<?php
if ($user_name==$sender_username AND $username==$receiver_username) {
	echo "
<li>
<div class='rightside-right-chat'>
<span>$username <small>$msg_date</small></span>
<p>$msg_content</p>
</div>
</li>";
}
else if ($user_name==$receiver_username AND $username==$sender_username) {
	echo "
<li>
<div class='rightside-left-chat'>
<span>$username <small>$msg_date</small></span>
<p>$msg_content</p>
</div>
</li>";		
}

  	?>
  </ul><?php } ?>
					</div>
				</div>
<div class="row">
	<div class="col-md-12 right-chat-textbox">
		<form method="post">
			<input type="text" name="msg_content" placeholder="type here...">
			<button class="btn btn-success" name="submit">Send</button>
		</form>
	</div>
</div>				
			</div>
		</div>
	</div>
<?php 
if (isset($_POST['submit'])) {
	$msg = htmlentities($_POST['msg_content']);
	if ($msg == "") {
        echo "
        <div class='alert alert-danger'>
        <strong><center>Message was unable to send..</center></strong>
        </div>
        ";
	}
	else if (strlen($msg)>200) {
        echo "
        <div class='alert alert-danger'>
        <strong><center>Message is too long.Use less than 200 characters</center></strong>
        </div>
        ";
	}
	else{
		$insert="insert into users_chat 
		(sender_username,receiver_username,msg_content,msg_status,msg_date)
                values('$user_name', '$username','$msg','unread',NOW())";
                $run_insert=mysqli_query($con,$insert);
	}
}
 ?>	

 <script>
 	$('#scrolling_to_bottom').animate({
 		scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
 </script>
 <script type="text/javascript">
 	$(document).ready(function(){
var height=$(window).height();
$('.left-chat').css('height',(height - 92)+'px');
$('.right-header-contentChat').css('height', (height - 163) + 'px');
 	});
 </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>