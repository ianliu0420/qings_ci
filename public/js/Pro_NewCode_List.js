$(document).ready(function() {
	
	$("#nav3").addClass("active");
	
	$("#searchbtn").click(function(){
	   var startDate = $("#startdate").val();
	   var endDate = $("#enddate").val();
	   
	   window.location.href = "query?startdate="+startDate+"&enddate="+endDate;
	});
	
	
	
});






