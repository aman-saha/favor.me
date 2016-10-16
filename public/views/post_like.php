<?php 
  include("../../includes/database_connection.php");
  include("../../includes/session.php");
  include("../../includes/functions.php");
?>
<?php
    if(logged_in())
    {
      $current_username= $_SESSION['current_username'];
      $current_name=$_SESSION['current_name'];
      $current_user_id=$_SESSION['current_user_id'];
    }
  else
    redirect_to("login.php");
?>
<?php

	$output="";
	$btn_status = $_POST['status'];
	$post_id = $_POST['like_id'];
	$query = "SELECT * FROM books WHERE favor_id = $post_id";
	
	//echo "$query";
	$result = mysqli_query($connection,$query);
	if($result)
	{
		$row = mysqli_fetch_assoc($result);
		if($btn_status == 'LIKE')
		{
			$numlikes = $row['likes']+1;
			$query_updt = "UPDATE books SET likes=$numlikes WHERE favor_id = $post_id";
			$result_updt = mysqli_query($connection,$query_updt);

			$query_inslike = "INSERT INTO favor_likes(user_id,favor_id,status) VALUES('$current_user_id','$post_id','UNLIKE')";
			$result_inslike = mysqli_query($connection,$query_inslike);
		}
		else if($btn_status == 'UNLIKE')
		{
			$numlikes = $row['likes']-1;
			$query_updt = "UPDATE books SET likes=$numlikes WHERE favor_id = $post_id";
			$result_updt = mysqli_query($connection,$query_updt);
			$query_inslike = "DELETE FROM favor_likes WHERE user_id = $current_user_id AND favor_id = $post_id";
			$result_inslike = mysqli_query($connection,$query_inslike);
		}
		echo "Success";
	}
	else
		echo "Fail";
 ?>