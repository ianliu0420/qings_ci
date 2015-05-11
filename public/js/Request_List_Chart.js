$(document).ready(function() {

	$("#nav1").addClass("active");
	var url = "query_chart";
	$.ajax({
		type : 'POST',
		url : url,
		dataType : "json",
        data: {"startdate":"2014-10-10","enddate":"2014-12-12"},
		success : function(data) {
//			drawChart(data);	
			if(data!=null && data.msg!=null && data.msg.length>0){
				drawChart(data.msg);
			}
		}
	});
	
	$("#searchbtn").click(function(){
	   var startdate = $("#startdate").val();
	   var enddate = $("#enddate").val();
	   var url = "query_chart";
		
		$.ajax({
			type : 'POST',
			url : url,
			dataType : "json",
            data: {"startdate":startdate,"enddate":enddate},
			success : function(data) {
				if(data!=null && data.msg!=null && data.msg.length>0){
					drawChart(data.msg);
				}else{
					$('#container').html("<div>no data available</div>");
				}
//				
//				if(data.length==0){
//					$('#container').html("<div>no data available</div>");
//				}else{
//					drawChart(data);
//				}
				
			}
		});
	});
	
});


function drawChart(data){
	if(data!=null && data.length>0){
		
		var rateResult = new Array();
		var startTime = Date.parse($("#startdate").val());
		var endTime = Date.parse($("#enddate").val());
		
		var temp = new Array();
		var k =0;
		for(var j = startTime; j<=endTime; j=j+3600*24*1000){
			var smallArray = new Array();
			smallArray[0] = j;
			smallArray[1] = 0;
			temp[k] = smallArray;
			k++;
		}
		
		for(var i=0;i<data.length;i++){
			for(var p=0;p<temp.length;p++){
				if(temp[p][0]==Date.parse(data[i]["request_date"])){
					temp[p][1] = parseInt(data[i]["count(*)"]); 
				}
			}
		}

	    $('#container').highcharts({
	        chart: {
	            type: 'spline'
	        },
	        title: {
	            text: 'Request Number'
	        },
	        xAxis: {
	            type : 'datetime',
	            dateTimeLabelFormats: { // don't display the dummy year
	            	day: '%e. %b',
	            	month: '%b \'%y',
	            	year: '%Y'
	            },
	            title: {
	                text: 'Date'
	            }
	        },
	        yAxis: {
	            title: {
	                text: 'Request Number'
	            },
	            min: 0
	        },
	        tooltip: {
	            headerFormat: '<b>{series.name}</b><br>',
	            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
	        },

	        series: [{
	            name: 'Request',
	            data:temp
	        }]
	    });
	
	}
	
	$(function () {});
	
	
}






