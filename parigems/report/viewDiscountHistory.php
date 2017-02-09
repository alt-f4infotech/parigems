<?php
  include '../common/header.php';
?>
<section class="main-section">
<div class="container-fluid crumb_top">
<ol class="breadcrumb" id="breadcrumb">
    <li><a href="../common/homepage.php">Home</a></li>
    <li class="active">View Discount History</li>
 </ol>
<h3 align="center">View Discount History</h3>
<div class="table-responsive">
<table class="table table-striped" id="table" data-height="400" data-show-columns="true" data-toggle="table" data-search="true" data-show-export="true">
                    <thead>
						  <tr>
						   <th><input type="checkbox" id="check_all"></th>
                           <th data-sortable="true">PG Stock Id</th>
							<th data-sortable="true">Cert.No.</th>
							<th data-sortable="true">Shape</th>
							<th data-sortable="true">Size</th>
							<th data-sortable="true">Color</th>
							<th data-sortable="true">Clarity</th>
							<th data-sortable="true">Cut</th>
							<th data-sortable="true">Polish</th>
							 <th data-sortable="true">Symm</th>
							 <th data-sortable="true">Rap</th>
							 <th data-sortable="true">Dis.</th>
							 <th data-sortable="true">Measurement</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i=1;
                            $certificteqry1="select d.*,l.username,de.discount1 from  diamond_master d,diamond_sale_edit de,login l,certificate_master c where d.diamond_id=de.diamond_id  and  d.added_by=l.userid and c.certificateid=d.certificate_id order by d.entrydate ASC";
                          $certiresult1=mysqli_query($con,$certificteqry1);
							 while($row=mysqli_fetch_assoc($certiresult1))
							 {
							  $did=$row['diamond_id'];
							  $diamond_status=$row['diamond_status'];
							  $certificate_id=$row['certificate_id'];
							 $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
							 $certiresult=mysqli_query($con,$certificteqry);
							 while($crow=mysqli_fetch_assoc($certiresult))
							 {
							  $lab=$crow['certi_name'];
							  $certi_no=$crow['certi_no'];
							  $reportno=$crow['report_no'];
							  $certiimage='../signup/'.$crow['logo'];
							 }
                             
							  $wishqry="select * from wishlist where diamondid=$did and userid=$userid and wishstatus=1";
                     $wishresult=mysqli_query($con,$wishqry);
                     $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
                     $statusqryresult=mysqli_query($con,$statusqry);
					 $bsnsprocess=mysqli_fetch_assoc($statusqryresult);
					 
                     $diamondstatusqry="select holdtime,userid as holduser from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
					 
					 $chevkcart="select * from add_to_cart where diamondid=$did and userid=$userid  and wishstatus='1'";
                     $cartresult=mysqli_query($con,$chevkcart);
					 
                            $holdedDiamonds=mysqli_query($con,"select * from diamond_status where diamondid=$did and diamond_status='HOLD'");
                            $onlineDiamonds=mysqli_query($con,"select * from diamond_master where diamond_id=$did and portalshow='portalyes'");
                            $offlineDiamonds=mysqli_query($con,"select * from diamond_master where diamond_id=$did and portalshow='portalno'");
                            
                            if(mysqli_num_rows($holdedDiamonds) > 0){
                               $class="warning"; 
                            }
                           else if(mysqli_num_rows($onlineDiamonds) > 0){
                               $class=""; 
                            }
                            else if(mysqli_num_rows($offlineDiamonds) > 0){
                               $class="danger"; 
                            }
                            else{
                                $class="";
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
						
						$getraprates="SELECT * FROM `diamond_purchase` where diamond_id=$did";
						$getrapratesresult=mysqli_query($con,$getraprates);
						$raprow=mysqli_fetch_assoc($getrapratesresult);
						
						$rapsalequery="select * from diamond_sale where diamond_id=".$did;
						$rapsaleres=mysqli_query($con,$rapsalequery);
						$srrow=mysqli_fetch_assoc($rapsaleres);

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
						
                        if(trim($row['diamond_shape'])=='ROUND')
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
						
						$carat=$row["weight"]; 
						$rap=($row["weight"]*$currentraprate);
						
						if($userdiscount==''){$userdiscount=0;}
						$final=$row['final']+$userdiscount;						
						$avg_price = ($final / 100) * $currentraprate;
						$total_value=($currentraprate-$avg_price)*$carat;
                        
						$firstDiscount=$row['discount1'];
						if($firstDiscount < 0)
						{
						  $explodefirstDiscount=explode('-',$firstDiscount);
						  $Discount='+'.$explodefirstDiscount[1]; 
						}
						else{						  
						 $Discount='-'.$firstDiscount; 
						}
						
                        
						    echo "<tr  class='$class'>";
							echo '<td>';
							if(mysqli_num_rows($statusqryresult) > 0)
					    {
					 	  echo '<input type="checkbox"  disabled /><br>'; //in business procee so noone can click this
					    }	
						else
						{
							if(mysqli_num_rows($dstatusqryresult) > 0)
							{
							 if(mysqli_num_rows($cartresult) > 0)
							 { ?>
							   <input type="checkbox" class="filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')" checked /><br>
					   <?php }
							else
							{ ?>
							   <input type="checkbox" class="filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('removehold','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>							 
					   <?php }
							}
						   else if(mysqli_num_rows($cartresult) > 0)
						    { ?>
							   <input type="checkbox" class="filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')" checked /><br>
					  <?php }
					        else
							{ ?>
								 <input type="checkbox" class="filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('add','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>
					   <?php }
					    }
							echo '</td>';
							echo "<td>".$row['referenceno']."</td>";
                           	echo '<td><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
							echo "<td>".$row['diamond_shape']."</td>";
							echo "<td>".$row['weight']."</td>";
							echo "<td>".$row['color']."</td>";
							echo "<td>".$row['clarity']."</td>";
							echo "<td class='center'>".$cutrow['semicut']."</td>";
							echo "<td class='center'>".$polishrow['semipolish']."</td>";
							echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
							echo "<td class='center'>$".$raprow['rap']."</td>";
							echo "<td class='center'>".$Discount."</td>";
							echo "<td class='center'>".$measurement."</td>";
					        echo "</tr>";
                       ?>
                    <input type="text" style="display: none;" name="amount[]"   value="<?php echo $total_value;?>"  />
                    <?php } ?>
                     </tbody>
        </table>
</div>
</div>
 </section>
<?php
include "../common/footer.php";
?>