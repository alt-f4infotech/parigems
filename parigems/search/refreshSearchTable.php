<?php
ob_start();
session_start();
error_reporting(0);
include '../common/config.php';
$mainquery="SELECT distinct(d.diamond_id),d.* FROM `diamond_master` d,certificate_master c,diamond_sale s WHERE  d.certificate_id=c.certificateid and d.diamond_status='1' and d.portalshow='portalyes' and d.diamond_id=s.diamond_id" ;
$result=mysqli_query($con,$mainquery);
?><!DOCTYPE html>
   <html>
   <head>
   	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<link href="../css/animsition.min.css" rel="stylesheet">
   	<link rel="stylesheet" type="text/css" href="../css/animate.css">
   	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
   	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
   	<!--datepicker--><link rel="stylesheet" href="../css/datepicker.css"><!--datepicker-->
   	<link rel="stylesheet" type="text/css" href="../css/jcarousel.responsive.css">
   	<link rel="stylesheet" type="text/css" href="../css/parigems.css">
   	<link rel="stylesheet" type="text/css" href="../css/responsive.css"/>
   	<!--<link rel="stylesheet" type="text/css" href="../css/loginstyle.css"/>-->
   	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

   	<link rel="stylesheet" href="../assets/bootstrap-table/src/bootstrap-table.css">
   	<link href="../css/select2.css" rel="stylesheet"/>
   	<script src="../assets/jquery.min.js"></script>
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
   	<script src="http://demo.phpgang.com/html-select-box-searching-support-jquery/select2.js"></script>
   	<script type="text/javascript" src="../libs/jsPDF/jspdf.min.js"></script>
   	<script type="text/javascript" src="../libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
   	<script type="text/javascript" src="../libs/html2canvas/html2canvas.min.js"></script>
   	<script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
   	<script src="../assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
   	<script src="../assets/tableExport.js"></script>
   	<script src="../assets/ga.js"></script>
   	<script src="../js/location.js"></script>
   	<!-- <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'> -->
   	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
   	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
   	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

   	<!--<link href="../css/demo-page.css" rel="stylesheet" media="all">-->
   	<link href="../css/hover.css" rel="stylesheet" media="all">
   	<script src="../js/animsition.min.js" charset="utf-8"></script>
   	<!--datepicker--><script src="../js/bootstrap-datepicker.js"></script><!--datepicker-->
   	<script src="../js/search.js" charset="utf-8"></script>
   	<script src="../js/calculation.js" charset="utf-8"></script>
   	<script src="../js/optionvalidation.js" charset="utf-8"></script>
   	<script src="../js/bootbox.min.js"></script>
   	<script src="../js/notify.min.js"></script>
