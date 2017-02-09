<?php
   include "../common/header.php";
   
   
    $cash="select sum(amount) as amount from kitty where txntype='CREDIT' and  status=1";
               $cashResult1 = mysqli_query($con,$cash);
                while($row=mysqli_fetch_assoc($cashResult1))
               {
               	$amount=$row['amount'];	
               }
                
                $debitcash="select  sum(amount) as amount from kitty where txntype='DEBIT' and  status=1 ";
               $debitcashResult1 = mysqli_query($con,$debitcash);
                while($row2=mysqli_fetch_assoc($debitcashResult1))
               {
               	$remainamount=$row2['amount'];	
                }
               $cash = $amount-$remainamount;
?>
<head>
   <script type="text/javascript">
      function ShowHideDiv() {
		 
          document.getElementById('amount').disabled=false;
            var cheque = document.getElementById("cheque");
			var checked=cheque.checked;
			if (checked==true) {
               $('#dropdown').prop('required', true);
            }
			else{
			   $('#dropdown').prop('required', false);
			}
            var chequeNumber = document.getElementById("chequeNumber");
            chequeNumber.style.display = cheque.checked ? "block" : "none";
			var bankname = document.getElementById("bankname");
            bankname.style.display = cheque.checked ? "block" : "none";	
        }
   </script>
</head>
<body  onload="amountcheck();">
   <section class="main-section">
<div class="container crumb_top" >
  
   <ol class="breadcrumb"  id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="index.php">Payment</a></li>
      <li class="active">Create Debit Voucher</li>
   </ol>
   <form class="form-inline" action="insertdebitreceipt.php" method="post">
      <input type="hidden" id="cashinhand" name="cashinhand" value="<?php echo $cash; ?>">
      <input type="hidden" name="addEntry" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
      <fieldset class="scheduler-border" >
        <center> <legend class="scheduler-border">Create Debit Voucher</legend></center>
         <input type="hidden" name="ttype" class="form-control" value="DEBIT"  required="true">		
         <div class="row">
            <div class="col-xs-12 col-sm-4 ">
               <label>Date : </label>
               <input type="text"  value="<?php echo date("d/m/Y"); ?>" name="date" class="form-control datepicker"  required="true">										
            </div>
            <div class="col-xs-12 col-sm-4">
               <label>Party Name : </label>
              <!-- <input type="text" data-type="productname" name="partyName" class="form-control autocomplete_txt" autocomplete="off" required="true">
               <input type="hidden" id="party_id" name="party_id" required="true">-->
			   
			   <select tabindex="1" name="partyName"  id="partyName" class="dropdownselect2"  onchange="getpartyinvoices();" required>
                     <option value=""> Select Party </option>
                     <?php 
                        $query = "SELECT
                        * 
                        FROM
                        party
                        where
                       partystatus=1";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
                        echo "<option value='".$row['partyid']."'>".$row['companyname']."</option>";
                        }
                        ?>
                  </select>
            </div>
			 <div class="col-xs-12 col-sm-4" id="invoicediv">
         <label>Invoice List:</label><br>
 <select name="invoiceno" class="form-control">
   <option value="">Select Invoice</option>
 </select>
         </div>
         </div>
         <br>
         <fieldset class="scheduler-border" >
            <legend class="scheduler-border" >Payment Type</legend>
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="input-group">
                     <input type="radio" value="cash" name="paymentType" id="cash"
                        onclick="ShowHideDiv()"  aria-label="..." required="true"> cash
                  </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-6" >
                  <div class="input-group">
                     <input type="radio" value="cheque" name="paymentType" id="cheque"
                        onclick="ShowHideDiv()" aria-label="..." required="true"> cheque
                  </div>
               </div>
         </fieldset>
         <br>
         <div class="row ">
         <div class="col-xs-12 col-sm-12 container" id="chequeNumber" style="display: none">
         <fieldset class="scheduler-border">
         <legend class="scheduler-border" >Bank Details</legend>
         <div class="col-xs-12 col-sm-12 col-md-6" >
         <label>Cheque Number : </label>
         <input type="text" name="chequeNumber" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control">
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6" >
         <label>Cheque Date : </label>
         <input type="text" name="chequedate" class="form-control datepicker">
         </div>
         </fieldset>
         </div>
         </div>
         <br>
         <div class="col-xs-12 col-sm-6 col-md-6">
         <label>Amount : </label>
         <input type="text" autocomplete="off" name="amount" id="amount" onkeyup="checkcash();" onkeypress="return IsNumeric(event);" class="form-control" required="true">
         <div id="checkamt" style="display: none" class="alert alert-danger">
   <strong>Alert!</strong> Amount is greater than cash in hand balance.
</div>
         </div>
         	
         <div class="col-xs-12 col-sm-6 col-md-6">
         <label>Transaction Description : </label>
         <textarea class="form-control" rows="5" name="transactionDescription" required="true"></textarea>
         </div>
		 <div class="col-xs-12 col-sm-6 col-md-6" id="bankname" style="display: none">
                           <label>Bank Name</label>
                              <select class="dropdownselect2" id="dropdown" name="bankname" onchange="send_option();">
                                 <option value=''>Select Bank</option>
                                 <?php $bankname = mysqli_query($conn,"SELECT * FROM bankaccounts where status=1");
                                    while($row = mysqli_fetch_assoc($bankname)){
                                        echo "<option value=".$row['id']." >". $row['bankname']."</option>";
                                        }
                                    ?>
                              </select>
           </div><br>
         <div class="col-xs-12">
         <button name="addEntry" type="submit" id="addentry" class="btn btn-primary">ADD ENTRY</button>
         </div>
      </fieldset>
   </form>
</div>
   </fieldset>
   </section>
   <script src="customer_name.js"></script>
</body>
<br>
<br>

<script>
   function checkcash()
   {
      
     var paymentType=$('input[name="paymentType"]:checked').val();
  
    if (paymentType=='cash') {
    
    var amount=parseInt(document.getElementById('amount').value);
    var cashinhand=parseInt(document.getElementById('cashinhand').value);
    if (amount > cashinhand) {
      document.getElementById('checkamt').style.display="block";
      document.getElementById('addentry').disabled=true;
    
    }
    else
    {
      document.getElementById('checkamt').style.display="none";
      document.getElementById('addentry').disabled=false;
    }
    
    }

   }
   
   function amountcheck() {
    document.getElementById('amount').disabled=true;
   }

   function getpartyinvoices() {
    var partyName=document.getElementById('partyName').value;
  if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
    http2=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
    http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {
   
   if (http2.readyState==4 )
   		 {
   				var respoo=http2.responseText;
                document.getElementById('invoicediv').innerHTML=respoo;
                }
   			}
			
		http2.open("GET","../angadia/getpartyinvoices.php?partyid="+partyName, true);
   		 http2.send(null);
   }
</script>
<?php
   include "../common/footer.php";
?>