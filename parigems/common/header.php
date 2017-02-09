<?php
ob_start();
session_start();
error_reporting(0);
include '../common/config.php';
date_default_timezone_set("Asia/Kolkata");
$role = $_SESSION['role'];

   /*if($role=='SUBADMIN')
   {$role='ADMIN';}else{$role=$role;}*/
   if($role=='')
   {
   	header('Location: ../common/index.php');
   }
   $username = $_SESSION['username'];
   if($role=='GUEST')
   {
   	$username=$role;
   }
   $userid = $_SESSION['userid'];

   $getlastlogin="select * from user_log where userid=$userid and action='login' and comments='USER'";
   $logresult=mysqli_query($con,$getlastlogin);
   while($l=mysqli_fetch_assoc($logresult))
   {
   	$lastloginentry=$l['timestamp'];
   }
   $getlastlogin1="select * from user_log where userid=$userid and action='login' and (comments='USER' OR comments='ADMIN') and timestamp!='$lastloginentry'";
   $logresult1=mysqli_query($con,$getlastlogin1);
   while($l1=mysqli_fetch_assoc($logresult1))
   {
   	$lastlogin=$l1['timestamp'];
   }

   $usernotifycount=0;
   $getusernotification="select n.* from  notification n,notification_user nu where nu.userid='$userid' and n.status='1' and nu.notificationid=n.id and nu.status='1'";
   $result1=mysqli_query($con,$getusernotification);
   while($row=mysqli_fetch_assoc($result1))
   {
   	$usernotifycount++;
   }
   
   $today=date("Y-m-d");
   $adminnotifycount=0;
   $getadminnotification="select n.* from  notification n,notification_user nu where nu.userid='$userid' and n.status='1' and nu.notificationid=n.id and nu.status='1'";
   $adminresult1=mysqli_query($con,$getadminnotification);
   while($arow=mysqli_fetch_assoc($adminresult1))
   {
   	$reminderdate0=explode(' ',$arow['reminderdate']);
   	if($reminderdate0[0] <= $today)
   	{
   		$purchase_invoiceno=$arow['purchase_invoiceno'];

   		$querypurchase="SELECT p.*,pt.* FROM purchaseinvoice p, party pt where  p.partyid=pt.partyid and p.purchase_invoiceid='$purchase_invoiceno'";
   		$result = mysqli_query($con,$querypurchase);
   		$row=mysqli_fetch_assoc($result);

   		$paymentinvoice="select sum(amount) as amount from debit_voucher where invoiceno='$purchase_invoiceno' and status='1'";
   		$receiptres=mysqli_query($con,$paymentinvoice);
   		if(mysqli_num_rows($receiptres) > 0 ){
   			$payrow=mysqli_fetch_assoc($receiptres);
   			$paidamount=$payrow['amount'];
   		}

   		if($purchase_invoiceno!='')
   		{
   			$balance=$row['total']-$paidamount;
   			$info='<br>Type : Purchase Reminder<br>Party: '.$row['companyname'].'<br>Invoice Number: PI-'.$row['invoiceno'].'<br>Balance Amount:'.sprintf("%.2f",$balance);
   		}else{$info='';}
   		if($purchase_invoiceno!='')
   		{
   			if($balance!='0.00')
   			{
   				$adminnotifycount++;
   			}
   		}
   		else{
   			$adminnotifycount++;
   		}
   	}
   }

   if($role=='USER'){
   	$getEmployeeName=mysqli_query($con,"select b.* from employee_user e,basic_details b where e.userid='$userid' and e.employeeId=b.userid and e.status='1'");
   	if(mysqli_num_rows($getEmployeeName) > 0)
   	{
   		$empRow=mysqli_fetch_assoc($getEmployeeName);
   		$employeeName=$empRow['username'];
   		$employeeNumber=$empRow['phoneno'];
   		$employeeEmail=$empRow['emailid'];
   	}
   }
        //$removetHoldedcart=mysqli_query($con,"delete from `add_to_cart_hold` where userid='$userid' and wishstatus='1'");
        //$removetWatchListcart=mysqli_query($con,"delete from `add_to_cart_wishlist` where userid='$userid' and wishstatus='1'");    
   $removetTempCart=mysqli_query($con,"delete from `add_to_cart_temp` where userid='$userid'");     

   ?>
   <!DOCTYPE html>
   <html>
   <head>
   	<meta charset="utf-8">	
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<link href="../css/animsition.min.css" rel="stylesheet">
   	<link rel="stylesheet" type="text/css" href="../css/animate.css">
   	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
   	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
   	<!--datepicker--><link rel="stylesheet" href="../css/datepicker.css"><!--datepicker-->
   	<link rel="stylesheet" type="text/css" href="../css/jcarousel.responsive.css">
   	<link rel="stylesheet" type="text/css" href="../css/parigems.css">
   	<link rel="stylesheet" type="text/css" href="../css/responsive.css"/>
   	<!--<link rel="stylesheet" type="text/css" href="../css/loginstyle.css"/>-->
   	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

   	<link rel="stylesheet" href="../assets/bootstrap-table/src/bootstrap-table.css">
   	<link href="../css/select2.css" rel="stylesheet"/>
   	<script src="../assets/jquery.min.js"></script>
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   	<script src="http://demo.phpgang.com/html-select-box-searching-support-jquery/select2.js"></script>
   	<script type="text/javascript" src="../libs/jsPDF/jspdf.min.js"></script>
   	<script type="text/javascript" src="../libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
   	<script type="text/javascript" src="../libs/html2canvas/html2canvas.min.js"></script>
   	<script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
   	<script src="../assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
   	<script src="../assets/tableExport.js"></script>
   	<script src="../assets/ga.js"></script>
   	<script src="../js/location.js"></script>
   	<!-- <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'> -->
   	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
   	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
   	<script type="text/javascript" src="../js/bootstrap.min.js"></script>



   	<!--<link href="../css/demo-page.css" rel="stylesheet" media="all">-->
   	<link href="../css/hover.css" rel="stylesheet" media="all">
   	<script src="../js/animsition.min.js" charset="utf-8"></script>
   	<!--datepicker--><script src="../js/bootstrap-datepicker.js"></script><!--datepicker-->
   	<!--<script src="../js/search.js" charset="utf-8"></script>-->
   	<script src="../js/calculation.js" charset="utf-8"></script>
   	<script src="../js/optionvalidation.js" charset="utf-8"></script>
   	<script src="../js/bootbox.min.js"></script>
   	<script src="../js/notify.min.js"></script>
   	    <script src="../js/bootstrap-table.min.js"></script>

   	<script type="text/javascript">
   		$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");

	});
