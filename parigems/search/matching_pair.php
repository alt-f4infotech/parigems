<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";
?>
<section class="main-section">
   <div class="container-fluid crumb_tp">
	 <ol class="breadcrumb " id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <!--<li><a href="../search/search.php">Search</a></li>-->
      <li class="active">Matching Pair Diamond</li>
   </ol>
  
     <div class="row">
        <div class="col-sm-4">
           <!-- <p class="btn btn-default">
            <span style="background-color: #ffffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Available
            <span style="background-color: #ebcccc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Business Process
            <span style="background-color: #faf2cc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Hold
         </p>-->
        </div>
        <div class="col-sm-8"><h3 align="left">Matching Pair Diamond</h3></div>
     </div>
      <div class="table-responsive">
	   <table id="table"
				   data-height="400"
				   data-toggle="table"
				   data-search="true"
				   data-url="../json/data1.json">
      <thead>
               <tr style="font-size:10px;">
                 <th data-field="state"></th>
                 <th data-sortable="true">View</th>				 
				 <th data-sortable="true">Stock Id</th>
                 <th data-sortable="true">Shape</th>
				 <th data-sortable="true">Lab</th>
                 <th data-sortable="true">Cert No.</th>
                 <th data-sortable="true">Size</th>
                 <th data-sortable="true">Color</th>
                 <th data-sortable="true">Clarity</th>
                 <th data-sortable="true">Cut</th>
                 <th data-sortable="true">Polish</th>
                 <th data-sortable="true">Symmetry</th>
				 <th data-sortable="true">Flr</th>
                 <th data-sortable="true">Rap</th>
                 <th data-sortable="true">Dis</th>
                <th data-sortable="true">Measurement</th>
                 <th data-sortable="true">Table</th>
                 <th data-sortable="true">Depth</th>  
               </tr>
            </thead>
            <tbody>
               <?php
                  $i=1;
                  $mainquery="SELECT distinct d.weight as 'carat', d.color, d.clarity, d.diamond_shape, d.cut,d.polish, d.symmetry, d.table, d.depth,d.diameter_min,d.diameter_max,d.height, GROUP_CONCAT(d.diamond_id) as did FROM `diamond_master` d WHERE 1 and diamond_status='1' group by d.weight ORDER BY d.weight ASC" ;
				  //echo $mainquery;
                  $result=mysqli_query($con,$mainquery);
                  while($row3=mysqli_fetch_assoc($result)){
					   if($row3['carat'] <= '2.0')
					   {
						$value=0.1;
						$td=1.0;
						$measurevalue=0.3;
					   }
					   else{
						$value=0.3;
						$td=1.0;
						$measurevalue=0.6;
					   }
					   $maxcarat=$row3['carat'] + $value;
					   $mincarat=$row3['carat'] - $value;
					   
					   $maxtable=$row3['table'] + $td;
					   $mintable=$row3['table'] - $td;
					   
					   $maxdepth=$row3['depth'] + $td;
					   $mindepth=$row3['depth'] - $td;
					   
					   $maxdiametermax=$row3['diameter_max'] + $measurevalue;
					   $mindiametermax=$row3['diameter_max'] - $measurevalue;
					   
					   $maxdiametermin=$row3['diameter_min'] + $measurevalue;
					   $mindiametermin=$row3['diameter_min'] - $measurevalue;
					   
					   $maxheight=$row3['height'] + $measurevalue;
					   $minheight=$row3['height'] - $measurevalue;
					   $dmndid=explode(',',$row3['did']);
					   $diamondsCount=count($dmndid);
					   if($diamondsCount > 1)
					   {
						for($key=0;$key<=$diamondsCount;$key++)
						{
					 $certificteqry13="select distinct d.diamond_id,d.* from diamond_master d where  d.diamond_status='1' and d.weight BETWEEN '$mincarat' AND '$maxcarat' and d.table BETWEEN '$mintable' AND '$maxtable' and d.depth BETWEEN '$mindepth' AND '$maxdepth' and d.diameter_min BETWEEN '$mindiametermin' AND '$maxdiametermin' and d.diameter_max BETWEEN '$mindiametermax' AND '$maxdiametermax' and d.height BETWEEN '$minheight' AND '$maxheight' and d.color='".$row3['color']."' and  d.clarity='".$row3['clarity']."' and d.diamond_shape='".$row3['diamond_shape']."' and d.cut='".$row3['cut']."' and d.polish='".$row3['polish']."' and d.symmetry='".$row3['symmetry']."' and d.diamond_id=".$dmndid[$key]." ORDER BY d.weight ASC";
					   //echo $certificteqry13.'<br>';
						$certiresult13=mysqli_query($con,$certificteqry13);
					 while($row=mysqli_fetch_assoc($certiresult13))
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
                     
                     $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
                     $statusqryresult=mysqli_query($con,$statusqry);
                     $diamondstatusqry="select * from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
                     if(mysqli_num_rows($dstatusqryresult) > 0){
                        $class="warning";
						echo '<button class="btn btn-warning"  onclick="autounhold('.$did.');" id="unhold" style="display:none;">Hold</button>';
                     }
                     elseif(mysqli_num_rows($statusqryresult) > 0){
                        $class="danger";
                     }
                     else{
                        $class="";
                     }
                   
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
			
			           $totaldiscc=$raprow['final']+$userdiscount;
			
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
						if(mysqli_num_rows($getrapratesresult) > 0)
						{
						if($raprow['rap']!='0')
						{
                     echo "<tr style='cursor:pointer;font-size:10px;'>";
					   ?>
                    <td id="hideguest">
                     <!--<input type="checkbox"/><br>-->
                     <!--<a  data-toggle="collapse" href="#collapseExample<?php //echo $did; ?>" aria-expanded="false" aria-controls="collapseExample"  onclick="$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')"><i class="fa fa-plus-circle fa-lg"></i>-->
					 <a href="javascript:;" data-id='<?php echo $did;?>' onclick="showDiamondModal('<?php echo $did;?>')"><i class="fa fa-plus-circle fa-lg"></i></a>
                     </a>
                    </td>
                  <?php 
                  echo "<td><a href=".$certiimage." target='_blank' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;
				  <a href='".$row['videolink']."' target='_blank' title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a></td>";
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
				  echo "<td class='center'>".$totaldiscc."</td>";
				  echo "<td class='center'>".$measurement."</td>";
                  echo "<td>".$row['table']."%</td>";
                  echo "<td>".$row['depth']."%</td>";?>
               </tr>
				<!--<tr  class="accordian-body collapse" id="collapseExample<?php echo $did; ?>">
					<td colspan="9" class="hiddenRow">
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
							<td ><b>Symmetric</b></td>
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
					</td>
					<td colspan="6" class="hiddenRow">
						<table class="table table-bordered" >
						<tbody>
						   <tr   style="background-color:#D3D3D3">
						  <td colspan="4"><b>Additional Information</b></td>
						  </tr>
						  <tr>
							<td ><b>Height</b></td>
							<td><?php echo $row['height'];?></td>
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
						</tbody>
					  </table>
					</td>
					<td colspan="3" class="hiddenRow">
						<table class="table table-bordered">
							<tbody>
							  <tr>
								<td  style="background-color:#D3D3D3"><b>Location</b></td>
								<td><?php echo $row['location'];?></td>
							  </tr>
							  <tr>
								<td  style="background-color:#D3D3D3"><b>Raprate</b></td>
								<td><?php echo $currentraprate;?></td>
							  </tr>
							   <tr>
								<td  style="background-color:#D3D3D3"><b>Report Comments</b></td>
								<td><?php echo $row['comments'];?></td>
							  </tr>
							  <tr>
								<td  style="background-color:#D3D3D3"><b>Key To Symbols</b></td>
								<td><?php echo $kysymbol;?></td>
							  </tr>
							</tbody>
						  </table>
					</td>
				</tr>-->
               <?php
                        } 
                       }
					}
				  }
				  echo "<tr class='danger'>";
						echo '<td></td><td></td><td></td><td></td><td></td><td></td>
						<td><!--<h5>'.$row3['carat'].'</h5>--></td>
						<td><!--<h5>'.$row3['color'].'</h5>--></td>
						<td><!--<h5>'.$row3['clarity'].'</h5>--></td>
						<td><!--<h5>'.$row3['cut'].'</h5>--></td>
						<td><!--<h5>'.$row3['polish'].'</h5>--></td>
						<td><!--<h5>'.$row3['symmetry'].'</h5>--></td>
						<td></td><td></td><td></td><td></td><td></td><td></td>';
						echo "</tr>";						
					   }
				  }
               ?>
            </tbody>
         </table>
      </div>
   </div>
   
</section>

<?php
include "../common/footer.php";
?>
	