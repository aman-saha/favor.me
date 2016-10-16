<?php 
include("../../../includes/database_connection.php");
include("../../../includes/session.php");
include("../../../includes/functions.php");
?>
<?php
	$current_user_id = $_POST['current_user_id'];
	$output = "";
	$salt_string = "@!";
	$add_friend_id = $_POST['add_friend_id'];
	$query = " DELETE * FROM friends WHERE user_id = $current_user_id AND friend_id = $add_friend_id"; 
	//echo "$query";
	$result = mysqli_query($connection, $query);  

	$query = " DELETE * FROM friends WHERE user_id = $add_friend_id AND friend_id = $current_user_id"; 
	//echo "$query";
	$result = mysqli_query($connection, $query);  
	 if($result)  
	 {
	 	echo("Unfriended");
	 }
 ?>  