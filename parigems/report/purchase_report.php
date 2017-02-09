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
	        <li class="active">C.A Purchase Report</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-center">C.A Purchase Report</h3>
		<div class="table-responsive">
		<table class="table table-striped" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
		data-show-columns="true">
		<thead>
			<tr>
				<th data-checkbox="true" ></th>
				<th data-sortable="true">Invoice No.</th>
				<th data-sortable="true">Date of Purchase Invoice</th>
				<th data-sortable="true">TIN of Seller</th>
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
                $querysale="SELECT p.*,i.*,SUM(pp.amount) as subtotal,pp.diamond FROM purchaseinvoice i,party p,purchaseinvoice_product pp where p.partyid=i.partyid and i.purchase_invoiceid=pp.purchase_invoiceid and i.purchasestatus='1' and i.ptype='vat' group by pp.purchase_invoiceid";
                $result = mysqli_query($con,$querysale);
				while($row=mysqli_fetch_assoc($result))
				{
                   
					$totalSubtotal=$totalSubtotal + $row['subtotal'];
					 $taxAmount= round(($totalSubtotal * $row['vat'])/100);
					$totalTaxamount=$totalTaxamount + $taxAmount;
					$totalFinal=$totalFinal + $row['total'];
                    
					    echo "<tr>";
						echo "<td class='center' style='text-align:center;'></td>";					
						echo "<td class='center' style='text-align:center;'>PG-".$row['invoiceno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['date']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['vattin']."</td>";
						echo "<td class='center' style='text-align:center;'>".sprintf("%.2f",$row['subtotal'])."</td>";
						echo "<td class='center' style='text-align:center;'>".sprintf("%.2f",$taxAmount)."</td>";
						echo "<td class='center' style='text-align:center;'>".sprintf("%.2f",$row['total'])."</td>";
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
	