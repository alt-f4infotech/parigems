<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  ?>
  
<body>
  <section class="main-section">
    <div class="container-fluid crumb_top">
         <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Diamonds</li>
   </ol>
 
        <h3 align="center">Diamonds</h3>
			<form action="diamond.php" method="post">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Filter By</label>
                            <select class="form-control" name="holdOption">
                                <option value="">Select Option</option>
                                <option value="HOLD">Hold</option>
                                <option value="UNHOLD">Unhold</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Filter By</label>
                            <select class="form-control" name="onlineOption">
                                <option value="">Select Option</option>
                                <option value="portalyes">Online</option>
                                <option value="portalno">Offline</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                    </div>
					 <div class="col-sm-3">
					  <label>Certificate Number</label>
					  <input type="text" name="certino" id="ceritno" class="form-control">
					</div>
                <div class="col-sm-3">
                   <div class="form-group"><br>
                      <button type="submit" class="btn btn-success">Submit</button> <button type="button" class="btn btn-danger" onclick="window.location.href='diamond.php'">Reset</button>
                    </div>
                </div>
             </div>
            </form>
            <?php
            if($_POST['holdOption']!='')
            { 
                if($_POST['holdOption']!='both')
                {
                    $filter1Qry=" and d.diamond_user_status='".$_POST['holdOption']."'";
                }
                else{ $filter1Qry="";}
            }
            else{$filter1Qry="";}
            
            if($_POST['onlineOption']!='')
            { 
                if($_POST['onlineOption']!='both')
                {
                    $filter2Qry=" and d.portalshow='".$_POST['onlineOption']."'";
                }
                else{
                  $filter2Qry="";  
                }
            }
            else{$filter2Qry="";}
			
			if ($_POST['certino']!="") {
				$certino= $_POST['certino'];
			    $certiqry="and c.certi_no='$certino'";
			  }
			  else{
			   $certiqry = "";
			   }
            
     $certificteqry1="select d.*,l.username from  diamond_master d,login l,certificate_master c where 1 $filter1Qry $filter2Qry $certiqry and d.diamond_status='1' and  d.added_by=l.userid and c.certificateid=d.certificate_id order by d.entrydate ASC";
            ?>
		<?php
	$cartitem=0;$carat=0;$rap=0;$avg_price=0;$holdcountt=0;
	$getcartqry="SELECT carat,rap,discount,diamondid FROM add_to_cart where wishstatus='1' and userid='$userid'";
	$resultcart=mysqli_query($con,$getcartqry);
	while($cartrow=mysqli_fetch_assoc($resultcart))
	{ 
	 $carat=$cartrow["carat"]; 
	 $diamondid=$cartrow["diamondid"];
	 $rap=($cartrow["carat"]*$cartrow["rap"]);
	 
	 $final=$cartrow['discount'];
	 
	 $avg_price = ($final / 100) * $cartrow["rap"];
	 $total_value=($cartrow["rap"]-$avg_price)*$carat;
	 $cartitem++;
   $finalcarat=$finalcarat+$carat;
   $finalrap=$finalrap+$rap;
   $lastvalue=$lastvalue+$total_value;
   
   $diamondstatusqry0="select holdtime,userid as holduser from diamond_status where diamondid=$diamondid and diamond_status='HOLD'";
  $dstatusqryresult0=mysqli_query($con,$diamondstatusqry0);
   if(mysqli_num_rows($dstatusqryresult0) > 0){
	$hrw0=mysqli_fetch_assoc($dstatusqryresult0);
	if($hrw0['holduser'] != $userid)
	{
		$holdcountt=$holdcountt+1;
	}
   }
  }
    
  if($lastvalue!=''){
          $lastavgdiscount=100-(($lastvalue/$finalrap)*100);
  }
  if($lastavgdiscount < 0)
	{
	 $lastavgdiscount=$lastavgdiscount; 
	}
	else{
	 $lastavgdiscount='-'.$lastavgdiscount; 
	}
		 $cartitemtotal=0;$carat=0;$raptotal=0;$avg_pricetotal=0;
	$productByCode ="SELECT d.*,dp.rap,dp.final FROM diamond_master d,diamond_sale dp WHERE d.diamond_id=dp.diamond_id and d.diamond_status='1'";
	$runproductByCode=mysqli_query($con,$productByCode);
	while($row=mysqli_fetch_assoc($runproductByCode))
	{
	  
		  
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
		
	 $diamondid=$row["diamond_id"];
	 $rap=($row['weight']*$currentraprate);
	 
	 $final=$row['final'];
	 
	 $avg_price = ($final / 100) * $currentraprate;
	 $total_value=($currentraprate-$avg_price)*$caret;
	 $cartitemtotal++;
   $finalcarattotal=$finalcarattotal+$caret;
   $finalraptotal=$finalraptotal+$rap;
   $lastvaluetotal=$lastvaluetotal+$total_value;
		
   }
    
  if($lastvaluetotal!=''){
          $lastavgdiscounttotal=100-(($lastvaluetotal/$finalraptotal)*100);
  }
  
    if($lastavgdiscounttotal < 0)
	{
	 $lastavgdiscounttotal=$lastavgdiscounttotal; 
	}
	else{
	 $lastavgdiscounttotal='-'.$lastavgdiscounttotal; 
	}
		   ?>
		   <div id="wait" style="display:none;width:69px;height:89px;position: fixed;left: 50%;top: 50%;background-size: cover;z-index: 1001;"><img src='../images/demo_wait.gif' width="64" height="64" /></div>
		<center>
		
		   <div id="carttable">
			<?php
        echo '<table class="table table-bordered carttable" align="center" id="carttatble" style="font-size:12px;">
            <tr><th></th><th>PCS</th><th>Carat</th><th>Rap Value</th><th>Avg. Discount</th><th>Avg. Price</th><th>Value</th></tr>
			
            <tr><td>Total</td><td>'.$cartitemtotal.'</td><td>'.$finalcarattotal.'</td><td>'.sprintf("%.2f",$finalraptotal).'</td><td>'.sprintf("%.2f",$lastavgdiscounttotal).'</td><td>'.sprintf("%.2f",($lastvaluetotal/$finalcarattotal)).'</td><td>'.sprintf("%.2f",$lastvaluetotal).'</td></tr>
			
			<tr><td>Selected</td><td id="cartitem">'.$cartitem.'</td><td id="finalcarat">'.$finalcarat.'</td><td id="finalrap">'.sprintf("%.2f",$finalrap).'</td><td id="lastavgdiscount">'.sprintf("%.2f",$lastavgdiscount).'</td><td id="avgprice">'.sprintf("%.2f",($lastvalue/$finalcarat)).'</td><td id="lastvalue">'.sprintf("%.2f",$lastvalue).'</td></tr>
         </table>';
                ?>
		</center>
		   </div>
        <form action="multiAction.php" method="post">
        <center>
		<button type="submit" class="btn btn-success"  onclick="return atleast_onediamond()" name="hold" id="holdid">Hold</button>
		<button type="submit" class="btn btn-warning"  onclick="return atleast_onediamond()" name="unhold">Unhold</button>
		<button type="button" class="btn btn-primary"  onclick="assignDiamonds()" name="assign">Assign</button>
		<button type="submit" name="assign" onclick="return atleast_onediamond()" style="display: none;">Hidden</button>
		<button type="submit" class="btn btn-info"     onclick="return atleast_onediamond()" name="online">Online</button>
		<button type="submit" class="btn btn-danger"   onclick="return atleast_onediamond()" name="offline">Offline</button>
		</center>
        <span class="">
         <p class="btn btn-default">
            <label><span  style="background-color: #faf2cc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Hold</label>
            <label><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Offline</label>
		 </p>
		</span>
		
						  <div class="table-responsive">
							<table cellspacing="0" cellpadding="0" border="0" width="325">
							 <tr>
								<td>
								  <div style="width:1342px;font-size:small">
									<table class="table table-stripped" cellspacing="0" cellpadding="0">
										 <tr class="tableHead">
											   <th class="thPlus"><input type="checkbox" id="check_all"></th>
												<th class="thPlus">PG Stock Id</th>
												<th class="thPlus">Cert.No.</th>
												<th class="thPlus">Shape</th>
												<th class="thPlus">Size</th>
												<th class="thPlus">Color</th>
												<th class="thPlus">Clarity</th>
												<th class="thPlus">Cut</th>
												<th class="thPlus">Pol</th>
												 <th class="thPlus">Sym</th>
												 <th class="thPlus">Flr</th>
												 <th class="thPlus">Rap $</th>
												 <th class="thPlus">Dis.</th>
												 <th class="thPlus">P/C</th>
												 <th class="thPlus">USD $</th>
												 <th class="thPlus">Depth</th>
												 <th class="thPlus">Table</th>
												 <th class="thPlus">Measurement</th>
											</tr>
									  </table>
								  </div>
								</td>
						    </tr>
						    <tr>
						    <td>
								<div style="width:1366px; height:300px; overflow:auto;font-size:small;margin-top:-20px;">
								  <table class="table table-stripped" cellspacing="0" cellpadding="0">
								   <tbody>
							  <?php
								 $i=1;
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
									 $class="warning-hold"; 
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
							  
							  $firstDiscount=$srrow['discount1'];
							  if($firstDiscount < 0)
							  {
							   $explodeFirstDiscount=explode('-',$firstDiscount);
							   $Discount='+'.$explodeFirstDiscount[1]; 
							  }
							  else{
							   $Discount='-'.$firstDiscount; 
							  }
								  echo "<tr  class='$class'>";
								  echo '<td class="tdPlus">';
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
									 <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')" checked /><br>
							 <?php }
								  else
								  { ?>
									 <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>							 
							 <?php }
								  }
								 else if(mysqli_num_rows($cartresult) > 0)
								  { ?>
									 <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')" checked /><br>
							<?php }
								  else
								  { ?>
									   <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('add','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>
							 <?php }
							  }?>
							  <a  data-toggle="collapse" href="#collapseExample<?php echo $did; ?>" aria-expanded="false" aria-controls="collapseExample"  onclick="$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')"><i class="fa fa-plus-circle fa-lg"></i></a>
							  <?php
								  echo '</td>';
								  echo "<td class='tdPlus'>".$row['referenceno']."</td>";
								  echo '<td class="tdPlus"><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
								  echo "<td class='tdPlus'>".$row['diamond_shape']."</td>";
								  echo "<td class='tdPlus'>".$row['weight']."</td>";
								  echo "<td class='tdPlus'>".$row['color']."</td>";
								  echo "<td class='tdPlus'>".$row['clarity']."</td>";
								  echo "<td class='center tdPlus'>".$cutrow['semicut']."</td>";
								  echo "<td class='center tdPlus'>".$polishrow['semipolish']."</td>";
								  echo "<td class='center tdPlus'>".$symhrow['semisymmetry']."</td>";
								  echo "<td class='center tdPlus'>".$row['fluoresence']."</td>";
								  echo "<td class='center tdPlus'>$".$raprow['rap']."</td>";
								  echo "<td class='center tdPlus'>".$Discount."</td>";
								  echo "<td class='center tdPlus'>".$srrow['pc']."</td>";
								  echo "<td class='center tdPlus'>$".$srrow['usd']."</td>";
								  echo "<td class='tdPlus'>".$row['depth']."%</td>";
								  echo "<td class='tdPlus'>".$row['table']."%</td>";
								  echo "<td class='center tdPlus'>".$measurement."</td>";
								  echo "</tr>";
							 ?>
							 <tr  class="accordian-body collapse" id="collapseExample<?php echo $did; ?>">
						  <td colspan="10" class="hiddenRow">
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
								  <td ><!--<b>Diameter</b>--></td>
								  <td><?php //echo $row['diameter_min'].'-'.$row['diameter_max'];?></td>
								</tr>
							  </tbody>
							</table>
						  </td>
						  <td colspan="5" class="hiddenRow">
							  <table class="table table-bordered" >
							  <tbody>
								 <tr   style="background-color:#D3D3D3">
								<td colspan="4"><b>Additional Information</b></td>
								</tr>
								<tr>
								  <!--<td ><b>Height</b></td>
								  <td><?php //echo $row['height'];?></td>-->
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
					  </tr>
						  <input type="text" style="display: none;" name="amount[]"   value="<?php echo $total_value;?>"  />
						  <?php } ?>
						   </tbody>
								  </table>
								</div>
						</td>
					  </tr>
        </table>
    </div>
          
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
 </section>
</body>
</html>
<script>
    function atleast_onediamond() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Diamond");
  return false;
  }
  else
  {
	return true;
  }
  }
  
function showAjaxModal(uid)
{
$.get('../search/viewcertificate.php?certi_id=' + uid, function(html){
              $('#myModal .modal-body').html(html);
              $('#myModal').modal('show', {backdrop: 'static'});
          });
}
   
   function assignDiamonds()
         {
    $.get('viewUserList.php', function(html){
                  $('#userModal .modal-body').html(html);
                  $("#customer").select2();
                  $('#userModal').modal('show', {backdrop: 'static'});
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
<?php
include "../common/footer.php";
?>