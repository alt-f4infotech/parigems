<?php
include "../common/header.php";
//include "databaseConnection.php";
?>
<head>
	<script type="text/javascript">
		function ShowHideDiv() {
        var cheque = document.getElementById("cheque");
        var chequeNumber = document.getElementById("chequeNumber");
        chequeNumber.style.display = cheque.checked ? "block" : "none";
		
		var other = document.getElementById("other");
        var otherid = document.getElementById("otherid");
        otherid.style.display = other.checked ? "block" : "none";
    }
	</script>
	
</head>
			<section class="main-section">
    <div class="container-fluid crumb_top">
			
			<ol class="breadcrumb"  id="breadcrumb" style="color: black">
				<li><a href="../common/homepage.php">Home</a></li>
				  <li><a href="index.php">Bank Details</a></li>
				 <li class="active">Add Bank Entry</li>
					  
			</ol>
			<form class="form-horizontal" action="save.php" method="post">
				<input type="hidden" name="addEntry" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
					<fieldset class="scheduler-border" >
						<center><legend class="scheduler-border">Add Bank Entry</legend></center>
								
								<!-- <div class="col-xs-12">
									<label>Current Balance : </label>
									<input type="text" class="form-control" value="
									<?php
									/*if ($currentBalance == null)
									{
										echo $currentBalance = "0";
									}
									else
									{
									echo $currentBalance;
									} */
									?> " disabled>
								</div>  end of col-xs-12 -->
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group" >
											<label class="control-label col-sm-4">Date</label>
											<div class="col-sm-8">
												<input type="text"  value="<?php echo date("d/m/Y"); ?>" max="<?php echo date("d/m/Y"); ?>" onkeypress="return false;" name="date" class="form-control datepicker" required="true">				
											</div>						
										</div> <!-- -->
									</div>
									<div class="col-sm-4">
										<div class="form-group" >
											<label class="col-sm-4 control-label">Bank Name</label>
											<div class="col-sm-8">
												<select class="dropdownselect2" id="my_select" name="selectbank" onchange="send_option();" required>
													<option value=''>Select Bank</option>
													<?php $bankname = mysqli_query($conn,"SELECT * FROM bankaccounts where status=1");
													while($row = mysqli_fetch_assoc($bankname)){
														echo "<option value=".$row['id']." >". $row['bankname']."</option>";
														}
													?>
												</select>
											</div>
										</div> <!-- -->
									</div>
									<div class="col-sm-4">
										<div class="form-group" >
											<label class="col-sm-4 control-label">Party Name</label>
											<div class="col-sm-8">
												<input type="text" data-type="productname" name="party_id" class="form-control autocomplete_txt" autocomplete="off" required="true">
											</div>	
										</div> <!-- -->
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6"> <!-- for fieldset alignment-->
										<fieldset class="scheduler-border" >
											<legend class="scheduler-border" >Payment Type</legend>
											<div class="form-group">
												<div class="col-sm-12">						
													<div class="radio-inline">
															<label>
																<input type="radio" value="cash" name="paymentType" onclick="ShowHideDiv()"  aria-label="..." required="true"> cash
															</label><!-- /input-group -->
													</div>
													
													<div class="radio-inline" >
															<label>
																<input type="radio" value="cheque" name="paymentType" id="cheque" onclick="ShowHideDiv()" aria-label="..." required="true"> cheque
															</label><!-- /input-group -->
													</div>
															
													<div class="radio-inline" >
															<label class="input-group">
																<input type="radio" value="other" name="paymentType" id="other" onclick="ShowHideDiv()" aria-label="..." required="true"> other
															</label><!-- /input-group -->
													</div>
												</div>
											</div>							
										</fieldset>
									</div>
									<div class="col-sm-6"> <!-- for fieldset alignment-->
										<fieldset class="scheduler-border" >
											<legend class="scheduler-border" >Transaction Type</legend>
											<div class="radio-inline">
												<label>
													<input type="radio" value="credit" name="transactionType"  aria-label="..." required="true" > credit
												</label><!-- /input-group -->
											</div>
										
											<div class="radio-inline">
												<label>
													<input type="radio" value="debit" name="transactionType" aria-label="..." required="true" > debit
												</label><!-- /input-group -->
											</div>									
										</fieldset>
									</div>								
								</div>
								
								
								<div class="row" id="chequeNumber" style="display: none"> <!-- for fieldset alignment-->
									<div class="col-sm-6">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border" >Bank Details</legend>
											<div class="form-group" >
												<label class="control-label col-sm-4">Cheque Number</label>
												<div class="col-sm-8">
													<input type="text" name="chequeNumber" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control">
												</div>
											</div>
												
										</fieldset>
									</div>
								</div>
								
								<div class="row" id="otherid" style="display: none"> <!-- for fieldset alignment-->
									<div class="col-sm-6">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border" >Bank Details</legend>
											<div class="form-group" >
												<label class="control-label col-sm-4">Transaction Id</label>
												<div class="col-sm-8">
													<input type="text" name="chequeNumber2" class="form-control">
												</div>
											</div>
												
										</fieldset>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-sm-4 control-label">Amount</label>
											<div class="col-sm-8">
												<input type="text" name="amount"  onkeypress="return IsNumeric(event);" class="form-control" required="true">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" >
											<label class="col-sm-4 control-label">Transaction Description</label>
											<div class="col-sm-8">
												<textarea class="form-control" rows="5" name="transactionDescription" required="true"></textarea>
											</div>
										</div>
									</div>
								</div>								
								
								<div class="row">
									<div class="col-xs-12 text-center">
										<button name="addEntry" type="submit" class="btn btn-primary">ADD ENTRY</button>
									</div>
								</div>
									
					 </fieldset>
								
				
			</form>
			</div>
			<script src="customer_name.js"></script>
			 </div>
			</section>
   <br>
   <br>
<?php
include "../common/footer.php";
?>
			