</script>
</head>

<?php
if($role=='GUEST')
{
	?>
	<style type="text/css">
		#home,#stock,#report,#payment,#viewcart,#purchase,#myprofile,#password,#carttatble,#buttondiv,#hideguest,#superadmin,#dummy{
			display:none;
		}
	</style>
	<?php
}
if($role=='EMPLOYEE')
{
	?>
	<style type="text/css">
		#home,#stock,#report,#payment,#viewcart,#purchase,#carttatble,#buttondiv,#hideguest,#superadmin{
			display:none;
		}
	</style>
	<?php
}
if($role=='USER')
{
	?>
	<style type="text/css">
		#search,#viewcart{
			display:block;
		}
		#stock,#report,#payment,#purchase,#superadmin,#dummy{
			display:none;
		}
	</style>
	<?php
}
if($role=='ADMIN' || $role=='SUBADMIN')
{
	?>
	<style type="text/css">
		#search,#viewcart,#superadmin{
			display:none;
		}
		#home,#stock,#report,#payment{
			display:block;
		}
	</style>
	<?php
}
if($role=='SUPERADMIN')
{
	?>
	<style type="text/css">
		#search,#viewcart{
			display:none;
		}
		#home,#stock,#report,#payment{
			display:block;
		}
	</style>
	<?php
}
if($role=='ADJUST')
{
	?>
	<style type="text/css">
		#search,#viewcart,#stock,#report,#payment,#purchase{
			display:none;
		}
		#dummy{
			display:block;
		}
	</style>
	<?php
} 
?>
<body>
	<div class="se-pre-con"></div>
	<div class="">
		<!-- start header -->
		<header class="hidden-print">

			<nav class="navbar navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="../common/homepage.php"   tabindex="-1">
							<img class="img-responsive navbrandlogo animated swing" width="250px" src="../images/parigem_logo.png">
						</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="home "><a href="../common/homepage.php" data-toggle="tooltip" data-placement="bottom" title="Home" id="home" tabindex="-1">Home</a></li>

							<li class="dropdown wel-user" >
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="viewcart" tabindex="-1">Search
									<span class="caret "></span>
								</a>
								<ul class="dropdown-menu user_single">
									<li><a href="../search/search.php" tabindex="-1">Single Diamond</a></li>
									<!--<li><a href="../search/matching_pair.php" tabindex="-1">Matching Pair</a></li>-->
								</ul>
							</li>
							<li class="dropdown wel-user" >
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="viewcart" tabindex="-1">My Account
									<span class="caret "></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="../search/mydemand.php" id="viewcart" tabindex="-1">My Demand</a></li>
									<li><a href="../search/wishlist.php" id="viewcart" tabindex="-1">My Watchlist</a></li>
									<li><a href="../search/holded.php" id="viewcart" tabindex="-1">My Holded Diamonds</a></li>
									<li><a href="../search/viewcart.php" id="viewcart" tabindex="-1">My Cart</a></li>
									<li><a href="../search/historyorder.php" id="viewcart" tabindex="-1">My Order History</a></li>
									<li><a href="../report/myledger.php" id="viewcart" tabindex="-1">My Ledger</a></li>
									<!--<li><a href="../search/historyorder.php" id="viewcart" tabindex="-1">My Order History</a></li>-->
								</ul>
							</li>

					      <!--<li><a href="../search/viewcart.php"  tabindex="-1">View Cart</a></li>
					      <li><a href="../search/wishlist.php" id="viewcart" tabindex="-1">View Watchlist</a></li>
					      <li><a href="../search/holded.php" id="viewcart" tabindex="-1">View Holded Items</a></li>
					      <li><a href="../search/mydemand.php" id="viewcart" tabindex="-1">My Demand</a></li>-->
					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="stock" tabindex="-1">Diamond
					      		<span class="caret "></span>
					      	</a>
					      	<ul class="dropdown-menu">
					      		<li><a href="../diamond_upload/diamond.php" id="stock" tabindex="-1">Upload Diamond</a></li>
					      		<li><a href="../search/search.php" id="stock" tabindex="-1">Search Diamond</a></li>
					      		<li><a href="../report/viewalldiamonds.php" id="stock" tabindex="-1">View All Diamond</a></li>
					      		<li><a href="../report/holddiamonds.php" id="stock" tabindex="-1">View Holded Diamond</a></li>
					      	</ul>
					      </li>
					      <!--<li><a href="../stock/stock.php" id="stock" tabindex="-1">Stock</a></li>-->

					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="payment" tabindex="-1">Payment
					      		<span class="caret "></span>
					      	</a>
					      	<ul class="dropdown-menu">
					      		<li><a href="../payment/payment_receipt.php" id="payment" tabindex="-1">Create Payment Receipt</a></li>
					      		<li><a href="../payment/create_debit_voucher.php" id="payment" tabindex="-1">Create Debit Voucher</a></li>
					      		<li><a href="../payment/view_debit_voucher.php" id="payment" tabindex="-1">Cash In Hand</a></li>
					      		<li><a href="../payment/view_payment_receipt.php" id="payment" tabindex="-1">View All Payment Receipt</a></li>
					      		<li><a href="../payment/view_debit_party.php" id="payment" tabindex="-1">View All Debit Voucher</a></li>
					      		<li><a href="../bankdetails/index.php" id="payment" tabindex="-1">Bank</a></li>
					      	</ul>
					      </li>

					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="payment" tabindex="-1">Angadia
					      		<span class="caret "></span>
					      	</a>
					      	<ul class="dropdown-menu">
					      		<li><a href="../angadia/angadia_payment_receipt.php" id="payment" tabindex="-1">Deposit Entry</a></li>
					      		<li><a href="../angadia/angadia_debit_voucher.php" id="payment" tabindex="-1">Expense Entry</a></li>
					      		<li><a href="../angadia/angadia_account.php" id="payment" tabindex="-1">View All Accounts</a></li>
					      		<li><a href="../angadia/view_angadia_voucher.php" id="payment" tabindex="-1">View All Transactions</a></li>
					      		<li><a href="../angadia/view_alldeposit.php" id="payment" tabindex="-1">View All Deposit Entry</a></li>
					      		<li><a href="../angadia/view_allexpense.php" id="payment" tabindex="-1">View All Expense Entry</a></li>
					      	</ul>
					      </li>

					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="dummy" tabindex="-1">Purchase <span class="caret "></span></a>
					      	<ul class="dropdown-menu">
					      		<li><a href="#" data-toggle="modal" data-target="#invoicemodal"  tabindex="-1" id="purchase">Purchase Entry</a></li>
					      		<li><a href="../purchase/viewallpurchase.php" id="purchase" tabindex="-1">View All Purchase Invoice</a></li>
					      		<li><a href="../purchase/addparty.php"  tabindex="-1">Add Party</a></li>
					      		<li><a href="../purchase/viewallparty.php" id="purchase" tabindex="-1">View All Party</a></li>
					      		<li><a href="../purchase/addlocation.php"  tabindex="-1">Add Location</a></li>
					      		<li><a href="../purchase/viewlocation.php" id="purchase" tabindex="-1">View All Location</a></li>
					      		<li><a href="#" data-toggle="modal" data-target="#dummyPurchaseInvoiceModal"  tabindex="-1" id="dummy">Create Dummy Purchase Invoice</a></li>
					      		<li><a href="../dummy_purchase/viewallDummypurchase.php" tabindex="-1" id="dummy">View Dummy Purchase Invoice</a></li>
					      	</ul>
					      </li>
					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="dummy" tabindex="-1">Sale <span class="caret "></span></a>
					      	<ul class="dropdown-menu">
					      		<li><a href="../saleinvoice/index.php" id="purchase">Sale Invoice</a></li>
					      		<li><a href="../saleinvoice/viewallsaleinvoice.php" tabindex="-1" id="purchase">View Sale Invoice</a></li>
					      		<li><a href="#" data-toggle="modal" data-target="#saleInvoiceModal"  tabindex="-1" id="dummy">Create Dummy Sale Invoice</a></li>
					      		<li><a href="../saleinvoice/viewallDummysaleinvoice.php" tabindex="-1" id="dummy">View Dummy Sale Invoice</a></li>
					      		<li><a href="../saleinvoice/createSaleinvoiceManual.php" tabindex="-1" id="dummy">Create Manual Sale Invoice</a></li>
					      		<li><a href="../saleinvoice/viewallSaleinvoiceManual.php" tabindex="-1" id="dummy">View Manual Sale Invoice</a></li>
					      	</ul>
					      </li>
					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="report" tabindex="-1">Reports
					      		<span class="caret "></span>
					      	</a>
					      	<ul class="dropdown-menu">
					      		<li><a href="../stock/vieworder.php" id="report" tabindex="-1">All Orders</a></li>
					      		<li><a href="../report/customer_ledger.php" id="report" tabindex="-1">Customer Ledger</a></li>
					      		<li><a href="../report/purchaser_ledger.php" id="report" tabindex="-1">Purchaser Ledger</a></li>
					      		<li><a href="../admin/notification.php" id="report" tabindex="-1">Notification Panel</a></li>
					      		<li><a href="../admin/myreminder.php" id="report" tabindex="-1">My Reminder</a></li>
					      		<li><a href="../report/diamond_report.php" id="report" tabindex="-1">Diamond Report</a></li>
					      		<li><a href="../report/sale_report.php" id="report" tabindex="-1">C.A Sales Report</a></li>
					      		<li><a href="../report/purchase_report.php" id="report" tabindex="-1">C.A Purchase Report</a></li>
					      		<li><a href="../report/noneDiamond.php" id="report" tabindex="-1">Non Purchased Diamond Report</a></li>
					      		<li><a href="../report/todaysOrders.php" id="report" tabindex="-1">Today's Orders</a></li>
					      		<li><a href="../report/diamond.php" id="report" tabindex="-1">Diamonds</a></li>
					      		<li><a href="../report/saleInvoiceReport.php" id="report" tabindex="-1">Sale Invoice Report</a></li>
					      		<li><a href="../report/purchaseInvoiceReport.php" id="report" tabindex="-1">Purchase Invoice Report</a></li>
					      		<li><a href="../report/userAssign.php" id="report" tabindex="-1">Assign Users</a></li>
					      		<li><a href="../report/viewAllAssignedUser.php" id="report" tabindex="-1">View Assigned Users</a></li>
					      		<li><a href="../report/viewDiscountHistory.php" id="report" tabindex="-1">View Discount History</a></li>
					      		<li><a href="../report/pendingPurchase.php" id="report" tabindex="-1">Purchase Pending Delivery</a></li>
					      		<li><a href="../report/userInformation.php" id="report" tabindex="-1">User's Watchlist/Cart</a></li>
					      		<li><a href="../report/updateDiscount.php" id="report" tabindex="-1">Update Discount</a></li>
					      	</ul>
					      </li>

					      <!--<li  ><a href="../pricelist/index.php" id="stock" tabindex="-1">Pricelist</a></li>-->
					      <!--<li  ><a href="../bankdetails/" id="payment" tabindex="-1">Bank</a></li>-->
					      

					      <?php if($role=='EMPLOYEE' || $role=='ADMIN'|| $role=='SUBADMIN'){?>
					      <li class="dropdown wel-user">
					      	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"  tabindex="-1">Options<span class="caret "></span></a>
					      	<ul class="dropdown-menu">
					      		<li><a href="#" data-toggle="modal" data-target="#calculator"  tabindex="-1">Rap Calculator</a></li>
					      		<li><a href="../search/raptable.php">Raptable</a></li>
					      		<li><a href="../upload/shape.php">Shapes</a></li>
					      		<li><a href="../upload/certificate.php">Certificates</a></li>
					      		<li><a href="../upload/cps.php">CPS</a></li>
					      		<li><a href="../upload/keysymbol.php">Key to Symbol</a></li>
					      		<li><a href="../upload/color.php">Color</a></li>
					      		<li><a href="../upload/fcolor.php">Fancy Color</a></li>
					      		<li><a href="../upload/fcolorint.php">Fancy Color Intensity</a></li>
					      		<li><a href="../upload/fcolorover.php">Fancy Color Overtone</a></li>
					      		<li><a href="../upload/tinge.php">Tinge</a></li>
					      		<li><a href="../upload/fluro.php">Fluorescence</a></li>
					      		<li><a href="../upload/clarity.php">Clarity</a></li>
					      		<li><a href="../upload/culet.php">Culet</a></li>
					      		<li><a href="../upload/blck.php">Black Inclusion</a></li>
					      		<li><a href="../upload/milky.php">Milky</a></li>
					      		<li><a href="../upload/girdlem.php">Girdle Min/Max</a></li>
					      		<li><a href="../upload/girdle.php">Girdle</a></li>
					      		<li><a href="../upload/incl.php">Inclusion Visibility</a></li>
					      		<li><a href="../upload/brown.php">Brown Inclusion</a></li>
					      	</ul>
					      </li>
					      <?php  } ?>
					      <?php if($role=='USER'){
					      	if($usernotifycount > 0){ /*$animationClass='animated infinite bounce';*/}
					      	else{ $animationClass='';}
					      	?>
					      	<li>
					      		<a href="#" data-toggle="modal" data-target="#usernotificationmodal"  tabindex="-1" title="Notification" id='hideguest'>
					      		<span class="badge notify <?php echo $animationClass;?>">
					      			<i class="fa fa-bell fa-lg"></i><?php echo $usernotifycount;?>
					      		</span>
					      	</li>
					      	<?php } ?>
					      	<?php if($role!='USER'){
					      		if($adminnotifycount > 0){ /*$animationClassAdmin='animated infinite bounce';*/}
					      		else{ $animationClassAdmin='';}
					      		?>
					      		<li>
					      			<a href="#" data-toggle="modal" data-target="#adminnotificationmodal"  tabindex="-1" title="Notification" id='hideguest'>
					      				<span class="badge notify <?php echo $animationClassAdmin;?>"> 
					      					<i class="fa fa-bell fa-lg"></i><?php echo $adminnotifycount;?>
					      				</span>
					      		</li>
					      		<?php } ?>

					      		<li class="dropdown wel-user margint_responsive">					 
					      			<a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" tabindex="-1">Hi <?php echo $username; ?> <span class="caret "></span></a>
					      			<ul class="dropdown-menu">
									<li><a href="../common/myprofile.php" id="viewcart" tabindex="-1">My Profile</a></li>
					      				<li><a href="../common/changepasswordfront.php" id="password" tabindex="-1">Change Password</a></li>

					      				<li id="report"><a href="../common/export.php" tabindex="-1" >Data Backup</a></li>
					      				<li><a href="../common/logout.php" tabindex="-1">Logout</a></li>
					      			</ul>
					      		</li>
				  <!--<li>
						<label style="font-size: 8px;">Associated Employee:</label> <?php echo $employeeName;?><br>
	<label style="font-size: 8px;">Employee Number: <?php echo $employeeNumber;?></label><br>
	<label style="font-size: 8px;">Employee Email Id: <?php echo $employeeEmail;?></label><br>
