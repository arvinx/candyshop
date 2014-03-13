$(function(){
	$("#edit-btn").click(function() {
		if ($("input").is(":disabled")) {
			$("input").attr('disabled', false);
			$("#edit-btn").text("Done");
			$("#edit-btn").css("background-color", "green");
			$(".delete-item").css('display', 'table-cell');
			$("#checkout-btn").attr('disabled', true);
			//$("thead tr").append("<th id='del' width='200'>DEL</th>");
		} else {
			var table_rows = $("tbody").children().each(function(i, r) {
				var row = $(r);
				var quantity = row.find("#quantity-input").val();
				if (quantity.match(/[0-9 -()+]+$/) && quantity > 0) {
					var product_id = row.find(".delete-btn").attr('alt');
					$.get("updateQuantity/" + product_id, {"quantity" : quantity});
				} else {
					alert("Please enter a non-zero positive number quantity");
					row.find("#quantity-input").val(0);
				}
			});
			$("input").attr('disabled', true);
			$("#edit-btn").text("Edit");
			$("#edit-btn").css("background-color", "#008cba");
			$(".delete-item").css('display', 'none');
			$("#checkout-btn").attr('disabled', false);
			//$("#del").remove();
		}
	});
	$(".delete-btn").click(function() {
		var product_id = $(this).attr('alt');
		$(this).parent().parent().css('display', 'none');
		$.get( "removeFromCart/" + product_id);
	});

	// $("#checkout-btn").click(function() {
	// 	var table_rows = $("tbody").children().each(function(i, r) {
	// 		var row = $(r);
	// 		var quantity = row.find("#quantity-input").val();
	// 		if (quantity.match(/[0-9 -()+]+$/) == null || quantity < 0) {
	// 			alert("Please enter a non-zero positive number quantity for your items to continue!");
	// 			row.find("#quantity-input").val(0);
	// 		}
	// 	});
	// });
});

