$(document).ready(function(){
	$("#buzz-submit").click(function(){
	  var post_title = $("#post_title").val();
	  var post_description = $("#post_description").val();
	  var start_date = $("#start_date").val();
	  var end_date = $("#end_date").val();
	  var start_time = $("#start_time").val();
	  var end_time = $("#end_time").val();
	  var image = $("#imgPrev").attr('src');
	  var error = "";
	  //alert(image);
	  if(end_time == "")
	  	error = "Enter end_time";
	  if(start_time == "")
	  	error = "Enter start_time";
	  if(end_date == "")
	  	error = "Enter end_time";
	  if(start_date == "")
	  	error = "Enter start_time";
	  if(post_title == "")
	  	error = "Please enter a title";

	  if(error == ""){

		  $.ajax({
			  type: 'POST',
			  url: 'create_buzz.php',
			  data: {post_title: post_title,post_description: post_description,start_date: start_date,end_date: end_date,start_time: start_time,end_time: end_time,image: image},
			  success: function(data){
			  	alert(data);
			  	$(data).insertAfter("#add_buzz");
			  }
			});
		  $("#close-buzz-btn")[0].click();
		  //$(location).attr('href', 'index.php');
		}
		else
		{
			alert(error);
		}
	});
});	