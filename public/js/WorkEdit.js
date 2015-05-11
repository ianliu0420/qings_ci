$(document).ready(function() {

	$("#nav2").addClass("active");
	
//	alert($("#extraserviceHidden").val());
//	alert($("#serviceTypeHidden").val());
	
	var servicetype = $("#serviceTypeHidden").val();
	var extras = $("#extraserviceHidden").val();
	
	// get all service types
	$.ajax({
		type : 'POST',
		url : "ServiceTypeDao.php",
		dataType : "json",
		success : function(data) {
			$("#worktype").html("");
			for(var i=0; i<=data.length; i++){
				var temp = data[i];
				if(temp!=null){
					if(servicetype==(i+1)){
						$("#worktype").append("<option selected value='"+temp['servicetype_id']+ "," + temp['servicetype_price']+"'>"+temp['servicetype_name']
								+"-----"+temp['servicetype_price']+"</option>");
					}else{
						$("#worktype").append("<option value='"+temp['servicetype_id']+"," + temp['servicetype_price']+"'>"+temp['servicetype_name']
								+"-----"+temp['servicetype_price']+"</option>");
					}
						
				}
			}
		}
	});
	
	
	// get all extra service types
	$.ajax({
		type : 'POST',
		url : "ExtraServiceTypeDao.php",
		dataType : "json",
		success : function(data) {
			$("#extraservicediv").html("");
			for ( var i = 0; i <= data.length; i++) {
				var temp = data[i];
				if (temp != null) {
					var tempStr = i+1+"";
					if(extras.indexOf(tempStr)>=0){
						$("#extraservicediv").append(
								"<input type='checkbox' checked onchange='calTotalShouldPay()' name='extraservice[]' value="+temp['id']+","+temp['serviceprice']+">"+temp['servicename']
								+"---"+temp['serviceprice']);						
					}else{
						$("#extraservicediv").append("<input type='checkbox' onchange='calTotalShouldPay()' name='extraservice[]' value="+temp['id']+","+temp['serviceprice']+">"+temp['servicename']
								+"---"+temp['serviceprice']);
					}
				}
			}
		}
	});
	
	
	$("#workdate").change(function(){
		var workdate = $("#workdate").val();
		var worktype = $("#worktype").val();
		var excludeId = $("#pid").val();

		if(workdate=="" || worktype==0){
			alert("please fill all the form!");
			return;
		}
		var t = worktype.split(",");
		var typeid=t[0];
		var length = t[1]/0.5;
		
		$.ajax({
			type : 'POST',
			url : "GetTimeslots.php",
			dataType : "json",
			data: { workdate: workdate, length: length, excludeId:excludeId },
			success : function(data) {

				$("#timeslot").html("");
				
				for(var i=0; i<=data.length; i++){
					var temp = data[i];
					if(temp!=null){
						var temps = temp.split(":");
						$("#timeslot").append("<option value='"+temp+"'>"+temps[1]+"</option>");	
					}
				}
			}
		});
		
	});
	
	$("#worktype").change(function(){
		$("#workdate").val("");
		$("#timeslot").html("");
//		calTotalShouldPay();
		$("#applybtn").click();
	});
	
	$("#carpettype").change(function(){
		calTotalShouldPay();
	});
	
	$("input[name='paymethod']:radio").change(function(){
		var paymentmethod = $("input[name='paymethod']:checked","#paymentform").val();
		if(paymentmethod==1){
			$("#buybuttondiv").show();
			$("#creditpaydiv").hide();
		}else if(paymentmethod==2){
			$("#buybuttondiv").hide();
			$("#creditpaydiv").show();
		}
		
//		alert("changed");
	});
	
	$("#buynowbtn").click(function(){
		$("#item_name").val("qings cleaning service");
		$("#item_number").val("4");
		$("#buynowform").submit();
	});
	
	
	$("#deleteorderbtn").click(function(){
		var r = confirm("Are you sure to delete this order?");
		if (r == true) {
			var pid = $("#pid").val();
			$.ajax({
				type : 'POST',
				url : "Payment_Delete.php",
				dataType : "json",
				data: { "pid":pid},
				success : function(data) {
					if(data==1){
						alert("delete suc");
						window.location.href="Payment_Detail.php?pid="+pid;
					}else{
						alert("delete fail");
					}
				}
			});
		}
	});
	
	
	
	$("input[name='paymethod']:radio").change(function(){
	     var paymentmethod =$("input[name='paymethod']:checked","#paymenteditform").val();
		 if(paymentmethod=="cash"){
			 $("#creditpaydiv").hide();
		 }else{
			 $("#creditpaydiv").show();
		 }
	 });
	
	
	
	
$("#comfirmpaybutton").click(function(){
		
		var team_id = $("#team_id").val();
		var event_id = $("#event_id").val();
		var uniqId = $("#uniqId").val();
		var deposit = $("#deposit").val();
		var paymethod = $("input[name='payby']:checked").val();

		$("#comfirmpaybutton").attr('disabled','disabled');
		var txt;
		var r = confirm("Are you confirm the payment?");
		if (r == true) {
			// here we going to pay the bill
		    $.ajax({
				type : 'POST',
				url : "Payment_Credit_Controller.php",
				dataType : "json",
				data: {"team_id":team_id,"uniqId":uniqId,"event_id":event_id,"paymethod":paymethod,"deposit":deposit},
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




$("#applybtn").click(function() {
	var procode = $("#procode").val();
	var totalAmount = $("#shouldpay").val();
	if (procode != null && procode != "") {
		$.ajax({
			type : 'POST',
			url : "Pro_NewCode_Check.php",
			dataType : "json",
			data : {
				"procode" : procode,
				"returnJsonObj":1,
				"totalAmount":totalAmount
			},
			success : function(data) {
				if(data['np_type'] == 1){
					$("#promoteinfo").val(data['np_type']+","+data['np_percent']);
				}else if(data['np_type'] == 2){
					$("#promoteinfo").val(data['np_type']+","+data['np_amount']);
				}
				calTotalShouldPay();
				$("#procodeErr").hide();
			},
			error: function(data){
				badProcode();
				$("#procodeErr").html("the procode is not valid");
				$("#procodeErr").show();
			}
		});
	}else{
		badProcode();
		$("#procodeErr").hide();
	}
});

$("#procode").blur(function() {
	$("#applybtn").click();
});
	
if($("#procode").val()!=null &&$("#procode").val()!=""){
	$("#applybtn").click();
}

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


function calTotalShouldPay(){
	
	var shouldpay = 0;
	var realpay = 0;
	
	var worktype = $("#worktype").val();
	var t = worktype.split(",");
	var work_price = parseInt(t[1]);
	realpay += work_price;
	shouldpay += work_price;
	
	var carpettype = $("#carpettype").val();
	var t1 = carpettype.split(",");
	var work_price1 = parseInt(t1[1]);
	realpay += work_price1;
	shouldpay += work_price1;
	
	
	$('input[type="checkbox"][name="extraservice\\[\\]"]:checked').each(function(i){
		var value =$(this).val();
		var worktype = $("#worktype").val();
		var ex = value.split(",");
		realpay += parseInt(ex[1]);
		shouldpay += parseInt(ex[1]);
	});
	
    var proInfo  = $("#promoteinfo").val();
    if(proInfo !=null && proInfo !=""){
    	var p = proInfo.split(",");
    	if(p[0]=="1"){
    		realpay = realpay - realpay * parseInt(p[1])/100;
    	}else if(p[0]=="2"){
    		realpay = realpay - parseInt(p[1]);
    	}
    }else{
    	if(shouldpay==realpay){
    	}else{
    		realpay=shouldpay;
    	}
    }

	if($("#recurdiscount").val()!="0"){
		realpay = shouldpay*(100-parseFloat($("#recurdiscount").val()))/100;
	}
	
	// realpay should subtract 谈何deposit
	depositMoney = $("#deposit").val();
	$("#realpay").val(realpay-depositMoney);
	$("#shouldpay").val(shouldpay);
	
}


function badProcode(){
	var shouldpayvalue = $("#shouldpay").val() 
	$("#realpay").val(shouldpayvalue);
	$("#realpayDisp").text(shouldpayvalue);
	$("#shouldpayDisp").text(shouldpayvalue);
}



