<?php
ob_start();
error_reporting(0);
session_start();
include "../common/config.php";;
$partycode=$_GET['partyid'];
$getpartyid="select * from purchaseinvoice where purchasestatus='1' and partyid='$partycode'";
$partyres=mysqli_query($con,$getpartyid);
?>
<label>Invoice List:</label><br>
 <select name="invoiceno"  class="form-control">
   <option value="">Select Invoice</option>
 <?php
while($p=mysqli_fetch_assoc($partyres)){
   $invoicenumber=$p['invoiceno'];
   $id=$p['purchase_invoiceid'];
   $invoicetotal=$p['total'];
   $validateinvoice="select SUM(amount) as amount from debit_voucher where invoiceno='$id' and status='1'";
   $receiptres=mysqli_query($con,$validateinvoice);
   $row=mysqli_fetch_assoc($receiptres);
   $paidamount=$row['amount'];
   if($paidamount < $invoicetotal){
    $balance=$invoicetotal-$paidamount;
echo '<option value="'.$id.'">'.$invoicenumber.'('.$balance.')</option>';
   }
}
?>
  </select>
</div>