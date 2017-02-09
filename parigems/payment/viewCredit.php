<?php
   ob_start();
   error_reporting(0);
   session_start();
   
   include "../common/header.php";
   
   
   ?>
<style>
   @media print {
   body {
   background: white;       
   padding: 0;
   }
   }
   table#recTable1{width:100%; border:1px solid black;margin-top:22px;}
   table#recTable{width:100%;text-align: center; border:1px solid black;margin-top:-2px;}
   #recTable tr td {height:20px; border:1px solid black;}		
</style>
<div class="container hidden-print content">
   <div style="float: right" class="form-group">
      <button  class="btn btn-danger delete"  onclick="window.print()">Print</button>
   </div>
   <h3 align="center">Credit Note Details</h3>
   <table class="table" style="margin-top:40px;" id="tableProduct">
      <thead>
         <tr>
            <th data-field="srno1" data-sortable="true" >Sr.No.</th>
            <th data-field="invoice1" data-sortable="true" >Invoice Number</th>
            <th data-field="customer1" data-sortable="true" >Customer Name</th>
            <th data-field="Date11" data-sortable="true" >Date</th>
            <th data-field="Amount1" data-sortable="true" >Amount</th>
         </tr>
      </thead>
      <tbody>
         <?php
            $getInvoiceProductsQuery1= "select cd.*,c.* from creditnote cd inner join  customer c  where c.customerid=cd.customerid and id=".$_GET['id'];
            
            $getInvoiceProductsResult1 = mysqli_query($con,$getInvoiceProductsQuery1);
            $i=1;$sr=1;
             while($row=mysqli_fetch_assoc($getInvoiceProductsResult1))
            	 {
            	  
               
            	  
            	  $invoiceno=$row['invoiceno'];
            	  $inlen=strlen($invoiceno);
            if($inlen==1){ $invv= 'S/00'.$invoiceno;}
            else if($inlen==2){  $invv= 'S/0'.$invoiceno;}
            else{ $invv= 'S/'.$invoiceno;}
            		echo 	"<tr>";
            
            					echo "<td>".$sr++."</td>";
            					echo "<td>" .$invv. "</td>";
            					echo "<td>" .$row['customername']. "</td>";
            					echo "<td>" .$row['date']. "</td>";
            					echo "<td>" .$row['amount']. "</td>";
            					
            echo "</tr>";
            
            	 }?>
      </tbody>
   </table>
</div>
<body class="print-mode print-paper-a4">
   <div class="print-papers print-preview">
   <div class="visible-print-inline col-xs-12" >
      <table  id="recTable1" border="1" >
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
               <table class="table" style="margin-top:40px;" id="tableProduct">
                  <thead>
                     <tr>
                        <th data-field="srno1" data-sortable="true" >Sr.No.</th>
                        <th data-field="invoice1" data-sortable="true" >Invoice Number</th>
                        <th data-field="customer1" data-sortable="true" >Customer Name</th>
                        <!--<th data-field="product" data-sortable="true" >Product Name</th>-->
                        <th data-field="Date11" data-sortable="true" >Date</th>
                        <th data-field="Amount1" data-sortable="true" >Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $getInvoiceProductsQuery1= "select cd.*,c.* from creditnote cd inner join  customer c where c.customerid=cd.customerid and id=".$_GET['id'];
                        $getInvoiceProductsResult1 = mysqli_query($con,$getInvoiceProductsQuery1);
                        $i=1;$sr=1;
                         while($row=mysqli_fetch_assoc($getInvoiceProductsResult1))
                        	 {
                        	  
                        	   $getInvoiceProductsQuery12= "select * from product_master where product_id=".$row['id'];
                        $getInvoiceProductsResult12 = mysqli_query($con,$getInvoiceProductsQuery12);
                        
                         while($row2=mysqli_fetch_assoc($getInvoiceProductsResult12))
                        	 {
                        	  $productname=$row2['productname'];
                        	 }
                        	  
                        		echo 	"<tr>";
                        
                        					echo "<td>".$sr++."</td>";
                        					echo "<td>" .$invv. "</td>";
                        					echo "<td>" .$row['customername']. "</td>";
                        					echo "<td>" .$row['date']. "</td>";
                        					echo "<td>" .$row['amount']. "</td>";
                        					
                        					
                        	
                        echo "</tr>";
                        
                        	 }?>
                  </tbody>
               </table>
               <br><br>
               <table id="recTable2" border="1" >
			   <tr>
                  <td>
                     <div>
                        <span class="col-xs-8" style="font-size: 12px">FSSI NO. 11515019000281, 11516019000245<br> VAT TIN NO. 27370344046V w.e.f 01-04-06<br>CAT TIN NO. 27370344046C w.e.f 01-04-06</span>
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