<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";
$id=encrypt_decrypt('decrypt',$_GET['id']);
	$queryStock="SELECT d.*,i.*,l.* FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' and i.deliverystatus is NULL and i.invoiceid='$id' ";
	$result1 = mysqli_query($con,$queryStock);
	$result = mysqli_query($con,$queryStock);
	$crw=mysqli_fetch_assoc($result1);
	
	$getinvoicedate="select date from invoice where invoiceid=".$id;
	$dateresult=mysqli_query($con,$getinvoicedate);
	$row2=mysqli_fetch_assoc($dateresult);
?>
<br><br><br><br>
<div class="container-fluid" style="margin-top:34px;">
<ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
	<li><a href="viewpendingorder.php">Pending Orders</a></li>
	 <li class="active">Pending Order List</li>
        </ol>   
    <div id="toolbar">
		<select class="form-control">
			<option value="">Export Basic</option>
			<option value="all">Export All</option>
			<option value="selected">Export Selected</option>
		</select>
	</div>	
		<p  style="margin-top: -20px;">  <h3 align="center">Pending Orders List of <?php echo $crw['username'];?> of dated <?php echo date('d-m-Y g:i:s A',strtotime($row2['date']));?></h3></p>
		
		<form id="movieForm" action="confirmorder.php" method="post">
        <table 
      data-show-columns="true"
      data-toggle="table"
      data-search="true"
      data-show-export="true"
      data-pagination="true"
      data-click-to-select="true"
      data-toolbar="#toolbar"
      data-show-refresh="true"
      data-show-toggle="true"
      data-url="../json/data1.json" style="font-size:10px;">
						 <thead>
							  <tr>
								<th><input type="checkbox" id="check_all" ></th>
								<!--<th data-field="srno" data-sortable="true">Sr. No.</th>-->
								  <!--<th data-field="productname" data-sortable="true"  >Customer Name</th>-->
								  <th data-sortable="true">View</th>
									<th data-sortable="true">Shape</th>
									<th data-sortable="true">Lab</th>
									<th data-sortable="true">PG Stock Id</th>
									<th data-sortable="true">Cert</th>
									<th data-sortable="true">Size</th>
									<th data-sortable="true">Color</th>
									<th data-sortable="true">Clarity</th>
									<th data-sortable="true">Cut</th>
									<th data-sortable="true">Polish</th>
									<th data-sortable="true">Symm</th>
									<th data-sortable="true">Flr</th>
									<th data-sortable="true">Rap $</th>
									<th data-sortable="true">Dis</th>
									<!--<th data-sortable="true">Final</th>-->
								   <th data-sortable="true">Measr.</th>
									<th data-sortable="true">Table</th>
									<th data-sortable="true">Depth</th> 
								 <th data-sortable="true">Amount $</th>
								 <th data-sortable="true">Location</th>
								 <th data-sortable="true">Delivery Status</th>
								 <th data-sortable="true">Order Status</th>
								  <!--<th data-field="action" data-sortable="true"  >Action</th>-->
							  </tr>
						  </thead>
								<tbody>
								<?php
								$i=1;
								 while($row=mysqli_fetch_assoc($result))
								 {
									$user=$row['userid'];
									$diamondid=$row['diamondid'];
									$did=$row['diamond_id'];
									$deliverystatus=$row['deliverystatus'];
									$diamond_user_status=$row['diamond_user_status'];
									
                     $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
                     $certiresult=mysqli_query($con,$certificteqry);
                     while($crow=mysqli_fetch_assoc($certiresult)){
                        $lab=$crow['certi_name'];
                        $reportno=$crow['report_no'];
						$certi_no=$crow['certi_no'];
                        $certiimage='../diamond_upload/'.$crow['logo'];
                     }                      
                     $wishqry="select * from wishlist where diamondid=$did and userid=$userid and wishstatus=1";
                     $wishresult=mysqli_query($con,$wishqry);
                     $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
                     $statusqryresult=mysqli_query($con,$statusqry);
                     $diamondstatusqry="select * from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
                     if($deliverystatus=='1'){
                        $class="success";
						$checked='disabled';
						$status='Delivered';
						$confirmStatus='CONFIRMED';
                     }
					 else if($deliverystatus=='0'){
                        $class="danger";
						$checked='';
						$status='Cancelled';
						$confirmStatus='CANCELLED';
                     }
                     else{
                        $class="";$checked='';$status='<font color="red">Pending</font>';
						$confirmStatus='CONFIRMED';
                     }
                    $chevkcart="select * from add_to_cart where diamondid=$did and wishstatus='0'";
					//echo $chevkcart.'<br>';
					$cartresult=mysqli_query($con,$chevkcart);
					$cartrow=mysqli_fetch_assoc($cartresult);
                     $keyquery="select * from diamond_keysymbol where diamond_id=$did";
                     $keyres=mysqli_query($con,$keyquery);
                     while($ksm=mysqli_fetch_assoc($keyres)){
                        $kysymbol=$kysymbol.','.$ksm['kysymbol'];   
                     }
					 
					 $getcut="SELECT cps.semi as semicut FROM `diamond_master` d,cut_polish_sym cps where d.cut=cps.title and d.diamond_id=$did";
						$getcutresult=mysqli_query($con,$getcut);
						$cutrow=mysqli_fetch_assoc($getcutresult);
						
						$getpolish="SELECT cps.semi as semipolish FROM `diamond_master` d,cut_polish_sym cps where  d.polish=cps.title and d.diamond_id=$did";
						$getpolishresult=mysqli_query($con,$getpolish);
						$polishrow=mysqli_fetch_assoc($getpolishresult);
						
						$getsymmetry="SELECT cps.semi as semisymmetry FROM `diamond_master` d,cut_polish_sym cps where  d.symmetry=cps.title and d.diamond_id=$did";
						$getsymmetryresult=mysqli_query($con,$getsymmetry);
						$symhrow=mysqli_fetch_assoc($getsymmetryresult);
						
						$getraprates="SELECT * FROM `diamond_sale` where diamond_id=$did";
						$getrapratesresult=mysqli_query($con,$getraprates);
						$raprow=mysqli_fetch_assoc($getrapratesresult);
						
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
						$lastTotalAmount=$lastTotalAmount + sprintf("%.2f",$row['amount']);
						
			  if($raprow['amount']!='0'){              
              echo "<tr class='$class'>";
			    if($diamond_user_status=='HOLD')
				{
                echo '<td><font color="red">Business Process</font></td>';
				}
				else{
				echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case" '.$checked.' /></td>';	
				}
                  echo "<td>";
				  if($certiimage!=''){
				  echo "<a href=".$certiimage." target='_blank' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;";
				  }if($row['videolink']!=''){
				  echo "<a href='".$row['videolink']."' target='_blank' title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a>";
				  }
				  echo "</td>";
				  echo "<td>".$row['diamond_shape']."</td>";
				  echo "<td>".$lab."</td>";
				  echo "<td class='center'>".$row['referenceno']."</td>";
                  echo '<td><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'</a></td>';
                  echo "<td>".$row['weight']."</td>";
                  echo "<td>".$row['color']."</td>";
                  echo "<td>".$row['clarity']."</td>";
                  echo "<td class='center'>".$cutrow['semicut']."</td>";
				  echo "<td class='center'>".$polishrow['semipolish']."</td>";
				  echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
				  echo "<td>".$row['fluoresence']."</td>";
				  echo "<td>$".$row['rapRate']."</td>";
				  echo "<td>".$row['discount']."</td>";
				  //echo "<td class='center'>".$final."</td>";
				  echo "<td class='center'>".$measurement."</td>";
                  echo "<td>".$row['table']."%</td>";
                  echo "<td>".$row['depth']."%</td>";
               echo "<td class='number'>".sprintf("%.2f",$row['amount'])."</td>
               <td class='number'>".$row['location']."</td>
			   <input type='text' style='display: none' name='userid' value='$user'>";
                  echo "<td>".$status."</td>
					    <td>".$confirmStatus."</td>";
									   
                                       // echo "<td class='names'><a onclick='confirmorder($user,$diamondid);' class='btn btn-success'>Confirm</a>
										//<a onclick='cancelorder($user,$diamondid);' class='btn btn-danger'>Cancel</a></td>";
										echo "</tr>";
								}
								 }
							
								?>
						 <tr>
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td class='number'><?php echo $lastTotalAmount;?></td><td></td><td></td><td></td>
						 </tr>
												
			</tbody>
								
					  </table>
		<center><br>
		<button type="submit" class="btn btn-primary"  onclick="return atleast_onecheckbox1()" name="confirm">Confirm Delivery</button>
		
		<!--<button type="button" class="btn btn-danger"  onclick="cancelReason()" name="cancel">Cancel Delivery</button>
		<button type="submit" name="cancel" onclick="return atleast_onecheckbox1()" style="display: none;">Hidden</button>-->
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
</div>
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
	