</li>-->
</ul>
</div><!--/.nav-collapse -->
</div><!--/.container-fluid -->
</nav>
</header>
<!-- end header -->
<div class="modal fade" id="adminnotificationmodal" role="dialog">
	<div class="modal-dialog"  style="width: 94%;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" align="center">Notifications</h4>
			</div>
			<div class="modal-body">
				<?php
				if(($usernotifycount) > 0)
					{?>
				<div class="row">
					<div class="col-sm-4 col-xs-4"><b>Message</b></div>
					<div class="col-sm-3 col-xs-3"><b>Sent By</b></div>
					<div class="col-sm-2 col-xs-2"><b>Date</b></div>
					<div class="col-sm-3 col-xs-3"><b>Close</b></div>
				</div><hr>
				<div id="notifydivadmin">
					<?php
					$getadminnotificationall="select n.*,nu.nid,l.username,n.reminderdate from  notification n,notification_user nu,login l where l.userid=n.userid and nu.userid='$userid' and n.status='1' and nu.notificationid=n.id and nu.status='1'  order by nu.notificationid DESC";
					$adminresultall1=mysqli_query($con,$getadminnotificationall);
					while($adrow2=mysqli_fetch_assoc($adminresultall1))
					{
						$reminderdate2=explode(' ',$adrow2['reminderdate']);
						$purchase_invoiceno=$adrow2['purchase_invoiceno'];

						$querypurchase="SELECT p.*,pt.* FROM purchaseinvoice p, party pt where  p.partyid=pt.partyid and p.purchase_invoiceid='$purchase_invoiceno'";
						$result = mysqli_query($con,$querypurchase);
						$row=mysqli_fetch_assoc($result);

						$paymentinvoice="select sum(amount) as amount from debit_voucher where invoiceno='$purchase_invoiceno' and status='1'";
						$receiptres=mysqli_query($con,$paymentinvoice);
						if(mysqli_num_rows($receiptres) > 0 ){
							$payrow=mysqli_fetch_assoc($receiptres);
							$paidamount=$payrow['amount'];
						}

						if($purchase_invoiceno!='')
						{
							$balance=$row['total']-$paidamount;
							$info='<br>Type : Purchase Reminder<br>Party: '.$row['companyname'].'<br>Invoice Number: PI-'.$row['invoiceno'].'<br>Balance Amount:'.sprintf("%.2f",$balance);
						}else{$info='';}
						if($reminderdate2[0] <= $today)
						{
							$remider=$adrow2['reminderdate'];
							if($adrow2['reminderdate']!='')
							{
								$remiderdate=$adrow2['entrydate'];
							}else{
								$remiderdate=$adrow2['entrydate'];
							}
							if($purchase_invoiceno!='')
							{
								if($balance!='0.00')
								{
									?>
									<div class="row">
										<div class="col-sm-4 col-xs-4"><?php echo nl2br($adrow2['message']).$info;?></div>
										<div class="col-sm-3 col-xs-3" style="word-wrap: break-word;"><?php echo $adrow2['username'];?></div>
										<div class="col-sm-2 col-xs-2"><small><?php echo date('d-m-Y g:i:s A',strtotime($adrow2['entrydate']));?></small></div>
										<div class="col-sm-3 col-xs-3"><a onclick="removenotificationadmin(<?php echo $adrow2['id'];?>)"  style="cursor: pointer;"  class='btn btn-default'>Mark As Read</a></div>
									</div><hr>
									<?php }
								}
								else{
								 $messageOrder = $adrow2['message'];
								 $stringContains   = 'New Order :';
								 $findOrderNumber=explode(':',$adrow2['message']);
								 $findOrderNumber2=explode('.',$findOrderNumber[1]);
								 
								 $registrationContains   = 'New Registration :';
									?>
									<div class="row">
										<div class="col-sm-4 col-xs-4"><?php echo nl2br($adrow2['message']);?></div>
										<div class="col-sm-3 col-xs-3" style="word-wrap: break-word;"><?php echo $adrow2['username'];?></div>
										<div class="col-sm-2 col-xs-2"><small><?php echo date('d-m-Y g:i:s A',strtotime($adrow2['entrydate']));?></small></div>
										<div class="col-sm-3 col-xs-3">
										 <a onclick="removenotificationadmin(<?php echo $adrow2['id'];?>)"  style="cursor: pointer;" class='btn btn-default'>Mark As Read</a>&nbsp;&nbsp;&nbsp;
										 <?php if( strpos( $messageOrder, $stringContains ) !== false ) {?>
										 <a onclick="readNotificationOrder(<?php echo $adrow2['id'];?>,'<?php echo encrypt_decrypt('encrypt',$findOrderNumber2[0]);?>')" class='btn btn-success'>View Order</a>
										 <?php }?>
										 <?php if( strpos( $messageOrder, $registrationContains ) !== false ) {?>
										 <a href="../admin/pendingusers.php" class='btn btn-info'>View User</a>
										 <?php }?>
										</div>
									</div><hr>
									<?php
								}
							}
						}
						?>
					</div>
					<?php } ?>
					<center><button class="btn btn-info" onclick="window.location.href='../admin/viewnotification.php';">View All Notifications</button></center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload();">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="usernotificationmodal" role="dialog">
		<div class="modal-dialog" style="width: 94%;">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" align="center">Notifications</h4>
				</div>
				<div class="modal-body">
					<?php
					if(($usernotifycount) > 0)
						{ ?>
					<div class="row">
						<div class="col-sm-4 col-xs-3"><b>Message</b></div>
						<div class="col-sm-3 col-xs-3"><b>Sent By</b></div>
						<div class="col-sm-2 col-xs-3"><b>Date</b></div>
						<div class="col-sm-3 col-xs-3"><b>Close</b></div>
					</div><hr>
					<div id="notifydivuser">
						<?php
						$getusernotificationall="select n.*,nu.nid,l.username from  notification n,notification_user nu,login l where l.userid=n.userid and nu.userid='$userid' and n.status='1' and nu.notificationid=n.id and nu.status='1' order by nu.notificationid DESC";
						$resultall1=mysqli_query($con,$getusernotificationall);
						while($nrow=mysqli_fetch_assoc($resultall1))
						{
						         $messageOrder = $nrow['message'];
								 $stringContains   = 'New Order Placed:';
								 $findOrderNumber=explode(':',$nrow['message']);
								 $findOrderNumber2=explode('.',$findOrderNumber[1]);
								 
							?>
							<div class="row">
								<div class="col-sm-4 col-xs-3"><?php echo nl2br($nrow['message']);?></div>
								<div class="col-sm-2 col-xs-3" style="word-wrap: break-word;"><?php echo $nrow['username'];?></div>
								<div class="col-sm-2 col-xs-3"><small><?php echo date('d-m-Y  g:i:s A',strtotime($nrow['entrydate']));?></small></div>
								<div class="col-sm-3 col-xs-3">
								   <a title="colse" onclick="removenotificationuser(<?php echo $nrow['id'];?>)" style="cursor: pointer;" class='btn btn-default'>Mark As Read</a>
								  <?php if( strpos( $messageOrder, $stringContains ) !== false ) {?>
								   <a onclick="readNotificationOrderUser(<?php echo $nrow['id'];?>,'<?php echo $findOrderNumber2[0];?>')" class='btn btn-success'>View Order</a>
								  <?php }?>
								</div>
							</div><hr>
							<?php }
							?>
						</div>
						<?php } ?>
						<center><button class="btn btn-info" onclick="window.location.href='../admin/viewnotification.php';">View All Notifications</button></center>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload();">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="invoicemodal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Purchase Type</h4>
					</div>
					<div class="modal-body">
						<div class="row" style="">
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<a href="../purchase/index.php">
									<img src="../images/without-vat.png" style="width: 100%;height: 100%;">
									<center><label>Without VAT</label></center>
								</a>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<a href="../purchase/vindex.php">
									<img src="../images/with-vat.png" style="width: 100%;height: 100%;">
									<center><label>With VAT</label></center>
								</a>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
								<a href="../purchase/hform.php">
									<img src="../images/h-form.png" style="width: 100%;height: 100%;">
									<center><label>H-Form</label></center>
								</a>
							</div>
			   <!--<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <a href="../purchase/regular.php">
                  <img src="../images/regular-buying.png" style="width: 100%;height: 100%;">
				  <center>Regular</center>
                  </a>
               </div>
			   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <a href="../purchase/regular1.php">
                  <img src="../images/regular-buying.png" style="width: 100%;height: 100%;">
				  <center>Regular(Manual)</center>
                  </a>
              </div>-->
              <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
              	<a href="../purchase/regular2.php">
              		<img src="../images/regular-buying.png" style="width: 100%;height: 100%;">
              		<center><label>Regular</label></center>
              	</a>
              </div>
          </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>

