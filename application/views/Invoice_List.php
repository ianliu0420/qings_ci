<?php require_once 'header.php'?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="Payment_List.php">Work list</a></li>
				<li class="active"><a href="index">Invoice list</a></li>
				<li><a href="graph">Invoice Graph</a></li>
			</ul>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

			<form role="form" class="form-inline" action="query" method="GET">
			    <input type="hidden" name="pageno" id="pageno" value="1">
			    <input type="hidden" name="pagesize" id="pagesize" value="10">
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
				
				<br />
				<div class="form-group">
					<label for="exampleInputEmail1">User Name:</label> <input
						class="form-control" id="username" name="username"
						placeholder="Select start time" value="<?php echo $username?>">
				</div>

				<div class="form-group col-sm-offset-1">
					<label for="exampleInputEmail1">Invoice Number:</label> <input
						class="form-control" id="invoiceno" name="invoiceno"
						placeholder="Select end time" value="<?php echo $invoiceno?>">
				</div>
				
				<br>
				<div class="form-group">
					<label for="exampleInputEmail1">Promotion code:</label> <input
						class="form-control" id="procode" name="procode"
						placeholder="Select end time" value="<?php echo $procode;?>">
				</div>
				<br />

				&nbsp;&nbsp;&nbsp;&nbsp;
				<button class="btn btn-primary" type="submit" id="searchbtn">Search</button>
			</form>

			<br>



			<h4 class="sub-header">Total should pay: <?php echo $totalPay;?></h4>
			<h4 class="sub-header">Total item: <?php echo $totalitem;?></h4>
			<div class="table-responsive">

				<table class="table table-striped">
					<thead>
						<tr>
						    <th>Invoice Number</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>should pay</th>
							<th>Real pay</th>
							<th>pay method</th>
							<th>Team</th>
							<th>Pay Date</th>
						</tr>
					</thead>
					<tbody>
	   <?php
					for($i = 0; $i < count ( $items ); $i ++) {
						  $row = $items [$i];	
						?>
	    <tr>
	                        <td> <?php echo  $row["invoiceno"];?>  </td>
							<td> <?php echo  $row["firstname"];?>  </td>
							<td>  <?php echo  $row["lastname"];?>  </td>
							<td> <?php echo  $row["shouldpay"];?>  </td>
							<td> <?php echo  $row["realpay"];?>  </td>
							<td> <?php echo  $row["paymethod"];?>  </td>
							<td>  <?php echo  "Group".$row["teamid"];?>  </td>
							<td>  <?php echo  $row["paydate"];?>  </td>
						</tr>
	
	    <?php } ?>
	    
	    </tbody>
				</table>

				<!--分页开始-->
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
				


			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'?>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/Invoice_List.js"></script>
<script type="text/javascript">
$(document).ready(function() {     
	 $("#starttime").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#endtime").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
