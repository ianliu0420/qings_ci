<?php require_once 'header.php'?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				
				<li class="active"><a href="query">Promotion Code Management</a></li>
				<li><a href="dispadd">New Promotion Code</a></li>
			</ul>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

		    <form role="form" class="form-inline">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Start Time:</label>
			    <input  class="form-control" id="startdate" placeholder="Select start time" value="<?php echo $startdate?>">
			  </div>
			  
			   <div class="form-group col-sm-offset-1">
			    <label for="exampleInputEmail1">End Time:</label>
			    <input class="form-control" id="enddate" placeholder="Select end time" value="<?php echo $enddate?>">
			   </div>
			   
			    &nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn btn-primary" type="button" id="searchbtn">Search</button>   
		    </form>
		    <br>
			  
		
			<h4 class="sub-header">Search result</h4>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Promotion code</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Type</th>
							<th>Persent</th>
							<th>amount</th>
							<th>Notes</th>
						</tr>
					</thead>
					<tbody>
	        <?php
				
					for($i = 0; $i < count ( $items ); $i ++) {
									$row = $items [$i];
						?>
	            <tr>
							<td> <?php echo  $row["np_code"];?>  </td>
							<td>  <?php echo  $row["np_startdate"];?>  </td>
							<td>  <?php echo  $row["np_enddate"];?>  </td>
							<td>  <?php echo  $row["np_type"];?>  </td>
							<td>  <?php echo  $row["np_percent"];?>  </td>
							<td>  <?php echo  $row["np_amount"];?>  </td>
							<td>  <?php echo  $row["np_notes"];?>  </td>
							<td><a href="getById?np_id=<?php echo $row["np_id"];?>"><button class="btn  btn-primary">Edit</button></a>
							<td><a target="_blank" href="<?php echo site_url('invoice/query?procode='.$row["np_code"]."&pageno=1&pagesize=10")?>"><button class="btn  btn-primary">Detail</button></a>
							</td>
				</tr>
	    <?php }
	    ?>
	    </tbody>
				</table>
	
          </div>
		</div>
	</div>
</div>

<?php include 'footer.php'?>
<script src="<?php echo base_url() ?>public/js/Pro_NewCode_List.js"></script>
<script type="text/javascript">
$(document).ready(function() {     
	 $("#startdate").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#enddate").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

