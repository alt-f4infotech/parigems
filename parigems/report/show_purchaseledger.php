<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/config.php";
  
  
   $today= date("Y-m-d");
   $startdate= date("2016-01-01");
 
   	
   if ($_GET['fromDate']!="" && $_GET['toDate']=="") {
   //$fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
   $fromDate2 =  explode('/',$_GET['fromDate']);
   $fromDate=$fromDate2[2].'-'.$fromDate2[1].'-'.$fromDate2[0];
   
   $from="and i.date between '$fromDate' and  '$today'";
   $fromp="and p.date between '$fromDate' and  '$today'";
    }
    else{
   $from= "";		
   $fromp= "";		
    }
   if ($_GET['toDate']!="" && $_GET['fromDate']=="") {
    //$toDate = date('Y-m-d',strtotime($_GET['toDate']));
	  
   $toDate2 =  explode('/',$_GET['toDate']);
   $toDate=$toDate2[2].'-'.$toDate2[1].'-'.$toDate2[0];
   
    	 $to="and i.date between '$startdate' and  '$toDate'";
    	 $top="and p.date between '$startdate' and  '$toDate'";
    }
    else{
     $to = "";
     $top = "";
     }
     if ($_GET['toDate']!="" && $_GET['fromDate']!="") {
    //$toDate = date('Y-m-d',strtotime($_GET['toDate']));
    //$fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
	$fromDate2 =  explode('/',$_GET['fromDate']);
   $fromDate=$fromDate2[2].'-'.$fromDate2[1].'-'.$fromDate2[0];
   $toDate2 =  explode('/',$_GET['toDate']);
   $toDate=$toDate2[2].'-'.$toDate2[1].'-'.$toDate2[0];
    	 $both="and i.date between '$fromDate' and  '$toDate'";
    	 $bothp="and p.date between '$fromDate' and  '$toDate'";
    }
    else{
     $both = "";
     $bothp = "";
     }
     
     if ($_GET['purchasrname']!="") {
    $custid = $_GET['purchasrname'];
    	 $name="and i.partyid='$custid'";
    	 $namep="and p.partyid='$custid'";
    }
    else{
     $name = "";
     $namep = "";
     }
   
   if ($fromDate=="")
   {
   $fromDate=$startdate;
   }
   if ($toDate=="")
   {
   $toDate=$today;
   }
	 $query3 = "SELECT
                        * 
                        FROM
                        party
                        where
                       partyid=$custid";
                        $execute3 = mysqli_query($con,$query3);
                        while ($row3 = mysqli_fetch_array($execute3))
                        {
                        $cutomername=$row3['companyname'];
                        }
                        ?>
<div  style="border-top:1px solid black;">
  <center><h4 align="center"><?php
  if($cutomername!='')
  {
  echo  "LEDGER REPORT OF ".$cutomername;
  }
  ?> </h4>
  <div class="row" style="overflow: auto;">
	<div class="col-sm-12">
	  <h4>Purchase Invoices</h4>
<table  class="table table-bordered">
<thead>
<tr style="font-size: small">
<th style='text-align:center;'>Sr.No</th>
<th style='text-align:center;'> Invoice Date</th>
<th style='text-align:center;'>Invoice No.</th>
<th style='text-align:center;'>Total Amount</th>
<th style='text-align:center;'>Paid Amount</th>
<th style='text-align:center;'>Balance Amount</th>
<th style='text-align:center;'>Receipt No.</th>
</tr>
</thead>
<tbody>
<?php
   $i=1;
   $k=1;
   $totalinvamount=0;
   $totalpayamount=0;
   $totalpaidamount=0;
   $totalbalanceamount=0;
   $querySales3="select
    distinct i.purchase_invoiceid,i.total,i.date,i.invoiceno 
   from
    purchaseinvoice i
   where
    1 $from $to $both  $name
    and i.purchasestatus=1";

   $result3 = mysqli_query($con,$querySales3);
  if(mysqli_num_rows($result3)){
    while($row11=mysqli_fetch_assoc($result3))
    {
	
   	   $invoiceno= $row11['purchase_invoiceid'];
	
	   	   $inlen=strlen($invoiceno);
    if($inlen==1){ $invv= '00'.$invoiceno;}
   else if($inlen==2){ $invv= '0'.$invoiceno;}
   else{$invv= ''.$invoiceno;}
   $totalinvamount=$totalinvamount+$row11['total'];
 $paidamount=0;$cnt=1;
 $validateinvoice="select amount,receiptno from debit_voucher where invoiceno='$invoiceno' and status='1'";
   $receiptres=mysqli_query($con,$validateinvoice);
   if(mysqli_num_rows($receiptres) > 0 ){
   while($row=mysqli_fetch_assoc($receiptres))
   {
   $paidamount=$paidamount+$row['amount'];
   if($cnt=='1'){
	  $receiptnoinvoice=$row['receiptno'];
   }else{
	  $receiptnoinvoice=$receiptnoinvoice.','.$row['receiptno'];
   }   
	$cnt++;
	}
   }
   else{$receiptnoinvoice='';}
   $totalpaidamount=$totalpaidamount+$paidamount;
   $balance=$row11['total']-$paidamount;
   $totalbalanceamount=$totalbalanceamount+$balance;
   		echo "<tr>";   	
   		echo "<td class='number'>".$i++."</td>";   		
   	   	echo "<td class='number'>".date("d-m-Y", strtotime($row11['date']))."</td>";
		echo "<td class='number'>".$row11['invoiceno']."</td>";
		echo "<td class='number'>".$row11['total']."</td>";
		echo "<td class='number'>".sprintf("%.2f",$paidamount)."</td>";
		echo "<td class='number'>".sprintf("%.2f",$balance)."</td>";
		echo "<td class='number'>".$receiptnoinvoice."</td>";
   		echo "</tr>";
   }
   ?>
</tbody>
<tr><td></td><td></td><td><b>Total Amount</b></td><td class='number'><b><?php echo sprintf("%.2f",$totalinvamount);?></b></td><td class='number'><b><?php echo sprintf("%.2f",$totalpaidamount);?></b></td><td class='number'><b><?php echo sprintf("%.2f",$totalbalanceamount);?></b></td><td></td></tr>
</table>
   <?php }else{ echo '<h5>Purchase Invoice Not Found.</h5>';} ?>
	</div>
  </div>
  <div class="row">
   <div class="col-sm-12">
	  <h4>Payment Receipts</h4>
	
  <table  class="table table-bordered">
