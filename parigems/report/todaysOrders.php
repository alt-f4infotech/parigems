<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  $today=date("Y-m-d");
  	$queryStock1="SELECT l.* FROM invoice i,login l where l.userid=i.userid and i.date like '%$today%'";
  	$result1 = mysqli_query($con,$queryStock1);
  	
  ?>
  <section class="main-section">
	<div class="container-fluid crumb_top">
	  	<ol class="breadcrumb" id="breadcrumb" style="color: black">
	    	<li><a href="../common/homepage.php">Home</a></li>
	    	<li class="active">Today's Orders</li>
	  	</ol>  
	  	<h3 align="center">Today's Orders</h3>
	  	<?php
	    	if(mysqli_num_rows($result1) > 0){ ?>
			  <div id="toolbar">
			    <select class="form-control">
			      <option value="">Export Basic</option>
			      <option value="all">Export All</option>
			      <option value="selected">Export Selected</option>
			    </select>
			  </div>
	  <table class="table table-striped" id="table" data-height="400" data-show-columns="true"
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
	    data-show-columns="true">
	    <thead>
	      <tr>
	        <th data-field="state" data-checkbox="true" ></th>
	        <!--<th data-field="srno" data-sortable="true">Sr. No.</th>-->
	         <th data-sortable="true">Order No.</th>
	        <th data-field="productname" data-sortable="true"  >Customer Name</th>
	        <th data-field="date" data-sortable="true"  >Order Date</th>
	        <th data-field="totalstone" data-sortable="true"  >Total Stone</th>
	        <th data-field="totalcarat" data-sortable="true"  >Total Carat</th>
	        <th data-field="Amount" data-sortable="true"  >Total Amount</th>
			 <?php if($role=='SUPERADMIN'){ ?>
			  <th data-sortable="true">Confirmed By</th> 
			 <?php } ?>
	        <th data-field="action" data-sortable="true"  >Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php
	        $queryStock="SELECT sum(i.amount) as total,sum(i.qty) as qty,sum(d.weight) as carat,d.*,l.*,i.invoiceid,i.empid FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2'  group by i.invoiceid order by i.invoiceid DESC";
	        $result = mysqli_query($con,$queryStock);
	        $i=1;
	         while($row=mysqli_fetch_assoc($result))
	         {
	        	$user=$row['userid'];
				$caret=$row['carat'];
				$invoiceid=encrypt_decrypt('encrypt',$row['invoiceid']);
				$getinvoicedate="select date from invoice where invoiceid=".$row['invoiceid']." and date like '%$today%'";
				$dateresult=mysqli_query($con,$getinvoicedate);
				$row2=mysqli_fetch_assoc($dateresult);
                if(mysqli_num_rows($dateresult) > 0)
                {
	        	   echo "<tr>";
	        		echo "<td class='center' style='text-align:center;'></td>";
	        		//echo "<td class='number'>".$i++."</td>";										
	        		echo "<td class='center' style='text-align:center;'>".$row['invoiceid']."</td>";
	        		echo "<td class='center' style='text-align:center;'>".$row['username']."</td>";
	          	    echo "<td>".date('d-m-Y g:i:s A',strtotime($row2['date']))."</td>";
	        		echo "<td>".$row['qty']."</td>";
	          	    echo "<td>".sprintf("%.2f",$caret)."</td>";
	        		echo "<td>".sprintf("%.2f",$row['total'])."</td>";
					if($role=='SUPERADMIN'){
					  $getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
					  $empname=mysqli_fetch_assoc($getempname);
					echo "<td>".$empname['username']."</td>";
					}
	        		echo "<td class='names'><a href='../stock/order.php?id=$invoiceid' class='btn btn-success'>View Order</a></td>";
	        		echo "</tr>";
                }
	        }
	        
	        ?>
	    </tbody>
	  </table>
	  <?php }
	  else{ echo "<center><font size='6' color='red'>No Orders Found.</font></center>"; } ?>
	</div>
  </section>
<?php
  include "../common/footer.php";
  ?>