<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
$encrypted_txt = encrypt_decrypt('decrypt',  $_GET['invoiceno']);
   $invoicenoaa = $encrypted_txt;
   	$PurchaseInvoiceQuery = "SELECT
     p.discount as pdiscount,p.vat as pvat,p.*,
      pp.*,
      pt.*,
      l.*,
      c.*,
	  d.*
   FROM
      `purchaseinvoice_product` pp,
      purchaseinvoice p,
      party pt,
      location_master l,
      certificate_master c,
	  diamond_master d
   where
   d.diamond_id=pp.diamond and 
      c.certificateid=d.certificate_id
      and p.locationid=l.locationid
      and p.partyid=pt.partyid
      and p.purchase_invoiceid=pp.purchase_invoiceid
      and p.purchase_invoiceid = $invoicenoaa  group by pp.gpid order by pp.id ASC";
   	$PurchaseInvoiceResult = mysqli_query($con,$PurchaseInvoiceQuery);
	
   	$InvoiceDetails = mysqli_fetch_assoc($PurchaseInvoiceResult);
	if($InvoiceDetails['ptype']=='wvat')
	{
	  $ptype='Without VAT';
	}
	if($InvoiceDetails['ptype']=='hform')
	{
	  $ptype='H-Form';
	}
	if($InvoiceDetails['ptype']=='regular')
	{
	  $ptype='Regular';
	}
?>

<section class="main-section">
   <div class="container-fluid">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
       <li class="active">Edit Purchase Entry(<?php echo $ptype;?>)</li>
    </ol>
    <h2 class="text-center">Edit Purchase Entry(<?php echo $ptype;?>)</h2>
    <form action="inserteditpurchase.php" method="post" enctype="multipart/form-data">
		 <input type="hidden" value="<?php echo $invoicenoaa;?>" name="puurchaseid">
		  	<fieldset>
		    	<div style="border: medium">
         <!--<div class='col-xs-4'>
            <div class="form-group">
               <font><label >Party Name:</label><?php  //echo $InvoiceDetails['companyname']; ?> </font><br>
               <label >Address:&nbsp;</label><font size = "2"><?php //echo $InvoiceDetails['compnayaddress']; ?></font>
            </div>
         </div>
         <div class='col-xs-4'>
            <div class="form-group">
			    <font> <b>Contact No.&nbsp;:&nbsp;</b><?php  //echo $InvoiceDetails['contactnumber']; ?></font><br>
               <font>
						  <b>Vattin No.&nbsp;:&nbsp;</b><?php  //echo $InvoiceDetails['vattin']; ?></font>
            </div>
         </div>-->
		  <div class="col-sm-4">
				  <div class=" form-group">
				   <label for="partyid" class="col-sm-12">Select Party</label>
				  <select name="partyid" id="partyid" onchange="getpartycode();" class="dropdownselect2 form-control" required>
				  <option value="">Select Party</option>
				  <?php
					$getpartyid="select * from party where partystatus='1'";
					$partyres=mysqli_query($con,$getpartyid);
					while($p=mysqli_fetch_assoc($partyres)){
					 if($InvoiceDetails['partyid']==$p['partyid'])
					 {
					  echo '<option value="'.$p['partyid'].'" selected>'.$p['companyname'].'</option>';
					 }else{
						echo '<option value="'.$p['partyid'].'">'.$p['companyname'].'</option>';
					 }
					}
				  ?>
				</select>			  						
				 </div>
  	    	</div>
        <div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="partyid" class="col-sm-12">Select Party Code</label>
  			  		<select id="partycode" onchange="getpartyname();" class="dropdownselect2 form-control" required>
                <option value="">Select Party Code</option>
                <?php
                  $getpartyid="select * from party where partystatus='1'";
                  $partyres=mysqli_query($con,$getpartyid);
                  while($p=mysqli_fetch_assoc($partyres)){
					 if($InvoiceDetails['partyid']==$p['partyid'])
					 {
                    echo '<option value="'.$p['partyid'].'" selected>'.$p['referenceno'].'</option>';
					 }else{
                    echo '<option value="'.$p['partyid'].'">'.$p['referenceno'].'</option>';
					 }
                  }
                ?>
              </select>			  						
  					</div>
  	    	</div>
		 <div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="locationid" class="col-sm-12">Select Location</label>
  			  		<select name="locationid" id="locationid" class="dropdownselect2" required>
                <option value="">Select Location</option>
                <?php
                  $getlocationid="select * from location_master where locationstatus='1'";
                  $locationres=mysqli_query($con,$getlocationid);
                  while($loc=mysqli_fetch_assoc($locationres)){
					 if($InvoiceDetails['locationid']==$loc['locationid'])
					 {
                    echo '<option value="'.$loc['locationid'].'" selected>'.$loc['locationname'].'</option>';
					 }else{
                    echo '<option value="'.$loc['locationid'].'">'.$loc['locationname'].'</option>';
					 }
                  }
                ?>
              </select>			  						
  					</div>
  	    	</div>
         <div class='col-xs-4'>
			<div class="form-group">
			<label >Date:</label>
              <!-- <label><?php //echo date('d/m/Y',strtotime($InvoiceDetails['date'])); ?></label>-->
			  <input class="form-control datepicker" type="text" name="date" id="date" value="<?php echo date('d/m/Y',strtotime($InvoiceDetails['date'])); ?>" required>
			</div>
		 </div>
			 <div class='col-xs-4'>
            <div class="form-group">
			   <?php if($ptype=='Regular'){?>
			   <label >Reference Number:</label>
			   <input class="form-control" type="text" value="<?php echo $InvoiceDetails['invoiceno']; ?>" readonly>
			   <input  value="<?php echo $InvoiceDetails['invoiceno']; ?>" type="hidden" name="invoiceno" >
			   <?php } ?>
               
            </div>
         </div>
		 <?php if($ptype!='Regular'){?>
		 <div class="col-sm-4">
  	    		<div class=" form-group">
             <label >Purchase Invoice Number:</label>
  			  		<input class="form-control" value="<?php echo $InvoiceDetails['invoiceno']; ?>" onkeyup="checkinvoice();" type="text" name="invoiceno" id="invoiceno" required>
  			  	</div>
				<input type="hidden" id="partyid" value="<?php  echo $InvoiceDetails['partyid']; ?>">
				<?php } ?>
				<div id="checkinvoice" style="display: none" class="alert alert-danger">
   <strong>Error!</strong> Invoice Number already exists for this Party.
