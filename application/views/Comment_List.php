<?php require_once 'header.php'?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="active"><a href="<?php echo site_url("comment/index")?>">Survey list</a></li>
				<li><a href="<?php echo site_url("comment_overall/index")?>">Overall Comment list</a></li>
				<li><a href="<?php echo site_url("myrequest/index")?>">Request list</a></li>
			</ul>
		</div>
		
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

			<form role="form" class="form-inline">
				<div class="form-group">
					<label for="exampleInputEmail1">Start Time:</label> <input
						class="form-control" id="startdate"
						placeholder="Select start time" value="">
				</div>

				<div class="form-group col-sm-offset-1">
					<label for="exampleInputEmail1">End Time:</label> <input
						class="form-control" id="enddate" placeholder="Select end time"
						value="">
				</div>

				<br />
				<br />
                <div class="form-group">
                     <label for="radios">Survey Type:</label>
                      <br/>
                      <label  for="radios-0">How likely would you be to recommend Qing's to friends or family?</label> 
					  <input type="radio" name="servey" id="radios-0" value="1" checked="checked"> <br/>
					  <label  for="radios-1">How knowledgeable did you find the team member?</label> 
					  <input type="radio"  name="servey" id="radios-1" value="2"> <br/>
					  <label  for="radios-2">Has the services requested been addressed?</label> 
					  <input type="radio"  name="servey" id="radios-2" value="3"><br/>
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
<script src="<?php echo base_url() ?>public/js/Comment_List.js"></script>
<script type="text/javascript">
$(document).ready(function() {     
	 $("#startdate").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#enddate").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>



