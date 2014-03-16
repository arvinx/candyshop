$(function(){
	$(".delete-btn").click(function() {
		var id = $(this).attr('alt');
		$(this).parent().parent().css('display', 'none');
		var type = $(this).parent().attr('class').split(' ')[0];
		$.post( "delete/" + id, {"type": type});
	});
});
