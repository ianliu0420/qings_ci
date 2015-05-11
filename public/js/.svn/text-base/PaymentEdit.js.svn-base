$(document).ready(function() {

	$("#nav2").addClass("active");
	
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
					$("#worktype").append("<option value='"+temp['servicetype_id']+","+temp['servicetype_length']+"'>"+temp['servicetype_name']+"-----"+temp['servicetype_price']+"</option>");	
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
	
	
});


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



