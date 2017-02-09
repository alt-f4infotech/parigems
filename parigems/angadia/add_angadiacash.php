<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   date_default_timezone_set('Asia/Kolkata');
   
   $cash="select
      sum(amount) as amount 
   from
      angadia_kitty 
   where
     txntype='CREDIT' and  status=1";
   									$cashResult1 = mysqli_query($con,$cash);
   									 while($row=mysqli_fetch_assoc($cashResult1))
   									{
   										$amount=$row['amount'];	
   									}
   									 
   									 $debitcash="select
      sum(amount) as amount 
   from
      angadia_kitty 
   where
     txntype='DEBIT' and  status=1";
   									$debitcashResult1 = mysqli_query($con,$debitcash);
   									 while($row2=mysqli_fetch_assoc($debitcashResult1))
   									{
   										$remainamount=$row2['amount'];	
   									 }
   									$cash = $amount-$remainamount;
    
   
   ?>
<section class="main-section">
<div class="container">
   <br>
   <ol class="breadcrumb"  id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="index.php">Payment</a></li>
      <li><a href="view_angadia_voucher.php">Angadia Transactions Details</a></li>
      <li class="active">Add Cash Entry</li>
   </ol>
   <form action="insertcashentry.php" method="post">
      <fieldset class="scheduler-border" >
        <center> <legend class="scheduler-border">Add Cash Entry</legend></center>
		<div class="row">
			<div class="col-sm-6">
			   <label>Current Cash in Hand :</label>
			   <input type="text" class="form-control" value=" <?php echo $cash;?>" disabled>
			</div>
			<!--<div class="col-sm-6 " >
			   <label>Date : </label>
			   <input type="text" name="date" class="form-control" value="<?php echo date("Y-m-d");  ?>">										
			</div>-->
		</div>
		 <div class="row">
			<div class="col-sm-6 ">
			   <div class="row">
				  <div class="col-sm-12 margin30" >
					 <label>Amount : </label>
					 <input type="number" name="amount" onkeypress="return IsNumeric(event);" class="form-control" required="true">
				  </div>
			    <div class="col-sm-12 margin30" >
				  <label>Angadia Account: </label>
				  <select name="accountid" id="category" class="dropdownselect2"  required>
					 <option value="">Select Account</option>
					 <?php 
						$query = "SELECT * from angadia_account where status='1'";
						$execute = mysqli_query($dbh,$query);
						while ($row = mysqli_fetch_array($execute)) {
						 echo "<option value='".$row['id']."'>".$row['accountname']."</option>";
						   }
						?>
				  </select>					
               </div>
			</div>
		 </div>
		 <div class="col-sm-6 ">
			   <label>Transaction Description : </label>
			  <textarea class="form-control" rows="5" name="notes" required="true"></textarea>
		 </div>
	  </div>
        <br>
         <div class="text-center">
            <button name="addEntry" type="submit" class="btn btn-primary">ADD ENTRY</button>
         </div>
      </fieldset>
   </form>
</div>
</section>
<?php
  include "../common/footer.php";
?>