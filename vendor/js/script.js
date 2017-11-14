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
		$('<div>').addClass('modal-window').appendTo('body').css('display','none').show(500);
		$('.m-window').click(function(){
			$(this).remove();
			$('.modal-window').remove();
			
		});
		$('<a>').attr('href','#').addClass('btn btn-danger close').html('&times;').click(function(){
			event.preventDefault();
			$('.modal-window').hide(500);
			setTimeout(function(){
				$('.modal-window').remove();
			},500)
			
			$('.m-window').remove();
		}).appendTo('.modal-window');
		
		}else{
			$('.modal-window');
		}
		
	}
	});
});