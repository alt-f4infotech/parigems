<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";
    if (isset($_POST['locationid'])) {
	  if($_POST['locationid']!=''){
	 $locaqry=" and p.locationid=".$_POST['locationid'];
	  }
   }
   else
   {$locaqry="";}
   
   if (isset($_POST['partyid'])) {
	  if($_POST['partyid']!=''){
	 $paertqry=" and p.partyid=".$_POST['partyid'];
	  }
   }
   else
   {$paertqry="";}
   
   if (isset($_POST['ptype'])) {
	  if($_POST['ptype']!=''){
	 $ptype=" and p.ptype='".$_POST['ptype']."'";
	  }
   }
   else
   {$ptype="";}
   
   if (isset($_POST['wvat'])) {
	  if($_POST['wvat']!=''){
	 $wvat=" and p.ptype='wvat' and p.purchasestatus='1'";
	  }
   }
   else
   {$wvat="";}
   
   if (isset($_POST['vat'])) {
	  if($_POST['vat']!=''){
	 $vat=" and p.ptype='vat' and p.purchasestatus='1'";
	  }
   }
   else
   {$vat="";}
   
   if (isset($_POST['hform'])) {
	  if($_POST['hform']!=''){
	 $hform=" and p.ptype='hform' and p.purchasestatus='1'";
	  }
   }
   else
   {$hform="";}
   
   if (isset($_POST['regular'])) {
	  if($_POST['regular']!=''){
	 $regular=" and p.ptype='regular' and p.purchasestatus='1'";
	  }
   }
   else
   {$regular="";}
   
   if (isset($_POST['deleted'])) {
	  if($_POST['deleted']!=''){
	 $deleted=" and p.purchasestatus='0'";
	  }
   }
   else
   {$deleted="";}
//}
$querypurchase="SELECT p.empid as employeeid,p.*,pt.*,l.* FROM purchaseinvoice_dummy p, party pt,location_master l where 1 $vatqry $locaqry $paertqry $ptype $wvat $vat $hform $regular $deleted and p.partyid=pt.partyid and p.locationid=l.locationid";

