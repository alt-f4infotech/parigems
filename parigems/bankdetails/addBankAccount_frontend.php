<?php
include"../common/header.php";
?>
<section class="main-section">
    <div class="container-fluid crumb_top">
	 <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
    <li><a href="index.php">Bank Details</a></li>
	 <li class="active">Add Bank Account</li>
        </ol>   
	
	<form method="post" action="addBankAccount_backend.php" class="form-horizontal">
	
<center> <legend class="scheduler-border">Add Bank Account</legend></center>
		
		<div class="row" style="margin-top:5%">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Bank Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control " id="bankname" name="bankname" tabindex="1" placeholder="Bank Name"  required >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Number</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" onkeypress="return IsNumeric(event);"  name="accnumber" id="accnumber" tabindex="5" placeholder="Account Number"  required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">IFSC Code</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control"  name="ifsccode" id="ifsccode" tabindex="5" placeholder="IFSC Code"  required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4">Account Holder Name</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" name="accountname" id="accountname" tabindex="5" placeholder="Account Holder Name"  required>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-sm-4">Bank Branch</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" name="bankbranch" id="bankbranch" tabindex="5" placeholder="Bank Branch"  required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Opening Date</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control datepicker" name="opendate" max="<?php echo date("d/m/Y"); ?>"  id="opendate" tabindex="6" placeholder="A/c Opening date" >
					</div>
				</div>				
				<div class="form-group">
					<label class="col-sm-4 control-label">Starting Balance</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" name="startingbalance"  onkeypress="return IsNumeric(event);"  id="startingbalance" tabindex="7" placeholder="Starting Balance" required>
					</div>
				</div>
			</div>
		</div>			
		
		<div class="text-center">
			<button type="submit" class="btn btn-primary" value="Submit">Add Bank Acoount</button>
			<button type="reset" class="btn btn-success" value="Reset">Reset</button>
		</div>
	
	</form>
</div>
 </div>
</section>
   <br>
   <br>
<?php
include "../common/footer.php";
?>
