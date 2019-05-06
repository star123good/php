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
	$("#box_exchange_amount").hide();
	$("#box_exchange_account").hide();
	$("#btn_exchange").hide();
	$("#box_important_information").hide();
	$("#box_exchange_to_content").html("<div style='clear:both;'></div><div style='padding-top:50px;padding-bottom:50px;'><center><i class='fa fa-spin fa-spinner fa-3x'></i></center></div>");
	LoadExchangeToList(id);
	$("#eex_gateway_send").val(id);
	$('html, body').animate({
                    scrollTop: $("#box_exchange_to").offset().top
                }, 1000);
}

function LoadExchangeToList(id) {
	var url = $("#url").val();
	var data_url = url + "requests/LoadExchangeToList.php?gateway_id="+id;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#box_exchange_to_content").html(data);
		}
	});
}

function ee_exchange_to(id) {
	$("#to_gateways").find($(".f-category")).removeClass("active_gateway");
	$("#to_gateway_"+id).addClass("active_gateway");
	$("#eex_gateway_receive").val(id);
	$("#box_exchange_amount").show();
	$("#box_exchange_amount_content").html("<div style='clear:both;'></div><div style='padding-top:50px;padding-bottom:50px;'><center><i class='fa fa-spin fa-spinner fa-3x'></i></center></div>");
	LoadAmountFields();
	$("#box_exchange_account").show();
	$("#box_exchange_account_content").html("<div style='clear:both;'></div><div style='padding-top:50px;padding-bottom:50px;'><center><i class='fa fa-spin fa-spinner fa-3x'></i></center></div>");
	LoadAccountFields();
	$("#box_important_information").show();
	$("#box_important_information_content").html("<div style='clear:both;'></div><div style='padding-top:50px;padding-bottom:50px;'><center><i class='fa fa-spin fa-spinner fa-3x'></i></center></div>");
	LoadExchangeInformation();
	$("#btn_exchange").show();
	$('html, body').animate({
                    scrollTop: $("#box_exchange_amount").offset().top
                }, 1000);
}

function LoadAmountFields() {
	var url = $("#url").val();
	var gateway_send = $("#eex_gateway_send").val();
	var gateway_receive = $("#eex_gateway_receive").val();
	var data_url = url + "requests/LoadAmountFields.php?gateway_send="+gateway_send+"&gateway_receive="+gateway_receive;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#box_exchange_amount_content").html(data);
		}
	});
}

function LoadAccountFields() {
	var url = $("#url").val();
	var gateway_send = $("#eex_gateway_send").val();
	var gateway_receive = $("#eex_gateway_receive").val();
	var data_url = url + "requests/LoadAccountFields.php?gateway_send="+gateway_send+"&gateway_receive="+gateway_receive;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#box_exchange_account_content").html(data);
		}
	});
} 

function LoadExchangeInformation() {
	var url = $("#url").val();
	var gateway_send = $("#eex_gateway_send").val();
	var gateway_receive = $("#eex_gateway_receive").val();
	var data_url = url + "requests/LoadExchangeInformation.php?gateway_send="+gateway_send+"&gateway_receive="+gateway_receive;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "html",
		success: function (data) {
			$("#box_important_information_content").html(data);
		}
	});
}

function EasyExCalculator() {
	var currency_from = $("#eex_currency_from").val();
	var currency_to = $("#eex_currency_to").val();
	var rate_from = $("#eex_rate_from").val();
	var rate_to = $("#eex_rate_to").val();
	var sic1 = $("#eex_sic1").val();
	var sic2 = $("#eex_sic2").val();
	var amount_send = $("#eex_amount_send").val();
	if(isNaN(amount_send)) {
		var data = '0';
	} else {
		if(sic1 == "1" && sic2 == "1") {
			if(rate_from < 1) {
				var sum = amount_send / rate_from;
				var data = sum.toFixed(8);
			} else {
				var sum = amount_send * rate_to;
				var data = sum.toFixed(8);
			}
		} else if(sic2 == "1") {
			var sum = amount_send / rate_from;
			var data = sum.toFixed(8);
		} else if(rate_from > 1) {
			var sum = amount_send / rate_from;
			var data = sum.toFixed(2);
		} else {
			var sum = amount_send * rate_to;
			var data = sum.toFixed(2);
		}	
			//var sum = amount_send / rate_from;
			//var data = sum.toFixed(8);
			//var sum = amount_send * rate_to;
			//var data = sum.toFixed(2);
	}
	$("#eex_amount_receive").val(data);
	$("#dam").html(data);
}

function MakeExchange() {
	var url = $("#url").val();
	var data_url = url + "requests/MakeExchange.php";
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#eex_exchanger_form").serialize(),
		dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				DisplayNotification(data.msg,"success");
				DisplayNotification(data.redirecting,"info");
				setTimeout(function(){ window.location.href=data.target_url; }, 3000);
			} else {
				DisplayNotification(data.msg,"danger");
			}
		}
	});
}

function DisplayNotification(message,tt) {
	$.notify({
		message: message
	}, { 
		type: tt,
		placement: {
			from: "top",
			align: "center"
		}
	});
}

function eex_submit_transaction(exchange_id) {
	var url = $("#url").val();
	var data_url = url + "requests/SubmitTransaction.php?exchange_id="+exchange_id;
	$.ajax({
		type: "POST",
		url: data_url,
		data: $("#eex_submit_transaction").serialize(),
		dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				DisplayNotification(data.msg,"success");
				$("#eex_exchange_box").html(data.content);
			} else {
				DisplayNotification(data.msg,"danger");
			}
		}
	});
}

function eex_TrackExchange() {
	var url = $("#url").val();
	var tracking_number = $("#eex_tracking_number").val();
	if(tracking_number == "") {
		DisplayNotification("Please enter exchange id to track it.","danger");
	} else {
		var redirect_track = url + "track/" + tracking_number;
		window.location.href=redirect_track;
	}
}

function eex_checkPayment(exchange_id,gateway_id,gateway,currency,amount,address,source) {
	var url = $("#url").val();
	var data_url = url + "requests/CheckPayment.php?exchange_id="+exchange_id+"&gateway_id="+gateway_id+"&gateway="+gateway+"&currency="+currency+"&amount="+amount+"&address="+address+"&source="+source;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				DisplayNotification(data.msg,"success");
				$("#eex_exchange_box").html(data.content);
			} else {
				DisplayNotification(data.msg,"danger");
			}
		}
	});
}