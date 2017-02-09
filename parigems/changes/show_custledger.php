<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/config.php";
  
  
   $today= date("Y-m-d");
   $startdate= date("2016-01-01");
   $todaydate=date("d/m/Y");
   $startdate2=date("01/01/2000");
   	
   if ($_GET['fromDate']!="" && $_GET['toDate']=="") {
  // $fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
   $date2 =  explode('/',$_GET['fromDate']);
     $fromDate=$date2[2].'-'.$date2[1].'-'.$date2[0];
	
   $from="and i.date between '".$_GET['fromDate']."' and  '$todaydate'";
   $fromp="and p.date between '$fromDate' and  '$today'";
   $fromc="and cd.date between '".$_GET['fromDate']."' and  '".$_GET['fromDate']."'";
    }
    else{
   $from= "";		
   $fromp= "";		
   $fromc= "";		
    }
   if ($_GET['toDate']!="" && $_GET['fromDate']=="") {
   // $toDate = date('Y-m-d',strtotime($_GET['toDate']));
	
	 $date3 =  explode('/',$_GET['toDate']);
     $toDate=$date3[2].'-'.$date3[1].'-'.$date3[0];
    	 $to="and i.date between '$startdate2' and  '".$_GET['toDate']."'";
    	 $top="and p.date between '$startdate' and  '$toDate'";
    	 $toc="and cd.date between '".$_GET['toDate']."' and  '".$_GET['toDate']."'";
    }
    else{
     $to = "";
     $top = "";
     $toc = "";
     }
     if ($_GET['toDate']!="" && $_GET['fromDate']!="") {
   // $toDate = date('Y-m-d',strtotime($_GET['toDate']));
    //$fromDate = date('Y-m-d',strtotime($_GET['fromDate']));
	$date2 =  explode('/',$_GET['fromDate']);
     $fromDate=$date2[2].'-'.$date2[1].'-'.$date2[0];
	 $date3 =  explode('/',$_GET['toDate']);
     $toDate=$date3[2].'-'.$date3[1].'-'.$date3[0];
    	 $both="and i.date between '".$_GET['fromDate']."' and  '".$_GET['toDate']."'";
    	 $bothp="and p.date between '$fromDate' and  '$toDate'";
    	 $bothc="and cd.date between '".$_GET['fromDate']."' and  '".$_GET['toDate']."'";
    }
    else{
     $both = "";
     $bothp = "";
     $bothc = "";
     }
     
     if ($_GET['customername']!="") {
    $custid = $_GET['customername'];
    	 $name="and i.userid='$custid'";
    	 $namep="and p.partyid='$custid'";
    	 $namec="and cd.userid='$custid'";
    }
    else{
     $name = "";
     $namep = "";
     $namec = "";
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
                         basic_details
                        where
                       userid=$custid";
                        $execute3 = mysqli_query($con,$query3);
                        while ($row3 = mysqli_fetch_array($execute3))
                        {
                        $cutomername=$row3['companyname'];
                        }
   
   					
                        ?>
   
<div class="container">

 <div  style="border-top:1px solid black;">
 
  <center><h4 align="center"><?php
  if($cutomername!='')
  {
  echo  "LEDGER REPORT OF  ".$cutomername;
  }
  ?> </h4>
  <div class="row">
  <div class="col-sm-12">
    <h4>Sales Invoices</h4>
	<?php
	 $querySales3="select
    distinct i.invoiceno as invoiceid,i.finaltotal as total,i.date 
   from
    saleinvoice i
   where
    1 $from $to $both  $name
    and i.status=1";

   $result3 = mysqli_query($con,$querySales3);
   if(mysqli_num_rows($result3) > 0){
	?>
  <table  class="table table-bordered">
<thead>
<tr style="font-size: small">
<th style='text-align:center;'>Sr.No</th>
<th style='text-align:center;'> Invoice Date</th>
<th style='text-align:center;'>Invoice No.</th>
<th style='text-align:center;'>Total</th>
</tr>
</thead>
<tbody>
<?php
   $i=1;
   $k=1;
   $totalinvamount=0;
   $totalpayamount=0;
   $final=0;
  
    while($row11=mysqli_fetch_assoc($result3))
    {
   	   $invoiceno= $row11['invoiceid'];
	   	   $inlen=strlen($invoiceno);
		   $invv= 'PG-'.$invoiceno;
   $totalinvamount=$totalinvamount+$row11['total'];
   		echo "<tr style='font-size: small;'>";   	
   		echo "<td class='number'>".$i++."</td>";   		
   	   	echo "<td class='number'>".$row11['date']."</td>";
		echo "<td class='number'>".$invv."</td>";
		echo "<td class='number'>".sprintf("%.2f",$row11['total'])."</td>";
   		echo "</tr>";
   }
   ?>
</tbody>
<tr style="font-size: small"><td></td><td></td><td><b>Total Amount</b></td><td class='number'><b><?php echo sprintf("%.2f",$totalinvamount);?></b></td></tr>
   </table>
  <?php }else{ echo '<h5>Sales Invoice Not Found.</h5>';} ?>
  </div>
  </div>
  <div class="row">
  <div class="col-sm-12">
  <h4>Payment Receipts</h4>
  <?php
  $querySales33="select
   distinct p.receiptno,p.date as pdate,p.amount,p.paytype,p.angadiaid,p.bankid,p.chequeno,p.chequedate
   from
    payment_receipt p
   where
    1  $fromp $top $bothp $namep and p.status=1";
   $result33 = mysqli_query($con,$querySales33);
  if(mysqli_num_rows($result33) > 0)
  {?>
  <table  class="table table-bordered">
<thead>
   <tr style="font-size: small">
<th style='text-align:center;'> Sr.No</th>
<th style='text-align:center;'> Receipt Date</th>
<th style='text-align:center;' > Receipt No.</th>
<th style='text-align:center;' >Total</th>
</tr>
</thead>
<tbody >
   <?php   
    
    while($row113=mysqli_fetch_assoc($result33))
    {	
   $totalpayamount=$totalpayamount+$row113['amount'];
   if($row113['angadiaid']!=''){$angadia=' (Transfered From Angadia.)';}else{$angadia='';}
   $getangadianameqry="select a.accountname from angadia_payment_receipt av,angadia_account a where av.accountid==a.accountid and a.status='1' and av.receiptno='$angadia'";
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
<tr style="font-size: small"><td></td><td></td><td><b>Total Payment</b></td><td class='number'><b><?php echo sprintf("%.2f",$totalpayamount);?></b></td></tr>

</table>
  <?php }else{ echo '<h5> Payment Receipts Not Found.</h5>';} ?>
   </div>
  </div>
  
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
  	<h4>Summary</h4>
  <table  class="table table-bordered">
  <tr style="font-size: small"><th>Total Sale:</th><td class="number">&nbsp;&nbsp;<?php echo sprintf("%.2f",$totalinvamount);?></td></tr>
   <tr style="font-size: small"><th>Total payment:</th><td class="number">&nbsp;&nbsp;<?php echo sprintf("%.2f",$totalpayamount);?></td></tr>
   <tr style="font-size: small"><th>Balance:</th><td class="number">&nbsp;&nbsp;<?php echo sprintf("%.2f",($totalinvamount-$totalpayamount));?></td></tr>
   </table>
 </div>
<div class="col-sm-4"></div>
</div>
  </center>
  </div>

  
   
	 
