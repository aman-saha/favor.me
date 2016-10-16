$(".info-item .btn").click(function(){
  $(".container").toggleClass("log-in");
});
$(document).ready(function(){
	$(".container-form .btn").click(function(){
	  var btnval = $(this).html();
	  var status = "";
	  
	  if(btnval=="Log in")
	  {
		var username = $("#username_login").val();
		var password = $("#password_login").val();
		$.ajax({
		  type: 'POST',
		  url: 'login.php',
		  data: {username:username,password:password},
		  success: function(data){
		  	checkStatus(data);
		  },
		  async:false
		});
	  }
	  else if(btnval=="Sign up")
	  {
	  	var username = $("#username").val();
	    var password = $("#password").val();
	    var confirm_password = $("#confirm_password").val();
	    var email = $("#email").val();
	    var name = $("#name").val();
	    

	    $.ajax({
		  type: 'POST',
		  url: 'signup.php',
		  data: {name:name,email:email,username:username,password:password,confirm_password:confirm_password},
		  success: function(data){
		  	//window.alert('signup'+data);
		  	checkStatus(data);
		  },
		  async:false
		});
	  }
	});
});	


function checkStatus(status)
{
	window.alert(status);
	var data = $.trim(status);
	if(data=="Wrong Login"){
		$("#err_msg_login").html(data);
	}
	else if(data=="Success Login")
	{
		$(location).attr('href', 'home.php');
	}
	else if(data=="Success Signup")
	{
		$(location).attr('href', 'home.php');
	}
	else if(data=="Wrong Signup")
	{
		$("#err_msg_signup").html(data);
	}
}