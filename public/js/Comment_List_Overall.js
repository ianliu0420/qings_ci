$(document).ready(function() {
    $("#nav1").addClass("active");
});


function pageNoClick(pageNo,totalpage){
	
	var starttime = $("#startdate").val();
	var endtime = $("#enddate").val();
	
	if(pageNo<=0){
		pageNo=1
	}
	
	if(pageNo>=totalpage){
		pageNo=totalpage
	}
	var pagesize= 10;
	window.location.href = "query?pageno="+pageNo+"&pagesize="+pagesize+"&startdate="+starttime+"&enddate="+endtime;
		
}



