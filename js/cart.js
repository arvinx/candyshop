$(function(){
	$("#edit-btn").click(function() {
		if ($("input").is(":disabled")) {
			$("input").attr('disabled', false);
			$("#edit-btn").text("Done");
			$("#edit-btn").css("background-color", "green");
			$(".delete-item").css('display', 'table-cell');
			$("#checkout-btn").attr('disabled', true);
		} else {
			var total = 0;
			var table_rows = $("tbody").children().each(function(i, r) {
				var row = $(r);
				var quantity = row.find(".quantity-input").val();
				if (quantity.match(/[0-9 -()+]+$/) && quantity > 0) {
					var product_id = row.find(".delete-btn").attr('alt');
					updateCartRequest(product_id, quantity);
					total += Number(quantity)*Number(row.find(".product-price").html().split("$")[1]);
				} else {
					row.find(".quantity-input").val(1);
				}
			});
			$("#order-total").html("Order Total: $" + total.toFixed(2));
			$("input").attr('disabled', true);
			$("#edit-btn").text("Edit");
			$("#edit-btn").css("background-color", "#008cba");
			$(".delete-item").css('display', 'none');
			$("#checkout-btn").attr('disabled', false);
		}
	});
	
	function updateCartRequest( product_id, quantity) {
		var endpoint = "updateQuantity";
		$.ajax({
	        url: endpoint,
	        type: 'POST',
	        async: false,
	        data: {"quantity": quantity, "product_id": product_id}
     	});
	}
	
	$(".delete-btn").click(function() {
		var product_id = $(this).attr('alt');
		$(this).parent().parent().css('display', 'none');
		$.get( "removeFromCart/" + product_id);
	});
});

