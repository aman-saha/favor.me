/**
 * This handler is responsible for submitting the buzz using the standard jquery ajax interface
 */
$(document).ready(function(){
	$("#buzz-submit").click(function(){
		var post_title = $("#post_title").val();
		var post_description = $("#post_description").val();
		var category = $("#category").val();
		var post_type = $("#post_type").val();
		var image = $("#imgPrev").attr('src');
		var error = "";
		if(category === "")
		error = "Enter category";
		if(post_type === "")
		error = "Enter post_type";
		if(post_title === "")
		error = "Please enter a title";
		
		if(error === ""){
			$.ajax({
				type: 'POST',
				url: 'create_buzz.php',
				data: {post_title,post_description,category,post_type,image},
				success: function(data){
					alert(data);
					$(data).insertAfter("#add_buzz");
				}
			});
			$("#close-buzz-btn")[0].click();
		}
		else{
			alert(error);
		}
	});
	
	$(document).keyup(function(){  
		$('#search_text').keyup(function(){  
			var txt = $(this).val(); 
			if(txt !== '')  {  
				$.ajax({  
					url:"fetch.php",  
					method:"POST",  
					data:{search:txt},  
					dataType:"text",  
					success:function(data) {
						$('#search_result').html(data);  
					}  
				});  
			}  
			else if($(this).val() === ''){
				$('#search_result').html('');
			}
		});  
	});  
});	