<?php
include"../common/header.php";
$querysale="SELECT * FROM saleinvoice_temp where status='1'";
$result = mysqli_query($con,$querysale);							
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	        <li><a href="../common/homepage.php">Home</a></li>
	        <li class="active">View All Manual Sale Invoice</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-center">View All Manual Sale Invoice</h3>
		<table class="table table-striped" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
		data-show-columns="true">
		<thead>
			<tr>
				<th data-field="state" data-checkbox="true" ></th>
				<th data-field="productname" data-sortable="true">Invoice Number</th>
				<th data-field="TotalQty" data-sortable="true">Company Name</th>
				<th data-field="code" data-sortable="true">Contact Number</th>
				<th data-field="date" data-sortable="true">Date</th>
				<th data-field="Amount" data-sortable="true">Total</th>
				<th data-field="action" data-sortable="true"  >Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				while($row=mysqli_fetch_assoc($result)){
					$id=$row['invoiceno'];
					$status=$row['status'];
					    echo "<tr class='$class'>";
						echo "<td class='center' style='text-align:center;'></td>";
						//echo "<td class='number'>".$i++."</td>";										
						echo "<td class='center' style='text-align:center;'>".$row['invoiceNumber']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['companyName']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['contactNumber']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['date']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['finaltotal']."</td>";
						echo "<td class='center' style='text-align:center;'>";
						echo "<a  href='view_sale_invoiceManual.php?id=".encrypt_decrypt('encrypt',$id)."'  class='btn btn-info'>View</a>&nbsp;";
						echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
		</table>
	</div>
</section>
<?php
include "../common/footer.php";
?>
	