</div>
  	    	</div>
		 <div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Terms</label>
  			  		<input class="form-control" value="<?php echo $InvoiceDetails['terms']; ?>" type="text" name="terms" id="terms" >
  			  	</div>
  	    	</div>
		 <div class='col-xs-4'>
            <div class="form-group">
			   <label >Due date:</label>
               <input class="form-control duedatepicker" type="text" value="<?php echo date('Y-m-d',strtotime($InvoiceDetails['duedate'])); ?>" name="duedate" id="duedate" onchange="getreminderdate();">
               </div>
         </div>
		 <div class='col-xs-4'>
            <div class="form-group">
			  <label >Reminder Date:</label>
               <input class="form-control duedatepicker" type="text" name="reminderdate" id="reminderdate" value="<?php echo date('Y-m-d',strtotime($InvoiceDetails['reminderdate'])); ?>" >
            </div>
         </div>
      </div>
        <table class="table table-bordered table-hover" id="table">
          <thead>
            <tr>
              <th><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th>Certificate Number</th>
              <th>Certificate Type</th>
              <th>Carat</th>
              <th>Description</th>
              <th>Pcs</th>
              <th>Qty(in Carat)</th>
              <th>Rate</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
                        $PurchaseInvoiceResult2 = mysqli_query($con,$PurchaseInvoiceQuery);
						$i=1;
						//echo $PurchaseInvoiceQuery;
               while($row=mysqli_fetch_assoc($PurchaseInvoiceResult2))
               		 {
						$certi_type='';$caret='';$certi='';$certi_no='';$clarity='';
						$ppquery="select * from purchaseinvoice_product where purchase_invoiceid=".$row['purchase_invoiceid']." and rate=".$row['rate']."";
						$ppqueryres=mysqli_query($con,$ppquery);
						//echo $ppquery;
						$l=1;
						while($pprow=mysqli_fetch_assoc($ppqueryres))
						{
						$rapquery2="select * from diamond_master where diamond_id=".$pprow['diamond'];
						$rapres2=mysqli_query($con,$rapquery2);
						$rrow2=mysqli_fetch_assoc($rapres2);
						
						$rapquery3="select * from certificate_master where certificateid=".$rrow2['certificate_id'];
						$rapres3=mysqli_query($con,$rapquery3);
						$rrow3=mysqli_fetch_assoc($rapres3);
						
						if($l==1){
						$certi=$pprow['diamond'];
						$caret=$rrow2['weight'];
						$clarity=$rrow2['clarity'];
						$cut=$rrow2['cut'];
						$polish=$rrow2['polish'];
						$symmetry=$rrow2['symmetry'];
						$certi_no=$rrow3['certi_no'];
						$certi_type=$pprow['certi_type'];
						}else{
						$certi=$certi.','.$pprow['diamond'];
						$caret=$caret.','.$rrow2['weight'];
						$clarity=$clarity.','.$rrow2['clarity'];
						$cut=$cut.','.$rrow2['cut'];
						$polish=$polish.','.$rrow2['polish'];
						$symmetry=$symmetry.','.$rrow2['symmetry'];
						$certi_no=$certi_no.','.$rrow3['certi_no'];
						$certi_type=$certi_type.','.$pprow['certi_type'];
						}
						$l++;
						}
						$rapquery="select * from diamond_purchase where diamond_id=".$row['diamond'];
						$rapres=mysqli_query($con,$rapquery);
						$rrow=mysqli_fetch_assoc($rapres);
                        $totpcsqty=$totpcsqty+$row["pcs"];
						$totalamount=$totalamount+$row["amount"];
                        ?>
            <tr>
              <td><input class="case" type="checkbox"/></td>
              <td><a data-toggle="tooltip"  href="javascript:;" data-id="<?php echo $i;?>" value="<?php echo $row["diamond"];?>" onclick="showAjaxModal(<?php echo $i;?>);">
                  <input type="hidden" name="certi[]" value="<?php echo $certi;?>" id="certi_<?php echo $i;?>">
				  <input type="text" id="certino_<?php echo $i;?>" value="<?php echo $certi_no;?>" class="form-control" required readonly placeholder="Click to Select Certificate">
                </a>
              </td>
              <td>
                <input type="text" name="certitype[]" value="<?php echo $certi_type;?>" id="certitype_<?php echo $i;?>" class="form-control" required readonly>
              </td>
			  <td>
                <input type="text" name="caret[]" value="<?php echo $caret;?>" id="caret_<?php echo $i;?>" class="form-control" readonly>
              </td>
             <td>
                <input type="text" name="description[]"  value="<?php echo $row["description"];?>" id="description_<?php echo $i;?>" class="form-control" required>
              </td>
              <td>  
                <input type="text" value="<?php echo $row["pcs"];?>" name="pcs[]" id="pcs_<?php echo $i;?>" class="form-control"  onkeypress="return IsNumeric(event);" >
              </td>
              <td>
                <input type="text" value="<?php echo $row["quantity"];?>" name="qty[]" id="qty_<?php echo $i;?>" class="form-control d2"  onkeypress="return IsNumeric(event);" >
              </td>
              <td>
                <input type="text" value="<?php echo $row["rate"];?>" name="rate[]" id="rate_<?php echo $i;?>" class="form-control d2"   onkeypress="return IsNumeric(event);" >
              </td>
               <td>
                <input type="text" value="<?php echo $row["amount"];?>" name="amount[]" id="amountt_<?php echo $i;?>" class="form-control  totalgrossadd" readonly>
              </td>
            </tr>
            <?php $i++;  } ?>
		            </tbody>
		            <tfoot>
		            	<!--<tr>
              <td colspan="7"></td>
              <td>
                <input class="form-control" type="hidden" name="vat" id="vat" value="0">
                <label for="discount">Discount</label>
                <input class="form-control d2" type="text" value="<?php echo sprintf("%.2f",$InvoiceDetails['pdiscount']);?>" name="discount" id="discount" >                
              </td>
              <td>
                <label>Total Amount</label>
                <input class="form-control" type="text" value="<?php echo sprintf("%.2f",$InvoiceDetails['total']);?>" name="total" id="total" required readonly>
              </td>
            </tr>-->
						<tr>
              <td colspan="4"></td>
			   <td>
                <label for="discount">Discount</label>
                <input class="form-control d2" type="text" value="<?php echo sprintf("%.2f",$InvoiceDetails['pdiscount']);?>" name="discount" id="discount">                
              </td>
			  <td>
                <label for="discount">Subtotal</label>
                <input class="form-control" type="text"  value="<?php echo sprintf("%.2f",(round($totalamount-$InvoiceDetails['pdiscount'])));?>" name="subtotal" id="subtotal" readonly>                
              </td>
			  <td>
                <label for="discount">VATAV(in %)</label>
                <input class="form-control d2" type="text" value="<?php echo sprintf("%.2f",$InvoiceDetails['pvat']);?>"  name="vat" id="vat" >                
              </td>
			  <td>
                <label for="discount">VATAV Amount(in Rs.)</label>
                <input class="form-control" type="text" value="<?php echo sprintf("%.2f",(round((($totalamount-$InvoiceDetails['pdiscount'])*$InvoiceDetails['pvat'])/100)));?>" name="vatamount" id="vatamount" readonly>                
              </td>
             
              <td>
                <label>Total Amount</label>
                <input class="form-control" type="text" value="<?php echo sprintf("%.2f",$InvoiceDetails['total']);?>" name="total" id="total" required readonly>
              </td>
            </tr>
		            </tfoot>
	            </table>
        <div class='row'>
          <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
            <div class="form-group">
              <button class="btn btn-danger delete"   type="button">- Delete</button>
              <button class="btn btn-success addmore"  type="button">+ Add More</button>
            </div>
  	      </div>
  	    </div>
		<div class='row'>
          <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
            <div class="form-group">
			   <label>Notes:</label>
              <textarea class="form-control" name="notes" rows="5"><?php echo $InvoiceDetails['notes'];?></textarea>
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

<div class="modal fade" id="certimodal" role="dialog" style="z-index: 10000;">
    		<div class="modal-dialog">
      			<!-- Modal content-->
      			<div class="modal-content border-radius0">
	   				<div class="modal-body" style="padding: 0px;">
	   				</div>
	  			</div>
	  		</div>
	</div>
<?php
   include "../common/footer.php";
?>
<script src="../js/purchaseregular2.js"></script>