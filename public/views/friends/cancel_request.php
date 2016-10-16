<?php 
include("../../../includes/database_connection.php");
include("../../../includes/session.php");
include("../../../includes/functions.php");
?>
<?php
    if(logged_in())
    {
      $current_username= $_SESSION['current_username'];
      $current_name=$_SESSION['current_name'];
      $current_user_id=$_SESSION['current_user_id'];
    }
  else
    redirect_to("../reg/index.php");
?>
<?php
	$output = "";
	$salt_string = "@!";
	$un_friend_id = $_POST['un_friend_id'];
	$query = "DELETE FROM friends WHERE user_id = $current_user_id AND friend_id = $un_friend_id"; 
	$result = mysqli_query($connection, $query);  

	$query = "DELETE FROM friends WHERE user_id = $un_friend_id AND friend_id = $current_user_id"; 
	//echo "$query";
	$result = mysqli_query($connection, $query);
	//echo "$query";

	if($result)  
	{
	 	echo "Unfriended";
	}
 ?>  