<table id="table"
				   data-height="400"
				   data-toggle="table"
				   data-search="true"
				   data-url="../json/data1.json">
				  <thead>
					<tr>
						<?php if($role!='GUEST'){ ?>
						<th   data-field="state"></th>
						<?php } ?>
						<!--<th   data-sortable="true">Sr.No.</th>-->
						<th   data-sortable="true">View</th>				 
						<th   data-sortable="true" title="PG Stock Id">Stock Id</th>
						<th   data-sortable="true" title="Shape">Shape</th>
						<th   data-sortable="true" title="Lab">Lab</th>
						<th   data-sortable="true" title="Certificate">Certificate</th>
						<th   data-sortable="true" title="Size/Carat">Size</th>
						<th   data-sortable="true" title="Color">Color</th>
						<th   data-sortable="true" title="Clarity">Clarity</th>
						<th   data-sortable="true" title="Cut">Cut</th>
						<th   data-sortable="true" title="Polish">Polish</th>
						<th   data-sortable="true" title="Symmetry">Symm.</th>
						<th   data-sortable="true" title="Fluorsence">Flr</th>
						<th   data-sortable="true" title="Rap Rate">Rap $</th>
						<th   data-sortable="true" title="Discount">&#177; Dis</th>
						<th   data-sortable="true" title="Per Carat Rate">P/C $</th>
						<th   data-sortable="true" title="Final Amount">Amount$</th>
						<th   data-sortable="true" title="Depth">Depth</th>  
						<th   data-sortable="true" title="Table">Table</th> 
					   <th   data-sortable="true" title="Measurement">Measurement</th>              
					   <th   data-sortable="true" title="H & A">H & A</th>              
					   <th   data-sortable="true" title="Milky">Milky</th>             
					   <th   data-sortable="true" title="Brown Inclusion">Br.I</th>             
					   <th   data-sortable="true" title="Black Inclusion">Bl.I</th>             
					   <th   data-sortable="true" title="Location">Location</th>
					   <th  >Timer</th>
						<?php if($role=='SUPERADMIN'){ ?>
						<th   data-sortable="true">Added By</th> 
						<?php } ?>
					 </tr>
				  </thead>
			 <tbody>
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
                        echo "<tr style='cursor:pointer;font-size:10px;' class='$class'>";
					    echo "<td class='tdPlus' id='hideguest'>";
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
							   <input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
					   <?php }
							else
							{ ?>
							   <input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>							 
					   <?php }
							}
						   else if(mysqli_num_rows($cartresult) > 0)
						    { ?>
							   <input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
					  <?php }
					        else
							{ ?>
							  <input type="checkbox" class="filter" name="cartcheck[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('add','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>
					   <?php }
					    }
					    ?>
				  <!--<a  data-toggle="collapse" href="#collapseExample<?php //echo $did; ?>" aria-expanded="false" aria-controls="collapseExample"  onclick="$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')"><i class="fa fa-plus-circle fa-lg"></i></a>-->
				  <a href="javascript:;" data-id='<?php echo $did;?>' onclick="showDiamondModal('<?php echo $did;?>')"><i class="fa fa-plus-circle fa-lg"></i></a>
                  <?php 
                  echo "</td><input type='hidden' name='quantity' id='quantity' value='1'/>";
                  echo "<td class='tdPlus'>";
				  if($certiimage!=''){
				  echo "<a href=".$certiimage." target='_blank' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;";
				  }if($row['videolink']!=''){
				  echo "<a href='".$row['videolink']."' target='_blank' title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a>";
				  }
				  echo "</td>";
				  echo "<td class='center tdPlus' title='PG Stock Id'>".$row['referenceno']."</td>";
                  echo "<td title='Shape'>".$row['diamond_shape']."</td>";
				  echo "<td title='Lab' class='tdPlus'>".$lab."</td>";
                  echo '<td title="'.$kysymbol.'"><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'</a></td>';
                  echo "<td title='Carat' class='tdPlus'>".$row['weight']."</td>";
				  if($row['color']==''){$rowColor='-';}else{$rowColor=$row['color'];}
                  echo "<td title='Color' class='tdPlus'>".$rowColor."</td>";
				  if($row['clarity']==''){$rowClarity='-';}else{$rowClarity=$row['clarity'];}
                  echo "<td title='Clarity' class='tdPlus'>".$rowClarity."</td>";
				  if($cutrow['semicut']==''){$rowSemicut='-';}else{$rowSemicut=$cutrow['semicut'];}
                  echo "<td class='center tdPlus' title='Cut'>".$rowSemicut."</td>";
				  if($polishrow['semipolish']==''){$rowSemipolish='-';}else{$rowSemipolish=$polishrow['semipolish'];}
				  echo "<td class='center tdPlus' title='Polish'>".$rowSemipolish."</td>";
				  if($symhrow['semisymmetry']==''){$rowSemisymmetry='-';}else{$rowSemisymmetry=$symhrow['semisymmetry'];}	
				  echo "<td class='center tdPlus' title='Symmetry'>".$rowSemisymmetry."</td>";
				  if($row['fluoresence']==''){$rowFluoresence='-';}else{$rowFluoresence=$row['fluoresence'];}	
				  echo "<td title='Flurosence' class='tdPlus'>".$rowFluoresence."</td>";
				  echo "<td class='center tdPlus' title='Rap Rate'>".$currentraprate."</td>";
				  echo "<td class='center tdPlus' title='Discount'>".$totaldiscc."%</td>";
				  if($raprow['pc']==''){$rowPC='-';}else{$rowPC=$raprow['pc'];}	
				  echo "<td class='center tdPlus' title='PC'>".$rowPC."</td>";
				  if($raprow['usd']==''){$rowUSD='-';}else{$rowUSD=$raprow['usd'];}	
				  echo "<td class='center tdPlus' title='USD'>".$rowUSD."</td>";	
				  if($row['depth']==''){$rowDepth='-';}else{$rowDepth=$row['depth'];}	
                  echo "<td title='Depth' class='tdPlus'>".$rowDepth."%</td>";		
				  if($row['table']==''){$rowTable='-';}else{$rowTable=$row['table'];}	 	
                  echo "<td title='Table' class='tdPlus'>".$rowTable."%</td>";
				  echo "<td class='center tdPlus' title='Measurement'>".$measurement."</td>";
				  if($row['H_A']==''){$rowH_A='-';}else{$rowH_A=$row['H_A'];}
				  echo "<td class='center tdPlus' title='H & A'>".$rowH_A."</td>";
				  if($row['milky']==''){$rowMilky='-';}else{$rowMilky=$row['milky'];}
				  echo "<td class='center tdPlus' title='Milky'>".$rowMilky."</td>";
				  if($row['brown_inclusion']==''){$rowBrownInclusion='-';}else{$rowBrownInclusion=$row['brown_inclusion'];}
				  echo "<td class='center tdPlus' title='Brown Inclusion'>".$rowBrownInclusion."</td>";		
				  if($row['black_inclusion']==''){$rowBlackInclusion='-';}else{$rowBlackInclusion=$row['black_inclusion'];}	 
				  echo "<td class='center tdPlus' title='Black Inclusion'>".$rowBlackInclusion."</td>";		
				  if($row['location']==''){$rowLocation='-';}else{$rowLocation=$row['location'];}	 		 
				  echo "<td class='center tdPlus' title='Location'>".$rowLocation."</td>";
				  if(mysqli_num_rows($dstatusqryresult) > 0){
				   echo '<script>
				   function checkUnhold'.$did.'(){
					  var unholdTime=$("#unholdTime_'.$did.'").val();
					  $("#hmsTimer_'.$did.'").countdown(unholdTime, function(event) {
					   var totalHours = event.offset.totalDays * 24 + event.offset.hours;
					   var countDownTimer=totalHours+":"+event.strftime("%M");
						$("#hours_'.$did.'").html(countDownTimer);
						if (countDownTimer=="0:00") {
						 checkholdtime('.$did.');
						}
						else{
						 
						 }
					  });
				  }
				  setInterval(function(){ checkUnhold'.$did.'(); }, 1000);
				  </script>';
				  echo "<td class='center tdPlus'  id='hmsTimer_".$did."'><div  id='hours_".$did."'></div></td>";
				  }
				  else{
					echo '<td></td>';
				  }
				  if($role=='SUPERADMIN'){
					$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['added_by']);
					$empname=mysqli_fetch_assoc($getempname);
                  echo "<td class='tdPlus'>".$empname['username']."</td>";
				  }
				  ?>
               </tr>				
               <?php }
				}
			}
               ?>
            </tbody>
		</table>