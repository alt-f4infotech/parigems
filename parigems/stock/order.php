<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";
$id=encrypt_decrypt('decrypt',$_GET['id']);
	$queryStock="SELECT d.*,i.*,l.* FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' and i.invoiceid='$id' ";
	$result = mysqli_query($con,$queryStock);
	$result1 = mysqli_query($con,$queryStock);
	$rrow=mysqli_fetch_assoc($result1);
	$customername=$rrow['username'];
	if($customername!='')
	{
		$customername=' of '.$customername;
	}
?>
<section class="main-section">
	<div class="container-fluid crumb_top">
 <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
	<li><a href="vieworder.php">Orders</a></li>
	 <li class="active">Order List</li>
        </ol> 
		<p  style="margin-top: -20px;">  <h3 align="center">Order List  <?php echo $customername;?></h3></p>
		<form id="movieForm" action="confirmorder.php" method="post">
       <table class="table table-bordered" id="table" data-height="400" data-toggle="table" data-search="true" >
						 <thead style="font-size:9px;">
							  <tr>
								<!--<th data-field="state" data-checkbox="true" ></th>-->
								<!--<th data-field="srno" data-sortable="true">Sr. No.</th>-->
								  <!--<th data-field="productname" data-sortable="true"  >Customer Name</th>-->
								  <th><input type="checkbox" id="check_all" ></th>
									<th data-sortable="true">Stock Id</th>
									<th data-sortable="true">Cert</th>
									 <th data-sortable="true">Lab</th>
									 <th data-sortable="true">Shape</th>
									 <th data-sortable="true">Carat</th>
									 <th data-sortable="true">Clr</th>
									 <th data-sortable="true">Clrt</th>
									 <th data-sortable="true">Cut</th>
									 <th data-sortable="true">Pol</th>
									 <th data-sortable="true">Symm</th>
									 <th data-sortable="true">Flr</th>
									 <th data-sortable="true">Rap $</th>
									<th data-sortable="true">Dis%</th>
									<th data-sortable="true">P/C $</th>
									<!--<th data-sortable="true">Final</th>-->
									<th data-sortable="true">USD $</th>
									<th data-sortable="true">Amount $</th>
									<th data-sortable="true">Depth</th>  
									<th data-sortable="true">Table</th> 
								    <th data-sortable="true">Measur.</th>   
								    <th data-sortable="true">Delivery Status</th>   
								    <th data-sortable="true">Order Status</th>   
									<!--
								  <th data-field="soldQty" data-sortable="true"  >Total Qty</th>
								  <th data-field="Amount" data-sortable="true"  >Price</th>-->
								  <?php if($role=='SUPERADMIN'){ ?>
									<th data-sortable="true">Confirmed By</th> 
								   <?php } ?>
								  <!--<th data-field="action" data-sortable="true"  >Action</th>-->
							  </tr>
						  </thead>
								<tbody style="font-size:9px;">
								<?php
								$i=1;
								 while($row=mysqli_fetch_assoc($result))
								 {
									$user=$row['userid'];
									$diamondid=$row['diamondid'];
									$certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
									$certiresult=mysqli_query($con,$certificteqry);
									while($crow=mysqli_fetch_assoc($certiresult)){
									   $lab=$crow['certi_name'];
									   $reportno=$crow['report_no'];
									   $certi_no=$crow['certi_no'];
									   $certiimage='../diamond_upload/'.$crow['logo'];
									}
									$getcut="SELECT cps.semi as semicut FROM `diamond_master` d,cut_polish_sym cps where d.cut=cps.title and d.diamond_id=$diamondid";
									$getcutresult=mysqli_query($con,$getcut);
									$cutrow=mysqli_fetch_assoc($getcutresult);
									
									$getpolish="SELECT cps.semi as semipolish FROM `diamond_master` d,cut_polish_sym cps where  d.polish=cps.title and d.diamond_id=$diamondid";
									$getpolishresult=mysqli_query($con,$getpolish);
									$polishrow=mysqli_fetch_assoc($getpolishresult);
									
									$getsymmetry="SELECT cps.semi as semisymmetry FROM `diamond_master` d,cut_polish_sym cps where  d.symmetry=cps.title and d.diamond_id=$diamondid";
									$getsymmetryresult=mysqli_query($con,$getsymmetry);
									$symhrow=mysqli_fetch_assoc($getsymmetryresult);
									
									if($row['diameter_min']!='')
									{
									  $diameter_min=$row['diameter_min'].'X';
									}
									else{$diameter_min='';}
									if($row['diameter_max']!='')
									{
									  $diameter_max=$row['diameter_max'].'X';
									}
									else{$diameter_max='';}
									if($row['height']!='')
									{
									  $height=$row['height'];
									}
									else{$height='';}
									$measurement=$diameter_min.$diameter_max.$height;
									
									
									$getraprates="SELECT * FROM `diamond_sale` where diamond_id=$diamondid";
									$getrapratesresult=mysqli_query($con,$getraprates);
									$raprow=mysqli_fetch_assoc($getrapratesresult);
						
									$chevkcart="select * from add_to_cart where diamondid=$diamondid and userid=$user  and wishstatus='0'";
									$cartresult=mysqli_query($con,$chevkcart);
									$cartrow=mysqli_fetch_assoc($cartresult);
									
									$deliverystatus=$row['deliverystatus'];
									$diamond_user_status=$row['diamond_user_status'];
									if($deliverystatus=='1'){
										$class="success";
										$status='SY.Confirmed';
										$confirmStatus='CONFIRMED';
									 }
									 else if($deliverystatus=='0'){
										$class="danger";
										$status='SY.Cancelled ('.$row['cancelreason'].')';
										$confirmStatus='CANCELLED';
										$checked='disabled';
									 }
									 else{
										$class="";$checked='';$status='<font color="red">Pending</font>';
										$confirmStatus='CONFIRMED';
									 }
									  if($diamond_user_status=='HOLD')
									{
									$businessProcess='<font color="red">Business Process</font>';
									}
									else
									{
										$businessProcess="";
									}
									 
									$firstDiscount=$cartrow['discount'];
									if($firstDiscount < 0)
									{
										$explodeFirstDiscount=explode('-',$firstDiscount);
										$Discount='+'.$explodeFirstDiscount[1]; 
									}
									else{
									 $Discount='-'.$firstDiscount; 
									}
									
									$finalValue=$raprow['final'];
									if($finalValue < 0)
									{
									$explodefinalValue=explode('-',$finalValue);
									$final='+'.$explodefinalValue[1];
									}
									else{
									 $final='-'.$finalValue; 
									}
									
									    echo "<tr class='$class'>";
										echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$diamondid.'" value="'.$diamondid.'" class="case" '.$checked.' />'.$businessProcess.'</td>';
										//echo "<td class='center' style='text-align:center;'></td>";
										//echo "<td class='number'>".$i++."</td>";										
										//echo "<td class='center' style='text-align:center;'>".$row['username']."</td>";
										echo "<td class='center' style='text-align:center;'>".$row['referenceno']."</td>";
										echo '<td><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'</a></td>';
										//echo "<td class='number'>".$row['qty']."</td>";
										echo "<td>".$lab."</td>";
										echo "<td>".$row['diamond_shape']."</td>";
										echo "<td>".$row['weight']."</td>";
										echo "<td>".$row['color']."</td>";
										echo "<td>".$row['clarity']."</td>";
										echo "<td class='center'>".$cutrow['semicut']."</td>";
										echo "<td class='center'>".$polishrow['semipolish']."</td>";
										echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
										echo "<td>".$row['fluoresence']."</td>";
										echo "<td>$".$row['rapRate']."</td>";
										echo "<td>".$row['discount']."</td>";
										$tempAvgPrice=$row['rapRate'] * ($row['discount'] / 100);
							            $finalAvgPrice=$row['rapRate'] + $tempAvgPrice;
										echo "<td class='center'>$".($finalAvgPrice)."</td>";
										//echo "<td class='center'>".$final."</td>";
										echo "<td class='center'>$".$raprow['usd']."</td>";
										echo "<td class='number'>".sprintf("%.2f",$row['amount'])."</td>";
										echo "<td>".$row['depth']."%</td>";	
										echo "<td>".$row['table']."%</td>";
										echo "<td class='center'>".$measurement."</td>";
										echo "<td class='center'>".$status."</td>
										<td class='center'>".$confirmStatus."</td>
										<input type='text' style='display: none' name='userid' value='$user'>";
										if($role=='SUPERADMIN'){
											$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
											$empname=mysqli_fetch_assoc($getempname);
										  echo "<td>".$empname['username']."</td>";
										  }
                                        //echo "<td class='names'><a onclick='cancelorder($user,$diamondid);' class='btn btn-danger'>Cancel Order</a></td>";
										echo "</tr>";
								}
							
								?>
												
			</tbody>
		</table>			
					  <center><br>
		<button type="button" class="btn btn-danger"  onclick="cancelReason()" name="cancel">Cancel Order</button>
		<button type="submit" name="cancel" onclick="return atleast_onecheckbox1()" style="display: none;">Hidden</button>
		</center>
		
<div class="modal fade" id="userModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
         <div class="modal-body" style="padding: 0px;">
         </div>
      </div>
   </div>
</div>
		</form>	
<script>
 
function cancelorder(i,j)
{
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
   				var respoo=http2.responseText;
                if (respoo==1)
                {
                  alert("Order has been Cancelled.");
                  window.location.reload();
                }
                }
   			}			 
         var res="&userid="+i+"&did="+j;
   		 http2.open("GET","cancelorder.php?res="+res, true);
   		 http2.send(null);
}
   
</script>
<script>

function atleast_onecheckbox1() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Atleast One Item");
  return false;
  }
  else
  {
	return true;
  //document.getElementById('button').click();
  }
  }
  $(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});
   
   function cancelReason()
         {
    $.get('cancelReason.php', function(html){
                  $('#userModal .modal-body').html(html);
                  $("#customer").select2();
                  $('#userModal').modal('show', {backdrop: 'static'});
              });
    
   }
</script>
<?php
include "../common/footer.php";
?>
	