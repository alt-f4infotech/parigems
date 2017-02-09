<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";

$querypurchase="SELECT * FROM party";
$result = mysqli_query($con,$querypurchase);							
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	        <li><a href="../common/homepage.php">Home</a></li>
	        <li class="active">View All Party</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-left">View All Party</h3>
	    <hr>
		<table class="table table-striped" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
		data-show-columns="true">
		<thead>
			<tr>
				<th data-field="state" data-checkbox="true" ></th>
				<th data-sortable="true">Sr. No.</th>
				<th data-sortable="true">Party Code</th>
				<th data-sortable="true">Company Name</th>
				<th data-sortable="true">Company Address</th>
				<th data-sortable="true">Contact Number</th>
				<th data-sortable="true">Email</th>
				<th data-sortable="true">Website</th>
				<th data-sortable="true">Rapnet Id</th>
				<th data-sortable="true">Skype Id</th>
				<th data-sortable="true">Contact Person</th>
				<th data-sortable="true">Contact Person Number</th>
				<th data-sortable="true">Broker Name</th>
				<th data-sortable="true">Broker Contact Number</th>
				<th data-sortable="true">CST Number</th>
				<th data-sortable="true">VATTIN Number</th>
				<th data-sortable="true">PAN Number</th>
				<th data-sortable="true">CIN Number</th>
				<th data-sortable="true">IEC Code</th>
				<th data-sortable="true">GST Number</th>
				<th data-sortable="true">RBI Code</th>
				<?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
				<th data-sortable="true">Bank Details</th>
				<th data-sortable="true">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				while($row=mysqli_fetch_assoc($result)){
					$id=$row['partyid'];
					$partystatus=$row['partystatus'];
					if($partystatus=='0'){$class='danger';}
					echo "<tr class='$class'>";
						echo "<td class='center' style='text-align:center;'></td>";
						echo "<td class='number'>".$i++."</td>";										
						echo "<td class='center' style='text-align:center;'>".$row['referenceno']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['companyname']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['compnayaddress']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['contactnumber'];if($row['contactnumber2']!=''){ echo ' / '.$row['contactnumber2']; } echo  "</td>";
						echo "<td class='center' style='text-align:center;'>".$row['email'];if($row['email2']!=''){ echo ' / '.$row['email2']; } echo  "</td>";
						echo "<td class='center' style='text-align:center;'>".$row['website']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['rapnetid']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['skypid']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['contactperson']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['contact']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['brokername']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['brokercontact']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['cst']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['vattin']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['pan']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['cinnumber']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['ieccode']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['gstnumber']."</td>";
						echo "<td class='center' style='text-align:center;'>".$row['rbicode']."</td>";
						if($role=='SUPERADMIN'){
							$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
							$empname=mysqli_fetch_assoc($getempname);
						  echo "<td>".$empname['username']."</td>";
						  }
						echo "<td class='center' style='text-align:center;'><a data-toggle='tooltip' title='View' href='javascript:;' data-id='$id' class='btn btn-success' onclick='showAjaxModal($id);'>Bank Details</a></td>";
						echo "<td class='center' style='text-align:center;'>";
						if($partystatus!='0'){
							$encrypted_txt = encrypt_decrypt('encrypt', $id);
						echo "<a  href='editparty.php?partyid=$encrypted_txt' class='btn btn-primary'>Edit</a>
						<a  href='viewParty.php?partyid=$encrypted_txt' class='btn btn-warning'>View</a>
						<a onclick='deleteparty($id);' class='btn btn-danger'>Delete</a>";
						}else{ echo "<a onclick='ativeparty($id);' class='btn btn-success'>Active</a>";}				
						echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
		</table>
	</div>
</section>
<script>
		function showAjaxModal(uid)
        {
		 $.get('viewpartybank.php?partyid=' + uid, function(html){
                 $('#myModal .modal-body').html(html);
                 $('#myModal').modal('show', {backdrop: 'static'});
             });
		}
		function deleteparty(id)
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
							bootbox.alert("Party Deleted Successfully.",function(){
								window.location.href="viewallparty.php";
								});
                        }
   					}			 
   			}
   				 http2.open("GET","deleteparty.php?id="+id, true);
   				 http2.send(null);
				 }
	 }); 
		}
		function ativeparty(id)
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
							bootbox.alert("Party Activated Successfully.",function(){
								window.location.href="viewallparty.php";
								});
                        }
   					}			 
   			}
   				 http2.open("GET","ativeparty.php?id="+id, true);
   				 http2.send(null);
				 }
	 }); 
		}
</script>
<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
    <div class="modal-dialog college-edit-modal-dialog">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
	       <div class="modal-body" style="padding: 0px;"></div>
	    </div>
	  </div>
	</div>
<?php
include "../common/footer.php";
?>
	