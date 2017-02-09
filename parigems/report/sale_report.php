<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";						
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	        <li><a href="../common/homepage.php">Home</a></li>
	        <li class="active">C.A Sales Report</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-center">C.A Sales Report</h3>
		<div class="table-responsive">
		<table class="table table-striped" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
		data-show-columns="true">
		<thead>
			<tr>
				<th>Sr.No.</th>
				<th data-sortable="true">Invoice No.</th>
				<th data-sortable="true">Date of Invoice</th>
				<th data-sortable="true">TIN of Purchase Dealer</th>
				<th data-sortable="true">Net Amount</th>
				<th data-sortable="true">Tax Amount</th>
				<th data-sortable="true">Total Amount</th>
				<?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
                $querysale="SELECT b.*,i.*,SUM(sp.amount) as subtotal,sp.diamondid FROM saleinvoice_dummy i,basic_details b,saleinvoice_product_dummy sp where b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and i.invoicetype='WithVat' group by sp.invoiceno";
                $result = mysqli_query($con,$querysale);
				while($row=mysqli_fetch_assoc($result))
				{
					$id=$row['invoiceno'];
					$diamondid=$row['diamondid'];
                    $conversion=$row['conversion'] + $row['extra_conversion'];
					if($conversion==0)
					{
						$conversion=1;
					}
                    $subtotal = $conversion * $row['subtotal'];
                    $taxAmount = $conversion  * $row['vatamount'];
					$totalSubtotal=$totalSubtotal + $subtotal;
					$totalTaxamount=$totalTaxamount + $row['vatamount'];
					$totalFinal=$totalFinal + $row['finaltotal'];
                    
					    echo "<tr>";
						echo "<td class='center' style='text-align:center;'>".$i++."</td>";					
						echo "<td class='center' style='text-align:center;'>PG-".$row['invoiceno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['date']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['vattinnumber']."</td>";
						echo "<td class='center' style='text-align:center;'>".sprintf("%.2f",$subtotal)."</td>";
						echo "<td class='center' style='text-align:center;'>".sprintf("%.2f",$row['vatamount'])."</td>";
						echo "<td class='center' style='text-align:center;'>".sprintf("%.2f",$row['finaltotal'])."</td>";
						if($role=='SUPERADMIN'){
							$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
							$empname=mysqli_fetch_assoc($getempname);
						  echo "<td>".$empname['username']."</td>";
						  }
					echo "</tr>";
				}
			?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>Total</td>
			<td><?php echo sprintf("%.2f",$totalSubtotal);?></td>
			<td><?php echo sprintf("%.2f",$totalTaxamount);?></td>
			<td><?php echo sprintf("%.2f",$totalFinal);?></td>
		</tr>
		</tbody>
		</table>
		</div>
	</div>
</section>
<?php
include "../common/footer.php";
?>
	