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

			<form class="form-horizontal" id="newProCodeForm" name="newProCodeForm">
				<fieldset>

					<!-- Form Name -->
					<legend>Edit promotion code</legend>

					 <input type="hidden" id="np_id" class="btn btn-primary" value="<?php echo $row['np_id'];?>"></input>
					
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="textinput">Promotion Code</label>
						<div class="col-md-3">
							<input id="np_code" name="np_code" type="text"
								placeholder="code" class="form-control input-md" value="<?php echo $row['np_code'];?>"> 
						</div>
						<div class="col-md-1">
						    <input type="button" id="genBtn" class="btn btn-primary" value="Generate"></input>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="textinput">Promotion start time</label>
						<div class="col-md-4">
							<input id="starttime" name="starttime" type="text"
								placeholder="start date" class="form-control input-md" value="<?php echo $row['np_startdate'];?>"> 
						</div>
					</div>
					
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="textinput">Promotion end time</label>
						<div class="col-md-4">
							<input id="endtime" name="endtime" type="text"
								placeholder="end date" class="form-control input-md" value="<?php echo $row['np_enddate'];?>"> 
						</div>
					</div>
					
					
					<div class="form-group">
					  <label class="col-md-4 control-label" for="radios">Inline Radios</label>
					  <div class="col-md-4"> 
					    <label class="radio-inline" for="radios-0">
					      <input type="radio" name="np_type" id="np_type_percent" value="1" 
					      <?php if($row['np_type']==1){?>checked="checked" <?php }?>>
					      By Percentage
					    </label> 
					    <label class="radio-inline" for="radios-1">
					      <input type="radio" name="np_type" id="np_type_amount" value="2"  
					      <?php if($row['np_type']==2){?>checked="checked" <?php }?>>
					      By Amount
					    </label> 
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group" id="percentDiv" <?php if($row['np_type']==2){?>style="display:none" <?php }?>>
						<label class="col-md-4 control-label" for="textinput">Percentage Rate</label>
						<div class="col-md-4">
							<input id="np_percent" name="np_percent" type="text" value="<?php echo $row['np_percent']?>"
								placeholder="percentage rate" class="form-control input-md"> 
						</div>
					</div>
					
					<!-- Text input-->
					<div class="form-group" id="amountDiv" <?php if($row['np_type']==1){?>style="display:none" <?php }?>>
						<label class="col-md-4 control-label" for="textinput">Amount</label>
						<div class="col-md-4">
							<input id="np_amount" name="np_amount" type="text"
								placeholder="amount" value="<?php echo $row['np_amount']?>" class="form-control input-md"> 
						</div>
					</div>
					
					<!-- Textarea -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="textarea">Notes</label>
					  <div class="col-md-4">                     
					    <textarea class="form-control" id="np_notes" name="np_notes"><?php echo $row['np_notes']?> </textarea>
					  </div>
					</div>
					
					<div class="form-group">
					  <label class="col-md-4 control-label" for="textarea"></label>
					  <div class="col-md-4">                     
					    <input type="button"class="btn btn-primary" id="formSubmit" value="Submit"></input> 
					  </div>
					</div>
					
				</fieldset>
			</form>
					
			


		</div>
	</div>
</div>

<?php include 'footer.php'?>
<script src="<?php echo base_url() ?>public/js/Pro_NewCode_Add.js"></script>
<script type="text/javascript">
$(document).ready(function() {     
	 $("#starttime").datepicker({ dateFormat: 'yy-mm-dd' });
	 $("#endtime").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

