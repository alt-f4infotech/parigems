<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  ?>
<body>
	<section class="main-section">
	  <div class="container-fluid">
	    <ol class="breadcrumb" id="breadcrumb">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li class="active">View Order History</li>
	    </ol>
	    <h3 align="center">View Order History</h3>
	    <form action="historyorder.php" method="post">
	      <div class="row">
	        <div class="form-group col-lg-4">
	          <label>From</label>
	          <input type="text" name="fromDate" id="fromDate" class="form-control datepicker">
	        </div>
	        <div class="form-group col-lg-4">
	          <label>To</label>
	          <input type="text" name="toDate" id="toDate"  class="form-control datepicker">
	        </div>
	        <div class="form-group col-lg-4">
	        	<br>
	          <button class="btn btn-success" type="submit" name="go">Go</button>
	          <button class="btn btn-success"  onClick="reset();">RESET ALL</button>
	        </div>
	      </div>
	    </form>
		<span class="">
         <p class="btn btn-default">
            <label><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Cancelled</label>
		 </p>
		</span>
	    <div id="toolbar">
	      <select class="form-control">
	        <option value="">Export Basic</option>
	        <option value="all">Export All</option>
	        <option value="selected">Export Selected</option>
	      </select>
	    </div>
	    <table class="table table-bordered" id="table" data-height="400"
	      data-show-columns="true"
	      data-toggle="table"
	      data-search="true"
	      data-show-export="true"
	      data-pagination="true"
	      data-click-to-select="true"
	      data-toolbar="#toolbar"
	      data-show-refresh="true"
	      data-show-toggle="true"
	      data-show-columns="true">
	      <thead>
	        <tr>
	          <th data-field="state" data-checkbox="true" ></th>
	          <!--<th data-sortable="true">Sr. No.</th>-->
	          <th data-sortable="true">Order No.</th>
	          <th data-sortable="true">Order Date</th>
	          <th data-sortable="true">Total Stone</th>
	          <th data-sortable="true">Total Carat</th>
	          <th data-sortable="true">PG Stock Id</th>
	          <th data-sortable="true">Certificate Number</th>
	          <th data-sortable="true">Total Amount</th>
	          <th data-sortable="true">Action</th>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	          $i=1;
	          $today= date("Y-m-d");
	          $startdate= date("2000-01-01");
	          if(isset($_POST['go']))
	          {
	          if ($_POST['fromDate']!="" && $_POST['toDate']=="") {
			  $fromDate2 =  explode('/',$_POST['fromDate']);
              $fromDate=$fromDate2[2].'-'.$fromDate2[1].'-'.$fromDate2[0];
	          $from="and date between '$fromDate' and  '$today'";
	          }
	          else if ($_POST['toDate']!="" && $_POST['fromDate']=="") {
	          $toDate2 =  explode('/',$_POST['toDate']);
              $toDate=$toDate2[2].'-'.$toDate2[1].'-'.$toDate2[0];
	          $to="and date between '$startdate' and  '$toDate'";
	          }
	          else if ($_POST['toDate']!="" && $_POST['fromDate']!="") {
	          $fromDate2 =  explode('/',$_POST['fromDate']);
			  $fromDate=$fromDate2[2].'-'.$fromDate2[1].'-'.$fromDate2[0];
			  $toDate2 =  explode('/',$_POST['toDate']);
			  $toDate=$toDate2[2].'-'.$toDate2[1].'-'.$toDate2[0];
	          $both="and date between '$fromDate' and  '$toDate'";
	          }
	          else{
	          $to = "";
	          $from= "";								
	          $both = "";
	          }
	          }
	          $certificteqry1="select * from invoice where 1 $from $to $both and  userid='$userid' and status='1' order by invoiceid DESC";
	          $certiresult1=mysqli_query($con,$certificteqry1);
	          while($row=mysqli_fetch_assoc($certiresult1))
	          {
	          $invoiceid=$row['invoiceid'];
	             
				$count=0; 
			  $getDiamondDetails=mysqli_query($con,"select d.referenceno,c.certi_no from invoice_product i,diamond_master d,certificate_master c where  i.diamondid=d.diamond_id and c.certificateid=d.certificate_id and i.invoiceid='$invoiceid'");
			  while($diamondRow=mysqli_fetch_assoc($getDiamondDetails))
			  {
				if($count==0)
				{
				$pgStockId=$diamondRow['referenceno'];
				$certificateNo=$diamondRow['certi_no'];
				}
				else
				{
				 $pgStockId=$pgStockId.'<br>'.$diamondRow['referenceno'];
				$certificateNo=$certificateNo.'<br>'.$diamondRow['certi_no']; 
				}
				$count++;
			  }
			  
	          $certificteqry12="select sum(ip.amount) as total, SUM(ip.qty) as qty,SUM(d.weight) as weight,ip.deliverystatus from invoice_product ip,diamond_master d where ip.userid='$userid' and d.diamond_id=ip.diamondid and ip.invoiceid=$invoiceid";
	          $certiresult12=mysqli_query($con,$certificteqry12);
	          while($row2=mysqli_fetch_assoc($certiresult12))
	          {
	          $qty=$row2['qty'];
	          $caret=$row2['weight'];
			  $amount=$row2['total'];
			  
			   if($qty==1)
			  {
				$deliverystatus=$row2['deliverystatus'];
				if($deliverystatus=='1'){
					$class="success";
				 }
				 else if($deliverystatus=='0'){
					$class="danger";
				 }
				 else{
					$class="";
				 }
			  }
						  
	          }
			 if($qty > 0)
			 { 
			  echo "<tr class='$class'>";
	          echo '<td></td>';
	          	//echo "<td>".$i++."</td>";
	          	echo "<td>".$invoiceid."</td>";
	          	echo "<td>".date('d-m-Y g:i:s A',strtotime($row['date']))."</td>";
	          	echo "<td>".$qty."</td>";
	          	echo "<td>".sprintf("%.2f",$caret)."</td>";
	          	echo "<td>".$pgStockId."</td>";
	          	echo "<td>".$certificateNo."</td>";
	          	echo "<td>$".sprintf("%.2f",$amount)."</td>";
	          	echo "<td><a href='viewhistoryproduct.php?orderno=$invoiceid' class='btn btn-success'>View</a>
	          <!--<a href='viewhistoryproduct.php?orderno=$invoiceid' class='btn btn-primary'>Print</a>-->
	          </td>";
	          	echo "</tr>";
			 }
	          }                           
	          ?>
	        <!--<tr><td></td><td><b>Total</b></td><td><b><?php echo $final;?></b></td></tr>-->
	      </tbody>
	    </table>
	  </div>
  </section>
</body>
</html>