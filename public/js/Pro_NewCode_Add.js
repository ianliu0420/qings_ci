$(document).ready(
		function() {

			$("#nav3").addClass("active");

			$("#genBtn").click(function() {
				var code = genCode();
				$("#np_code").val(code);
			});

			$("input[name='np_type']:radio").change(
					function() {
						var paymentmethod = $(
								"input[name='np_type']:checked",
								"#newProCodeForm").val();
						if (paymentmethod == 1) {
							$("#percentDiv").toggle();
							$("#amountDiv").toggle();
						} else if (paymentmethod == 2) {
							$("#percentDiv").toggle();
							$("#amountDiv").toggle();
						}
					});

			
			
			$("#formSubmit").click(function(){
				var np_id = $("#np_id").val();
				var np_code = $("#np_code").val();
				var np_startdate = $("#startdate").val();
				var np_enddate = $("#enddate").val();
				var np_type = $('input:radio[name=np_type]:checked').val();
				var np_percent = $("#np_percent").val();
				var np_amount = $("#np_amount").val();
				var np_notes = $("#np_notes").val();
				var np_upper = $("#np_upper").val();
				var np_lower = $("#np_lower").val();
				 $.ajax({
					 type : 'POST',
					 url : "add",
					 dataType : "json",
					 data: {"np_id":np_id,"np_code":np_code,"np_startdate":np_startdate,"np_enddate":np_enddate,"np_type":np_type,
						    "np_percent":np_percent,"np_amount":np_amount,"np_notes":np_notes,"np_upper":np_upper,"np_lower":np_lower},
					 success : function(data) {
						 if(data!=null && data.msg!=null && data.msg == true){
								alert("add success");
							}else{
								alert("add fail");
							}
					 }
				 });
				
			});
			
			
		});

function propay(agentId, startDate, endDate) {

	var url = "Pro_Pay.php?agentId=" + agentId + "&startDate=" + startDate
			+ "&endDate=" + endDate + "";
	window.location.href = url;

	// alert(agentId);
	// alert(amount);
	// $.ajax({
	// type : 'POST',
	// url : "Pro_Pay.php",
	// dataType : "json",
	// data: {agentId:agentId,amount:amount},
	// success : function(data) {
	// alert(data);
	// }
	// });
}

function genCode() {
	return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(0);
}

//
// var guid = (function() {
// function s4() {
// return Math.floor((1 + Math.random()) * 0x10000)
// .toString(16)
// .substring(1);
// }
// return function() {
// return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
// s4() + '-' + s4() + s4() + s4();
// };
// })();

