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
      pt.*,pt.referenceno as partyreferenceno,
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
	//echo '<br><br><br>'.$PurchaseInvoiceQuery;
   	$InvoiceDetails = mysqli_fetch_assoc($PurchaseInvoiceResult);
	if($InvoiceDetails['ptype']=='vat')
	{
	  $ptype='With VAT';
	}
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
<style>
   @media print {
   body {
   background: white;       
   padding: 0;
   }
   }
   table#recTable1{width:100%;margin-top:3px;}
   table#recTable{width:100%;margin-top:-2px;}
   #recTable tr td th{height:20px;}
 
}
</style>
<section class="main-section">
   <div class="container hidden-print content crumb_tp">
<div class="container">
   <ol class="breadcrumb" >
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="viewallpurchase.php">View All Purchase Invoice</a></li>
      <li class="active">View Purchase Invoice(<?php echo $ptype;?>)</li>
   </ol>
      <!--<div style="float: right" class="form-group">
        <button  class="btn btn-danger delete"  onclick="printDiv('<?php echo $invoicenoaa;?>');">Print</button>
         &nbsp;&nbsp;&nbsp;
      </div>-->
      <h2 align="center">Purchase Invoice(<?php echo $ptype;?>)</h2>
      <br>
      <div style="border: medium">
         <div class="row">
  				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label>Party Name : </label><?php  echo $InvoiceDetails['companyname'].' [ '.$InvoiceDetails['partyreferenceno'].' ]'; ?>
  					</div>
  	    	  </div>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="locationid">Location : </label><?php  echo $InvoiceDetails['locationname']; ?>
  					</div>
  	    	</div>
				<?php if($ptype!='Regular'){?>
  				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Purchase Invoice Number : </label><?php  echo 'PI-'.$InvoiceDetails['invoiceno']; ?>
  	    	</div>
  	    	</div>
				<?php }else{ ?>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Reference Number : </label><?php  echo $InvoiceDetails['invoiceno']; ?>
  	    	</div>
  	    	</div>
				<?php } ?>
				
				<?php if($ptype!='Regular' && $ptype!='Without VAT'){?>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label>CST Number : </label><?php  echo $InvoiceDetails['cst']; ?>
  					</div>
  	    	  </div>
				<?php } ?>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Terms : </label><?php  echo $InvoiceDetails['terms']; ?>
  			  	</div>
  			  	</div>
				
				 <div class="col-sm-4">
            <div class=" form-group">
              <label for="date">Date : </label><?php  echo date('d-m-Y',strtotime($InvoiceDetails['date'])); ?>
            </div>
          </div>
				 <?php if($ptype!='Regular' && $ptype!='Without VAT'){?>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label>VATTIN Number : </label><?php  echo $InvoiceDetails['vattin']; ?>
  					</div>
  	    	  </div>
				<?php } ?>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Due Date : </label><?php  echo date('d-m-Y',strtotime($InvoiceDetails['duedate'])); ?>
  			  	</div>
  	    	</div>
				
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Reminder Date : </label><?php  echo date('d-m-Y',strtotime($InvoiceDetails['reminderdate'])); ?>
			  </div>
  	    	</div>
				<?php if($ptype!='Regular' && $ptype!='Without VAT'){?>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label>PAN Number : </label><?php  echo $InvoiceDetails['pan']; ?>
  					</div>
  	    	  </div>
				<?php } ?>
  			</div>
  		
      </div>
      <table class="table " style="margin-top:40px;" id="tableProduct">
         <thead>
            <tr>
               <th>Certificate Number</th>
              <th>Certificate Type</th>
              <th>Carat</th>
              <th>Description</th>
              <th>Pcs</th>
              <th>Qty(in Carat)</th>
              <th>Rate</th>
              <th>Amount</th>
			  <?php if($InvoiceDetails['ptype']!='vat'){?>
              <!--<th>Discount(in Rs.)</th>-->
			  <?php } if($InvoiceDetails['ptype']=='vat'){?>
              <!--<th>Amount</th>
              <th>VAT(in %)</th>
              <th>VAT Amount(in Rs.)</th>-->
			  <?php } ?>
              <th>Final Amount</th>
            </tr>
         </thead>
         <tbody>
            <?php
              $PurchaseInvoiceResult2 = mysqli_query($con,$PurchaseInvoiceQuery);
						$i=1;
						//echo $PurchaseInvoiceQuery;
               while($row=mysqli_fetch_assoc($PurchaseInvoiceResult2))
               		 {
						$certi_type='';$caret='';$certi='';$certi_no='';
						$ppquery="select * from purchaseinvoice_product where purchase_invoiceid=".$row['purchase_invoiceid']." and rate=".$row['rate']." and gpid=".$row['gpid'];
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
						$certi_no=$rrow3['certi_no'];
						$certi_type=$pprow['certi_type'];
						}else{
						$certi=$certi.','.$pprow['diamond'];
						$caret=$caret.','.$rrow2['weight'];
						$certi_no=$certi_no.','.$rrow3['certi_no'];
						$certi_type=$certi_type.','.$pprow['certi_type'];
						}
						$l++;
						}
						$rapquery="select * from diamond_purchase where diamond_id=".$row['diamond'];
						$rapres=mysqli_query($con,$rapquery);
						$rrow=mysqli_fetch_assoc($rapres);
                        $totpcsqty=$totpcsqty+$row["pcs"];
                        $totcarat=$totcarat+$row["quantity"];
						$totalamount=$totalamount+$row["amount"];
               			echo 	"<tr >";
               echo '<td class="name"><font '.$color.'>'.$certi_no.'</font></td>
                    <td class="name"><font '.$color.'>'.$certi_type.'</font></td> 
                    <td class="name"><font '.$color.'>'.$caret.'</font></td> 
                    <td class="name"><font '.$color.'>'.$row["description"].'</font></td> 
                    <td class="name"><font '.$color.'>'.$row["pcs"].'</font></td> 
                    <td class="name"><font '.$color.'>'.sprintf("%.2f",$row["quantity"]).'</font></td> 
                    <td class="number"><font '.$color.'>'.sprintf("%.2f",$row["rate"]).'</font></td> 
                    <td class="number"><font '.$color.'>'.sprintf("%.2f",($row["rate"] * $row["quantity"])).'</font></td>';
					if($InvoiceDetails['ptype']!='vat'){
                    //echo '<td style="text-align: right;"><font '.$color.'>'.$row["discount"].'</font></td>';
					}
					if($InvoiceDetails['ptype']=='vat'){
                   /* echo '<td style="text-align: right;"><font '.$color.'>'.(($row["rate"] * $row["quantity"])-$row["discount"]).'</font></td> 
                    <td style="text-align: right;"><font '.$color.'>'.$row["vat"].'</font></td> 
                    <td style="text-align: right;"><font '.$color.'>'.$row["vat_amount"].'</font></td>';*/
					}
               		echo '<td class="number"><font '.$color.'>'.sprintf("%.2f",$row["amount"]).'</font></td>
               	</tr >';
               		 }?>
         </tbody>
		 
		 
			<?php if($InvoiceDetails['ptype']=='hform' || $InvoiceDetails['ptype']=='wvat'){ ?>
			 <tr>
			<td colspan="1"></td>
			<td class="number" colspan="1"><b>Total Pcs</b></td><td class="number" colspan="1"><?php echo $totpcsqty;?></td>
			<td class="number" colspan="1"><b>Total Carat</b></td><td class="number" colspan="1"><?php echo $totcarat;?></td>
			<td class="number" colspan="1"><b>Total Discount</b></td><td class="number" colspan="1"><?php echo sprintf("%.2f",$InvoiceDetails['pdiscount']);?></td>
			<td class="number" colspan="1"><b>Total Amount</b></td><td class="number" colspan="1"><?php echo sprintf("%.2f",$InvoiceDetails['total']);?></td>
		  </tr>
		  <?php }?>
		  <?php if($InvoiceDetails['ptype']=='vat'){ ?>
		  <tr>
			<td class="number" colspan="4"><b>Total Pcs</b></td>
			<td class="number" colspan="1"><b>Total Carat</b></td>
			<td class="number" colspan="1"><b>Total Discount</b></td>
			<td class="number" colspan="1"><b>Subtotal</b></td>
			<td class="number" colspan="1"><b>VAT (<?php echo sprintf("%.2f",$InvoiceDetails['pvat']);?>%)</b></td>
			<td class="number" colspan="1"><b>Total Amount</b></td>
		  </tr>
		  <tr>
			<td class="number" colspan="4"><?php echo $totpcsqty;?></td>
			<td class="number" colspan="1"><?php echo $totcarat;?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",$InvoiceDetails['pdiscount']);?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",($totalamount-$InvoiceDetails['pdiscount']));?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",(round(((($totalamount-$InvoiceDetails['pdiscount'])*$InvoiceDetails['pvat'])/100))));?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",$InvoiceDetails['total']);?></td>
		  </tr>
		   <?php }?>
		   <?php if($InvoiceDetails['ptype']=='regular'){ ?>
		   <tr>
			<td class="number" colspan="4"><b>Total Pcs</b></td>
			<td class="number" colspan="1"><b>Total Carat</b></td>
			<td class="number" colspan="1"><b>Total Discount</b></td>
			<td class="number" colspan="1"><b>Subtotal</b></td>
			<td class="number" colspan="1"><b>VATAV (<?php echo sprintf("%.2f",$InvoiceDetails['pvat']);?>%)</b></td>
			<td class="number" colspan="1"><b>Total Amount</b></td>
		   </tr>
		  <tr>
			<td class="number" colspan="4"><?php echo $totpcsqty;?></td>
			<td class="number" colspan="1"><?php echo $totcarat;?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",$InvoiceDetails['pdiscount']);?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",($totalamount-$InvoiceDetails['pdiscount']));?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",(round(((($totalamount-$InvoiceDetails['pdiscount'])*$InvoiceDetails['pvat'])/100))));?></td>
			<td class="number" colspan="1"><?php echo sprintf("%.2f",$InvoiceDetails['total']);?></td>
		  </tr>
		   <?php }?>
      </table>
	  <div class='row'>
          <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
            <div class="form-group">
			   <label>Notes:</label>
              <?php echo $InvoiceDetails['notes'];?>
            </div>
  	      </div>
  	    </div>
   </div>
