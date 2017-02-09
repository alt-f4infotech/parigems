<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $useridarray = $_POST['userid'];
   $ordernoarray=$_POST['check'];
   $uniqueuserid=$useridarray[0];
   $orderno='';
   foreach($ordernoarray as $key => $value)
   {
	if($uniqueuserid!=$useridarray[$key])
	{
	 ?>
   <body onload="bootbox.alert('Select Orders Of one Customer.', function() {
            window.location.href='index.php';
				});"></body>
<?php
	}
	else{
	// echo '<br><br><br><br>'.$getcustomerdetails;
	 $getcustomerdetails="SELECT b.* FROM invoice_product i,basic_details b where b.userid=i.userid and i.pstatus='2' and i.deliverystatus='1' and i.userid=".$useridarray[$key];
	 $customerresult=mysqli_query($con,$getcustomerdetails);
	 $custrow=mysqli_fetch_assoc($customerresult);
	 if($key==0)
	 {
	  $orderno=$ordernoarray[$key];
	  $qry0=' i.invoiceid='.$ordernoarray[$key];
	 }else{	  
	 $orderno=$orderno.','.$ordernoarray[$key];
	 $qry0=' i.invoiceid='.$ordernoarray[$key];
	 }
	 $qry2=$qry2.' OR '.$qry0;	 
	}
   }
   
   if($qry2!='')
   {
	$tqry2 = substr($qry2, 4);
	$qry=' and ('.$tqry2.')';
   }
   if($uniqueuserid!='')
   {
?>
   <section class="main-section">
  <div class="container-fluid crumb_top">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="../saleinvoice/index.php">Pending Sale Orders</a></li>
      <li class="active">Sale Invoice With VAT</li>
    </ol>
    <h2 class="text-center">Sale Invoice With VAT</h2>
    <form action="insertsaleinvoice.php" method="post">
  			<div class="row">
  				<div class="col-sm-4">
				 <div class="form-group">
					<label><b>Customer Name:</b></label> <?php echo $custrow['username'];?>
				</div>
				</div>
				<div class="col-sm-4">
				   <div class="form-group">
					<label><b>Company Name:</b></label> <?php echo $custrow['companyname'];?>
					</div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label><b>Contact Number:</b></label> <?php echo $custrow['phoneno'];?>
				  </div>
				</div>
  			</div>
  		   <div class="row">
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>Address:</b></label> <?php echo $custrow['office_address'];?>
				  </div>
				</div>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>Order Number:</b></label> <?php echo $orderno;?>
				  </div>
				</div>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>Date:</b></label><input class="form-control datepicker" type="text" name="date" id="date" required>
				  </div>
			 </div>
  			</div>
			<div class="row">
			 <?php if($custrow['pannumber']!=''){?>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>PAN Number:</b></label> <?php echo $custrow['pannumber'];?>
				  </div>
				</div>
			   <?php }if($custrow['cstnumber']!=''){?>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>CST Number:</b></label> <?php echo $custrow['cstnumber'];?>
				  </div>
				</div>
			   <?php }if($custrow['vattinnumber']!=''){?>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>VAT Number:</b></label> <?php echo $custrow['vattinnumber'];?>
				  </div>
			 </div>
			 <?php }?>
  			</div><br>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th>Certificate Type</th>
              <th>Certificate Number</th>
              <th>Description</th>
              <th>Qty(in Carat)</th>
              <th>Rate (in $)</th>
              <th>Amount (in $)</th>
            </tr>
          </thead>
          <tbody>
		   <?php
		   $fetchdiamonddetails="SELECT d.diamond_id,d.weight,d.certificate_id,i.*,l.* FROM diamond_master d,invoice_product i,login l where 1 $qry and i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' and i.deliverystatus='1'";
		   //echo $fetchdiamonddetails;
		   $fetchresult = mysqli_query($con,$fetchdiamonddetails);
		   $i=1;
			while($row=mysqli_fetch_assoc($fetchresult))
			{
			   $user=$row['userid'];
			   $diamondid=$row['diamondid'];
			   $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
			   $certiresult=mysqli_query($con,$certificteqry);
			   while($crow=mysqli_fetch_assoc($certiresult)){
				  $lab=$crow['certi_name'];
				  $reportno=$crow['report_no'];
				  $certi_no=$crow['certi_no'];
				  $certiimage='../diamond_upload/'.$crow['logo'];
			   }
			   
			  /* $chevkcart="select * from add_to_cart where diamondid=$diamondid and userid=$user and wishstatus='0'";
			   $cartresult=mysqli_query($con,$chevkcart);
			   $cartrow=mysqli_fetch_assoc($cartresult);*/
			   $rap=($row['amount'] / $row['weight']);
			   $finaltotal=$finaltotal+$row['amount'];
		   ?>
            <tr>
              <td><input class="case" type="checkbox"/></td>
              <td><input type="text" name="lab[]" id="lab_1" value="<?php echo $lab;?>" class="form-control" readonly></td>
              <td><input type="text" value="<?php echo $certi_no;?>" class="form-control" readonly></td>
              <td><input type="text" name="description1[]" id="description_1" class="form-control"></td>
			  <td><input type="text" name="carat[]" id="carat_1" value="<?php echo $row['weight'];?>" class="form-control" readonly></td>
              <td><input type="text" name="rate[]" id="rate_1" value="<?php echo $rap;?>" class="form-control" ></td>
              <td><input type="text" name="amount[]" id="amount_1" value="<?php echo sprintf("%.2f",$row['amount']);?>" class="form-control" ></td>
			  <input type="text" style="display:none" name="userid" value="<?php echo $uniqueuserid;?>">
			  <input type="text" style="display:none" name="invoicetype" value="With-VAT">
			  <input type="text" style="display:none" name="orderno" value="<?php echo $orderno;?>">
			  <input type="text" style="display:none" name="diamondid[]" value="<?php echo $diamondid;?>">
            </tr>
			<?php } ?>
          </tbody>
          <tfoot>
            <tr>
			 <td colspan="5"></td>
			  <td><label>Subtotal (in $)</label></td>
			  <td>
                <input class="form-control" tabindex="-1" value="<?php echo sprintf("%.2f",$finaltotal);?>" type="text" name="subtotal" id="subtotal" required >
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="conversion" id="conversion" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();" >
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Extra Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="extraconversion" id="extraconversion" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();" >
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Total Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="totalconversion" id="totalconversion" readonly>
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td>
                <label>Discount (in Rs.)</label>
			  </td>
			  <td>
                <input class="form-control"  type="text" name="discount" id="discount" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();"  >
              </td></tr>
			<tr>
			 <td colspan="5"></td>
			 <td>			   
                <label>VAT (in %)</label>
			  </td>
			 <td>			  
				 <input class="form-control" type="text" name="vat" id="vat" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();"  >
			 </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td>			   
                <label>VAT Amount</label>
			  </td>
			  <td>
				 <input class="form-control" tabindex="-1" type="text" name="vatamount" id="vatamount" readonly>
              </td></tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Roundoff</label></td>
			  <td>                
                <input class="form-control" type="text" value="<?php echo sprintf("%.2f",($finaltotal-round($finaltotal)));?>" name="roundoff" id="roundoff" readonly>
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Total Amount (in Rs.)</label></td>
              <td>
                <input class="form-control" tabindex="-1" value="<?php echo sprintf("%.2f",round($finaltotal));?>" type="text" name="total" id="total" required readonly>
              </td>
            </tr>
          </tfoot>
        </table>
		<div class='row'>
          <div class='col-sm-6'>
            <div class="form-group">
			   <label>Notes:</label>
              <textarea class="form-control" name="notes" rows="5"></textarea>
            </div>
  	      </div>
  	    </div>
  			<center>
          <button type="submit" class="action-button">Submit</button>
        </center>
  		</fieldset>
  	</form>
  </div>
</section>
   <?php }?>
   <script src="../js/saleinvoice.js"></script>