<?php
	include("../../../includes/functions.php");
	session_start();
	destroySession();
	redirect_to("index.php");
?>