<h3>RAP Purchase Details</h3>
<?php
$PurchaseInvoiceQueryRap = "SELECT
     p.discount as pdiscount,p.vat as pvat,p.*,
      pp.*,
      pt.*,pt.referenceno as partyreferenceno,
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
      and p.purchase_invoiceid = $invoicenoaa  order by pp.id ASC";
 $PurchaseInvoiceResult22 = mysqli_query($con,$PurchaseInvoiceQueryRap);
               while($row2=mysqli_fetch_assoc($PurchaseInvoiceResult22))
               		 {
						$rapquery="select * from diamond_purchase where diamond_id=".$row2['diamond'];
						//echo $rapquery;
						$rapres=mysqli_query($con,$rapquery);
						$rrow=mysqli_fetch_assoc($rapres);
						?>
		<hr>
		<div class="row">
		 <div class="col-sm-3">
				<div class="form-group">
					<label>Certificate</label> : <?php echo $row2["certi_no"].'/'.$row2['referenceno'];?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>Rap</label> : <?php echo $rrow['rap'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount %</label> : <?php echo $rrow['discount1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>P/C</label> : <?php echo $rrow['pc'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>LESS</label> : <?php echo $rrow['discount2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>P A D</label> : <?php echo $rrow['pad'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount1</label> : <?php echo $rrow['discount3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount Amount1</label> : <?php echo $rrow['extraamount1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount2</label> : <?php echo $rrow['discount4'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount Amount2</label> : <?php echo $rrow['extraamount2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount3</label> : <?php echo $rrow['discount5'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount Amount3</label> : <?php echo $rrow['extraamount3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 1</label> : <?php echo $rrow['discount6'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount1</label> : <?php echo $rrow['expense1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 2</label> : <?php echo $rrow['discount7'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount2</label> : <?php echo $rrow['expense2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 3</label> : <?php echo $rrow['discount8'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount3</label> : <?php echo $rrow['expense3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 4</label> : <?php echo $rrow['discount9'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount4</label> : <?php echo $rrow['expense4'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Final</label> : <?php echo $rrow['final'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>USD</label> : <?php echo $rrow['usd'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Conv</label> : <?php echo $rrow['conv'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Extra Conv</label> : <?php echo $rrow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Total Conv</label> : <?php echo ($rrow['conv']+$rrow['extraconv']);?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>INR</label> : <?php echo $rrow['inr'];?>
				</div>
			</div>
		</div>
		<?php } ?>
	
</div>
</section>
<?php
   mysqli_close($con);
   ?>