<thead>
<tr style="font-size: small">
<th style='text-align:center;'>Sr.No</th>
<th style='text-align:center;'>Receipt Date</th>
<th style='text-align:center;' >Receipt No.</th>
<th style='text-align:center;' >Debit Amount</th>
</tr>
</thead>
<tbody>
   <?php 
    $querySales33="select
   distinct p.receiptno,p.date as pdate,p.amount,p.paytype,p.angadiaid,p.bankid,p.chequeno,p.chequedate
   from
    debit_voucher p
   where
    1  $fromp $top $bothp $namep and p.status=1";
   $result33 = mysqli_query($con,$querySales33);
  if(mysqli_num_rows($result33) > 0)
  {
    while($row113=mysqli_fetch_assoc($result33))
    {	
   $totalpayamount=$totalpayamount+$row113['amount'];
   if($row113['angadiaid']!=''){$angadia=' (Transfered From Angadia.)';}else{$angadia='';}
   
   $getangadianameqry="select a.accountname from angadia_voucher av,angadia_account a where av.accountid==a.accountid and a.status='1' and av.receiptno='$angadia'";
   $angadiares = mysqli_query($con,$getangadianameqry);
  if(mysqli_num_rows($angadiares) > 0)
  {
   $row55=mysqli_fetch_assoc($angadiares);
   $angadianame=$row55['accountname'];
  }
   else{
	  $angadianame='';
   }
   $banknameqry = mysqli_query($conn,"SELECT * FROM bankaccounts where status=1 and id=".$row113['bankid']);
			   while($brow = mysqli_fetch_assoc($banknameqry)){
				   $bankname='('.$brow['bankname'].')';
				   }
   		echo "<tr>";
   		echo "<td class='number'>".$k++."</td>";
		echo "<td class='number'>".date("d-m-Y", strtotime($row113['pdate']))."</td>";
		echo "<td class='number'>";
		echo $row113['receiptno'].'  ('.$row113['paytype'].')'.$angadia.$angadianame;
		if($row113['paytype']=='cheque')
					{ echo " - ".$row113['chequeno'].'/'.date("d-m-Y",strtotime($row113['chequedate'])).$bankname; }
					echo "</td>";
		echo "<td class='number'>".sprintf("%.2f",$row113['amount'])."</td>";   		
   		echo "</tr>";
   }
   ?>
</tbody>
<tr><td></td><td></td><td><b>Total Payment</b></td><td class='number'><b><?php echo sprintf("%.2f",$totalpayamount);?></b></td></tr>
<?php } else{}?>
</table>
   	
		 <!--</td>
	  </tr>
	</table>-->
  
	</div>
 
  <div class="row">
   <div class="col-sm-4"></div>
	 <div class="col-sm-4">
	  <h4>Summary</h4>
  	<center><table class="table" border="1">
  <tr style="font-size: small"><th>Total Purchase:</th><td><?php echo sprintf("%.2f",$totalinvamount);?></td></tr>
   <tr style="font-size: small"><th>Total Payment:</th><td><?php echo sprintf("%.2f",$totalpayamount);?></td></tr>
   <tr style="font-size: small"><th>Balance:</th><td><?php echo sprintf("%.2f",$totalinvamount-$totalpayamount);?></td></tr>
   </table></center> <hr>
 </div>
	 <div class="col-sm-4"></div>
  </div>
   
	 
