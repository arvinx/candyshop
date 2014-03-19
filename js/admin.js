$(function(){
	$(".delete-btn").click(function() {
		var id = $(this).attr('alt');
		$(this).parent().parent().css('display', 'none');
		var type = $(this).parent().attr('class').split(' ')[0];
		var endpoint = "delete/" + id;
		$.ajax({
	        url: endpoint,
	        type: 'POST',
	        async: false,
	        data: {"type": type}
     	});
		window.location.reload();
	});

	$('#delete-all-btn').click(function() {
		$.get("deleteallcustomers");
		$.ajax({
	        url: "deleteallcustomers",
	        type: 'GET',
	        async: false
     	});
     	window.location.reload();
	});
});

