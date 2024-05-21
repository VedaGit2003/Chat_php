<?php 
include("connection.php");
function search_user(){
	global $con;

	if (isset($_GET['search_btn'])) {
		$search_query = htmlentities($_GET['search_query']);
		$get_user="select * from users where user_name like '%$search_query%'";
	}
	else{
		$get_user = "select * from users order by user_name DESC LIMIT 5";
	}

	$run_user = mysqli_query($con,$get_user);
	while ($row_user=mysqli_fetch_array($run_user)) {
		$user_name=$row_user['user_name'];
		$user_profile=$row_user['user_profile'];
		$user_status=$row_user['user_status'];
		$user_ex=$row_user['user_ex'];

		// display
		echo "
       <div class='card'>
      <img src='../$user_profile'>
      <h1>$user_name</h1>
      <p class='title'>$user_status</p>
      <p>$user_ex</p>
      <form method='post'>
            <p><button name='add'>Chat with $user_name</button></p>
      </form>
       </div><br><br>
		";
		if (isset($_POST['add'])) {
			echo "<script>window.open('../home.php?user_name=$user_name','_self')</script>";
		}
	}
}

?>