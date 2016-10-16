<?php
include("../../../includes/database_connection.php");
include("../../../includes/functions.php");
include("../../../includes/session.php");
?>
<?php
	$salt_string = "@!";
	$output = "";
	$search_data = $_POST['search'];
	$query = "SELECT * FROM user_details WHERE username LIKE '%".$search_data."%'";
	//echo "$query";
	$result = mysqli_query($connection, $query);  
	 if(mysqli_num_rows($result) > 0)  
	 {  
	      $output .= '<h4 align="center">Search Result</h4>';  
	      $output .= '<div class="table-responsive">  
	                  	<table class="table table bordered">  
	                        <tr>  
	                            <th>User Names</th>
	                        </tr>';  
	      while($row = mysqli_fetch_array($result))  
	      {  
	           $output .= '  
	                <tr>  
	                    <td>'.chop($row['username'],$salt_string).'</td>  
	                </tr> 
	           ';  
	      }  
      echo $output;   
	 }  
	 else  
	 {  
	      echo 'Data Not Found';  
	 }  
 ?>  