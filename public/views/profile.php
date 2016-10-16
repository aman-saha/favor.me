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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Tag-me-Not</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="profile.php">My profile</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-cog"></span>&nbsp;Settings</a>
              <ul class="dropdown-menu">
                <li><a href="profile_settings.php">Profile Settings</a></li>
                <li><a href="account_settings.php">Account Settings</a></li>
              </ul>
            </li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <form>
        <div class="form-group">
          <label for="email">Upload Image</label>
          <input type="file" class="form-control" id="image">
        </div>
        <button type="button" id="pupload" class="btn btn-default">Refresh</button>
        <br/>
      </form>

      <div id="user_posts"></div>   
      <div>
      	<a href="logout.php">LOGOUT</a>
      </div>  
    </div>
    <script type="text/javascript">      
     $(document).ready(function(){
        $("#user_posts").load("fetch_user_feed.php");
      });

      $(document).ready(function(){
        $("#pupload").click(function(){
            $("#user_posts").load("fetch_user_feed.php");
        });
      });

      $(document).on('click', '.favor', function(){
        var like_id = $(this).attr('id');
        window.alert(like_id);
        
        var data = $(this).find('#likebtn').html();
        window.alert(data);
        var fav_id = like_id;
        if(data == 'LIKE')
        {
          $(this).find('#likebtn').html('UNLIKE');
        }
        else if(data == 'UNLIKE')
        {
          $(this).find('#likebtn').html('LIKE');
        }
        if(data == 'LIKE' || data== 'UNLIKE'){
          $.post("post_like.php", {like_id: like_id,status: data} , function(data)
          {
            window.alert(data);
          });
        }

        $.post("refresh_post.php", {pid: fav_id} , function(data)
          {
            window.alert(data);
            $("#"+like_id).html(data);
          });
      });
    </script>
  </body>  
</html>