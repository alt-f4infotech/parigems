<?php
include "../common/header.php";
//include "databaseConnection.php";
$conn = $con;
?>
<head>
	
</head>

<?php
	
$id = $_GET['id'];

								
								$result = mysqli_query($conn,"SELECT * FROM bankdetails where id=$id");
								while ($row = mysqli_fetch_assoc($result))
								{
									$selectedid = $id;

									$date = $row['date'];
									$partyName = $row['partyName'];
									$credit = $row['credit'];
									$debit = $row['debit'];
									$transactionDescription = $row['transactionDescription'];
									
									$paymentType = $row['paymentType'];
									$chequeNo = $row['chequeNo'];
									$accountid = $row['accountid'];
									
									$result2 = mysqli_query($conn,"SELECT * FROM customer where customerid=$partyName");
								while ($row2 = mysqli_fetch_assoc($result2))
								{
								$customername = $row2['customername'];	
								}
									
								}
								
?>
<section class="main-section">
    <div class="container-fluid">
	<ol class="breadcrumb" id="breadcrumb" style="color: black">
		<li><a href="../common/homepage.php">Home</a></li>
		<li><a href="index.php">Bank Details</a></li>
		<li><a href="bankdetails.php">Bank Entries</a></li>
		<li class="active">Modify Bank Details</li>
	</ol>
	<form class="form-horizontal" action="save.php?id=<?php echo $id ?>" method="post" onsubmit="return validation();">
	    <input type="hidden" name="showDetails" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
		<fieldset class="scheduler-border" >
			<center><legend class="scheduler-border">Modify Bank Details</legend></center>
			<div class="row">
                <div class="col-sm-6">
                	<div class="form-group">
						<label class="col-sm-4 control-label">Date</label>
						<div class="col-sm-8">
							<input type="text" name="updatedDate" class="form-control datepicker" value="<?php echo date('d/m/Y',strtotime($date)); ?>" >
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<label class="col-sm-4 control-label">Party Name</label>
					<div class="col-sm-8">
						<input type="text" data-type="productname" name="updatedPartyName" class="form-control autocomplete_txt" autocomplete="off" value="<?php echo $partyName ?>" >
						<input type="hidden" name="accountid"  value="<?php echo $accountid ?>" >
						<input type="hidden" id="party_id" name="updatedParty_id" required="true">
					</div>
				</div>
			</div>
			<div class="row">
										
				<?php 
					if($credit != 0){
						echo"<div class='col-sm-6'>
								<div class='form-group'>
									<label class='col-sm-4 control-label'>Transaction Type</label>
									<div class='col-sm-8'>
										<label class='radio-inline'><input type='radio' value='credit' name='updatedTransactionType' checked>Credit</label>
										<label class='radio-inline'><input type='radio' value='debit' name='updatedTransactionType' >Debit</label>
									</div>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class='form-group'>
									<label class='col-sm-4 control-label'>Amount</label>
									<div class='col-sm-8'>
										<input type='text' value='$credit' name='updatedAmount' class='form-control'/>
									</div>
								</div>
							</div>";
					}
					else{
						echo"<div class='col-sm-6'>
								<div class='form-group'>
									<label class='col-sm-4 control-label'>Transaction Type</label>
									<div class='col-sm-8'>
										<label class='radio-inline'><input type='radio' value='debit' name='updatedTransactionType' checked  >Debit</label>
										<label class='radio-inline'><input type='radio' value='credit' name='updatedTransactionType'>Credit</label>
									</div>
								</div>
							</div>	
							<div class='col-sm-6'>
								<div class='form-group'>
									<label class='col-sm-4 control-label'>Amount</label>
									<div class='col-sm-8'>
										<input type='text' value='$debit' name='updatedAmount' class='form-control'/>
									</div>
								</div>
							</div>";
					}
				?>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-4 control-label">Payment Type</label>
						<div class="col-sm-8">
							<?php 	
								if($paymentType == "cash"){
									echo "<label class='radio-inline'><input type='radio' value='cash' id='cashno' onclick='toggel(3);' name='updatedPaymentType' checked>Cash</label>";
								}
								else{
									echo "<label class='radio-inline'><input type='radio' value='cash' id='cashno' onclick='toggel(3);' name='updatedPaymentType'>Cash</label>";
								}
								if($paymentType == "cheque"){
									echo "<label class='radio-inline'><input type='radio' value='cheque' id='chequeno' onclick='toggel(1);' name='updatedPaymentType' checked  >Cheque</label>";
								}
								else{
									echo "<label class='radio-inline'><input type='radio' value='cheque' id='chequeno' onclick='toggel(1);' name='updatedPaymentType'>Cheque</label>";
								}
								if($paymentType == "other"){
									echo "<label class='radio-inline'><input type='radio' value='other' id='other' onclick='toggel(2);' name='updatedPaymentType' checked>Other</label>";
								}
								else{
									echo "<label class='radio-inline'><input type='radio' value='other' id='other' onclick='toggel(2);' name='updatedPaymentType'>Other</label>";
								}
							?>
						</div>
					</div>						
				</div>	
			</div>
			<div class="row">
				<?php 
					if($paymentType=='other'){ ?>	
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Transaction Id</label>
							<div class="col-sm-8">
								<input type="text" id="transactionid" name="updatedChequeNumber" class="form-control" value="<?php echo $chequeNo ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Cheque Number</label>
							<div class="col-sm-8">
								<input type="text" id="updatedChequeNumber" name="updatedChequeNumber" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control" disabled>
							</div>
						</div>
					</div>
				<?php }
				else if($paymentType=='cheque'){ ?>
					<div class="col-xs-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Transaction Id</label>
							<div class="col-sm-8">
								<input type="text" id="transactionid" name="updatedChequeNumber" class="form-control" disabled>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Cheque Number</label>
							<div class="col-sm-8">
								<input type="text" id="updatedChequeNumber" name="updatedChequeNumber"  onkeypress="return IsNumeric(event);" maxlength="6" class="form-control" value="<?php echo $chequeNo ?>"  >
							</div>
						</div>
					</div>
				<?php }else if($paymentType=='cash'){ ?>
					<div class="col-xs-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Transaction Id</label>
							<div class="col-sm-8">
								<input type="text" id="transactionid" name="updatedChequeNumber" class="form-control" disabled>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<label class="col-sm-4 control-label">Cheque Number</label>
							<div class="col-sm-8">
								<input type="text" id="updatedChequeNumber" name="updatedChequeNumber" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control" disabled>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-4 control-label">Transaction Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="5" name="updatedTransactionDescription">
								<?php echo htmlspecialchars($transactionDescription);?>
							</textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 text-center">
					<button type="submit" name="modifyDetails" class="btn btn-success">MODIFY DETAILS</button>
					<!--<button type="submit" onclick="return confirm('Are you sure?');"	name="deleteDetails" class=" btn btn-danger">DELETE ENTRY</button>-->
					<button type="submit" class="btn btn-danger">Cancel</button>
				</div>
			</fieldset>
					
			</form>
			</div>
</section>
			<script>
				
				function validation()
				{
                   var cheque=document.getElementById('chequeno').checked;
                   var updatedChequeNumber=document.getElementById('updatedChequeNumber').value;
				   if (cheque==true) {
                    if (updatedChequeNumber=='' || updatedChequeNumber=='-') {
						alert('Please Enter Cheque Number');
                        return false;
                    }
                   }
                }
window.onload = function() 
	{
	document.getElementById('cashno').onchange = disablefield;
	document.getElementById('chequeno').onchange = disablefield;
	document.getElementById('other').onchange = disablefield;

	} 

function disablefield()
	{

		if ( document.getElementById('cashno').checked == true)
		{
			document.getElementById('updatedChequeNumber').disabled = true;
			document.getElementById('transactionid').disabled = true;
			document.getElementById('updatedBankName').disabled = true;
			document.getElementById('updatedBankBranch').disabled = true;
		}
		else if (document.getElementById('chequeno').checked == true )
		{
			document.getElementById('updatedChequeNumber').disabled = false;
			document.getElementById('transactionid').disabled = true;
			document.getElementById('updatedBankName').disabled = false;
			document.getElementById('updatedBankBranch').disabled = false;
			
		}
		else if (document.getElementById('other').checked == true )
		{
			document.getElementById('updatedChequeNumber').disabled = true;
			document.getElementById('transactionid').disabled = false;
			document.getElementById('updatedBankName').disabled = false;
			document.getElementById('updatedBankBranch').disabled = false;
			
		}
	}

</script>
		<script src="customer_name.js"></script>	
		<?php include "../common/footer.php"; ?>