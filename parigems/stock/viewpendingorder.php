<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  
  	$queryStock1="SELECT l.* FROM invoice i,login l where l.userid=i.userid and  i.status='1' ";
  	$result1 = mysqli_query($con,$queryStock1);
  	
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
	  <ol class="breadcrumb" id="breadcrumb" style="color: black">
	    <li><a href="../common/homepage.php">Home</a></li>
	    <li class="active">Pending Delivery Orders</li>
	  </ol>
	  <h3 align="center">Pending Delivery Orders</h3>
	  <?php
	    if(mysqli_num_rows($result1) > 0){ ?>
	  <div id="toolbar">
	    <select class="form-control">
	      <option value="">Export Basic</option>
	      <option value="all">Export All</option>
	      <option value="selected">Export Selected</option>
	    </select>
	  </div>
	  <table class="table table-striped" id="table"
	    data-height="400"
	    data-show-columns="true"
	    data-toggle="table"
	    data-search="true"
	    data-show-export="true"
	    data-pagination="true"
	    data-click-to-select="true"
	    data-toolbar="#toolbar"
	    data-show-refresh="true"
	    data-show-toggle="true"
	    data-show-columns="true"
	    >
	    <thead>
	      <tr>
	        <th data-field="state" data-checkbox="true" ></th>
	        <!--<th data-field="srno" data-sortable="true">Sr. No.</th>-->
			<th data-sortable="true">Order No.</th>
	        <th data-field="productname" data-sortable="true"  >Customer Name</th>
			 <th data-field="date" data-sortable="true"  >Order Date</th>
	        <th data-field="soldQty" data-sortable="true"  >Total Stone</th>
	        <th data-field="stockid" data-sortable="true"  >PG Stock Id</th>
	        <th data-field="totalcarat" data-sortable="true"  >Total Carat</th>
	        <th data-field="Amount" data-sortable="true"  >Total Amount $</th>
	        <th data-field="action" data-sortable="true"  >Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php
	        $queryStock="SELECT sum(i.amount) as total,sum(i.qty) as qty,d.*,l.*,i.invoiceid FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' and i.deliverystatus is NULL group by i.invoiceid  order by i.invoiceid DESC";
	        $result = mysqli_query($con,$queryStock);
	        $i=1;
	         while($row=mysqli_fetch_assoc($result))
	         {
	        	$user=$row['userid'];
				$invoiceid=$row['invoiceid'];
				$invoiceid2=encrypt_decrypt('encrypt',$row['invoiceid']);
				$query2="SELECT d.*,i.*,l.* FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' and i.invoiceid='$invoiceid' ";
	            $result2 = mysqli_query($con,$query2);
				
				$getinvoicedate="select date from invoice where invoiceid=".$row['invoiceid'];
				$dateresult=mysqli_query($con,$getinvoicedate);
				$row2=mysqli_fetch_assoc($dateresult);
	        	if($row['qty']!='0'){
	        	   echo "<tr>";
	        		echo "<td class='center' style='text-align:center;'></td>";
	        		//echo "<td class='number'>".$i++."</td>";		
					echo "<td>".$invoiceid."</td>";								
	        		echo "<td class='center' style='text-align:center;'>".$row['username']."</td>";
					echo "<td>".date('d-m-Y g:i:s A',strtotime($row2['date']))."</td>";
	        		echo "<td class='number'>".$row['qty']."</td>";
	        		echo "<td class='number'>";
					$caret=0;
					while($prw=mysqli_fetch_assoc($result2))
					{					  
				      $caret=$caret + $prw['weight'];				
					  $certificteqry="select * from certificate_master where certificateid=".$prw['certificate_id'];
                      $certiresult=mysqli_query($con,$certificteqry);
                     while($crow=mysqli_fetch_assoc($certiresult)){
                        $lab=$crow['certi_name'];
                        $reportno=$crow['report_no'];
						$certi_no=$crow['certi_no'];
                        $certiimage='../diamond_upload/'.$crow['logo'];
                     }
					  echo "<a href=".$certiimage." target='_blank' title='View Certificate'>".$prw['referenceno'].'</a><br>';
					}
					echo "</td>";					
	          	    echo "<td>".sprintf("%.2f",$caret)."</td>";
	        		echo "<td class='number'>$".sprintf("%.2f",$row['total'])."</td>";
	        		echo "<td class='names'><a href='pendingorder.php?id=$invoiceid2' class='btn btn-success'>View Order</a></td>";
	        		echo "</tr>";
	        	}else{echo "No Pending Orders.";}
	        }
	        
	        ?>
	    </tbody>
	  </table>
	  <?php }else{ echo "<center><font size='6' color='red'>No Orders Found.</font></center>"; } ?>
	</div>
</section>
<?php
  include "../common/footer.php";
  ?>