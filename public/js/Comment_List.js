$(document).ready(function() {

	$("#nav1").addClass("active");
	
	var serveyId = $("input[name='servey']:checked").val();
	var url = "query";
	$("#startdate").val("2014-10-10");
	$("#enddate").val("2014-12-12");
	$.ajax({
		type : 'POST',
		url : url,
		dataType : "json",
        data: {"startdate":"2014-10-10","enddate":"2014-12-12","serveyId":serveyId},
		success : function(data) {
			if(data!=null && data.msg!=null && data.msg.length>0){
				drawChart(data.msg);
			}
		}
	});
	
	$("#searchbtn").click(function(){
	   var startTime = $("#startdate").val();
	   var endTime = $("#enddate").val();
	   var serveyId = $("input[name='servey']:checked").val();
	   var url = "query";
		
		$.ajax({
			type : 'POST',
			url : url,
			dataType : "json",
                        data: {"startdate":startTime,"enddate":endTime,"serveyId":serveyId},
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
	if(data!=null && data.length>0){
		var rateResult = new Array();
		for(var i=0;i<5;i++){
			rateResult[i] = 0;
		}
		
		for(var i=0;i<data.length;i++){
		    var rate = data[i].rate;
		    rateResult[rate-1] = rateResult[rate-1]+1;
		}
		
		console.log(rateResult);
		
		$('#container').highcharts({
	        title: {
	            text: 'Survey Result',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'Qings cleaning',
	            x: -20
	        },
	        xAxis: {
	            categories: ['1', '2', '3', '4', '5']
	        },
	        yAxis: {
	            title: {
	                text: 'Rate Level'
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
	            name: 'Rate',
	            data: rateResult
	        }]
	    });
	}
}






