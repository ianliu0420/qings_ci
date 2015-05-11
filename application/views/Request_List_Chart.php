<?php require_once 'header.php'?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="<?php echo site_url("comment/index")?>">Survey list</a></li>
				<li ><a
					href="<?php echo site_url("comment_overall/index")?>">Overall
						Comment list</a></li>
				<li class="active"><a href="<?php echo site_url("myrequest/index")?>">Request list</a></li>
			</ul>
		</div>
		
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

			<form role="form" class="form-inline">
				<div class="form-group">
					<label for="exampleInputEmail1">Start Time:</label> <input
						class="form-control" id="startdate"
						placeholder="Select start time" value="<?php echo $startdate?>">
				</div>

				<div class="form-group col-sm-offset-1">
					<label for="exampleInputEmail1">End Time:</label> <input
						class="form-control" id="enddate" placeholder="Select end time"
						value="<?php echo $enddate?>">
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
<script src="<?php echo base_url() ?>public/js/Request_List_Chart.js"></script>
<script type="text/javascript">
$(document).ready(function() {     
	 $("#startdate").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#enddate").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>



