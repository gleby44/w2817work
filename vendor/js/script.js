'use strict'
$(function(){
	var i=0;
	$('a.menu').bind({
	
	'mouseover':function(){
		if($('#title').length!=0){
			$('#title').remove();
		}
		i++;
		var body=$(this).attr('data-body');
		var color=$(this).attr('data-color');
		if(i==1){
		$('<div id="title">'+body+'</div>').appendTo('body');
		setTimeout(function(){
			$('#title').remove();
			i=0;
		},1500);
		}
	},
	'click':function(){
		event.preventDefault();
		var data=$(this).attr('href');
		if($('.modal-window').length==0){
		$('<div>').addClass('m-window').appendTo('body');
		$('<div>').addClass('modal-window').appendTo('body').css('display','none').show(100);
		var url=$(this).attr('href');
		var get=url.split('?');
		var id=get[1].split('=');
		var url=id[1];
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data:'url='+url,
			
			success: function (data) {
				$('.modal-window').append(data);	
				var str=data[0];
			},
			
			error: function(msg) {
				$('.modal-window').append(msg);	
			}
			
		})
		$('.m-window').click(function(){
			$(this).remove();
			$('.modal-window').remove();
			
		});
		$('<a>').attr('href','#').addClass('btn btn-danger close').html('&times;').click(function(){
			event.preventDefault();
			$('.modal-window').hide(100);
			setTimeout(function(){
				$('.modal-window').remove();
			},100)
			
			$('.m-window').remove();
		}).appendTo('.modal-window');
		
		}else{
			$('.modal-window');
		}
		
	}
	});
});