<?php
include"../common/header.php";
$id=$_GET['id'];
$selectbankacc="SELECT * FROM `bankaccounts` where id=$id";
$result = mysqli_query($con,$selectbankacc);
 while($row=mysqli_fetch_assoc($result))
{
 $bankname=$row['bankname'];	 
 $bankbranch=$row['bankbranch'];	 
 $accountnumber=$row['accountnumber'];	 
 $accountname=$row['accountname'];	 
 $startingbalance=$row['startingbalance'];	 
 }
?>
<div class="container">
	 <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
    <li><a href="index.php">Bank Details</a></li>
    <li><a href="allbankaccounts.php">Bank Accounts</a></li>
	 <li class="active">Edit Bank Account</li>
        </ol>   
	
	<form method="post" action="editBankAccount_backend.php">
	
<center> <legend class="scheduler-border">Edit Bank Account</legend></center>
		
		<div class="row" style="margin-top:5%">
			<div class="form-group col-md-3 col-lg-2 col-xs-5 ">
				<label>Bank Name</label>
			</div>
			<div class="form-group col-md-3 col-lg-3 col-xs-7">
				<input type="text" class="form-control " value="<?php echo $bankname;?>" id="bankname" name="bankname" tabindex="1" placeholder="Bank Name"  required >
				<input type="hidden" class="form-control " value="<?php echo $id;?>" id="id" name="id" tabindex="-1" placeholder="Bank Name"  required >
			</div>
		</div>
		
		<div class="row">
			<div class="form-group col-md-2 col-lg-2 col-xs-5 ">
				<label>Account Number</label>
			</div>
			<div class="form-group col-md-3 col-lg-3 col-xs-7">
				<input type="text"  class="form-control" value="<?php echo $accountnumber;?>" name="accnumber" id="accnumber" tabindex="5" placeholder="Account Number"  required>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group col-md-2 col-lg-2 col-xs-5 ">
				<label>Account Name</label>
			</div>
			<div class="form-group col-md-3 col-lg-3 col-xs-7">
				<input type="text"  class="form-control" value="<?php echo $accountname;?>" name="accountname" id="accountname" tabindex="5" placeholder="Account Name"  required>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group col-md-2 col-lg-2 col-xs-5 ">
				<label>Bank Branch</label>
			</div>
			<div class="form-group col-md-3 col-lg-3 col-xs-7">
				<input type="text"  class="form-control" value="<?php echo $bankbranch;?>" name="bankbranch" id="bankbranch" tabindex="5" placeholder="Bank Branch"  required>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group col-md-2 col-lg-2 col-xs-5 ">
				<label>Starting Balance</label>
			</div>
			<div class="form-group col-md-3 col-lg-3 col-xs-7">
				<input type="text"  class="form-control" value="<?php echo $startingbalance;?>" name="startingbalance" id="startingbalance" tabindex="5" placeholder="Starting Balance" required>
			</div>
		</div>
		
		<div class="row">
		<button type="submit" class="btn btn-primary" value="Submit">Edit Bank Acoount</button>
	</div>
	
	</form>
</div>
 </div>
   <br>
   <br>
<?php
include "../common/footer.php";
?>
