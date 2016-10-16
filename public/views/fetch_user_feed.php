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
	$query = "SELECT * FROM books WHERE user_id = $current_user_id ORDER BY favor_id DESC";
	//echo "$query";
	$result = mysqli_query($connection,$query);
	if($result)
	{
		if(mysqli_num_rows($result)>0)
		{
			while($row=mysqli_fetch_assoc($result))
			{
				$favor_id = $row['favor_id'];
				$query_btnstatus = "SELECT * FROM favor_likes WHERE user_id = $current_user_id AND favor_id = $favor_id";
				$result_btnstatus = mysqli_query($connection,$query_btnstatus);
				$likebtn_status = "";
				$like_row = mysqli_fetch_assoc($result_btnstatus);
				if($like_row['status'] == "")
				{
					$likebtn_status = "LIKE";
				}
				else
				{
					$likebtn_status = $like_row['status'];
				}

				$output.="
				<div class = 'favor' id = ".$favor_id."> 
					<table>
				 		<tr>	
				 			<td>".$row['favor']."</td>
				 			<td>posted by</td>
				 			<td>".$current_username."</td>
				 		</tr>
				 		<tr>
				 			<br/>
				 			<br/>
					      	<td><span id = 'likebtnc'><button type='button' id='likebtn' class='btn btn-danger'>".$likebtn_status."</button></span>
					    	<td><span id = 'numlikebtn".$row['favor_id']."'>".$row['likes']."</span>
					    </tr> 
			 		</table>
			 	</div>
		 		";
			}
			echo "$output";
		}
		else
			echo "No data found";
	}
	else
	{
		echo "query failed";
	}
 ?>