$(document).ready(function() {

	
	$("#nav1").addClass("active");
	
	
	$("#searchbtn").click(function(){
	   var startTime = $("#starttime").val();
	   var endTime = $("#endtime").val();
	   
	   var sort = 0;
	   if ($('#sort').is(':checked')) {
          sort = 1;
	   }
		
	   window.location.href = "Pro_List.php?sort="+sort+"&starttime="+startTime+"&endtime="+endTime;
	   
	});
	
	
	
});


function propay(agentId, startDate, endDate){
    
	var url = "Pro_Pay.php?agentId="+agentId+"&startDate="+startDate+"&endDate="+endDate+"";
	window.location.href = url;
	
//	alert(agentId);
//	alert(amount);
//	$.ajax({
//		type : 'POST',
//		url : "Pro_Pay.php",
//		dataType : "json",
//		data: {agentId:agentId,amount:amount},
//		success : function(data) {
//			alert(data);
//		}
//	});
	
	
}





