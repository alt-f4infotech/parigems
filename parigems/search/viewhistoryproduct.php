<?php
include '../common/header.php';
error_reporting(0);
session_start();
$orderno=$_GET['orderno'];
$certificteqry1="select * from invoice where invoiceid='$orderno' and status='1' ";
							 $certiresult1=mysqli_query($con,$certificteqry1);
							 while($row=mysqli_fetch_assoc($certiresult1))
							 {
							  $date=$row['date'];
							 }
?>
<br>
<br>
<br>
<br>
    <div class="container-fluid">
         <ol class="breadcrumb" id="breadcrumb">
		 <li><a href="../common/homepage.php">Home</a></li>
		 <li><a href="../search/historyorder.php">View Order History</a></li>
		 <li class="active">View Products</li>
        </ol>
        <h3 align="center">Order Number :- <?php echo $orderno;?></h3>
		<p style="float: right;">Order date: <?php echo date('d-m-Y g:i:s A',strtotime($date));?></p>
	<br>
			<div class="product_history">
                <table class="table table-bordered" id="table" data-height="400" data-toggle="table" data-search="true">
						<thead style="font-size:9px;">
						  <tr>
						  <!--<th><input type="checkbox" id="check_all" ></th>-->
                           <!--<th data-sortable="true">Sr.No.</th>-->
                           <th data-sortable="true">PG Stock Id</th>
                           <th data-sortable="true">Cert No.</th>
							<th data-sortable="true">Lab</th>
							<th data-sortable="true">Shape</th>
							<th data-sortable="true">Carat</th>
							<th data-sortable="true">Color</th>
							<th data-sortable="true">Clarity</th>
							<th data-sortable="true">Cut</th>
							<th data-sortable="true">Polish</th>
							<th data-sortable="true">Symmetry</th>
							<th data-sortable="true">Flr</th>
							<th data-sortable="true">Rap $</th>
							<th data-sortable="true">Order Dis.%</th>
							<th data-sortable="true">P/C $</th>
						    <th data-sortable="true">Amount $</th>
						    <th data-sortable="true">Measurement</th>
                           <th data-sortable="true">Delivery Status</th>
                           <th data-sortable="true">Order Status</th>
                           <th data-sortable="true">Location</th>
                        </tr>
                     </thead>
                     <tbody style="font-size:9px;">
                        <?php
                           $i=1;
							
							  $certificteqry13="select distinct(d.diamond_id),d.*,i.* from invoice_product i,diamond_master d where  i.diamondid=d.diamond_id and i.invoiceid='$orderno' ORDER BY d.weight ASC";
							 $certiresult13=mysqli_query($con,$certificteqry13);
							 while($row=mysqli_fetch_assoc($certiresult13))
							 {
							  $deliverystatus=$row['deliverystatus'];
							  $userId=$row['userid'];
							  if($row['pstatus']=='1')
							{
							 $orderstatus="PENDING";
							 $confirmStatus='PENDING';
							 $class="info";
							}
							else if($deliverystatus=='1')
							{
							 $orderstatus="SY.CONFIRMED";
							 $confirmStatus='CONFIRMED';
							 $class="success";
							}
							else if($deliverystatus=='0')
							{
							 $orderstatus='SY.CANCELLED ('.$row['cancelreason'].')';
							 $confirmStatus='CANCELLED';
							 $class="danger";
							}
							else{
							 $orderstatus='<font color="red">Pending</font>';$class="";
							 $confirmStatus='CONFIRMED';
							}
							
							$diamondid=$row['diamondid'];
							$did=$row['diamond_id'];
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
						
						//$chevkcart="select * from add_to_cart where diamondid=$did and userid='$userId'  and wishstatus='0'";
						$chevkcart="select * from add_to_cart where diamondid=$did and wishstatus='0'";
                        $cartresult=mysqli_query($con,$chevkcart);
						$cartrow=mysqli_fetch_assoc($cartresult);
						
						$getlocation="select * from basic_details where userid=$userid";
                        $locationresult=mysqli_query($con,$getlocation);
						$locrow=mysqli_fetch_assoc($locationresult);
					 
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
						
					    $getuserdiscount="select userdiscount,countrytype from basic_details where userid='$userid' and userstatus='1'";
						$discountres=mysqli_query($con,$getuserdiscount);
						$discrw=mysqli_fetch_assoc($discountres);
						$userdiscount=$discrw['userdiscount'];
						$countrytype=$discrw['countrytype'];
						
						$getcountrydiscount="select discount,countryname from country_discount where countryname='$countrytype'";
						$discountcountryres=mysqli_query($con,$getcountrydiscount);
						if(mysqli_num_rows($discountcountryres) > 0){
						$disccntryrw=mysqli_fetch_assoc($discountcountryres);
						$discountcountry=$disccntryrw['discount'];
						$countryname=strtolower($disccntryrw['countryname']);
						  //if($countryname==$countrytype)
						  //{
						   $userdiscount=$userdiscount+$discountcountry;
						  //}
						}
			
						$totaldiscc=$raprow['final'];
						if($totaldiscc > 0)
						{
						  $totaldiscc='-'.$totaldiscc;
						}
						else{						 
						  $explodeOldDiscount=explode('-',$totaldiscc);
						  $totaldiscc='+'.$explodeOldDiscount[1];
						}
						  $newDiscount=$totaldiscc+$userdiscount;
						//$firstDiscount=$raprow['discount'];
						/*if($firstDiscount < 0)
						{
						 $explodefirstDiscount=explode('-',$firstDiscount);
						  $Discount='+'.$explodefirstDiscount[1]; 
						 //$Discount=$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}*/
						$Discount=$newDiscount; 
							
						    echo "<tr class='$class'>";
							//echo '<td><input style="width:30px;" type="checkbox" /></td>';
                            //echo "<td>".$i++."</td>";
							echo "<td>".$row['referenceno']."</td>";
							echo "<td>".$certi_no."</td>";
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
							$rowUSD=$finalAvgPrice * $row['weight'];
							$final=$final+$rowUSD;
							echo "<td class='number'>".sprintf("%.2f",$rowUSD)."</td>";
							echo "<td class='center'>".$measurement."</td>";
							echo "<td>".$orderstatus."</td>";
							echo "<td>".$confirmStatus."</td>";
							echo "<td>".$locrow['countrytype']."</td>";
							echo "</tr>";
                           }
                           ?>
                        <tr><!--<td></td><td></td>--><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></td><td><b>Total</b></td><td class='number'><b><?php echo sprintf("%.2f",$final);?></b></td><td></td><td></td><td></td><td></td></tr>
                     </tbody>
                  </table>
                  </div>
				 
</div>
    
	
</<br>
</html>
<script>
		function showAjaxModal(uid)
         {
    $.get('viewcertificate.php?certi_id=' + uid, function(html){
                  $('#myModal .modal-body').html(html);
                  $('#myModal').modal('show', {backdrop: 'static'});
              });
   }
	</script>
    
<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
         <div class="modal-body" style="padding: 0px;">
         </div>
      </div>
   </div>
</div>