$result = mysqli_query($con,$querypurchase);							
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	        <li><a href="../common/homepage.php">Home</a></li>
	        <li class="active">View All Dummy Purchase Invoice</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-left">View All Dummy Purchase Invoice</h3>
	    <hr>
		<form action="viewallDummypurchase.php" method="post">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
				 		<label for="locationid">By Location</label>
						<select class="dropdownselect2"  name="locationid" id="locationid" >
		                    <option value="">Select Location</option>
		                    <?php
		                        $getlocationid="select * from location_master where locationstatus='1'";
		                        $locationres=mysqli_query($con,$getlocationid);
		                        while($loc=mysqli_fetch_assoc($locationres)){
								  if($_POST['locationid']==$loc['locationid']){
		                            echo '<option value="'.$loc['locationid'].'" selected>'.$loc['locationname'].'</option>';
								  }else{
		                            echo '<option value="'.$loc['locationid'].'">'.$loc['locationname'].'</option>';
								  }
		                        }
		                    ?>
		                </select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
				 		<label for="locationid">By Party</label>
						<select class="dropdownselect2"  name="partyid" id="partyid2" >
		                    <option value="">Select Party</option>
		                    <?php
		                        $getpartyid="select * from party where partystatus='1'";
		                        $partyres=mysqli_query($con,$getpartyid);
		                        while($prty=mysqli_fetch_assoc($partyres)){
								  if($_POST['partyid']==$prty['partyid']){
		                            echo '<option value="'.$prty['partyid'].'" selected>'.$prty['companyname'].' [ '.$prty['referenceno'].' ] </option>';
								  }else{
		                            echo '<option value="'.$prty['partyid'].'">'.$prty['companyname'].' [ '.$prty['referenceno'].' ] </option>';
								  }
		                        }
		                    ?>
		                </select>
					</div>
				</div>
				<div class="col-lg-3 col-sm-4"><br>
					<div class="form-group">
						<button class="btn btn-success " type="submit">Submit</button>
						<a class="btn btn-warning"  onClick="window.location.href='viewallDummypurchase.php';">RESET ALL</a>
					</div>
				</div>
			</div>
		
		<?php
		$getcount1="SELECT p.*,pt.*,l.* FROM purchaseinvoice_dummy p, party pt,location_master l where p.partyid=pt.partyid and p.locationid=l.locationid and p.ptype='wvat' and p.purchasestatus='1'";
		$result1=mysqli_query($con,$getcount1);
		$getcount2="SELECT p.*,pt.*,l.* FROM purchaseinvoice_dummy p, party pt,location_master l where p.partyid=pt.partyid and p.locationid=l.locationid and p.ptype='vat' and p.purchasestatus='1'";
		$result2=mysqli_query($con,$getcount2);
		$getcount3="SELECT p.*,pt.*,l.* FROM purchaseinvoice_dummy p, party pt,location_master l where p.partyid=pt.partyid and p.locationid=l.locationid and p.ptype='hform' and p.purchasestatus='1'";
		$result3=mysqli_query($con,$getcount3);
		$getcount4="SELECT p.*,pt.*,l.* FROM purchaseinvoice_dummy p, party pt,location_master l where p.partyid=pt.partyid and p.locationid=l.locationid and p.ptype='regular' and p.purchasestatus='1'";
		$result4=mysqli_query($con,$getcount4);
		$getcount5="SELECT p.*,pt.*,l.* FROM purchaseinvoice_dummy p, party pt,location_master l where p.partyid=pt.partyid and p.locationid=l.locationid and p.purchasestatus='0'";
		$result5=mysqli_query($con,$getcount5);
		?>
		<span class="">
         <p class="btn btn-default view_all_diamond">
            <label for="wvat"><input type="checkbox" onclick="this.form.submit();" name="wvat" value="wvat" id="wvat" style="display: none;" ><span  style="background-color: #dff0d8;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Witout VAT(<b><?php echo mysqli_num_rows($result1);?></b>)</label> 
            <label for="vat"><input type="checkbox" onclick="this.form.submit();" name="vat" value="vat" id="vat" style="display: none;"><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;VAT (<b><?php echo mysqli_num_rows($result2);?></b>)</label>
            <label for="hform"><input type="checkbox"  onclick="this.form.submit();" name="hform" value="hform" id="hform" style="display: none;"><span style="background-color: #d9edf7;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;H-Form (<b><?php echo mysqli_num_rows($result3);?></b>)</label>
            <label for="regular"><input type="checkbox" onclick="this.form.submit();" name="regular" value="regular" id="regular" style="display: none;"><span  style="background-color: #faf2cc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Regular (<b><?php echo mysqli_num_rows($result4);?></b>)</label>
			<label for="deleted"><input type="checkbox" onclick="this.form.submit();" name="deleted" value="deleted" id="deleted" style="display: none;"><span  style="background-color: #fff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Deleted (<b><?php echo mysqli_num_rows($result5);?></b>)</label>
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
				<th data-field="srno" data-sortable="true">Sr. No.</th>
				<th data-field="productname" data-sortable="true"  >Purchase Invoice Number</th>
				<th data-field="TotalQty" data-sortable="true"  >Party Name</th>
				<th data-field="code" data-sortable="true"  >Party Code</th>
				<th data-field="soldQty" data-sortable="true"  >Location</th>
				<th data-field="date" data-sortable="true"  >Date</th>
				<th data-field="Amount" data-sortable="true"  >Total</th>
				<?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
				<th data-field="action" data-sortable="true"  >Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//echo $querypurchase;
				$i=1;
				while($row=mysqli_fetch_assoc($result)){
					$id=$row['purchase_invoiceid'];
					$purchasestatus=$row['purchasestatus'];
					$ptype=$row['ptype'];
					if($ptype=='vat'){$class='danger';}
					if($ptype=='wvat'){$class='success';}
					if($ptype=='hform'){$class='info';}
					if($ptype=='regular'){$class='warning';}
					if($purchasestatus=='0'){$class='';}
					 $encrypted_txt = encrypt_decrypt('encrypt', $id);
					 
					echo "<tr class='$class'>";
						echo "<td class='center' style='text-align:center;'></td>";
						echo "<td class='number'>".$i++."</td>";										
						echo "<td class='center' style='text-align:center;'>".'PI-'.$row['invoiceno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['companyname']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['referenceno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['locationname']."</td>";
						echo "<td class='center' style='text-align:center;'>".date('d-m-Y',strtotime($row['date']))."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['total']."</td>";
						if($role=='SUPERADMIN'){
							$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['employeeid']);
							$empname=mysqli_fetch_assoc($getempname);
						  echo "<td>".$empname['username']."</td>";
						  }
						echo "<td class='center' style='text-align:center;'>";
						if($purchasestatus!='0'){
						if($ptype=='vat'){
						echo "<a  href='edit_vpurchaseinvoice.php?invoiceno=$encrypted_txt' class='btn btn-primary'>Edit</a>";
						}
						else if($ptype=='regular'){
						echo "<a  href='edit_regular.php?invoiceno=$encrypted_txt' class='btn btn-primary'>Edit</a>";
						}
						else{
						   	echo "<a  href='edit_purchaseinvoice.php?invoiceno=$encrypted_txt' class='btn btn-primary'>Edit</a>";
						}
						echo "<a  onclick='deleteinvoice($id);' class='btn btn-danger'>Delete</a>";
						}else{
						//echo "<a  onclick='activeinvoice($id);' class='btn btn-success'>Activate</a><span class='btn btn-danger'>Deleted</span>";
						}
						echo "<a  href='view_Dpurchaseinvoice.php?invoiceno=$encrypted_txt'  class='btn btn-info'>View</a>";
						echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
		</table>
	</div>
</section>
<script>
function deleteinvoice(id)
        {
			var r =  bootbox.confirm("Are you sure?", function(result) {
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
   				 http2.open("GET","deletepurchaseinvoice.php?id="+id, true);
   				 http2.send(null);
				 }
	 }); 
		}
		
		
		function activeinvoice(id)
        {
			var r =  bootbox.confirm("Are you sure?", function(result) {
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
   				 http2.open("GET","activepurchaseinvoice.php?id="+id, true);
   				 http2.send(null);
				 }
	 }); 
		}
</script>
<?php
include "../common/footer.php";
?>
	