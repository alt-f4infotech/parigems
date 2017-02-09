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
?>
   <section class="main-section hidden-print">
  <div class="container crumb_top">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="../saleinvoice/viewallsaleinvoice.php">View All Sale Invoice</a></li>
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
					<label><b>Date:</b></label> <?php echo $custrow['date'];?>
				  </div>
			 </div>
  			</div>
		   <div class="row">
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>VATTIN Number:</b></label> <?php echo $custrow['vattinnumber'];?>
				  </div>
				</div>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>CST Number:</b></label> <?php echo $custrow['cstnumber'];?>
				  </div>
			 </div>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>PAN Number:</b></label> <?php echo $custrow['pannumber'];?>
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
		  <tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Subtotal</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$finaltotal);?></td>
			</tr>
		  <?php if($custrow['discount']!='' || $custrow['discount']!='0'){?>
		  <tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Discount</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$custrow['discount']);?></td>
			</tr>
		  <?php } ?>
			<?php if($custrow['vat']!='0')
			{
			  $vatAmount=($finaltotal * $custrow['vat'])/100;
			  ?>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Add V.A TAX <?php echo sprintf("%.2f",$custrow['vat']);?>%</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$vatAmount);?></td>
			</tr>
			<?php }
			else{
			 $vatAmount=0;
			  }
			  $roundoff0=$finaltotal + $vatAmount;
			  $roundoff=round($roundoff0) - $roundoff0;
			  ?>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Roundoff</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$roundoff);?></td>
			</tr>
          <tfoot>
            <tr>
			 <td></td>
			  <td class="text-right">Total Carat</td>
			  <td class="text-right"><?php echo $finalCarat;?></td>
              <td class="text-right">Grand Total(in Rs.)</td>
              <td class="text-right"><?php echo sprintf("%.2f",$custrow['finaltotal']);?></td>
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
		
		<h3>RAP Sale Details</h3>
