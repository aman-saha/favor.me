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
	$search_data = $_POST['search'];
	$query = " SELECT * FROM user_details WHERE username LIKE '%".$search_data."%' AND NOT user_id = $current_user_id";
	//echo "$query";
	$result = mysqli_query($connection, $query);  
	 if(mysqli_num_rows($result) > 0)  
	 {  
	      $output .= '<h4 align="center">Search Result</h4>';
	      $output .= '<br/>';  
	      $output .= '<div class="table-responsive">  
	                          <table class="table table bordered">  
	                               <tr>  
	                                    <th>User Names</th>
	                               </tr>';  
	      while($row = mysqli_fetch_array($result))  
	      {  
	       		$friend_id = $row['user_id'];
	       		$query_if_friend_1 = "SELECT * FROM friends WHERE user_id = $current_user_id AND friend_id = $friend_id";
				$result_1 = mysqli_query($connection,$query_if_friend_1);
				/*$query_if_friend_2 = "SELECT * FROM friends WHERE user_id = $friend_id AND friend_id = $current_user_id";
				$result_2 = mysqli_query($connection,$query_if_friend_2);*/

				if($result_1 || $result_2)
				{
					$row_friend = mysqli_fetch_assoc($result_1);
					if($row_friend['status'] == 1)
					{
						$friend_status = "CANCEL REQUEST";
					}
					else if($row_friend['status'] == 2)
					{
						$friend_status = "ALREADY FRIENDS";
					}
					else if($row_friend['status'] == 0)
					{
						$friend_status = "ADD FRIEND";
					}
				}
				else
				{
					$friend_status = "ADD FRIEND";
				}    
				
	           $output .= " 
	                <tr>  
	                     <td>".chop($row['username'],$salt_string)."</td>
	                     <td><span id = 'addbtn'><button type='button' id='addbtn".$row['user_id']."' class='btn btn-danger'>".$friend_status."</button></span>  
	                </tr>  
	           ";  
	      }  
      echo $output;   
	 }  
	 else  
	 {  
	      echo 'Data Not Found';  
	 }  
 ?>  s