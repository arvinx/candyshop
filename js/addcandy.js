$(function() {
	$(".cta-button").click(function() {
		var id = $(this).find("#add-cart-btn").val();
		//http://localhost:8888/candyshop/index.php/candystore/addToCart/5

		//http://localhost:8888/candyshop/index.php/candystore/index.php/candystore/addToCart/6
		$.get("/candyshop/index.php/candystore/addToCart/" + id);
		$("#view-cart").fadeOut("fast");
		$("#view-cart").children().css("background-color", "OrangeRed ");
		$("#view-cart").fadeIn("fast");
	});
});