<div class="modal fade" id="calculator" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Rap Calculator</h4>
			</div>
			<div class="modal-body">
				<div class="row" style="">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class=" form-group">
							<label>Size/Carat</label>
							<input class="form-control cal1 slcal1" type="text" id="weight11" required onkeypress="return IsNumeric(event);">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class=" form-group">
							<label>Diamond Color</label>
							<select  id="color11" class="col-sm-4 dropdownselect2" onchange="change2();">
								<option value="">Select Color</option>
								<?php
								$color="select * from  color  where status='1'";
								$clr=mysqli_query($con,$color);
								while($cr=mysqli_fetch_assoc($clr)){
									echo '<option value="'.$cr['colorname'].'">'.$cr['colorname'].'</option>';
								} ?>
							</select>
						</div>
					</div>			   
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class=" form-group">
							<label>Diamond Clarity</label>
							<select  id="clarity11" class="dropdownselect2" onchange="change2();">
								<option value="">Select Clarity</option>
								<?php
								$clarity="select * from  clarity  where status='1'";
								$clrit=mysqli_query($con,$clarity);
								while($cl=mysqli_fetch_assoc($clrit)){
									echo '<option value="'.$cl['clarityname'].'">'.$cl['clarityname'].'</option>';
								} ?>										
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class=" form-group">
							<label>Diamond Shape</label>
							<select  id="diamond_shape11" class="dropdownselect2" onchange="change2();">
								<option value="">Select Shape</option>
								<?php
								$getshape="select * from shape_master  where status='1'";
								$shpe=mysqli_query($con,$getshape);
								while($s=mysqli_fetch_assoc($shpe)){
									echo '<option value="'.$s['shapename'].'">'.$s['shapename'].'</option>';
								} ?>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class=" form-group">
							<label>RAP</label>
							<input type="checkbox" style="display: none;" id="currentrap33" onclick="change2();" checked>
							<input type="text"  id="slrap11" class="form-control slcal1" readonly >
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="saleInvoiceModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Sale Invoice Type</h4>
			</div>
			<div class="modal-body">
				<div class="row" style="">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../saleinvoice/dummy_saleInvoiceVAT.php">
							<img src="../images/with-vat.png" style="width: 100%;height: 100%;">
							<center><label>With VAT</label></center>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../saleinvoice/dummy_saleInvoiceHform.php">
							<img src="../images/h-form.png" style="width: 100%;height: 100%;">
							<center><label>H-Form</label></center>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../saleinvoice/dummy_saleInvoiceCash.php">
							<img src="../images/regular-buying.png" style="width: 100%;height: 100%;">
							<center><label>Cash</label></center>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../saleinvoice/dummy_saleInvoiceHongkong.php">
							<img src="../images/without-vat.png" style="width: 100%;height: 100%;">
							<center><label>Hongkong</label></center>
						</a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="dummyPurchaseInvoiceModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Purchase Type</h4>
			</div>
			<div class="modal-body">
				<div class="row" style="">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../dummy_purchase/index.php">
							<img src="../images/without-vat.png" style="width: 100%;height: 100%;">
							<center><label>Without VAT</label></center>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../dummy_purchase/vindex.php">
							<img src="../images/with-vat.png" style="width: 100%;height: 100%;">
							<center><label>With VAT</label></center>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../dummy_purchase/hform.php">
							<img src="../images/h-form.png" style="width: 100%;height: 100%;">
							<center><label>H-Form</label></center>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<a href="../dummy_purchase/regular.php">
							<img src="../images/regular-buying.png" style="width: 100%;height: 100%;">
							<center><label>Regular</label></center>
						</a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php
