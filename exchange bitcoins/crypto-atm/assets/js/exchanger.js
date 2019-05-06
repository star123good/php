$(document).ready(function() {
	$("#btn_exchange").hover(
	  function() {
		$("#btn_exchange_i").addClass("fa-spin");
	  }, function() {
		$("#btn_exchange_i").removeClass("fa-spin");
	  }
	);
});

function ee_exchange_from(id) {
	$("#box_feedbacks").remove();
	$("#box_reserve").remove();
	$("#from_gateways").find($(".f-category")).removeClass("active_gateway");
	$("#from_gateway_"+id).addClass("active_gateway");
	$("#box_exchange_to").show();
	$('html, body').animate({
                    scrollTop: $("#box_exchange_to").offset().top
                }, 1000);
}

function ee_exchange_to(id) {
	$("#to_gateways").find($(".f-category")).removeClass("active_gateway");
	$("#to_gateway_"+id).addClass("active_gateway");
	$("#box_exchange_amount").show();
	$("#box_exchange_account").show();
	$("#box_important_information").show();
	$("#btn_exchange").show();
	$('html, body').animate({
                    scrollTop: $("#box_exchange_amount").offset().top
                }, 1000);
}