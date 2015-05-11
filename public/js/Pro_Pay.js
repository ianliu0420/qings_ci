$(document).ready(function() {

	$("#nav1").addClass("active");
	
	$("#propaybtn").click(function(){
		$("#propaybtn").attr('disabled','disabled');
		
		var txt;
		var r = confirm("Are you confirm the payment?");
		if (r == true) {
			var pid = $("#paymentid").val();
			// here we going to pay the bill
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
		    
		} else {
			$("#propaybtn").removeAttr('disabled');
		}
		
	});

	
	
});