  <?php 
  include("../../../includes/database_connection.php");
  include("../../../includes/functions.php");
  include("../../../includes/session.php");
  ?>
  <?php
  if(logged_in())
    redirect_to("home.php");
  ?> 
  <!DOCTYPE html> 
  <html > 
    <head> 
      <meta charset="UTF-8"> 
      <title>Log in / Sign up</title> 
      <link rel="stylesheet" href="css/style.css"> 
    </head>
    <style>
    body{
      margin: 0;
    }

    ul.topnav {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #3F51B5;
    }

    ul.topnav li {
      float: right;
    }

    ul.topnav li a {
      display: block;
      color: white;
      margin: 0;
      text-align: center;
      padding: 20px 26px;
      text-decoration: none;
    }

    ul.topnav li a:hover:not(.active){
      background-color: #FF80AB;
    }

    ul.topnav li a.active{
      background-color: #FF4081;
    }

    ul.topnav li.right{
      float: left;
      margin: 0;
      padding: 0;
    }
    #err_msg_login{
      color: red;
      margin-top: 15px;
      text-align: center;
      font-size: 20px;
      text-decoration: underline;
    }
    #err_msg_signup{
      color: red;
      margin-top: 15px;
      text-align: center;
      font-size: 20px;
      text-decoration: underline;
    }
    </style>
    <body>
      <ul class="topnav">
        <li class="right">
          <a href="#">Tag</a>
        </li>
        <li>
         <a class="active" href="#home">Home</a>
       </li>
       <li>
        <a href="#news">
          News
        </a>
      </li>
      <li>
        <a href="#contact">Contact</a>
      </li>
    </ul>

    <div class="container"> 
      <div class="box">
      </div> 
      <div class="container-forms"> 
        <div class="container-info"> 
          <div class="info-item"> 
            <div class="table"> 
              <div class="table-cell"> 
                <p> Have an account? </p> 
                <div class="btn"> Log in 
                </div> 
              </div> 
            </div> 
          </div> 
          <div class="info-item"> 
            <div class="table"> 
              <div class="table-cell"> 
                <p> Don't have an account? </p> 
                <div class="btn"> Sign up </div> 
              </div> 
            </div> 
          </div> 
        </div>
        <form method = "POST" name = "login_form"> 
          <div class="container-form"> 
            <div class="form-item log-in"> 
              <div class="table"> 
                <div class="table-cell"> 
                  <input id="username_login" placeholder="Username"  type="text" required/>
                  <input id="password_login" placeholder="Password" type="Password"  required/> 
                  <div class="btn">Log in</div> 
                  <div id = "err_msg_login"></div>
                </div> 
              </div> 
            </div>
          </form>
          <form method = "POST" name = "signup_form"> 
            <div class="form-item sign-up"> 
              <div class="table"> 
                <div class="table-cell"> 
                  <input id="email" placeholder="Email" type="email" required/>
                  <input id="name" placeholder="Full Name" type="text" pattern="[a-zA-Z]+" required/>
                  <input id="username" placeholder="Username" type="text" required/>
                  <input id="password" placeholder="Create Password" type="Password" required/>
                  <input id="confirm_password" placeholder="Confirm Password" type="Password" required/>
                  <div id="PasswordMatch"></div>  
                  <div class="btn">Sign up</div>
                  <div id = "err_msg_signup"></div> 
                </div> 
              </div> 
            </div>
          </form> 
        </div> 
      </div> 
    </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <script type="text/javascript">
    $(function() {
      $("#confirm_password").keyup(function() {
        var password = $("#password").val();
        $("#PasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
      });
    });
    </script>
  </body> 
</html>