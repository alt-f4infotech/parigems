<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $id=encrypt_decrypt('decrypt',$_GET['id']);
   
	 $getsaleinvoicedetails="SELECT b.*,i.*,sp.* FROM saleinvoice i,basic_details b,saleinvoice_product sp where b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and i.invoiceno=".$id;
     
	 $result1=mysqli_query($con,$getsaleinvoicedetails);
	 $result=mysqli_query($con,$getsaleinvoicedetails);
	 $result2=mysqli_query($con,$getsaleinvoicedetails);
	 $custrow=mysqli_fetch_assoc($result1);
     
     $getExportDetails=mysqli_query($con,"select * from hform_invoice where invoiceno='$id'");
     $export=mysqli_fetch_assoc($getExportDetails);
?>
   <section class="main-section hidden-print">
  <div class="container">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="../saleinvoice/viewallDummysaleinvoice.php">View All Sale Invoice</a></li>
      <li class="active">View Sale Invoice <?php echo $custrow['invoicetype'];?></li>
    </ol>
    <h2 class="text-center">View Sale Invoice <?php echo $custrow['invoicetype'];?></h2>
            <div class="row">
              <div class="col-sm-4">
			      <div class="form-group">
					<label><b>Invoice Number:</b></label> PG-<?php echo $id;?>
				  </div>
			 </div>
			  <div class="col-sm-4" style="float: right;">
			      <div class="form-group">
					<button onclick="window.print()" class="btn btn-danger">Print</button>
				  </div>
			 </div>
			</div>
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
			   <?php if($custrow['orderno']!=''){?>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>Order Number:</b></label> <?php echo $custrow['orderno'];?>
				  </div>
				</div>
			   <?php } ?>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>Date:</b></label><?php echo $custrow['date'];?>
				  </div>
			 </div>
  			</div>
           
          
          <div class="row">
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Exporters Reference Number : </b></label><?php echo nl2br($export["exporters_reference"]);?>
				  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Buyers & Order No. & Date : </b></label><?php echo nl2br($export["buyer_order"]);?>
				  </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-12">
			  <div class="form-group">
					<label><b>Other Reference(s) : </b></label><?php echo nl2br($export["other_reference"]);?>
				  </div>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Consignee : </b></label><?php echo nl2br($export["consignee"]);?>
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Buyer (Other than Consignee) : </b></label><?php echo nl2br($export["other_consignee"]);?>
			  </div>
			</div>
		  </div>
		</div>
	   </div>
	   <div class="row">
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Pre Carriage By : </b></label><?php echo nl2br($export["pre_carriage_by"]);?></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Place Of receipt By Precarrier : </b></label><?php echo nl2br($export["place_of_receipt"]);?></div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Vessel/Flight No. : </b></label><?php echo nl2br($export["flight_no"]);?></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Port Of Loading : </b></label><?php echo nl2br($export["port_of_loading"]);?></div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Port Of Discharge : </b></label><?php echo nl2br($export["port_of_discharge"]);?></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Final Destination : </b></label><?php echo nl2br($export["final_destination"]);?></div>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Country Of Origin Of Goods : </b></label><?php echo nl2br($export["country_of_origin_goods"]);?></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Country Of Final Destination : </b></label><?php echo nl2br($export["country_of_final_destination"]);?></div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-12">
			  <div class="form-group"><label><b>Terms Of Delivery & Payment : </b></label><?php echo nl2br($export["terms_of_delivery_payment"]);?></div>
			</div>
		  </div>
		</div>
	   </div>
           <br>
        <table class="table" border="1">
		  <thead>
             <tr>
                <th class="text-maxwidth text-center">Sr.No.</th>
                <th class="text-maxwidth text-center">Description of Goods</th>
                <th class="text-minwidth text-center">Weight(in Carat)</th>
                <th class="text-minwidth text-center">Rate(in Rs.)</th>
                <th class="text-minwidth text-center">Amount(in Rs.)</th>
            </tr>
			 </thead>
          <tbody>
		  <?php
		  $srno=1;
            while($row=mysqli_fetch_assoc($result))
			{
			   $diamondid=$row['diamondid'];
               $conversion=$row['conversion'] + $row['extra_conversion'];
			   if($conversion=='0')
			   {
				$conversion=1;
			   }
			   $amount=$conversion * $row['amount'];
			   $rate=($amount / $row['carat']);
               $finaltotal=$finaltotal + $amount;
               $finalCarat=$finalCarat + $row['carat'];
		   ?>
            <tr>
              <td class="text-right"><?php echo $srno++;?></td>
              <td><?php echo $row['description'];?></td>
			  <td class="text-right"><?php echo $row['carat'];?></td>
              <td class="text-right"><?php echo sprintf("%.2f",$rate);?></td>
              <td class="text-right"><?php echo sprintf("%.2f",$amount);?></td>
            </tr>
			<?php
            }
            ?>
			<tr>
			 <td height="100"></td> 
			 <td></td> 
			 <td></td> 
			 <td></td> 
			 <td></td> 
			</tr>
          </tbody>
			<?php if($custrow['vat']!='0')
			{?>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Add V.A TAX <?php echo sprintf("%.2f",$custrow['vat']);?>%</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$custrow['vatamount']);?></td>
			</tr>
			<?php } ?>
          <tfoot>
            <tr>
			 <td></td>
			  <td class="text-right">Total Carat</td>
			  <td class="text-right"><?php echo $finalCarat;?></td>
              <td class="text-right">Grand Total(in Rs.)</td>
              <td class="text-right"><?php echo sprintf("%.2f",$finaltotal);?></td>
            </tr>
          </tfoot>
        </table>
		<p style="line-height: 3px;padding: 4px;">Rupees (in words)  : 
		<?php echo no_to_words(sprintf("%.2f",$custrow['finaltotal'])).'Only</p>';?>
		
        <?php if($custrow['notes']!=''){?>
		<div class='row'>
          <div class='col-sm-6'>
            <div class="form-group">
			   <label>Notes:</label>
              <?php echo $custrow['notes'];?>
            </div>
  	      </div>
  	    </div>
        <?php } ?>
  		</fieldset>
  </div>
