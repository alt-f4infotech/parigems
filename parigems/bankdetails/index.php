<?php
ob_start();
error_reporting(0);
session_start();
include "../common/header.php";

?>

<style>
    .vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 90vh; /* These two lines are counted as one :-)       */
  margin: 0px;
  padding: 0px;

  display: flex;
  align-items: center;
  

}
</style>
<section class="main-section">
<div class="container crumb_top">
 
	 <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
	 <li class="active">Bank Details</li>
        </ol>
		
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
        <a href="addBankAccount_frontend.php" class="thumbnail" >
         <img src="../images/ADD BANK ACCOUNT.png" alt="...">
        </a>
    
    </div>
    

    
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
        <a href="allbankaccounts.php" class="thumbnail">
        <img src="../images/SHOW ALL BANK ACOUNT.png" alt="...">
        </a>
         <!--<h3><center> View All Bank Accounts</center></h3>-->
    </div>
    
	
   
    
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
        <a href="addEntry.php" class="thumbnail">
         <img src="../images/ADD BANK ENTRY.png" alt="...">
        </a>
         <!--<h3><center> Create Bank Account</center></h3>-->
    </div>
   
    
    
	 <div class="col-xs-12 col-sm-12 col-md-3 col-lg-6">
        <a href="bankdetails.php" class="thumbnail" >
       <img src="../images/SHOW ALL BANK ENTRIES.png" alt="...">
        </a>
         <!--<h3><center> View All Bank Enteries</center></h3>-->
    </div>
	 
    </div> <!--end of container-->
</section>



<?php
include "../common/footer.php";
?>

