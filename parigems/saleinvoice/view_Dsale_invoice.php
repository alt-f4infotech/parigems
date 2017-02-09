<?php
include '../common/header.php';
   ob_start();
   session_start();
   error_reporting(0);
   $id=encrypt_decrypt('decrypt',$_GET['id']);
   
	 $getsaleinvoicedetails="SELECT b.*,i.*,sp.* FROM saleinvoice_dummy i,basic_details b,saleinvoice_product_dummy sp where b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and i.invoiceno=".$id." group by sp.invoiceno,sp.key";
     //echo '<br><br><br>'.$getsaleinvoicedetails;
	 $result1=mysqli_query($con,$getsaleinvoicedetails);
	 $result=mysqli_query($con,$getsaleinvoicedetails);
	 $result2=mysqli_query($con,$getsaleinvoicedetails);
	 $custrow=mysqli_fetch_assoc($result1);
?>
   <section class="main-section hidden-print">
  <div class="container crumb_top">
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
              <td class="text-right"><?php echo sprintf("%.2f",$row['rate']);?></td>
              <td class="text-right"><?php echo sprintf("%.2f",$row['amount']);?></td>
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
              <td class="text-right"><?php echo sprintf("%.2f",$custrow['finaltotal']);?></td>
            </tr>
          </tfoot>
        </table>
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
		<div class="row" style="border:1px solid black;min-height: 200px;">
		 <center><img src="../images/parigem_logo.png" style="width: 50%;height: 30%;"></center><br>
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
			<?php echo nl2br("<b>Sold To : ".$custrow['username']."</b>
							                ".$custrow['companyname']."
										    ".$custrow['office_address']."
										    ".$custrow['phoneno']);
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
			  Local Invoice Number :&nbsp; <b>PG-<?php echo $id;?></b>
			  </div>
		   </div>
			  <br>
			  <div class="row">
			   <div class="col-xs-12">
			    Date : <b><?php echo $custrow['date'];?></b>
				</div>
			 </div>
		   </div>
		  </div>
	   <div class="row" style="border-left:1px solid black;border-right:1px solid black;min-height:400px;">
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
              <td class="text-right"><?php echo sprintf("%.2f",$row['rate']);?></td>
              <td class="text-right"><?php echo sprintf("%.2f",$row['amount']);?></td>
            </tr>
			<?php
            }
            ?>
			<tr>
			 <td height="300"></td> 
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
			 <td class="text-right">Add VAT TAX <?php echo sprintf("%.2f",$custrow['vat']);?>%</td>
			 <td class="text-right"><?php echo sprintf("%.2f",$custrow['vatamount']);?></td>
			</tr>
			<?php } ?>
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
		<p style="line-height: 3px;padding: 4px;">Rupee (in words)  : 
		<?php echo no_to_words(sprintf("%.2f",$custrow['finaltotal'])).'Only</p>';?>
       </div>
	   <div class="row" style="border:1px solid black;border-top:none;">
		<div class="col-xs-12 text-left"><br><br>
          <?php echo nl2br('<b>Certification : </b>
						   I/We hereby certify that my/our registration certificate under the Maharashtra Value Added tax,2002 is in force on the date on which sale of the
						   goods specified in this bill/ invoice is made by me/us and that the transaction of sale covered by this bill/cash Memorandum has been effected by me/us and it shall be accounted for in the turnover of sales while filling my return
						   and due tax, if any,payable on the sale has been paid or shall be paid.');?>
						   <br>
						   <?php echo nl2br('<b>Declaration : </b>
						   The diamond herein invoiced have been purchased from legitimate sources not involved in funding conflict & in compliance with United Nations
						    resolutions. The seller	hereby guarantees that these diamonds are conflict free, based on personal knowledge and/or written guarantees provided by
							the supplier of these diamonds.The diamonds herin invoiced are exclusively of natural origin and untreated based on personal knowledge and/or
							written guarantess provided by the supplier of these diamonds.The Acceptance of goods herin invoiced will be as per WFDB guideline.To the best of our
							knowledge and/ or written assurance from our suppliers, we statethe diamonds herin invoiced have not beddn obtained in violation of applicable nation.');?>
							<br>
							<?php echo nl2br('
						   <b>Bankers Details : </b>
						   INDUSIND BANK
						   OPERA HOUSE BRANCH INDUSIND HOUSE 425,D.B MARG, MUMBAI-400004.ACCOUNT NO. : 200000097011  IFS CODE :INDB0000001
						   P.A.N. : AANFP3387Q');?>
		<br><br><br><br>
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
	   <center>REGD OFFICE : 308,3rd Floor,Amrut Diamond House,Tata Road No.1, Opera House ,Girgaun,Mumbai,400 004,<br>T. :0222 41208616</center>
	   
	  </div>
   </div>
</body>