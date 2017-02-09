<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";
if (isset($_POST['vat'])) {
	  if($_POST['vat']!=''){
	 $vat=" and i.invoicetype='With-VAT' and i.status='1'";
	  }
   }
else
{$vat="";}

if (isset($_POST['hform'])) {
	  if($_POST['hform']!=''){
	 $hform=" and i.invoicetype='H-Form' and i.status='1'";
	  }
   }
else
{$hform="";}

if (isset($_POST['cash'])) {
	  if($_POST['cash']!=''){
	 $cash=" and i.invoicetype='Cash' and i.status='1'";
	  }
   }
else
{$cash="";}

if (isset($_POST['hongkong'])) {
	  if($_POST['hongkong']!=''){
	 $hongkong=" and i.invoicetype='Hongkong' and i.status='1'";
	  }
   }
else
{$hongkong="";}

$querysale="SELECT b.*,i.* FROM saleinvoice i,basic_details b where 1 $vat $hform $cash $hongkong and b.userid=i.userid";
$result = mysqli_query($con,$querysale);							
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	        <li><a href="../common/homepage.php">Home</a></li>
	        <li class="active">View All Sale Invoice</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-center">View All Sale Invoice</h3>
		
		<form action="viewallsaleinvoice.php" method="post">
		<?php
		$getcount1="SELECT b.*,i.* FROM saleinvoice i,basic_details b where b.userid=i.userid and i.status='1' and i.invoicetype='With-VAT'";
		$result1=mysqli_query($con,$getcount1);
		$getcount2="SELECT b.*,i.* FROM saleinvoice i,basic_details b where b.userid=i.userid and i.status='1' and i.invoicetype='H-Form'";
		$result2=mysqli_query($con,$getcount2);
		$getcount3="SELECT b.*,i.* FROM saleinvoice i,basic_details b where b.userid=i.userid and i.status='1' and i.invoicetype='Cash'";
		$result3=mysqli_query($con,$getcount3);
		$getcount4="SELECT b.*,i.* FROM saleinvoice i,basic_details b where b.userid=i.userid and i.status='1' and i.invoicetype='Hongkong'";
		$result4=mysqli_query($con,$getcount4);
		?>
		<span class="">
         <p class="btn btn-default">
            <label for="vat" class="label label-danger"><input type="checkbox" onclick="this.form.submit();" name="vat" value="With-VAT" id="vat" style="display: none;">With VAT(<b><?php echo mysqli_num_rows($result1);?></b>)</label> 
            <label for="hform" class="label label-success"><input type="checkbox"  onclick="this.form.submit();" name="hform" value="H-Form" id="hform" style="display: none;">H-Form (<b><?php echo mysqli_num_rows($result2);?></b>)</label>
            <label for="cash" class="label label-warning"><input type="checkbox" onclick="this.form.submit();" name="cash" value="Cash" id="cash" style="display: none;">Cash (<b><?php echo mysqli_num_rows($result3);?></b>)</label>
			<label for="hongkong" class="label label-info"><input type="checkbox" onclick="this.form.submit();" name="hongkong" value="Hongkong" id="hongkong" style="display: none;">Hongkong (<b><?php echo mysqli_num_rows($result4);?></b>)</label>
         </p>
      </span>
		</form>
		
		<table class="table table-striped" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
		data-show-columns="true">
		<thead>
			<tr>
				<th data-field="state" data-checkbox="true" ></th>
				<!--<th data-field="srno" data-sortable="true">Sr. No.</th>-->
				<th data-field="productname" data-sortable="true">Invoice Number</th>
				<th data-field="TotalQty" data-sortable="true">Company Name</th>
				<th data-field="code" data-sortable="true">Contact Number</th>
				<th data-field="date" data-sortable="true">Date</th>
				<th data-field="Amount" data-sortable="true">Total</th>
				<th data-field="type" data-sortable="true">Invoice Type</th>
				<?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
				<th data-field="action" data-sortable="true"  >Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				while($row=mysqli_fetch_assoc($result)){
					$id=$row['invoiceno'];
					$status=$row['status'];
					$invoicetype=$row['invoicetype'];
					if($invoicetype=='With-VAT'){$class='danger';}
					else if($invoicetype=='H-Form'){$class='success';}
					else if($invoicetype=='Cash'){$class='warning';}
					else if($invoicetype=='Hongkong'){$class='info';}
                    else{$class='';}
					if (strpos($invoicetype, 'Dummy') == false) {
					    echo "<tr class='$class'>";
						echo "<td class='center' style='text-align:center;'></td>";
						//echo "<td class='number'>".$i++."</td>";										
						echo "<td class='center' style='text-align:center;'>PG-".$row['invoiceno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['companyname']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['phoneno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['date']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['finaltotal']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['invoicetype']."</td>";
						if($role=='SUPERADMIN'){
							$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
							$empname=mysqli_fetch_assoc($getempname);
						  echo "<td>".$empname['username']."</td>";
						  }
						echo "<td class='center' style='text-align:center;'>";
						echo "<a  href='view_sale_invoice.php?id=".encrypt_decrypt('encrypt',$id)."'  class='btn btn-info'>View</a>&nbsp;";
                        if($status=='1')
                        {
						echo "<a  onclick='deleteinvoice($id)'  class='btn btn-danger'>Delete</a>";
                        }else{
						echo "<a  onclick='activeinvoice($id)'  class='btn btn-success'>Undo</a>";
                        }
						echo "</td>";
					echo "</tr>";
					}
				}
			?>
		</tbody>
		</table>
	</div>
</section>
<script>
function deleteinvoice(id)
        {
			var r =  bootbox.confirm("Are you sure want to delete Invoice Number: PG-"+id+"?", function(result) {
    if (result == true) {
			if (window.XMLHttpRequest)
   	 	{// code for IE7+, Firefox, Chrome, Opera, Safari
   	  http2=new XMLHttpRequest();
   		}
   	else
   	 {// code for IE6, IE5
   	  http2=new ActiveXObject("Microsoft.XMLHTTP");
   	 }
   	http2.onreadystatechange=function()
   	{
   
   		if (http2.readyState==4 )
   				 {
   						var respo=http2.responseText;
                        if (respo==1)
                        {
							bootbox.alert("Invoice Deleted Successfully.",function(){
								window.location.reload();
								});
                        }
   					}			 
   			}
   				 http2.open("GET","deletesaleinvoice.php?id="+id, true);
   				 http2.send(null);
				 }
	 }); 
		}
		
		
		function activeinvoice(id)
        {
		  var r =  bootbox.confirm("Are you sure want to delete Invoice Number: PG-"+id+"?", function(result) {
    if (result == true) {
			if (window.XMLHttpRequest)
   	 	{// code for IE7+, Firefox, Chrome, Opera, Safari
   	  http2=new XMLHttpRequest();
   		}
   	else
   	 {// code for IE6, IE5
   	  http2=new ActiveXObject("Microsoft.XMLHTTP");
   	 }
   	http2.onreadystatechange=function()
   	{
   
   		if (http2.readyState==4 )
   				 {
   						var respo=http2.responseText;
                        if (respo==1)
                        {
							bootbox.alert("Invoice Deleted Successfully.",function(){
								window.location.reload();
								});
                        }
   					}			 
   			}
   				 http2.open("GET","activesaleinvoice.php?id="+id, true);
   				 http2.send(null);
				 }
	 }); 
		}
</script>
<?php
include "../common/footer.php";
?>
	