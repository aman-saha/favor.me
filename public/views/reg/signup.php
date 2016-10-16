<?php 
	include("../../../includes/database_connection.php");
	include("../../../includes/functions.php");
	include("../../../includes/session.php");
?>
<?php
	if(logged_in())
		redirect_to("home.php");
?> 
<?php
	global $error_in_name,$error_in_email,$error_in_password,$error_in_username;
	$salt_string="@!";
	
		$name = mysqli_real_escape_string($connection,(mysql_entities_fix_string($_POST['name'])));
		$email = mysqli_real_escape_string($connection,(mysql_entities_fix_string($_POST['email'])));
		$password = mysqli_real_escape_string($connection,(mysql_entities_fix_string($_POST['password'])));
		$confirm_password = mysqli_real_escape_string($connection,(mysql_entities_fix_string($_POST['confirm_password'])));
		$username = mysqli_real_escape_string($connection,(mysql_entities_fix_string($_POST['username'])));
		$hash_password = password_hashing($password);
		$validation_of_name=valid_name($name);
		$validation_of_email=valid_email($email,$connection);
		$validation_of_username=valid_username($username,$connection);
		$validation_of_password=valid_password($password,$confirm_password);
		
		if($validation_of_name==1 && $validation_of_email==1 && $validation_of_password==1 && $validation_of_username==1)
		{
			$check=1;
		}
		else
		{
			$check=0;
		}

		if ($check==1) 
		{
			$name.=$salt_string;
			$username.=$salt_string;
			$email.=$salt_string;
			$query = "INSERT INTO user_details(name,email,username,password) VALUES('$name','$email','$username','$hash_password')";
			$result = mysqli_query($connection,$query);
			if (!$result)
			{
				echo "Wrong Signup";
			}
			else
			{
				echo "Success Signup";;
			}
		}
		else
			echo "Wrong Signup";

?>