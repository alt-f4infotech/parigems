<?php
ob_start();
   session_start();
include '../common/config.php';
   error_reporting(0);
   $userid = $_SESSION['userid'];
   $diamondId = $_GET['diamondId'];
    
  $mainquery="SELECT distinct(d.diamond_id),d.* FROM `diamond_master` d,certificate_master c,diamond_sale s WHERE d.certificate_id=c.certificateid and d.diamond_status='1' and d.portalshow='portalyes' and d.diamond_id=s.diamond_id and d.diamond_id='$diamondId'";
  $result=mysqli_query($con,$mainquery);
   ?>
  
	<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>        
  <div class="clearfix"></div>
			   <?php
			   $i=1;
                  while($row=mysqli_fetch_assoc($result)){
                     $did=$row['diamond_id'];
					 
					 $today=date('Y-m-d');
					 $diamondAddedDate=date('Y-m-d',strtotime($row['entrydate']));
					 
						$date1=date_create($diamondAddedDate);
						$date2=date_create($today);
						$diff=date_diff($date1,$date2);
						$dateDiffeterence=$diff->format("%a");
						
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
					 $bsnsprocess=mysqli_fetch_assoc($statusqryresult);
					 
                     $diamondstatusqry="select holdtime,userid as holduser from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
					 
                     if(mysqli_num_rows($dstatusqryresult) > 0){
						$hrw=mysqli_fetch_assoc($dstatusqryresult);
						$holdtimer=$hrw['holdtime'];
						
						$unholdTime=date('Y/m/d H:i',strtotime("$holdtimer +4 hour"));
						
						//echo '<input type="hidden" id="currentDate">';
						echo '<input type="hidden" class="unholdTime" id="unholdTime_'.$did.'" value="'.$unholdTime.'">';
						
                        $class="warning-hold";
                     }
                     elseif(mysqli_num_rows($statusqryresult) > 0){
                        $class="danger";
						$unhold_time='-';
                     }
					else if($dateDiffeterence <='2')
						{
						  $class="info-row";
						}
                     else{
                        $class="";
						$unhold_time='-';
                     }
					 
                     $chevkcart="select * from add_to_cart where diamondid=$did and userid=$userid  and wishstatus='1'";
                     $cartresult=mysqli_query($con,$chevkcart);
					 
					 $finalcart="select * from add_to_cart where diamondid=$did and userid=$userid  and wishstatus='2'";
                     $finalcartresult=mysqli_query($con,$finalcart);
                     $keyquery="select * from diamond_keysymbol where diamond_id=$did";
                     $keyres=mysqli_query($con,$keyquery);
					 $ks=1;
					 if(mysqli_num_rows($keyres) > 0){
                     while($ksm=mysqli_fetch_assoc($keyres)){
						if($ks==1)
						{
						$kysymbol=$ksm['kysymbol'];
						}else{
                        $kysymbol=$kysymbol.','.$ksm['kysymbol'];
						}
						$ks++;
                     }
					 }else{$kysymbol='';}
					 
					    $getcut="SELECT cps.semi as semicut FROM `diamond_master` d,cut_polish_sym cps where d.cut=cps.title and d.diamond_id=$did";
						$getcutresult=mysqli_query($con,$getcut);
						$cutrow=mysqli_fetch_assoc($getcutresult);
						
						$getpolish="SELECT cps.semi as semipolish FROM `diamond_master` d,cut_polish_sym cps where  d.polish=cps.title and d.diamond_id=$did";
						$getpolishresult=mysqli_query($con,$getpolish);
						$polishrow=mysqli_fetch_assoc($getpolishresult);
						
						$getsymmetry="SELECT cps.semi as semisymmetry FROM `diamond_master` d,cut_polish_sym cps where  d.symmetry=cps.title and d.diamond_id=$did";
						$getsymmetryresult=mysqli_query($con,$getsymmetry);
						$symhrow=mysqli_fetch_assoc($getsymmetryresult);
						
						$getraprates="SELECT * FROM `diamond_sale` where 1 $qry45 and diamond_id=$did";
						$getrapratesresult=mysqli_query($con,$getraprates);
						$raprow=mysqli_fetch_assoc($getrapratesresult);
						
						
						$getuserdiscount="select userdiscount,countrytype from basic_details where userid='$userid' and userstatus='1'";
						$discountres=mysqli_query($con,$getuserdiscount);
						$discrw=mysqli_fetch_assoc($discountres);
						$userdiscount=$discrw['userdiscount'];
						$countrytype=$discrw['countrytype'];
						
						$getcountrydiscount="select discount,countryname from country_discount";			
						$discountcountryres=mysqli_query($con,$getcountrydiscount);
						if(mysqli_num_rows($discountcountryres) > 0){
						$disccntryrw=mysqli_fetch_assoc($discountcountryres);
						$discountcountry=$disccntryrw['discount'];
						$countryname=strtolower($disccntryrw['countryname']);			
						if($countryname==$countrytype)
						{
						$userdiscount=$userdiscount+$discountcountry;
						}
						}
			            
						$firstDiscount=$raprow['final'] + $userdiscount;
						if($firstDiscount < 0)
						{
						$explodefirstDiscount=explode('-',$firstDiscount);
						 $totaldiscc='+'.$explodefirstDiscount[1]; 
						}
						else{
						 $totaldiscc='-'.$firstDiscount; 
						}						
			            
			
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
						$diamondshape=trim($row['diamond_shape']);
						if($diamondshape=='ROUND')
						{
						 $shape="BR";   
						}
						else
						{
						 $shape="PS";   
						}
						$caret=sprintf("%.2f",$row['weight']);
						
						if($row['clarity']=='FL')
						{
						$diamond_clarity='IF';
						}
						else
						{
						$diamond_clarity=$row['clarity'];
						}
						$qryraprate="select * from raptable where  color='".$row['color']."' and '$caret' between raprangestart and raprangeend and clarity='".$diamond_clarity."' and shape='$shape'";
						$raprateres=mysqli_query($con,$qryraprate);
						while($rprow=mysqli_fetch_assoc($raprateres))
						{
						 $currentraprate=$rprow['rate'];
						}
						if(mysqli_num_rows($getrapratesresult) > 0){
						if($raprow['rap']!='0'){
						?>
				  <div class="row">
					 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					 <table class="table table-bordered" >
						<tbody>
						   <tr   style="background-color:#D3D3D3">
						  <td><b>Certificate No.:</b><?php echo $lab.' '.$certi_no;?></td>
						  <td></td>
						  <td><b>PG Stock ID:</b> <?php echo $row['referenceno'];?></td>
						  <td></td>
						  </tr>
						  <tr>
							<td ><b>Shape</b></td>
							<td><?php echo $row['diamond_shape'];?></td>
							<td ><b>Uploaded date</b></td>
							<td><?php echo date('d-m-Y g:i:s A',strtotime($row['entrydate']));?></td>
						  </tr>
						  <tr>
							<td ><b>Size</b></td>
							<td><?php echo $row['weight'];?></td>
							<td ><b>Measurement</b></td>
							<td><?php echo $measurement;?></td>
						  </tr>
						  <tr>
							<td ><b>Color</b></td>
							<td><?php echo $row['color'];?></td>
							<td ><b>Culet</b></td>
							<td><?php echo $row['cutlet'];?></td>
						  </tr>
						  <tr>
							<td ><b>Clarity (eye clean)</b></td>
							<td><?php echo $row['clarity'];?></td>
							<td ><b>Girdle</b></td>
							<td><?php echo $row['girdlevalue'];?>%</td>
						  </tr>
						  <tr>
							<td ><b>Cut</b></td>
							<td><?php echo $cutrow['semicut'];?></td>
							<td ><b>Crown Angle</b></td>
							<td><?php echo $row['crown_angle'];?> &deg;</td>
						  </tr>
						  <tr>
							<td ><b>Polish</td>
							<td><?php echo $polishrow['semipolish'];?></td>
							<td ><b>Pavilion Angle</td>
							<td><?php echo $row['pavilion_angle'];?> &deg;</td>
						  </tr>
						  <tr>
							<td ><b>Symmetry</b></td>
							<td><?php echo $symhrow['semisymmetry'];?></td>
							<td ><b>Crown Height</b></td>
							<td><?php echo $row['crown_height'];?>%</td>
						  </tr>
						  <tr>
							<td ><b>Fluorescence</b></td>
							<td><?php echo $row['fluoresence'];?></td>
							<td ><b>Pavilion Depth</b></td>
							<td><?php echo $row['pavilion_height'];?>%</td>
						  </tr>
						  <tr>
							<td ><b>Depth %</b></td>
							<td><?php echo $row['depth'];?>%</td>
							<td ><b>Ratio</b></td>
							<td><?php echo $row['diameter_ratio'];?></td>
						  </tr>
						  <tr>
							<td ><b>Table %</b></td>
							<td><?php echo $row['table'];?>%</td>
							<td ><b>Star Length</b></td>
							<td><?php echo $row['length'];?>%</td>
						  </tr>
						  <tr>
							<td ><b>Tinge</b></td>
							<td><?php echo $row['tinge'];?></td>
							<td ></td>
							<td><?php //echo $row['diameter_min'].'-'.$row['diameter_max'];?></td>
						  </tr>
						</tbody>
					  </table>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<table class="table table-bordered" >
						<tbody>
						   <tr   style="background-color:#D3D3D3">
						  <td colspan="4"><b>Additional Information</b></td>
						  </tr>
						  <tr>
							<td ><b>Brown Inclusion</b></td>
							<td><?php echo $row['brown_inclusion'];?></td>
							<td ><b>Girdle Condition</b></td>
							<td><?php echo $row['giddle'];?></td>
						  </tr>
						  <tr>
							<td ><b>Girdle Min/Max</b></td>
							<td><?php echo $row['girdlemin'];?>-<?php echo $row['girdlemax'];?></td>
							<td ><b>Lower Half</b></td>
							<td><?php echo $row['lower_half'];?>%</td>
						  </tr>
						  <tr>
							<td ><b>H & A</b></td>
							<td><?php echo $row['H_A'];?></td>
							<td ><b>Milky</b></td>
							<td><?php echo $row['milky'];?></td>
						  </tr>
						  <tr>
							<td ><b>Black Inclusion</b></td>
							<td><?php echo $row['black_inclusion'];?></td>
							<td ><b>Inclusion Visibility</b></td>
							<td><?php echo $row['inclusive_visibility'];?></td>
						  </tr>
						  <tr>
						   <td height="10" colspan="4"></td>
						  </tr>
							  <tr>
								<td  style="background-color:#D3D3D3"  colspan="2"><b>Location</b></td>
								<td   colspan="2"><?php echo $row['location'];?></td>
							  </tr>
							  <tr>
								<td   colspan="2" style="background-color:#D3D3D3"><b>Raprate</b></td>
								<td  colspan="2"><?php echo $currentraprate;?></td>
							  </tr>
							   <tr>
								<td   colspan="2" style="background-color:#D3D3D3"><b>Report Comments</b></td>
								<td  colspan="2"><?php echo $row['comments'];?></td>
							  </tr>
							  <tr>
								<td   colspan="2" style="background-color:#D3D3D3"><b>Key To Symbols</b></td>
								<td  colspan="2"><?php echo $kysymbol;?></td>
							  </tr>
							</tbody>
						  </table>
					</div>
				</div>
		 <?php }
				}
			}
               ?>
</tbody>
        </table>
	   </center>
  	  </div>
    </div>
  
</div>