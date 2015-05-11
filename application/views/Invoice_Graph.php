<?php require_once 'header.php'?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="Payment_List.php">Work list</a></li>
				<li><a href="index">Invoice list</a></li>
				<li class="active"><a href="graph">Invoice Graph</a></li>
			</ul>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

			<form role="form" class="form-inline"
				method="GET">
				<div class="form-group">
					<label for="exampleInputEmail1">Start Time:</label> <input
						class="form-control" id="starttime" name="starttime"
						placeholder="Select start time" value="<?php echo $starttime?>">
				</div>

				<div class="form-group col-sm-offset-1">
					<label for="exampleInputEmail1">End Time:</label> <input
						class="form-control" id="endtime" name="endtime"
						placeholder="Select end time" value="<?php echo $endtime?>">
				</div>
				
				
				<div class="form-group col-sm-offset-1">
					<label for="exampleInputEmail1">Total number or amount:</label>
					<select class="form-control" name="numberOramount" id="numberOramount">
						<!-- id, length, price -->
						<option value='1'>Total Number</option>
						<option value='2'>Total money</option>
					</select>
				</div>
								
				<br>
				<div class="form-group">
					<label for="radios">Payment Status:</label>
					<label for="radios-0">All</label>
					<input type="radio" name="paymethod" value="-1" checked="checked"> &nbsp;&nbsp; 
					
					<label for="radios-1">pay by cash</label> 
					<input type="radio" name="paymethod" value="0">&nbsp;&nbsp;
					
					<label for="radios-0">Pay by card</label>
					<input type="radio" name="paymethod" value="1">&nbsp;&nbsp; 
				</div>
 

				&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="btn btn-primary" type="button" id="searchbtn">Search</button>
			</form>
            
			<br>
            <h4 class="sub-header">Search result</h4>
			<div id="container"
				style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		</div>
	</div>
</div>

<?php include 'footer.php'?>

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/Invoice_Graph.js"></script>
<script type="text/javascript">
$(document).ready(function() {     
	 $("#starttime").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#endtime").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>


