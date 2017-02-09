<?php
include"../common/header.php";
$query = "SELECT b.id,b.bankname,b.bankbranch,b.accountnumber,b.accountname,b.ifsccode,b.startingbalance,sum(d.credit)-sum(d.debit) as balance,b.empid,b.entrydate FROM bankaccounts b INNER JOIN bankdetails d where b.id=d.accountid and b.status=1 and d.Deleted='false' and b.id=".$_GET['id']." group by d.accountid";
$execute = mysqli_query($con,$query);
$row=mysqli_fetch_assoc($execute);
?>
<section class="main-section">
    <div class="container-fluid crumb_top">
	 <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
    <li><a href="index.php">Bank Details</a></li>
	 <li class="active">View Bank Details</li>
        </ol>  
		<center> <legend class="scheduler-border">View Bank Details</legend></center>
		
		<div class="row form-horizontal" style="margin-top:5%">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Bank Name</label>
					<div class="col-sm-8 control-label" style="text-align:left;">
						<?php echo $row['bankname'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Number</label>
					<div class="col-sm-8 control-label" style="text-align:left;">
						<?php echo $row['accountnumber'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">IFSC Code</label>
					<div class="col-sm-4 control-label" style="text-align: left;">
						<?php echo $row['ifsccode'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Holder Name</label>
					<div class="col-sm-8 control-label" style="text-align: left;">
						<?php echo $row['accountname'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Added Date</label>
					<div class="col-sm-8 control-label" style="text-align: left;">
						<?php echo date('d-m-Y',strtotime($row['entrydate']));?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Bank Branch</label>
					<div class="col-sm-8 control-label" style="text-align: left;">
						<?php echo $row['bankbranch'];?>
					</div>
				</div>				
				<div class="form-group">
					<label class="col-sm-4 control-label">Starting Balance</label>
					<div class="col-sm-8 control-label" style="text-align: left;">
						<?php echo $row['startingbalance'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Current Balance</label>
					<div class="col-sm-8 control-label" style="text-align: left;">
						<?php echo $row['balance'];?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Opening Date</label>
					<div class="col-sm-8 control-label" style="text-align: left;">
						<?php if($row['date']!='0000-00-00'){ echo date('d-m-Y',strtotime($row['date']));}?>
					</div>
				</div>
			</div>	
</div>
 </div>
</section>
   <br>
   <br>
<?php
include "../common/footer.php";
?>
