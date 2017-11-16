$(function(){
	$('#google_click').bind('click',function(){
		console.log(1);
		$.ajax({
				url:'ajax_google.php',
				type:'POST',
				beforesend:function(){
					$('#empty').html('text');
				},
				success :function(data){
					$('#empty').html(data);
				},
				error:function(msg){
					$('#empty').html(msg);
				}
		});
	});
});