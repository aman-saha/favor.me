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
	$add_friend_id = $_POST['add_friend_id'];
	$query_if_friend_1 = "SELECT * FROM friends WHERE user_id = $current_user_id AND friend_id = $add_friend_id LIMIT 1";
	$result_1 = mysqli_query($connection,$query_if_friend_1);
	$query_if_friend_2 = "SELECT * FROM friends WHERE user_id = $add_friend_id AND friend_id = $current_user_id";
	$result_2 = mysqli_query($connection,$query_if_friend_2);
	if($result_1 || $result2)
	{
		if(mysql_num_rows($result_1)>0)
		{
			$row = mysqli_fetch_assoc($result_1);
			if($row['status'] == 0)
			{
				echo "ADD FRIEND";
			}
			else if($row['status'] == 1)
			{
				echo "REQUEST SENT";
			}
			else if($row['status'] == 2)
			{
				echo "ALREADY FRIENDS";
			}
		}
		else
		{
			$query = "INSERT INTO friends(user_id, friend_id, status) VALUES ($current_user_id,$add_friend_id,1)";
			//echo "$query";
			$result = mysqli_query($connection, $query);  
	 		if($result)  
	 		{
	 			echo "Friend added";
	 		}
	 }
	}
 ?>  