<?php
$getsaleinvoicedetailsSale= mysqli_query($con,"SELECT b.*,i.*,sp.*,c.*,d.* FROM saleinvoice i,basic_details b,saleinvoice_product sp,certificate_master c,
	  diamond_master d where d.diamond_id=sp.diamondid and c.certificateid=d.certificate_id and b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and i.invoiceno=".$id);
               while($row2=mysqli_fetch_assoc($getsaleinvoicedetailsSale))
               		 {
						$rapquery="select * from diamond_sale where diamond_id=".$row2['diamondid'];
						$rapres=mysqli_query($con,$rapquery);
						$srow=mysqli_fetch_assoc($rapres);
						
						$rapquerypurchase="select * from diamond_purchase where diamond_id=".$row2['diamondid'];
						$raprespurchase=mysqli_query($con,$rapquerypurchase);
						$rrow=mysqli_fetch_assoc($raprespurchase);
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
					<label>Rap</label> : <?php echo $srow['rap'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount %</label> : <?php echo $srow['discount1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>P/C</label> : <?php echo $srow['pc'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>LESS</label> : <?php echo $srow['discount2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>P A D</label> : <?php echo $srow['pad'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount1</label> : <?php echo $srow['discount3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount Amount1</label> : <?php echo $srow['extraamount1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount2</label> : <?php echo $srow['discount4'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount Amount2</label> : <?php echo $srow['extraamount2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount3</label> : <?php echo $srow['discount5'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount Amount3</label> : <?php echo $srow['extraamount3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 1</label> : <?php echo $srow['discount6'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount1</label> : <?php echo $srow['expense1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 2</label> : <?php echo $srow['discount7'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount2</label> : <?php echo $srow['expense2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 3</label> : <?php echo $srow['discount8'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount3</label> : <?php echo $srow['expense3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense 4</label> : <?php echo $srow['discount9'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense Amount4</label> : <?php echo $srow['expense4'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Final</label> : <?php echo $srow['final'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>USD</label> : <?php echo $srow['usd'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Conv</label> : <?php echo $srow['conv'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Extra Conv</label> : <?php echo $srow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Total Conv</label> : <?php echo ($srow['conv']+$srow['extraconv']);?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>INR</label> : <?php echo sprintf("%.2f",round($srow['inr']));?>
				</div>
			</div>
		</div>
		
		<div class="row">
							<div class="col-sm-6">
								<h3>Summary(in USD)</h3>
								<hr>
								<table class="carttable carttable2 table table-bordered table-shadow" align="left">
									<thead>
										<tr>
											<th>Sale</th>
											<th>Purchase</th>
											<th>Result in $</th>
										</tr>
									</thead>
									<?php $resultval1= $srow['usd']-$rrow['usd'];?>
									<tbody>
										<tr>
											<td id="salevalueusd" class="sale"><?php echo sprintf("%.2f",round($srow['usd']));?></td>
											<td id="purchasevalueusd" class="purchase"><?php echo sprintf("%.2f",round($rrow['usd']));?></td>
											<?php if($resultval1 > 0){ ?>
											<td id="resultvalueusd" class="profit"><?php echo sprintf("%.2f",round($resultval1));?></td>
											<?php }else{ ?>
											<td id="resultvalueusd" class="loss"><?php echo sprintf("%.2f",round($resultval1));?></td>
											<?php } ?>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-sm-6">
								<h3>Summary(in INR)</h3>
								<hr>
								<table class="carttable carttable2 table table-bordered table-shadow" align="left">
									<thead>
										<tr>
											<th>Sale</th>
											<th>Purchase</th>
											<th>Result in INR</th>
										</tr>
									</thead>
									<?php $resultval2= $srow['inr']-$rrow['inr'];?>
									<tbody>
										<tr>
											<td id="salevalueinr" class="sale"><?php echo sprintf("%.2f",round($srow['inr']));?></td>
											<td id="purchasevalueinr" class="purchase"><?php echo sprintf("%.2f",round($rrow['inr']));?></td>
											<?php if($resultval2 > 0){ ?>
											<td id="resultvalueinr" class="profit"><?php echo sprintf("%.2f",round($resultval2));?></td>
											<?php }else{ ?>
											<td id="resultvalueinr" class="loss"><?php echo sprintf("%.2f",round($resultval2));?></td>
											<?php } ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
		<?php } ?>
		
  		</fieldset>
  </div>
</section>
  <body class="print-mode print-paper-a4">
   <div class="container print-papers print-preview">
      <div class="visible-print-inline" style="font-size:14px;">
		<div class="row" style="border:1px solid black;min-height: 200px;">
		 <center><img src="../images/parigem_logo.png" style="width: 30%;height: 10%;"></center><br>
		 <div class="row">
		  <div class="text-center">
			<?php if($custrow['invoicetype']!='Cash'){?>
		<center><h4>LOCAL SALE OF POLISHED DIAMONDS<br><u>TAX INVOICE (Mumbai)</u></h4></center>
		 <?php }else{ ?>
		 <center><h4>LOCAL SALE OF POLISHED DIAMONDS<br><u>INVOICE (Mumbai)</u></h4></center>
		 <?php } ?>
		  </div>
		 </div>
		</div>
		 <div class="row" style="border:1px solid black;border-top:none;">
		  <div class="col-xs-6">
			<?php echo nl2br("<b>Sold To : <br> ".$custrow['companyname']."</b>
										    ".$custrow['office_address']."
										    ");
			?>
		  <br>
		  <?php echo nl2br("VAT TIN NO. : ".$custrow['vattinnumber'].
						   "<br>CST TIN no. : ".$custrow['cstnumber'].
						   "<br>P.A.N  :     ".$custrow['pannumber']);
			?>
		  </div>
		  <div class="col-xs-6">
		   <div class="row">
			 <div class="col-xs-12 text-left">
			   Local Invoice Number :&nbsp; <b>2016-2017/21</b>
			  </div>
		   </div>
			  <br>
			  <div class="row">
			   <div class="col-xs-12">
			    Date :<?php echo $custrow['date'];?>
				</div>
			 </div>
		   </div>
		  </div>
	    <div class="row" style="border-left:1px solid black;border-right:1px solid black;min-height:400px;">
        <table class="table" border="1">
             <tr>
                <td class="text-maxwidth text-center"><b>SR.NO.</b></td>
                <td class="text-maxwidth text-center"><b>DESCRIPTION OF GOODS</b></td>
                <td class="text-minwidth text-center"><b>WEIGHT IN CTS</b></td>
                <td class="text-minwidth text-center"><b>RATE PER CTS RS.</b></td>
                <td class="text-minwidth text-center"><b>AMOUNT RS.</b></td>
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
              <td class="text-center"><?php echo $srno++;?></td>
              <td><?php echo $row['description'];?></td>
			  <td class="text-center"><?php echo $row['carat'];?></td>
              <td class="text-center"><?php echo sprintf("%.2f",$rate);?></td>
              <td class="text-center"><?php echo sprintf("%.2f",$amount);?></td>
            </tr>
			<?php
            }
            ?>
			<tr>
			 <td height="200"></td> 
			 <td></td> 
			 <td></td> 
			 <td></td> 
			 <td></td> 
			</tr>
          </tbody>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Subtotal</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$finaltotal);?></td>
			</tr>
		  <?php if($custrow['discount']!='' || $custrow['discount']!='0'){?>
		  <tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Discount</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$custrow['discount']);?></td>
			</tr>
		  <?php } ?>
			<?php if($custrow['vat']!='0')
			{
			  $vatAmount=($finaltotal * $custrow['vat'])/100;
			  ?>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Add V.A TAX <?php echo sprintf("%.2f",$custrow['vat']);?>%</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$vatAmount);?></td>
			</tr>
			<?php }
			else{
			 $vatAmount=0;
			  }
			  $roundoff0=$finaltotal + $vatAmount;
			  $roundoff=round($roundoff0)- $roundoff0;
			  ?>
			<tr>
			 <td></td>
			  <td></td>
			  <td></td>
			 <td class="text-right">Roundoff</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$roundoff);?></td>
			</tr>
			<tr>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td class="text-right">Weighing Charges(in Rs.) LESS</td>
			  <td class="text-right">-<?php echo sprintf("%.2f",$custrow['discount']);?></td>
			</tr>
          <tfoot>
            <tr>
			 <td></td>
			  <td class="text-right">Total Carat</td>
			  <td class="text-right"><?php echo $finalCarat;?></td>
              <td class="text-right">Grand Total(in Rs.)</td>
              <td class="text-right"><?php echo sprintf("%.2f",$custrow['finaltotal']);?></td>
            </tr>
          </tfoot>
        </table>
		<p style="line-height: 3px;padding: 4px;">Rupees (in words)  : 
		<?php echo no_to_words(sprintf("%.2f",$custrow['finaltotal'])).'Only</p>';?>
       </div>
	   <div class="row" style="border:1px solid black;border-top:none;">
		<div class="col-xs-12 text-left">
          <?php echo nl2br('<b>Certification : </b>
						   I/We hereby certify that my/our registration certificate under the Maharashtra Value Added tax,2002 is in force on the date on which sale of the
						   goods specified in this bill/ invoice is made by me/us and that the transaction of sale covered by this bill/cash Memorandum has been effected by me/us and it shall be accounted for in the turnover of sales while filling my returns	and due tax, if any, payable on the sale has been paid or shall be paid.');?>
						   <br>
						   <?php echo nl2br('<b>Declaration : </b>
						   The diamond herein invoiced have been purchased from legitimate sources not involved in funding conflict & in compliance with United Nations
						    resolutions. The seller	hereby guarantees that these diamonds are conflict free, based on personal knowledge and/or written guarantees provided
							by the supplier of these diamonds.The diamonds herein invoiced are exclusively of natural origin and untreated based on personal knowledge
							and/or written guarantees provided by the supplier of these diamonds.The Acceptance of goods herein invoiced will be as per WFDB guideline.
							
							To the best of our knowledge and/or written assurances from our Suppliers, we state that “Diamonds herein invoiced have not been obtained in violation of applicable
							National laws and/or sanctions by the U.S. Department of Treasury’s office of Foreign Assets Control (OFAC) and have not originated from the Mbada and Marange
							Resources of Zimbabwe”.
							The diamonds herein invoiced are natural diamonds. We guarantee the originality of the diamonds supplied are free from any synthetic or treated diamonds.');?>
							<br>
							<?php echo nl2br('
						   <b>Bankers Details : </b>
						   <b>INDUSIND BANK</b>
						   OPERA HOUSE BRANCH INDUSIND HOUSE 425,D.B MARG, MUMBAI-400004.<br>ACCOUNT NO. : <b>200000097011 </b> <br> IFSC CODE : <b> INDB0000001</b>
						   P.A.N. : AANFP3387Q');?>
		<br><br>
		</div>
	   </div>
	   <div class="row" style="border:1px solid black;">
		<div class="col-xs-8 text-left" style="border-right:1px solid black;">
		  <?php echo nl2br('<b>GOODS SOLD & DELIVERED AT MUMBAI</b>
						   Subject to Mumbai Jurisdiction
						   VAT TIN NO.27540903400V WEF.10-03-2012
						   CST TIN NO.27540903400C WEF.10-03-2012
						   The invoice is exclusive of all other taxex and levies which will be collected if applicable.');?>
		</div>
		<div class="col-xs-4 text-right">
		  <?php echo nl2br('FOR : M/S PARI GEMS
						   <BR>
						   DIRECTOR/AUTHORISED SIGNATORY');?>
		</div>
	   </div>
	   <center>REGD OFFICE : 308,3rd Floor,Amrut Diamond House,Tata Road No.1, Opera House ,Girgaum,Mumbai,400 004,<br>T. :0222 41208616</center>
	  </div>
   </div>
</body>