<?php
ob_start();
   session_start();
include '../common/config.php';
   error_reporting(0);
   $userid = $_SESSION['userid'];
   ?>
 <div class="modal-body">
	<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
	<center>
  		<div class="table-responsive">
		 <table class="table table-bordered" style="font-size:13px;">
			<thead style="font-size:8px;padding: 0px;">
			   <tr>
					 <th data-sortable="true">Stock Id</th>
					 <th data-sortable="true">Shape</th>
					 <th data-sortable="true">Lab</th>
					 <th data-sortable="true">Cert</th>
					 <th data-sortable="true">Size</th>
					 <th data-sortable="true">Color</th>
					 <th data-sortable="true">Clarity</th>
					 <th data-sortable="true">Cut</th>
					 <th data-sortable="true">Polish</th>
					 <th data-sortable="true">Symmetry</th>
					 <th data-sortable="true">Flr</th>
					 <th data-sortable="true">Rap $</th>
					 <th data-sortable="true">&#177; Dis</th>
					 <th data-sortable="true">P/C $</th>
					 <th data-sortable="true">Amt$</th>
					 <th data-sortable="true">Depth</th> 
					 <th data-sortable="true">Table</th>
					 <th data-sortable="true">Measurement</th>
					 <th data-sortable="true">H & A</th>              
					 <th data-sortable="true">Milky</th>             
					 <th data-sortable="true">Br.I</th>             
					 <th data-sortable="true">Bl.I</th>             
					 <th data-sortable="true">Loc.</th>
				</tr>
			  </thead>
			  <tbody  style="font-size:8px;padding: 0px;">
		 <?php
$didarray=explode(',',$_GET['did']);
for($d=0;$d< count($didarray);$d++)
{
 
$certificteqry1="select i.*,d.*,dp.rap,dp.discount1,dp.discount2,dp.discount3,dp.final from wishlist i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id and i.diamondid=d.diamond_id and d.diamond_status='1' and i.userid='$userid' and i.wishstatus='1' and d.diamond_id=".$didarray[$d];
//echo $certificteqry1;
              $certiresult1=mysqli_query($con,$certificteqry1);
              while($row=mysqli_fetch_assoc($certiresult1))
              {
              $did=$row['diamond_id'];
                     $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
                     $certiresult=mysqli_query($con,$certificteqry);
                     while($crow=mysqli_fetch_assoc($certiresult)){
                        $lab=$crow['certi_name'];
                        $reportno=$crow['report_no'];
						$certi_no=$crow['certi_no'];
                        $certiimage='../diamond_upload/'.$crow['logo'];
                     }                      
                     
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
						
					  $finalcarat=$finalcarat+$carat;
					  $finalrap=$finalrap+$rap;
					 
					  $firstDiscount=$raprow['final'];
						/*if($firstDiscount < 0)
						{
						 $Discount=$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}*/
						if($firstDiscount < 0)
						{
							$explodefirstDiscount=explode('-',$firstDiscount);
							$Discount='+'.$explodefirstDiscount[1]; 
						}
						else{
							$Discount='-'.$firstDiscount; 
						}
						
						$newDiscount=$Discount+$userdiscount;
						if($newDiscount > 0)
						{
						 $Discount='+'.$newDiscount ;
						}
						else
						{
						  $Discount=$newDiscount;
						}
						
						$statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
              $statusqryresult=mysqli_query($con,$statusqry);
              if(mysqli_num_rows($statusqryresult) > 0){}
			  else{
			  if($raprow['rap']!='0'){
			      echo "<tr class='$class'>";
                  echo "<td class='center'>".$row['referenceno']."</td>";
                  echo "<td>".$row['diamond_shape']."</td>";
				  echo "<td>".$lab."</td>";
                  echo '<td><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'</a></td>';
                  echo "<td>".$row['weight']."</td>";
                  echo "<td>".$row['color']."</td>";
                  echo "<td>".$row['clarity']."</td>";
                  echo "<td class='center'>".$cutrow['semicut']."</td>";
				  echo "<td class='center'>".$polishrow['semipolish']."</td>";
				  echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
				  echo "<td>".$row['fluoresence']."</td>";
				  echo "<td class='center'>".$currentraprate."</td>";
				  echo "<td class='center'>".$Discount."</td>";
				   $temprapRate=$currentraprate * ($Discount / 100);
						$finalRapRate=$currentraprate + $temprapRate;
						$rowUSD=$finalRapRate * $row['weight'];
						 $lastvalue=$lastvalue+$rowUSD;
				  echo "<td class='center'>".$finalRapRate."</td>";
                  echo "<td>".sprintf("%.2f",$rowUSD)."</td>";
                  echo "<td>".$row['depth']."%</td>";
                  echo "<td>".$row['table']."%</td>";
				  echo "<td class='center'>".$measurement."</td>";
				  if($row['H_A']==''){$rowH_A='-';}else{$rowH_A=$row['H_A'];}
				  echo "<td>".$rowH_A."</td>";
				  if($row['milky']==''){$rowMilky='-';}else{$rowMilky=$row['milky'];}
				  echo "<td>".$rowMilky."</td>";
				  if($row['brown_inclusion']==''){$rowBrownInclusion='-';}else{$rowBrownInclusion=$row['brown_inclusion'];}
				  echo "<td>".$rowBrownInclusion."</td>";		
				  if($row['black_inclusion']==''){$rowBlackInclusion='-';}else{$rowBlackInclusion=$row['black_inclusion'];}	 
				  echo "<td>".$rowBlackInclusion."</td>";		
				  if($row['location']==''){$rowLocation='-';}else{$rowLocation=$row['location'];}	 		 
				  echo "<td>".$rowLocation."</td>";
              echo "</tr>";
              $i++;
			  }
             }
			  }
}
?>
		<tr>
              <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
              <td><b>Total</b></td>
              <td><b><?php echo sprintf("%.2f",$lastvalue);?></b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
</tbody>
        </table>
       <center><br><button type="submit" class="btn btn-primary" name="place_order" value="place_order">Confirm</button>
	   <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
	    </center>
  	  </div>
    </center>
</div>