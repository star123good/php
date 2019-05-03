function EEXAdmin_CreateModal(module,id) {
	var data_url = "requests/EEXAdmin_CreateModal.php?module="+module+"&id="+id;
	$.ajax({
		type: "GET",
		url: data_url,
		dataType: "json",
		success: function (data) {
			if(data.status == "success") {
				$("#EEXAdmin_Content").html(data.msg);
				$("#"+module+"_"+id+"_modal").modal("show");
			} else {
				alert(data.msg);
			}
		}
	});
}

function EEXAdmin_UpdateCompleted(id,type) {
	if(type == "1") {
		var data_url = "requests/EEXAdmin_Update.php?module=UpdateCompleted&id="+id;
		$.ajax({
			type: "GET",
			url: data_url,
			dataType: "html",
			success: function (data) {
				$("#explore_"+id+"_modal_content").html(data);
			}
		});	
	} else if(type == "2") {
		var txn_id = $("#txn_id").val();
		var data_url = "requests/EEXAdmin_Update.php?module=UpdateCompletedConfirmed&id="+id+"&txn_id="+txn_id;
		if(txn_id == "") {
			$("#txn_id_formgroup").addClass("has-warning");
			$("#txn_id").addClass("is-invalid");
		} else {
			$.ajax({
				type: "GET",
				url: data_url,
				dataType: "html",
				success: function (data) {
					$("#explore_"+id+"_modal_content").html(data);
					$("#pending_exchange_"+id).fadeOut(300, function(){ $(this).remove();});
					var nums = $("#pending_exchanges_num").html();
					var nums = nums-1;
					$("#pending_exchanges_num").html(nums);
				}
			});	
		}
	} else {
		return false;
	}
}	

function EEXAdmin_UpdateCanceled(id,type) {
	if(type == "1") {
		var data_url = "requests/EEXAdmin_Update.php?module=UpdateCanceled&id="+id;
		$.ajax({
			type: "GET",
			url: data_url,
			dataType: "html",
			success: function (data) {
				$("#explore_"+id+"_modal_content").html(data);
			}
		});
	} else if(type == "2") {
		var data_url = "requests/EEXAdmin_Update.php?module=UpdateCanceledConfirmed&id="+id;
			$.ajax({
				type: "GET",
				url: data_url,
				dataType: "html",
				success: function (data) {
					$("#explore_"+id+"_modal_content").html(data);
					$("#pending_exchange_"+id).fadeOut(300, function(){ $(this).remove();});
					var nums = $("#pending_exchanges_num").html();
					var nums = nums-1;
					$("#pending_exchanges_num").html(nums);
				}
			});	
	} else if(type == "3") {
		$("#explore_"+id+"_modal").modal("hide");
	} else {
		return false;
	}
}