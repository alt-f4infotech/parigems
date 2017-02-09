<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   date_default_timezone_set('Asia/Kolkata');
   
   $cash="select
      sum(amount) as amount 
   from
      kitty 
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
      kitty 
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
      <li><a href="view_debit_voucher.php">Cash in Hand Details</a></li>
      <li class="active">Add Cash Entry</li>
   </ol>
   <form class="" action="addCashentry.php" method="post">
      <fieldset class="scheduler-border" >
        <center> <legend class="scheduler-border">Add Cash Entry</legend></center>
         <div class="col-xs-12">
            <label>Current Cash in Hand :</label>
            <input type="text" class="form-control" value=" <?php echo $cash;?>" disabled>
         </div>
         <!-- end of col-xs-12 -->
         <div class="col-xs-12 col-sm-6 " >
            <label>Date : </label>
            <input type="text" name="date" class="form-control datepicker" value="<?php echo date("d/m/Y");  ?>">										
         </div>
        
         <div class="col-xs-12 col-sm-12 col-md-6 ">
            <label>Amount : </label>
            <input type="number" name="amount" onkeypress="return IsNumeric(event);" class="form-control" required="true">
         </div>
		 
		 
		 <div class="col-xs-12 col-sm-12 col-md-6 ">
            <label>Transaction Description : </label>
           <textarea class="form-control" rows="5" name="notes" required="true"></textarea>
         </div>
        <br>
         <div class="col-xs-12">
            <button name="addEntry" type="submit" class="btn btn-primary">ADD ENTRY</button>
         </div>
      </fieldset>
   </form>
</div>
</section>
<div class="modal fade" id="myModal1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <form action="debitcategory.php" method="post">
               <label>Catergory Name : </label>
               <input type="text" name="categoryname" class="form-control" placeholder="category name" required="true">
               <label>Catergory Description : </label>
               <input type="text" name="description" class="form-control" placeholder="category description" required="true">
               <button  type="submit">ADD</button>
               <button type="reset">Reset</button>
            </form>
         </div>
      </div>
   </div>
</div>

<?php

   include "../common/footer.php";
   
   ?>