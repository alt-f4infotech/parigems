<?php
   ob_start();
   session_start();
   include "../common/config.php";
   error_reporting(0);
   date_default_timezone_set("Asia/Kolkata");
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
  $userid=$_SESSION['userid'];
  $role=$_SESSION['role'];
  $id=$_GET['id'];
  $today=date("Y-m-d");
	$updateqry="Update notification_user set status='0' where notificationid=$id";
      if(mysqli_query($con,$updateqry))
   {
	  $updateqry2="Update notification set status='0' where id=$id";
    if(mysqli_query($con,$updateqry2))
   {
	  if($role=='USER')
	  {
     $getusernotificationall="select n.*,nu.nid,l.username from  notification n,notification_user nu,login l where l.userid=n.userid and nu.userid='$userid' and n.status='1' and nu.notificationid=n.id and nu.status='1' order by nu.notificationid ASC";
	 $resultall1=mysqli_query($con,$getusernotificationall);
			while($nrow=mysqli_fetch_assoc($resultall1))
			{
			  $messageOrder = $nrow['message'];
			  $stringContains   = 'New Order Placed:';
			  $findOrderNumber=explode(':',$nrow['message']);
			  $findOrderNumber2=explode('.',$findOrderNumber[1]);
			?>
			<div class="row">
               <div class="col-sm-4">
               <?php echo nl2br($nrow['message']);?> 
               </div>
             <div class="col-sm-3"><?php echo $nrow['username'];?></div>
             <div class="col-sm-2"><small><?php echo date('d-m-Y',strtotime($nrow['entrydate']));?></small></div>
			 <div class="col-sm-3 col-xs-3">
			   <a title="colse" onclick="removenotificationuser(<?php echo $nrow['id'];?>)" style="cursor: pointer;" class='btn btn-default'>Mark As Read</a>
			    <?php if( strpos( $messageOrder, $stringContains ) !== false ) {?>
				  <a onclick="readNotificationOrderUser(<?php echo $nrow['id'];?>,'<?php echo $findOrderNumber2[0];?>')" class='btn btn-success'>View Order</a>
			     <?php }?>
			 </div>
            </div><hr>
			<?php
			}
	  }else{
		$getusernotificationall="select n.*,nu.nid,l.username,n.reminderdate from  notification n,notification_user nu,login l where l.userid=n.userid and nu.userid='$userid' and n.status='1' and nu.notificationid=n.id and nu.status='1'  order by nu.notificationid ASC";
		//echo $getusernotificationall;
			$resultall1=mysqli_query($con,$getusernotificationall);
			while($nrow=mysqli_fetch_assoc($resultall1))
			{
			   $purchase_invoiceno=$nrow['purchase_invoiceno'];
			    $reminderdate2=explode(' ',$nrow['reminderdate']);
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
			  $remider=$nrow['reminderdate'];
			  if($nrow['reminderdate']!='')
			  {
			   $remiderdate=$nrow['reminderdate'];
			  }else{
			   $remiderdate=$nrow['entrydate'];
			  }
			  if($purchase_invoiceno!='')
			  {
			  if($balance!='0.00')
			  {
			?>
			<div class="row">
               <div class="col-sm-4">
               <?php echo nl2br($nrow['message']).$info;?> 
               </div>
             <div class="col-sm-3"><?php echo $nrow['username'];?></div>
             <div class="col-sm-2"><small><?php echo date('d-m-Y',strtotime($remiderdate));?></small></div>
			 <div class="col-sm-3"><a title="colse" onclick="removenotificationadmin(<?php echo $nrow['id'];?>)" style="cursor: pointer;" class='btn btn-default'>Mark As Read</a></div>
            </div><hr>
			<?php }
			  }
			  else
			  {
			   $messageOrder = $nrow['message'];
			   $stringContains   = 'New Order :';
			   $findOrderNumber=explode(':',$nrow['message']);
			   $findOrderNumber2=explode('.',$findOrderNumber[1]);
			   $registrationContains   = 'New Registration :';
			   ?>
			<div class="row">
               <div class="col-sm-4">
               <?php echo nl2br($nrow['message']);?> 
               </div>
             <div class="col-sm-3"><?php echo $nrow['username'];?></div>
             <div class="col-sm-2"><small><?php echo date('d-m-Y',strtotime($remiderdate));?></small></div>
			 <div class="col-sm-3">
			   <a title="colse" onclick="removenotificationadmin(<?php echo $nrow['id'];?>)" style="cursor: pointer;" class='btn btn-default'>Mark As Read</a>&nbsp;&nbsp;&nbsp;
			   <?php if( strpos( $messageOrder, $stringContains ) !== false ) {?>
			   <a onclick="readNotificationOrder(<?php echo $nrow['id'];?>,'<?php echo encrypt_decrypt('encrypt',$findOrderNumber2[0]);?>')" class='btn btn-success'>View Order</a>
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
	  }
   }
   }
   ?>