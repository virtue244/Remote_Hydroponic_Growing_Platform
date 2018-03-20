jQuery(document).ready(function(){

//Method1
$("#testForm").submit(function(e){
	
	e.preventDefault();
	
	var inputs = $(this).serialize();
	
	$.post("insert.php", inputs, function(){
		$('.content').load('post.php');
		$('#testForm').get(0).reset();
		});
	});
	
//METHOD2
/*$("#testSubmit").click(function(e){
	
	e.preventDefault();
	
	var inputs = $('#testForm').serialize();
	$.ajax({
		type: "POST",
		url: "insert.php",
		data: inputs,
		success: function(){
		$('.content').load('post.php');
		$('#testForm').get(0).reset();
		}
		});
	});*/
});