</section>
   <body class="print-mode print-paper-a4">
   <div class="container print-papers print-preview">
      <div class="visible-print-inline" style="font-size:12px;">
		 <div style="margin-top:-100px;"><center><h6>TAX INVOICE</h6></center></div>
		 <center><img src="../images/parigem_logo.png" style="width: 30%;height: 30%;"></center>
		 <div class="row" style="border:1px solid black;margin-top:10px;">
		  <div class="col-xs-6">
			  <b>PRIGEMS</b><br>
			 308,3rd Floor,Amrut Diamond House,<br>
			 Tata Road No.1, Opera House ,Girgaon,<br>
             Mumbai,400 004<br>0222 41208616
		  </div>
		  <div class="col-xs-6"  style="border-left:1px solid black;">
		   <div class="row"  style="border-bottom:1px solid black;">
			 <div class="col-xs-6 text-left">
			   Invoice No. & Date :<br>PG/EXP/<?php echo $id;?>/16-17, <?php echo $custrow['date'];?>
			  </div>
			 <div class="col-xs-6 text-left" style="border-left:1px solid black;">
					<label>Exporters Reference Number<br></label><?php echo nl2br($export["exporters_reference"]);?>
			  </div>
		   </div>
		   <div class="row">
			 <div class="col-xs-12 text-left" style="border-bottom:1px solid black;">
			  <label>Buyers & Order No. & Date </label><br><?php echo nl2br($export["buyer_order"]);?>
			 </div>
		   </div>
		   <div class="row">
			 <div class="col-xs-12 text-left" style="border-bottom:1px solid black;">
			  <label>Other Reference(s) : </label><br><?php echo nl2br($export["other_reference"]);?>
			 </div>
		   </div>
		   </div>
		  </div>
		 <div class="row" style="border:1px solid black;">
		  <div class="col-xs-6">
		   <label>Consignee</label><br><?php echo nl2br($export["consignee"]);?>
		  </div>
		  <div class="col-xs-6" style="border-top:none;">
			<div class="row" style="border-bottom:1px solid black;border-left:1px solid black;">
			  <div class="col-xs-12">
               <label>Buyer (Other than Consignee)</label><br><?php echo nl2br($export["other_consignee"]);?>
			  </div>
		    </div>
			<div class="row" style="border-left:1px solid black;">
			  <div class="col-xs-6">
              <label>Country Of Origin Of Goods</label><br><?php echo nl2br($export["country_of_origin_goods"]);?>
			  </div>
			  <div class="col-xs-6" style="border-left:1px solid black;">
              <label>Country Of Final Destination</label><br><?php echo nl2br($export["country_of_final_destination"]);?>
			  </div>
		    </div>
		  </div>
		 </div>
	   <div class="row" style="border:1px solid black;">
		<div class="col-xs-6">
		  <div class="row" style="border-bottom:1px solid black;">
			<div class="col-xs-6">
			  <label>Pre Carriage By</label><br><?php echo nl2br($export["pre_carriage_by"]);?>
			</div>
			<div class="col-xs-6"  style="border-left:1px solid black;">
			  <label>Place Of receipt By Precarrier</label><br><?php echo nl2br($export["place_of_receipt"]);?>
			</div>
		  </div>
		  <div class="row" style="border-bottom:1px solid black;">
			<div class="col-xs-6" >
			  <label>Vessel/Flight No.</label><br><?php echo nl2br($export["flight_no"]);?>
			</div>
			<div class="col-xs-6" style="border-left:1px solid black;">
			  <label>Port Of Loading</label><br><?php echo nl2br($export["port_of_loading"]);?>
			</div>
		  </div>
		  <div class="row">
			<div class="col-xs-6">
			  <label>Port Of Discharge</label><br><?php echo nl2br($export["port_of_discharge"]);?>
			</div>
			<div class="col-xs-6"  style="border-left:1px solid black;">
			  <label>Final Destination</label><br><?php echo nl2br($export["final_destination"]);?>
			</div>
		  </div>
		</div>
		<div class="col-xs-6"  style="border-left:1px solid black;">
		  <label>Terms Of Delivery & Payment : </label><?php echo nl2br($export["terms_of_delivery_payment"]);?>
		</div>
	   </div>
	   <div class="row" style="border-left:1px solid black;border-right:1px solid black;min-height:350px;">
        <table class="table" border="1">
             <tr>
                <td class="text-maxwidth text-center">SR.NO.</td>
                <td class="text-maxwidth text-center">DESCRIPTION OF GOODS</td>
                <td class="text-minwidth text-center">WEIGHT IN CTS</td>
                <td class="text-minwidth text-center">RATE PER CTS RS.</td>
                <td class="text-minwidth text-center">AMOUNT RS.</td>
            </tr>
          <tbody>
		  <?php
		  $srno=1;
            while($row=mysqli_fetch_assoc($result2))
			{
			   $diamondid=$row['diamondid'];
			   $amount=$conversion * $row['amount'];
			   $rate=($amount / $row['carat']);
		   ?>
            <tr>
              <td class="text-right"><?php echo $srno++;?></td>
              <td><?php echo $row['description'];?></td>
			  <td class="text-right"><?php echo $row['carat'];?></td>
              <td class="text-right"><?php echo sprintf("%.2f",$rate);?></td>
              <td class="text-right"><?php echo sprintf("%.2f",$amount);?></td>
            </tr>
			<?php
            }
            ?>
			<tr>
			 <td height="100"></td> 
			 <td></td> 
			 <td></td> 
			 <td></td> 
			 <td></td> 
			</tr>
          </tbody>
			<?php if($custrow['vat']!='0')
			{?>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Add V.A TAX <?php echo sprintf("%.2f",$custrow['vat']);?>%</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$custrow['vatamount']);?></td>
			</tr>
			<?php } ?>
          <tfoot>
            <tr>
			 <td></td>
			  <td class="text-right">Total Carat</td>
			  <td class="text-right"><?php echo $finalCarat;?></td>
              <td class="text-right">Grand Total(in Rs.)</td>
              <td class="text-right"><?php echo sprintf("%.2f",$finaltotal);?></td>
            </tr>
          </tfoot>
        </table>
		<u>DOOR TO DOOR INSURANCE COVERED BY BRINKS</u>
		<p style="line-height: 3px;padding: 4px;">Amount Chargeable (in words)</p>
		<?php echo "<p style='padding: 4px;'>TOTAL C & F US DOLLEARS &nbsp;". no_to_words(sprintf("%.2f",$custrow['finaltotal'])).'Only</p>';?>
       </div>
	   <div class="row" style="border:1px solid black;font-size:9px;">
		<div class="col-xs-12">
		<?php echo nl2br("PAYMENT INSTRUCTION : PLEASE REMIT THE PAYMENT THROUGH INDUSIND BANK LIMITED, OPERA HOUSE BRANCH, 425,
		DADASAHEB BHADKAMKAR MARG, MUMBAI-400004.A/C NO.-200000097011 AD-6000009
		DECLARATION :-
		THE DIAMONDS HEREIN INVOICED HAVE BEEN PURCHASE FROM LEGITIMATE SOURCES NOT INVOLVED IN FUNDING CONFLICT AND IN COMPANIANCE WITH
		UNITED NATIONS RESOLUTION. THE SELLER HEREBY GUARANTEES THAT THESE DIAMONDS AND CONFLICT FREE BASED ON PERSONAL KNOWLEDGE AND
		OT WRITTEN GUARANTEE PROVED BY THE SUPPLIER OF THESE DIAMONDS.");?>
		</div>
	   </div>
	   <div class="row" style="border:1px solid black;padding: 2px;font-size:9px;">
		<div class="col-xs-8" >
		<?php echo nl2br("Declaration:
						 We declare that this Invoice shows the actual price of the goods
						 described and that all particulars are true and correct.");?>
		</div>
		<div class="col-xs-4" style="border-left:1px solid black;">
		<?php echo nl2br('Signature & Date
						 <br><br>
                          ');?>
		</div>
	   </div>
	  </div>
   </div>
</body>