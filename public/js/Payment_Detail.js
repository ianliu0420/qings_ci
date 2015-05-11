$(document).ready(function() {

	$("#nav2").addClass("active");
	
	$("#comfirmpaybutton").click(function(){
		
		var team_id = $("#hiddenTeamId").val();
		var event_id = $("#hiddenEventId").val();
		var uniqId = $("#hiddenUniqId").val();
		event_id = uniqId;
		
		var paymethod = $("input[name='payby']:checked").val();

		$("#comfirmpaybutton").attr('disabled','disabled');
		var txt;
		var r = confirm("Are you confirm the payment?");
		if (r == true) {
//			var pid = $("#paymentid").val();
			// here we going to pay the bill
		    $.ajax({
				type : 'POST',
				url : "Payment_Credit_Controller.php",
				dataType : "json",
				data: {"team_id":team_id,"event_id":event_id,"paymethod":paymethod},
				success : function(data) {
					if(data==1){
						alert("we have comfirm the payment, and we will get the money shortly!");
						$("#comfirmpaybutton").removeAttr('disabled');
						location.reload();
					}else if(data=2){
						alert("please contact the developer, some problem occured");
						$("#comfirmpaybutton").removeAttr('disabled');
					}else if(data=0){
						alert("payment failed");
						$("#comfirmpaybutton").removeAttr('disabled');
					}
				}
			});
		    
		} else {
			$("#comfirmpaybutton").removeAttr('disabled');
		}
	});
		
		
//		// user pay by the cash
//		// 1. update description   2. insert a record in invoice
//		if(paymethod == 0){
//			
//		}else{  // 1. update description   2. insert a record in invoice  3.pay the money
//				
//		}
		
		
		
		  
		

	
//    $("#comfirmpaybutton").click(function(){
//		
//		$("#comfirmpaybutton").attr('disabled','disabled');
//		var txt;
//		var r = confirm("Are you confirm the payment?");
//		if (r == true) {
//			var pid = $("#paymentid").val();
//			// here we going to pay the bill
//		    $.ajax({
//				type : 'POST',
//				url : "Payment_Credit_Controller.php",
//				dataType : "json",
//				data: {"pid":pid},
//				success : function(data) {
//					if(data==1){
//						alert("we have comfirm the payment, and we will get the money shortly!");
//						$("#comfirmpaybutton").removeAttr('disabled');
//						location.reload();
//					}else if(data=2){
//						alert("please contact the developer, some problem occured");
//						$("#comfirmpaybutton").removeAttr('disabled');
//					}else if(data=0){
//						alert("payment failed");
//						$("#comfirmpaybutton").removeAttr('disabled');
//					}
//				}
//			});
//		    
//		} else {
//			$("#comfirmpaybutton").removeAttr('disabled');
//		}
//	});
    
//   $("#confirmworkbutton").click(function(){
//		
//		$("#confirmworkbutton").attr('disabled','disabled');
//		var txt;
//		var r = confirm("Are you confirm the work?");
//		if (r == true) {
//			var pid = $("#paymentid").val();
//			// here we going to pay the bill
//		    $.ajax({
//				type : 'POST',
//				url : "Payment_Status_update.php",
//				dataType : "json",
//				data: {"pid":pid},
//				success : function(data) {
//					if(data.errono==0){
//						alert("we have comfirm the work!");
//						$("#confirmworkbutton").removeAttr('disabled');
//						location.reload();
//					}else if(data.errono==1){
//						alert("please contact the developer, some problem occured");
//						$("#comfirmpaybutton").removeAttr('disabled');
//					}
//				}
//			});
//		    
//		} else {
//			$("#comfirmpaybutton").removeAttr('disabled');
//		}
//	});

	
   
});


function quickconfirm(event_id,team_id){
	$("#confirmworkbutton").attr('disabled','disabled');
	var r = confirm("Are you confirm the work?");
	if (r == true) {
	    $.ajax({
			type : 'POST',
			url : "Payment_Status_update.php",
			dataType : "json",
			data: {"event_id":event_id,"team_id":team_id},
			success : function(data) {
				if(data.errono==0){
					alert("we have comfirm the work!");
					location.reload();
				}else if(data.errono==1){
					alert("please contact the developer, some problem occured");
				}
			}
		});
	    
	} else {
	}
}
