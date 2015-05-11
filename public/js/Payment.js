var totlashouldpay = 0;

$(document).ready(
		function() {

			calTotalShouldPay();
			
			
			jQuery.validator.addMethod("zipcoderule", function(value, element) { 
				 var pattern = /^[0-9]{4}$/; 
				 return this.optional(element) || (pattern.test(value)); 
			 }, "zip code format is wrong");
			
			jQuery.validator.addMethod("cvcrule", function(value, element) { 
				 var pattern = /^[0-9]{3}$/; 
				 return this.optional(element) || (pattern.test(value)); 
			 }, "CVC format is wrong");
			
			
			$("#paymentform").validate({
				rules : {
					firstname : "required",
					lastname : "required",
					email: {
					    required: true,
					    email: true
					},
					zipcode: {
						required: true,
						zipcoderule:true
					},
					phoneno:{required:true},
					address:{required:true},
					city:{required:true},
					state:{required:true},
					cardno:{required:true},
					cvc: {
						required: true,
						cvcrule:true
					},
					worktype: {
						required: true
					},
					workdate: {
						required: true
//						cvcrule:true
					},
					timeslot:{
						required: true
					}
				},
				messages : {
					firstname : "please fill your first name",
					lastname : "please fill your last name",
					email:{
						required: "please fill the email",
				        email:"format is wrong"
					},
					zipcode:{
						required: "zipcode should be filled",
						zipcoderule:"zipcode format is wrong"
					},
					phoneno:{
						required: "please fill the phone number",
					},
					address:{
						required:"please fill the address",
					},
					city:{
						required:"please fill the city",
					},
					state:{
						required:"please fill the state",
					},
					cardno:{required:"plaese fill the credit card no"},
					cvc:{
						required:"plaese fill the credit card no"
					},
					worktype: {required:"please select a work type"},
					workdate: {
						required: "please select a work date"
//						cvcrule:true
					},
					timeslot:{
						required: "please select a work time",
					}
				}
			});
			
			// get all service types
//			$.ajax({
//				type : 'POST',
//				url : "ServiceTypeDao.php",
//				dataType : "json",
//				success : function(data) {
//
//					$("#worktype").html("");
//
//					for ( var i = 0; i <= data.length; i++) {
//						var temp = data[i];
//						if (temp != null) {
//							$("#worktype").append(
//									"<option value='" + temp['servicetype_id']
//											+ "," + temp['servicetype_length']
//									        + "," + temp['servicetype_price']
//											+ "'>" + temp['servicetype_name']
//											+ "-----"
//											+ temp['servicetype_price']
//											+ "</option>");
//							calTotalShouldPay();
//						}
//					}
//				}
//			});
			
			
			// when the user select hourly service, we should show the select
			$("#worktype").change(function(){
				$("#workdate").val("");
				$("#timeslot").html("");
				
				var workType = $("#worktype").val();
				if(workType=="0"){
					$("#worktypehourdiv").show();
				}else{
					$("#worktypehourdiv").hide();
				}
				calTotalShouldPay();
			});
			
			$("#carpettype").change(function(){
				calTotalShouldPay();
			});
			
			$("#worktypehour").change(function() {
				$("#workdate").val("");
				$("#timeslot").html("");
				calTotalShouldPay();
			});
			
			
			// get all extra service types
			$.ajax({
				type : 'POST',
				url : "manage/ExtraServiceTypeDao.php",
				dataType : "json",
				success : function(data) {
					$("#extraservicediv").html("");
					for ( var i = 0; i <= data.length; i++) {
						var temp = data[i];
						if (temp != null) {
							$("#extraservicediv").append(
									"<h6><input type='checkbox'  onchange='calTotalShouldPay()' name='extraservice[]' value="+temp['id']+","+temp['serviceprice']+">"+temp['servicename']
									+"---"+temp['serviceprice']+"</h6>")
						}
						
					}
					$("#extraservicediv").append("<br/>");
				}
			});
			

			$("#procode").blur(function() {
				$("#applybtn").click();
			});
			
			$("#applybtn").click(function() {
				var procode = $("#procode").val();
				var totalAmount = $("#shouldpay").val();
				
				if (procode != null && procode != "") {
					$.ajax({
						type : 'POST',
						url : "manage/Pro_NewCode_Check.php",
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

			$("#singlebutton").click(function() {
				
				 // then we will check the credit card info
				var paymethod = $(
						"input:radio[name=paymethod]:checked")
						.val();
				var cardno = $("#cardno").val();
				var emonth = $("#emonth").val();
				var eyear = $("#eyear").val();

				$("#singlebutton").attr('disabled','disabled');
				
				// if user pay by cash
				if(paymethod=="cash"){
					// 
					var procode = $("#procode").val();
					if (procode != "") {
						$.ajax({
							type : 'POST',
							url : "manage/Pro_NewCode_Check.php",
							dataType : "json",
							data : {
								"procode" : procode
							},
							success : function(data) {
								if (data.errono == 0) {
									$("#singlebutton").removeAttr('disabled');
									$("#paymentform").submit();
								} else {
									$("#errorInfo").html("your promotion code is not valid");
//									alert("your promotion code is not valid");
								}
							}
						});
					}else{
						$("#paymentform").submit();
						$("#singlebutton").removeAttr('disabled');
					}
					
				}else{// if user pay by credit card
					if(cardno==""||emonth==""||eyear==""){
						$("#errorInfo").html("please input the correct credit cord infor!");
					}else{
						$.ajax({
							type : 'POST',
							url : "manage/Payment_StoreCard_check.php",
							dataType : "json",
							data : {
								"type" : paymethod,
								"number" : cardno+ "",
								"emonth" : emonth,
								"eyear" : eyear
							},
							success : function(data) {
								if (data.errono == 0) {
									$("#errorInfo").html("");
									
									var procode = $("#procode").val();
									if (procode != "") {
										$.ajax({
											type : 'POST',
											url : "manage/Pro_NewCode_Check.php",
											dataType : "json",
											data : {
												"procode" : procode
											},
											success : function(data) {
												if (data.errono == 0) {
													$("#singlebutton").removeAttr('disabled');
													$("#paymentform").submit();
												} else {
													$("#errorInfo").html("your promotion code is not valid");
//													alert("your promotion code is not valid");
												}
											}
										});
									}else{
										$("#paymentform").submit();
										$("#singlebutton").removeAttr('disabled');
									}
									
								} else {
//									alert("your card is not valid");
									$("#errorInfo").html("your card is not valid!");
									$("#singlebutton").removeAttr('disabled');
								}
							}
						});
					}
				}
			});

			$("#workdate").change(
					function() {
						var workdate = $("#workdate").val();
						// if the user choose hourly service
						var worktype = getWorkType();;
						if (workdate == "" || worktype == 0) {
							alert("please fill all the form!");
							return;
						}
						var t = worktype.split(",");
						var typeid = t[0];
						var length = t[1] / 0.5;

						$.ajax({
							type : 'POST',
							url : "manage/GetTimeslots.php",
							dataType : "json",
							data : {
								workdate : workdate,
								length : length
							},
							success : function(data) {

								$("#timeslot").html("");

								for ( var i = 0; i <= data.length; i++) {
									var temp = data[i];
									if (temp != null) {
										var temps = temp.split(":");
										$("#timeslot").append(
												"<option value='" + temp + "'>"
														+ temps[1]
														+ "</option>");
									}
								}
							}
						});

					});

			
			 $("input[name='paymethod']:radio").change(function(){
			     var paymentmethod =$("input[name='paymethod']:checked","#paymentform").val();
				 if(paymentmethod=="cash"){
					 $("#creditpaydiv").hide();
				 }else{
					 $("#creditpaydiv").show();
				 }
			 });
			 
		});


function calTotalShouldPay(){
	var shouldpay = 0;
	var realpay = 0;
	
	var worktype = getWorkType();
	
	var t = worktype.split(",");
	var work_price = parseInt(t[2]);
	realpay += work_price;
	shouldpay += work_price;
	
    var carpettype = $("#carpettype").val();
	var t1 = carpettype.split(",");
	var work_price1 = parseInt(t1[1]);
	realpay += work_price1;
	shouldpay += work_price1;
	
	$(":checkbox:checked").each(function(i){
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
    }
	
	$("#realpay").val(realpay);
	$("#shouldpay").val(shouldpay);

//***************************to display the infor*********************************	
    $("#realpayDisp").text(realpay);
	$("#shouldpayDisp").text(shouldpay);
	
	var reviewArray=[];
	// get the work type info
	var worktypetxt = $("#worktype option:selected").text();
	reviewArray["worktype"] = worktypetxt;
	if($("#carpettype").val()!="0,0"){
		var carpettypetxt = $("#carpettype option:selected").text();
		reviewArray["carpettype"] = carpettypetxt;
	}
	
	
	$(":checkbox:checked").each(function(i){
		var value =$(this).val();
		if(value=="1,30"){
			reviewArray["extra"] = "extra service 1---30";
		}else if(value=="2,10"){
			reviewArray["extra"] =reviewArray["extra"]+ ",extra service 2---10";
		}
	});
	
	
	var reviewDivUL =$("#reviewDivUL"); 
	reviewDivUL.html("");
	if(reviewArray['worktype']!=null){
		reviewDivUL.append("<li>"+reviewArray['worktype']+"</li>");	
	}
	if(reviewArray['carpettype']!=null){
		reviewDivUL.append("<li>"+reviewArray['carpettype']+"</li>");
	}
	if(reviewArray['extra']!=null){
		reviewDivUL.append("<li>"+reviewArray['extra']+"</li>");
	}
	

}

//*******************if the promotion code is bad*************************
function badProcode(){
	var shouldpayvalue = $("#shouldpay").val() 
	$("#realpay").val(shouldpayvalue);
	$("#realpayDisp").text(shouldpayvalue);
	$("#shouldpayDisp").text(shouldpayvalue);
}




//*******************get the work type*************************
function getWorkType(){
	var worktype = $("#worktype").val();
	if(worktype=="0"){
		worktype  = $("#worktypehour").val();
	}
	
	return worktype;
}


//*********************Google Address autocomplete************************
var placeSearch, autocomplete;
var autoplace;
var componentForm = {
  // street_number: 'short_name',
//  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
//  country: 'long_name',
  postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('fakelocality')),
      { types: ['geocode'] });
  
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
//	  if()
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
  
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
	
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
  
}

function delocate(){
	setTimeout(function(){
		$('#fakelocality').val($("#locality").val());
	},500);
}

//*********************Google Address autocomplete************************ 
