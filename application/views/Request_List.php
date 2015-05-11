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

			<form role="form" class="form-inline" action="query" method="GET">
				<div class="form-group">
					<label for="exampleInputEmail1">Start Time:</label> <input
						class="form-control" id="startdate" name="startdate"
						placeholder="Select start time" value="<?php echo $startdate?>">
				</div>

				<div class="form-group col-sm-offset-1">
					<label for="exampleInputEmail1">End Time:</label> <input
						class="form-control" id="enddate" name="enddate" placeholder="Select end time"
						value="<?php echo $enddate?>">
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="btn btn-primary" type="submit" id="searchbtn">Search</button>
			</form>

			<br>

			<h4 class="sub-header">Search result &nbsp;&nbsp;&nbsp;  <a href="<?php echo site_url()?>/myrequest/chart"><button class="btn btn-primary">View by chart</button></a></h4>
			

			<div class="row">
				<div class="col-xs-11">

					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="col-md-2">Date</th>
									<th>User name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Message</th>
								</tr>
							</thead>
							<tbody>
							
							 <?php
								
									for($i = 0; $i < count ( $items ); $i ++) {
										$row = $items [$i];
										?>
	   						    <tr>
	   						        <td> <?php echo  $row["request_date"];?>  </td>
									<td> <?php echo  $row["user_name"];?>  </td>
									<td>  <?php echo  $row["user_email"];?>  </td>
									<td>  <?php echo  $row["user_phone"];?>  </td>
									<td>  <?php echo  $row["message"];?>  </td>
								</tr>
	
	          			 	<?php }?>
							
							</tbody>

						</table>


						<!--pagination start-->
						<ul class="pagination">
							<li <?php if(1==$currentpage){?> class="disabled" <?php }?>><a
								onclick="pageNoClick(<?php echo $currentpage-1?>,<?php echo $totalpage?>)">&laquo;</a></li>
			
			<?php for($temp=1;$temp<5&&($temp+$duan*4<=$totalpage);$temp++){?>
			<?php if($temp+$duan*4==$currentpage){?>
			  <li class="active"><a>
			       <?php echo $temp+$duan*4; ?>
			   </a></li>
			<?php }else{?>
			   <li><a
								onclick="pageNoClick(<?php echo $temp+$duan*4?>,<?php echo $totalpage;?>)">
			       <?php echo $temp+$duan*4; ?>
			   </a></li>
			<?php }} ?>
			<?php if($totalpage>($temp+$duan*4)){?>
			 <li class="disabled"><a href="javascript:;">&middot;&middot;&middot;</a></li>
			
			<?php } ?>
			<?php if($totalpage>($temp+$duan*4-1)){?>
			<li><a
								onclick="pageNoClick(<?php echo $totalpage ?>,<?php echo $totalpage?>)"><?php echo $totalpage; ?></a></li>
			<?php } ?>
			<li <?php if($totalpage==$currentpage){?> class="disabled" <?php }?>><a
								onclick="pageNoClick(<?php echo $currentpage+1?>,<?php echo $totalpage?>)">&raquo;</a></li>

						</ul>
						<!--pagination start-->

					</div>
				</div>

			</div>
		</div>
	</div>

<?php include 'footer.php'?>
<script src="<?php echo base_url() ?>public/js/Request_List.js"></script>
	<script type="text/javascript">
$(document).ready(function() {     
	 $("#startdate").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#enddate").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>