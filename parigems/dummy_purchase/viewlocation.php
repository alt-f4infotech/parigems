<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";

$querypurchase="SELECT * FROM location_master";
$result = mysqli_query($con,$querypurchase);							
?>
<section class="main-section">
	<div class="container-fluid">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	        <li><a href="../common/homepage.php">Home</a></li>
	        <li class="active">View All Location</li>
	    </ol>
	   	<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
	    <h3 class="text-left">View All Location</h3>
	    <hr>
		<table class="table table-striped" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
		data-show-columns="true">
		<thead>
			<tr>
				<th data-field="state" data-checkbox="true" ></th>
				<th data-sortable="true">Sr. No.</th>
				<th data-sortable="true">Location Name</th>
				<?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
				<th data-sortable="true">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				while($row=mysqli_fetch_assoc($result)){
					$id=$row['locationid'];
					$locationstatus=$row['locationstatus'];
					if($locationstatus=='0'){$class='danger';}
					echo "<tr class='$class'>";
						echo "<td class='center' style='text-align:center;'></td>";
						echo "<td class='number'>".$i++."</td>";										
						echo "<td class='center' style='text-align:center;'>".$row['locationname']."</td>";
						if($role=='SUPERADMIN'){
							$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
							$empname=mysqli_fetch_assoc($getempname);
						  echo "<td>".$empname['username']."</td>";
						  }
						echo "<td class='center' style='text-align:center;'>";
						if($locationstatus!='0'){
						echo "<a onclick='deletelocation($id,0);' class='btn btn-danger'>Delete</a>";
						}else{ echo "<a onclick='deletelocation($id,1);' class='btn btn-success'>Active</a>";}				
						echo "</td>";
					echo "</tr>";
				}
			?>
		</tbody>
		</table>
	</div>
</section>
<script>
		function deletelocation(id,i)
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
                            if (i=='0') {
                              bootbox.alert("Location Deleted Successfully.",function(){
								window.location.reload();
								});
                            }
							if (i=='1') {
                              bootbox.alert("Location Activated Successfully.",function(){
								window.location.reload();
								});
                            }
                        }
   					}			 
   			}
   				 http2.open("GET","deletelocation.php?id="+id+"&action="+i, true);
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
	