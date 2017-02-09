<?php include"../common/header.php";
   ob_start();
   error_reporting(0);
   session_start();
   $id = $_GET['id'];
   $getpaymentQuery= "SELECT * FROM angadia_payment_receipt  where  receiptno=$id";
   $getpaymentResult = mysqli_query($con,$getpaymentQuery);
   $pay =mysqli_fetch_assoc($getpaymentResult);
   
    $date=$pay['date'];
    $partyname=$pay['partyname'];
    $amount=$pay['amount'];
    $paytype=$pay['paytype'];
    $chequeno=$pay['chequeno'];
   ?>
<style>
   @media print {
   body {
   background: white;       
   padding: 0;
   }
   }
   table#recTable1{width:100%;margin-top:22px;}
   table#recTable{width:100%;text-align: center;margin-top:-2px;}
   #recTable tr td {height:20px;}		
</style>
<section class="main-section">
<div class="container hidden-print content">
   <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="view_alldeposit.php">View All Deposit Entry</a></li>
      <li class="active">Deposit Receipt</li>
   </ol>
   <div style="float: right" class="form-group">
      <!--<button  class="btn btn-danger delete"  onclick="window.print()">Print</button>-->
   </div>
   <h2 align="center">Deposit Receipt</h2>
   <br>
   <div class="col-xs-6">
      <font><label>From : </label><?php  echo $partyname; ?></font>
   </div>
   <div class="col-xs-3">
      <font><label>Date :</label><?php echo date("d/m/Y", strtotime($date));?> </font>
   </div>
   <div class="col-xs-3">
      <font><label>Receipt Number : </label><?php echo $id;?> </font>
   </div>
   <br>
   <br>
   <br>
   <table class="table " style="margin-top:40px;" id="tableProduct">
      <thead>
         <tr>
        
            <th>Amount</th>
            <th>Paytype</th>
            <?php if($paytype=='cheque')
               { ?>
			      <th>Cheque Details</th>
            <th>Cheque Date</th>
         
            <?php } ?>
         </tr>
      </thead>
      <tbody>
         <?php
            $getpaymentQuery= "SELECT * FROM angadia_payment_receipt  where  receiptno=$id";
            $getpaymentResult = mysqli_query($con,$getpaymentQuery);
            
            
            $i=1;
             while($row=mysqli_fetch_assoc($getpaymentResult))
            	 {
            	  $notes=$row['notes'];
				   $totalAmount=$row["amount"];
            		echo 	"<tr>";
            echo 	'					
            
            	<td>'.$row["amount"].'</td>
            	<td>'.$row['paytype'].'</td>';
            	if($paytype=='cheque')
            		{
					 
					 	 echo '<td>'.$row['chequeno'].'</td>';
					echo '<td>'.$row['chequedate'].'</td>';
							
					 }
            echo '</tr>';
            	 }?>
      </tbody>
   </table>
      <?php echo "Rupees&nbsp;:&nbsp;". no_to_words($totalAmount).'Only<br><br>';?>
   <label>Notes:<?php echo $notes;?></label>
</div>
</div>
</section>
<body class="print-mode print-paper-a4">
   <div class="print-papers print-preview">
   <div class="visible-print-inline col-xs-12" >
	<div  style="height: 190px;border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;" >
      <table  id="recTable1" >
                  <tr>
                     <td>
                      <div id="printhead" style="margin-left: -35px;">
                       <center> <h6 style="margin-left:2%;">Subject to Vasai Jurisdiction <span style="float: right;font-size:10px;" ></span></h6></h6>
            <h2 align="left" style="margin:0px;"><img src="../../images/nakoda_1.png" style="height: 15%;width: 18%;margin:-40px 30px 0px 60px;">NAKODA TRADERS </h2>
                       <p style="line-height:100%;font-size: 12px;"><u>Wholeseller Dealer</u><br>Suger,Edible Oil,Chakki Fresh Atta,Maida,Suji & Besan<br><br>Shop No. 1,Dev Krupa Society,Near Vidhya Vihar School,Virat Nagar,Virar(W).<br>Mobile No.: 9158838837 / 9158881110</p></center>
                     </div>
            </td>
         </tr>
      </table>
</div>
	 <?php
	 $i=1;
	 $getpaymentQuery= "SELECT * FROM payment_receipt  where  receiptno=$id";
         $getpaymentResult = mysqli_query($con,$getpaymentQuery);
         
          while($row=mysqli_fetch_assoc($getpaymentResult))
         	 {
			   $totalAmount=$row["amount"];
         	  $notes=$row['notes'];
         	    }
			 ?>
          <div class="col-xs-3" style="float: right;">
						 <font><label>Receipt No: </label><?php echo $id;?> </font>	<br>
               
                        <font><label>Date :</label><?php echo date("d/m/Y", strtotime($date));?> </font><br>
                        <font><label>Rs :</label><?php echo $totalAmount;?> </font>
					
                     </div>
                
      <div style="height: 200px;border-left:1px solid black;border-right:1px solid black;">
		  <div class="col-xs-6">
                        <font>From: <?php  echo $partyname; ?></font>
                     </div>
		  <br>
		  
    <div class="col-xs-12">
	   <label>Particulars: <?php echo $notes;?> </label> <br><br>
	   <?php echo "Rupees&nbsp;:&nbsp;". no_to_words($totalAmount).'Only<br><br>';?>
      
      </div>
      </div>
	  <table id="recTable2" border="1" >
			   <tr>
                  <td>
                     <div>
                        <span class="col-xs-8" style="font-size: 10px">FSSI NO. 11515019000281, 11516019000245<br> VAT TIN NO. 27370344046V w.e.f 01-04-06<br>CAT TIN NO. 27370344046C w.e.f 01-04-06</span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>
                     <div>
                        <span class="col-xs-8" style="font-size: 8px">"I/We hereby certify that my/our registration certificate undet the maharashtra value added tax act 2002 is in force on the date on which the sales of goods specified in this tax invoice is made by me/us and that the transaction of sale covered by this tax invoice has been effectd by me/us and it shall be accounted in the run over of sales while filling of return and the due tax if any payable on this sale has been paid or shall be paid."</span>
                        <span style="float: right">
                        For Nakoda Traders</span>
                        <span style="float: right;margin-top: 5%"">Partners & Authorised Sign.</span>
                        <span class="col-xs-8" style="float: left;font-size:10px;">
                     
                        <b>NOTE: Good sold once will not taken back.</b></span>
                     </div>
                  </td>
               </tr>
            </table>
      </div>
   </div>
</body>