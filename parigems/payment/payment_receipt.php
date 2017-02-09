<?php
   include "../common/header.php";
?>
<head>
   <script type="text/javascript">
      function ShowHideDiv() {
            var cheque = document.getElementById("cheque");
            var chequeNumber = document.getElementById("chequeNumber");
            chequeNumber.style.display = cheque.checked ? "block" : "none";
            var bankname = document.getElementById("bankname");
            bankname.style.display = cheque.checked ? "block" : "none";	
        }
   </script>
</head>
<section class="main-section">
   <div class="container crumb_top" >
      <ol class="breadcrumb"  id="breadcrumb" style="color: black">
         <li><a href="../common/homepage.php">Home</a></li>
         <li><a href="index.php">Payment</a></li>
         <li class="active">Add Payment Entry</li>
      </ol>
      <form class="form-horizontal" action="insertpaymentreceipt.php" method="post">
         <input type="hidden" name="addEntry" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
         <fieldset class="scheduler-border" >
            <h3>Add Payment  Entry</h3> 
            <hr>
            <input type="hidden" name="ttype" class="form-control" value="CREDIT"  required="true">	
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Date :</label>
                     <div class="col-sm-9">
                        <input type="text" name="date"  value="<?php echo date("d/m/Y"); ?>" class="form-control datepicker"  required="true">
                     </div>
                  </div>										
               </div>
               <div class="col-sm-4">
                  <div class="form-group">
                     <label class="col-sm-4 control-label">Party Name :</label>
                     <div class="col-sm-8">
                        <select tabindex="1" name="partyName"  id="partyName" class="dropdownselect2" onchange="getCustomerinvoices();" required>
                           <option value=""> Select Party </option>
                           <?php 
                              $query = "SELECT * FROM basic_details where userstatus=1 and usertype='user'";
                              $execute = mysqli_query($con,$query);
                              while ($row = mysqli_fetch_array($execute))
                              {
                                 echo "<option value='".$row['userid']."'>".$row['companyname'].'<p style="font-size:smaller;">('.$row['username'].')</p>'."</option>";
                              }
                           ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-4" id="invoicediv">
                <label class="col-sm-3 control-label">Invoice List:</label>
                  <div class="col-sm-9">
                  <select name="invoiceno" class="form-control">
                    <option value="">Select Invoice</option>
                  </select>
                  </div>
               </div>
            </div>
            <h3>Payment Type</h3>
            <hr>
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group">
                     <div class="col-sm-12">
                        <label class="font-normal margin-right10">
                           <input type="radio" value="cash" name="paymentType" onclick="ShowHideDiv()"  aria-label="..." required="true"> 
                           &nbsp;Cash
                        </label>

                        <label class="font-normal">
                           <input type="radio" value="cheque" name="paymentType" id="cheque"
                           onclick="ShowHideDiv()" aria-label="..." required="true"> 
                           &nbsp;Cheque
                        </label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row ">
               <div class="col-sm-12" id="chequeNumber" style="display: none">
                  <h3>Bank Details</h3>
                  <hr>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Cheque Number :</label>
                           <div class="col-sm-9">
                              <input type="text" name="chequeNumber" onkeypress="return IsNumeric(event);" maxlength="6" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label class="col-sm-4 control-label">Cheque Date :</label>
                           <div class="col-sm-8">
                              <input type="text" name="chequedate" class="form-control datepicker">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label class="control-label col-sm-3">Amount :</label>
                           <div class="col-sm-9">
                              <input type="text" name="amount" onkeypress="return IsNumeric(event);" class="form-control" required="true">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12" id="bankname" style="display: none">
                        <div class="form-group" >
                           <label class="col-sm-3 control-label">Bank Name</label>
                           <div class="col-sm-9">
                              <select class="dropdownselect2" id="dropdown" name="bankname" onchange="send_option();">
                                 <option value=''>Select Bank</option>
                                 <?php $bankname = mysqli_query($conn,"SELECT * FROM bankaccounts where status=1");
                                    while($row = mysqli_fetch_assoc($bankname)){
                                        echo "<option value=".$row['id']." >". $row['bankname']."</option>";
                                        }
                                    ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label class="control-label col-sm-4">Transaction Description :</label>
                     <div class="col-sm-8">
                        <textarea class="form-control" rows="5" name="transactionDescription" required="true"></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <center>
                     <button name="addEntry" type="submit" class="btn btn-primary">ADD ENTRY</button>
                  </center>
               </div>
            </div>
         </fieldset>
      </form>
      </div>
      <script src="customer_name.js"></script>
   </div>
</section>
<script>
   function getCustomerinvoices() {
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
                //alert(respoo);
                document.getElementById('invoicediv').innerHTML=respoo;
                }
   			}
			
		http2.open("GET","getCustomerinvoices.php?partyid="+partyName, true);
   		 http2.send(null);
   }
</script>
<?php
   include "../common/footer.php";
?>