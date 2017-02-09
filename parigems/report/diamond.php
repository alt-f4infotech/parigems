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
                            <label>Filter By Hold/Unhold</label>
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
                            <label>Filter By Online/Offline</label>
                            <select class="form-control" name="onlineOption">
                                <option value="">Select Option</option>
                                <option value="portalyes">Online</option>
                                <option value="portalno">Offline</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                    </div>
					<div class="col-sm-3">
							<label>Select User:</label>
							<select class="dropdownselect2" name="customerPost" id="color1">
								<option value="">Select User</option>
								<?php
								$getUserList=mysqli_query($con,"select * from basic_details where usertype='USER' and userstatus='1'");
								while($row=mysqli_fetch_assoc($getUserList))
								{
								 if($_POST['customerPost']==$row['userid'])
								 {  ?>
								<option value="<?php echo $row['userid'];?>" selected><?php echo $row['companyname'];?></option>
								<?php
								 }
								 else{
								  ?>
								<option value="<?php echo $row['userid'];?>"><?php echo $row['companyname'];?></option>
								<?php }} ?>
							</select>
					</div>
					<div class="col-sm-3">
							<label>Select Country:</label>
							<select class="countries form-control" id="location" name="countrytype"  onchange="$('#location1').val(this.value);" >
								<option value="">Select Country</option>
							</select>
							<input type="hidden" id="location1">
					</div>
					 <!--<div class="col-sm-3">
					  <label>Certificate Number</label>
					  <input type="text" name="certino" id="ceritno" class="form-control">
					</div>-->
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
		<button type="submit" class="btn btn-success warning-hold"  onclick="return atleast_onediamond()" name="hold" id="holdid">Hold</button>
		<button type="submit" class="btn btn-warning"  onclick="return atleast_onediamond()" name="unhold">Unhold</button>
		
		<?php
		if($_POST['customerPost']!='')
		{ ?>
		 <input type="text" style="display: none;" value="<?php echo $_POST['customerPost'];?>" name="customerPost" id="customerPost">
         <button type="submit" class="btn btn-primary" name="assign">Assign</button>
		<?php }else{ ?>
		<button type="button" class="btn btn-primary"  onclick="assignDiamonds()" name="assign">Assign</button>
		<?php } ?>
		<button type="submit" name="assign" onclick="return atleast_onediamond()" style="display: none;">Hidden</button>
		<button type="submit" class="btn btn-info"     onclick="return atleast_onediamond()" name="online">Online</button>
		<button type="submit" class="btn btn-danger"   onclick="return atleast_onediamond()" name="offline">Offline</button>
		</center>
        <span class="">
         <p class="btn btn-default">
            <label><span class="warning-hold" style="border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Hold</label>
            <label><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Offline</label>
		 </p>
		</span>
		
						  <div class="table-responsive">
							<table id="table"
							  data-height="400"
							  data-show-columns="true"
							  data-toggle="table"
							 data-search="true"
							 data-show-export="true"
							 data-click-to-select="true"
							 data-toolbar="#toolbar"
							 data-show-refresh="true"
							 data-show-toggle="true"
							 data-show-columns="true"
							 data-url="../json/data1.json">
							  <thead>
										 <tr class="tableHead">
											   <th><input type="checkbox" id="check_all"></th>
												<th data-sortable="true">PG Stock Id</th>
												<th data-sortable="true">Cert.No.</th>
												<th data-sortable="true">Shape</th>
												<th data-sortable="true">Size</th>
												<th data-sortable="true">Color</th>
												<th data-sortable="true">Clarity</th>
												<th data-sortable="true">Cut</th>
												<th data-sortable="true">Pol</th>
												 <th data-sortable="true">Sym</th>
												 <th data-sortable="true">Flr</th>
												 <th data-sortable="true">Rap $</th>
												 <th data-sortable="true">Dis.</th>
												 <!--<th data-sortable="true">User Dis.</th>-->
												 <th data-sortable="true">P/C</th>
												 <th data-sortable="true">USD $</th>
												 <th data-sortable="true">Depth</th>
												 <th data-sortable="true">Table</th>
												 <th data-sortable="true">Measurement</th>
											</tr>
									  </thead>
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
							  
							  if($_POST['customerPost']!="")
							  {
							  $getuserdiscount="select userdiscount,countrytype from basic_details where userid='".$_POST['customerPost']."' and userstatus='1'";
							  $discountres=mysqli_query($con,$getuserdiscount);
							  $discrw=mysqli_fetch_assoc($discountres);
							  $userdiscount=$discrw['userdiscount'];
							  $countrytype=$discrw['countrytype'];
							  }
							  else
							  {
								$userdiscount=0;
								if($_POST['countrytype']!="")
								{
								 $countrytype=$_POST['countrytype'];
								}
								else
								{
								 $countrytype="";  
								}
							  }
							  
							  if($_POST['countrytype']!="")
							  {
							   $countrytype=$_POST['countrytype'];
							  }
							  else
							  {
							   $countrytype="";  
							  }
							  
							  $getcountrydiscount="select discount,countryname from country_discount where countryname='$countrytype'";
							  $discountcountryres=mysqli_query($con,$getcountrydiscount);
							  if(mysqli_num_rows($discountcountryres) > 0){
							  $disccntryrw=mysqli_fetch_assoc($discountcountryres);
							  $discountcountry=$disccntryrw['discount'];
							  $countryname=strtolower($disccntryrw['countryname']);
							  $userdiscount=$userdiscount+$discountcountry;
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
							   $Discount='+'.('+'.$explodeFirstDiscount[1]+ $userdiscount);
							   $SaleUserDiscount='+'.('+'.$explodeFirstDiscount[1]+ $userdiscount);
							  }
							  else{
							   $Discount=('-'.$firstDiscount+$userdiscount);
							   $SaleUserDiscount=('-'.$firstDiscount+ $userdiscount);
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
									 <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
							 <?php }
								  else
								  { ?>
									 <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>							 
							 <?php }
								  }
								 else if(mysqli_num_rows($cartresult) > 0)
								  { ?>
									 <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
							<?php }
								  else
								  { ?>
									   <input type="checkbox" class="case filter" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart('add','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>
							 <?php }
							  }?>
							   <a href="javascript:;" data-id='<?php echo $did;?>' onclick="showDiamondModal('<?php echo $did;?>')"><i class="fa fa-plus-circle fa-lg"></i></a>
							  <?php
								  echo '</td>';
								  echo "<td>".$row['referenceno']."</td>";
								  echo '<td><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
								  echo "<td>".$row['diamond_shape']."</td>";
								  echo "<td>".$row['weight']."</td>";
								  echo "<td>".$row['color']."</td>";
								  echo "<td>".$row['clarity']."</td>";
								  echo "<td>".$cutrow['semicut']."</td>";
								  echo "<td>".$polishrow['semipolish']."</td>";
								  echo "<td>".$symhrow['semisymmetry']."</td>";
								  echo "<td>".$row['fluoresence']."</td>";
								  echo "<td>$".$currentraprate."</td>";
								  echo "<td>".$Discount."</td>";
								 // echo "<td>".$SaleUserDiscount."</td>";
								  $temprapRate=$currentraprate * ($Discount / 100);
								  $finalRapRate=$currentraprate + $temprapRate;
								  $rowUSD=$finalRapRate * $row['weight'];
								  $lastvalue=$lastvalue+$rowUSD;
								  echo "<td>".$finalRapRate."</td>";
								  //echo "<td>".$temprapRate."</td>";
								  echo "<td>$".$rowUSD."</td>";
								  echo "<td>".$row['depth']."%</td>";
								  echo "<td>".$row['table']."%</td>";
								  echo "<td>".$measurement."</td>";
								  echo "</tr>";
							 ?>
						  <input type="text" style="display: none;" name="amount_<?php echo $did;?>"   value="<?php echo $rowUSD;?>"  />
						  <input type="text" style="display: none;"  name="userdiscountPost_<?php echo $did;?>"   value="<?php echo $Discount;?>"  />
						  <input type="text" style="display: none;"  name="rapRatePost_<?php echo $did;?>"   value="<?php echo $currentraprate;?>"  />
						  <?php } ?>
						   </tbody>
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
   $(document).ready(function() {
	$.ajax({
    url:"../search/sendaction.php?action=reset",  
    success:function(data) {
	}
	});
});
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