function no_to_words($no)
{   
	$words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred &','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
	if($no == 0)
		return ' ';
	else {
		$novalue='';
		$highno=$no;
		$remainno=0;
		$value=100;
		$value1=1000;       
		while($no>=100)    {
			if(($value <= $no) &&($no  < $value1))    {
				$novalue=$words["$value"];
				$highno = (int)($no/$value);
				$remainno = $no % $value;
				break;
			}
			$value= $value1;
			$value1 = $value * 100;
		}       
		if(array_key_exists("$highno",$words))
			return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
		else {
			$unit=$highno%10;
			$ten =(int)($highno/10)*10;            
			return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
		}
	}
}

function encrypt_decrypt($action, $string) {
	$output = false;

	$encrypt_method = "AES-256-CBC";
	$secret_key = 'This is my secret key';
	$secret_iv = 'This is my secret iv';

    // hash
	$key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	}
	else if( $action == 'decrypt' ){
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}
?>
<script>
	//datepicker
	$(document).ready(function() {
		/* $('#duedate').datepicker({
                    format: "dd/mm/yyyy",
					autoclose: true
                });
		 $('#reminderdate').datepicker({
                    format: "dd/mm/yyyy",
					autoclose: true
				});*/
				$('.datepicker').datepicker({
					format: "dd/mm/yyyy"
					/*,
					 endDate: '+0d',
					 autoclose: true*/
					});
				$('.duedatepicker').datepicker({
					format: "yyyy-mm-dd"
				});

				$("#dropdown").select2();
				$("#diamond_shape1").select2();
				$("#diamond_shape11").select2();
				$("#color1").select2();
				$("#color11").select2();
				$("#clarity1").select2();
				$("#clarity11").select2();
				$("#fluoresence").select2();
				$("#tinge").select2();
				$("#partyName").select2();
				$("#category").select2();
				$("#partyid2").select2();
				$("#partyid").select2();
				$("#partycode").select2();
				$("#locationid").select2();
				$("#ptype").select2();
				$("#customername").select2();
				$("#purchasrname").select2();
				$("#my_select").select2();
			});

	function removenotificationuser(id) {
		$.ajax({
			url:"../admin/removeusernotification.php?id="+id,  
			success:function(data) {
				document.getElementById('notifydivuser').innerHTML=data;
			}
		});
	}
	function removenotificationadmin(id) {
		$.ajax({
			url:"../admin/removeusernotification.php?id="+id,  
			success:function(data) {
				document.getElementById('notifydivadmin').innerHTML=data;
			}
		});
	}	
	function readNotificationOrder(id,orderId)
	{
		$.ajax({
			url:"../admin/removeusernotification.php?id="+id,  
			success:function(data) {
				document.getElementById('notifydivadmin').innerHTML=data;
				window.location.href="../stock/pendingorder.php?id="+orderId;
			}
		});
	}
	function readNotificationOrderUser(id,orderId)
	{
		$.ajax({
			url:"../admin/removeusernotification.php?id="+id,  
			success:function(data) {
				document.getElementById('notifydivadmin').innerHTML=data;
				window.location.href="../search/viewhistoryproduct.php?orderno="+orderId;
			}
		});
	}
</script>