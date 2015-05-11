$(document).ready(function() {
	$("#nav1").addClass("active");
});


function pageNoClick(agent_id,pageNo,totalpage){
	if(pageNo<=0){
		pageNo=1
	}
	
	if(pageNo>=totalpage){
		pageNo=totalpage
	}
	var pagesize= 10;
	window.location.href = "Pro_List_Detail.php?agent_id="+agent_id+"&pageno="+pageNo+"&pagesize="+pagesize;		
}



