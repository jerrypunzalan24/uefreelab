$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	// setInterval(function(){
	// 	$.ajax({
	// 		type :'POST',
	// 		url : '/update/studentsinlab/',
	// 		data:{},
	// 		success:function(html){
		
	// 			$('#onlabtbody').html(html)
	// 		}
	// 	})
	// },2000)
	$('.filterbtn').click(function(){
		var category = '', val = $(this).html(), link = ''
		$('.filterbtn').removeClass('active')
		$(this).addClass('active')
		if($(this).hasClass('day')){
			category = 'day'
			link = '/filter/filterstudent'
		}
		else if($(this).hasClass('lab')){
			category = 'lab'
			link = '/filter/filterlab'
		}
		$.ajax({
			type: 'POST',
			url: link,
			data:{
				category: category,
				value: val
			},
			success: function(html){
				$('#labtbody').html(html)
			}
		})
	})
})