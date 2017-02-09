<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   
?>
<section class="main-section">
<div class="container-fluid">
   <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Payment</li>
   </ol>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
      <a href="payment_receipt.php" class="thumbnail" >
      <img src="../images/CREATE_PAYMENT_CUSTOMER.png" alt="...">
      </a>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
      <a href="view_payment_receipt.php" class="thumbnail" >
      <img src="../images/VIEWPAYMENT_CUSTOMET.png" alt="...">
      </a>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
      <a href="create_debit_voucher.php" class="thumbnail" >
      <img src="../images/CREATE_DEBIT_PURCHASERS.png" alt="...">
      </a>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
      <a href="view_debit_party.php" class="thumbnail" >
      <img src="../images/VIEWDEBIT_PURCHASER.png" alt="...">
      </a>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
            <a href="view_debit_voucher.php" class="thumbnail" >
            <img src="../images/CASH IN HAND.png" alt="...">
            </a>
         </div>
</div>
</section>
<?php
   include "../common/footer.php";
?>