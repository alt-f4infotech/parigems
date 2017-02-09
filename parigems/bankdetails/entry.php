<?php
include "../common/header.php";
include "databaseConnection.php";
?>
<head>
	

	<script type="text/javascript">
		function ShowHideDiv() {
        var cheque = document.getElementById("cheque");
        var chequeNumber = document.getElementById("chequeNumber");
        chequeNumber.style.display = cheque.checked ? "block" : "none";		
    }
	
  

	</script>
	
</head>

<!------------------->
			<div class="container" style="background-color: #ffffff; margin-top: 50px;">
				 <br>
			<ol class="breadcrumb"  style="background-color:#87CEFA;color: black;">
				<li><a href="../common/homepage.php">Home</a></li>
				 <li class="active">Add Entry</li>
					  
			</ol>
			<form class="form-inline" action="save.php" method="post">
				<input type="hidden" name="addEntry" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
					<fieldset class="scheduler-border" >
					<legend class="scheduler-border">Add Entry</legend>
								
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
								<div class="col-xs-12 col-sm-4 margin30" >
										<label>Bank Name : </label>
										<select class="form-control" id="my_select" name="selectbank" onchange="send_option();" >
											<option>Select Bank</option>
											<?php $bankname = mysqli_query($conn,"SELECT * FROM bankaccounts");
											while($row = mysqli_fetch_assoc($bankname)){
												echo "<option value=".$row['id']." >". $row['bankname']."</option>";
												}
											?>
										</select>
								</div> <!-- <div class="col-xs-12 col-sm-4 margin30" >
										<label>Bank Name : </label>
										<select class="form-control" id="my_select" name="selectbank" onchange="send_option();" >
											<option>Select Bank</option>
											<?php $bankname = mysqli_query($conn,"SELECT * FROM bankaccounts");
											while($row = mysqli_fetch_assoc($bankname)){
												echo "<option value=".$row['id']." >". $row['bankname']."</option>";
												}
											?>
										</select>
								</div> <!-- --->
								<div class="col-xs-12 col-sm-4 margin30" >
										<label>Date : </label>
										<input type="date" name="date" class="form-control" required="true">										
								</div> <!-- -->
								
								
									
								<div class="col-xs-12 col-sm-4 margin30" >
										<label>Party Name : </label>
										<input type="text" name="partyName" class="form-control" required="true">
								</div> <!-- -->
								
								<div class="col-xs-12 col-sm-6 margin30"> <!-- for fieldset alignment-->
								<fieldset class="scheduler-border" >
									<legend class="scheduler-border" >Payment Type</legend>
										
											<div class="col-xs-12 col-sm-12 col-md-6">
													<div class="input-group">
													
													<input type="radio" value="cash" name="paymentType"
														   onclick="ShowHideDiv()"  aria-label="..." required="true"> cash
													
													</div><!-- /input-group -->
											</div>
									
											<div class="col-xs-12 col-sm-12 col-md-6" >
												<div class="input-group">
												
												<input type="radio" value="cheque" name="paymentType" id="cheque"
													   onclick="ShowHideDiv()" aria-label="..." required="true"> cheque
												</div><!-- /input-group -->
											</div>
																		
								</fieldset>
								</div>
								
								<div class="col-xs-12 col-sm-6 margin30"> <!-- for fieldset alignment-->
								<fieldset class="scheduler-border" >
									<legend class="scheduler-border" >Transaction Type</legend>
										<div class="col-xs-12 col-sm-12 col-md-6">
													<div class="input-group">
													<input type="radio" value="credit" name="transactionType"  aria-label="..."
													required="true" > credit
													</div><!-- /input-group -->
											</div>
									
											<div class="col-xs-12 col-sm-12 col-md-6" >
												<div class="input-group">
												<input type="radio" value="debit" name="transactionType" aria-label="..."
												required="true" > debit
												</div><!-- /input-group -->
											</div>									
								</fieldset>
								</div>
								
								<div class="col-xs-12 col-sm-12" id="chequeNumber" style="display: none"> <!-- for fieldset alignment-->
								<fieldset class="scheduler-border">
									<legend class="scheduler-border" >Bank Details</legend>
										
										
										<!--<div class="col-xs-12 col-sm-12 col-md-7 ">
													<label>Bank Name : </label>
													<input type="text" name="bankName" id="bankName" class="form-control">
											</div>
										<div class="col-xs-12 col-sm-12 col-md-5 ">
													<label>Branch : </label>
													<input type="text" name="bankBranch" class="form-control">
											</div>-->
										<div class="col-xs-12 col-sm-12 col-md-6" >
												<label>Cheque Number : </label>
												<input type="text" name="chequeNumber" class="form-control">
										</div>
										
								</fieldset>
								</div>
								
								<div class="col-xs-12 col-sm-12 col-md-6 margin30">
													<label>Amount : </label>
													<input type="text" name="amount" class="form-control" required="true">
								</div>
								
								
									
								
								
								<div class="col-xs-12 col-sm-12 col-md-6 margin30" >
								<label>Transaction Description : </label>
								<textarea class="form-control" rows="5" name="transactionDescription" required="true"></textarea>
								</div>
								
								<div class="col-xs-12">
								<button name="addEntry" type="submit" class="btn btn-primary">ADD ENTRY</button>
								</div>
									
					 </fieldset>
								
				
			</form>
			</div>


<?php
	include "../common/footer.php";
?>
