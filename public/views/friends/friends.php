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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      table,td,tr{
        border: 1px solid black;
      }
    </style>
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
          <label for="email">Search a Friend</label>
          <input type="name" class="form-control" id="search_text">
        </div>
        <button type="button" id="search_user" class="btn btn-default">Search</button>
        <br/>
      </form>

      <div id="friends">
      </div>   
      <div>
      	<a href="../reg/logout.php">LOGOUT</a>
      </div>  
    </div>
     <script>  
        $(document).ready(function(){  
            $('#search_text').keyup(function(){  
                 var txt = $("#search_text").val();  
                 if(txt != '')  
                 {  
                      $.ajax({  
                           url:"fetch_users.php",  
                           method:"post",  
                           data:{search:txt},  
                           dataType:"text",  
                           success:function(data) 
                           {  
                                $('#friends').html(data);  
                           }  
                      });  
                 }  
                 else  
                 {  
                      $('#result').html('');                 
                 }  
            });  
        });  
        $(document).on('click', 'button', function(){ 
          var btn_id = $(this).attr('id');
          var data = $(this).html();
          if(data == 'ADD FRIEND')
          {
            $(this).html('CANCEL REQUEST');
            var user_req_id = btn_id.slice(6,btn_id.length);
            alert(user_req_id);
            $.ajax({  
               url:"add_friend.php",  
               method:"POST",  
               data:{add_friend_id : user_req_id},  
               dataType:"text",  
               success:function(data) 
               {  
                  window.alert(data);  
              }  
            });  
          }
          else if(data == 'CANCEL REQUEST')
          {
            $(this).html('ADD FRIEND');
            var user_req_id = btn_id.slice(6,btn_id.length);
            alert(user_req_id);
            $.ajax({  
               url:"cancel_request.php",  
               method:"POST",  
               data:{un_friend_id : user_req_id},  
               dataType:"text",  
               success:function(data) 
               {  
                  window.alert(data);  
              }  
            });
          }
          
        });
      </script>  

