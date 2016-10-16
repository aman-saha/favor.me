$(document).ready(function(){
	$("#buzz-submit").click(function(){
	  var post_title = $("#post_title").val();
	  var post_description = $("#post_description").val();
	  var category = $("#category").val();
	  var post_type = $("#post_type").val();
	  var image = $("#imgPrev").attr('src');
	  var error = "";
	  alert(category);
	  if(category == "")
	  	error = "Enter category";
	  if(post_type == "")
	  	error = "Enter post_type";
	  if(post_title == "")
	  	error = "Please enter a title";

	  if(error == ""){

		  $.ajax({
			  type: 'POST',
			  url: 'create_buzz.php',
			  data: {post_title: post_title,post_description: post_description,category: category,post_type: post_type,image: image},
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