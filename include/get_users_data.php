<?php
$con = mysqli_connect("sql310.byetcluster.com","epiz_32921449","5ERvyeyvwUEfZRY","epiz_32921449_mychat");
// $con=mysqli_connect("localhost","root","","mychat");
$user="select * from users";
$run_user=mysqli_query($con,$user);
while ($row_user=mysqli_fetch_array($run_user)) {
	$user_id=$row_user['user_id'];
	$user_name=$row_user['user_name'];
	$user_profile=$row_user['user_profile'];
	$login=$row_user['log_in'];

	echo "
<li>
    <div class='chat-left-img'>
     <img src='$user_profile' height='50px' width='50px'>
    </div>

    <div class='chat-left-detail'>
    <p><a href='home.php?user_name=$user_name'>$user_name</a></p>";
    if ($login=="Online") {
    	echo "<span><i class='fa fa-circle' area-hidden='true'></i>Online</span>";
    }
    else{
    	echo "<span><i class='fa fa-circle-o' area-hidden='true'></i>Offline</span>";
    }
    "
    </div>
</li>
";
    }

?>