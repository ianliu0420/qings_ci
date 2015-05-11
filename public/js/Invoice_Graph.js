$(document).ready(function() {

	$("#nav2").addClass("active");
//	var serveyId = $("input[name='servey']:checked").val();
//	var url = "Comment_Dao.php";
//	$.ajax({
//		type : 'POST',
//		url : url,
//		dataType : "json",
//                data: {"starttime":"2014-10-10","endtime":"2014-12-12","serveyId":serveyId},
//		success : function(data) {
//			// drawChart(data);	
//		}
//	});
	
	$("#searchbtn").click(function(){
	   var startTime = $("#starttime").val();
	   var endTime = $("#endtime").val();
	   var paymethod = $("input[name='paymethod']:checked").val();
	   
	   var url = "query_graph";
	   $.ajax({
			type : 'POST',
			url : url,
			dataType : "json",
            data: {"starttime":startTime,"endtime":endTime,"type":paymethod},
			success : function(data) {
				if(data!=null && data.msg!=null && data.msg.length>0){
					drawChart(data.msg);
				}else{
					$('#container').html("<div>no data available</div>");
				}
				
			}
		});
	});
	
});


function drawChart(data){
	
	var numberOramount = $("#numberOramount").val();
	
	var uData = [];
	
	var rateResult = new Array();
	console.log($("#starttime").val());
	console.log($("#endtime").val());
	var startTime = Date.parse($("#starttime").val());
	var endTime = Date.parse($("#endtime").val());
	
	var k =0;
	for(var j = startTime; j<=endTime; j=j+3600*24*1000){
		
		var date = new Date(j);
		var year    = date.getFullYear();
		var month   = date.getMonth()+1;
		if(month<10){
			month = "0"+month;
		}
		var day     = date.getDate()+1;
		if(day<10){
			day = "0"+day;
		}
		var key = year+"-"+month+"-"+day;
		uData[key] = 0;
	}
	
	for ( var i = 0; i < data.length; i++) {
		var datestr = data[i].paydate;
		var date = datestr.split(" ");
		date = date[0];
		if(numberOramount==1){
			if(uData[date]==null){
				uData[date] = 1;
			}else{
				uData[date] += 1;
			}
		}else if(numberOramount==2){
			if(uData[date]==null){
				uData[date] = data[i].realpay;
			}else{
				var temp =uData[date];
				uData[date] = parseInt(uData[date])+parseInt(data[i].realpay);
			}
		}
		
	}
	
	var xValue = [];
	var yValue = [];
	var xValue = Object.keys(uData);
	for ( var j = 0; j < xValue.length; j++) {
		yValue[j] =  uData[xValue[j]];
	}
	
	
	if(yValue!=null && yValue.length>0){
		
		$('#container').highcharts({
	        title: {
	            text: 'Invoice Result',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'Qings cleaning',
	            x: -20
	        },
	        xAxis: {
	            categories: xValue
	        },
	        yAxis: {
	            title: {
	                text: 'Invoice Number'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        tooltip: {
	            valueSuffix: ''
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	            name: 'Number',
	            data: yValue
	        }]
	    });
	}
}






