$(function() {
	$(".cta-button").click(function() {
		var id = $(this).find("#add-cart-btn").val();
		//http://localhost:8888/candyshop/index.php/candystore/addToCart/5

		//http://localhost:8888/candyshop/index.php/candystore/index.php/candystore/addToCart/6
		$.getJSON("/candyshop/index.php/candystore/addToCart/" + id,  function(response, status, jqXHR){
           if (jqXHR.responseJSON['logged_on'] == 'false') {
           		window.location.replace("/candyshop/index.php/candystore/login");
           }
        });
		$("#view-cart").fadeOut("fast");
		$("#view-cart").children().css("background-color", "OrangeRed ");
		$("#view-cart").fadeIn("fast");
	});
});