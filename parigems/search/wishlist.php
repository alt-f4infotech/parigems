<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  if(isset($_POST['watchlistRemove']))
  {
  if($_POST['existingValue']!='')
	{
	$removeWishlistName="delete from  wishlist where userid='$userid' and watchlistName='".$_POST['existingValue']."'";
	  if(mysqli_query($con,$removeWishlistName))
	  {
		$removeWishlist="delete from add_to_cart_wishlist where userid='$userid'";
		if(mysqli_query($con,$removeWishlist))
		{
		 echo '<script>window.location.href="wishlist.php";</script>';
		}
	  }
	}
  }
  ?>
<body>
  <section class="main-section">
    <div class="container-fluid">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li><a href="../search/search.php">Search</a></li>
        <li class="active">My Watchlist</li>
      </ol>
	  <!--<span style="color:red;">Note: Page will load auto interval for better communication.</span>-->
	  <span style="color:red;">Note: Please Refresh the Page for better communication.</span>
      <h3 align="center">My Watchlist</h3>
	  <?php
	  $cartitem=0;$carat=0;$rap=0;$avg_price=0;$holdcountt=0;
	$getcartqry="SELECT carat,rap,discount,diamondid FROM wishlist where wishstatus='1' and userid='$userid'";
	$resultcart=mysqli_query($con,$getcartqry);
	while($cartrow=mysqli_fetch_assoc($resultcart))
	{ 
	 $carat=$cartrow["carat"]; 
	 $diamondid=$cartrow["diamondid"];
	 $rap=($cartrow["carat"]*$cartrow["rap"]);
	 
	 $final=$cartrow['discount'];
	 
	 $avg_price = ($final / 100) * $cartrow["rap"];
	 $total_value=($cartrow["rap"]+$avg_price)*$carat;
	 $cartitem++;
	  $finalcarat=$finalcarat+$carat;
	  $finalrap=$finalrap+$rap;
	  $lastvalue=$lastvalue+$total_value;
   }
  
	if($lastvalue!=''){
	$lastavgdiscount1=100-(($lastvalue/$finalrap)*100);
	}
	
     if($lastavgdiscount1>0)
  {
   $lastavgdiscount='-'.abs((-1)*sprintf("%.2f",$lastavgdiscount1));
  }
  else
  {
   $lastavgdiscount='+'.abs((-1)*sprintf("%.2f",$lastavgdiscount1));
  }
	
	if($_POST['showWatchlistDivName']=='existingWatchlist')
	{
	  $watchlistQry=" and watchlistName='".$_POST['existingValue']."'";
	  $watchlistQryTotal=" and i.watchlistName='".$_POST['existingValue']."'";
	}
	else
	{
	 $watchlistQry=""; $watchlistQryTotal="";
	}
	
	$cartitemtotal=0;$carat=0;$raptotal=0;$avg_pricetotal=0;
	$productByCode ="SELECT d.*,dp.rap,dp.final FROM diamond_master d,diamond_sale dp,wishlist i WHERE 1 $watchlistQryTotal and d.diamond_id=dp.diamond_id and i.diamondid=d.diamond_id and i.userid='$userid' and i.wishstatus='1'";
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
		 $diamondid=$row["diamond_id"];
		$statusqry="select * from invoice_product where diamondid=$diamondid and pstatus=1";
        $statusqryresult=mysqli_query($con,$statusqry);
       if(mysqli_num_rows($statusqryresult) > 0){}else{
		
						  
		$qryraprate="select * from raptable where  color='".$row['color']."' and '$caret' between raprangestart and raprangeend and clarity='".$diamond_clarity."' and shape='$shape'";
		$raprateres=mysqli_query($con,$qryraprate);
		while($rprow=mysqli_fetch_assoc($raprateres))
		{
		 $currentraprate=$rprow['rate'];
		}
		
	
	 $rap=($row['weight']*$currentraprate);
	 
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
			
	 $final=$row['final'];
	 if($final > 0)
	  {
		$final='-'.$final;
	  }
	  else{						 
		$explodefinal=explode('-',$final);
		$final='+'.$explodefinal[1];
	  }
	$final=$final+$userdiscount;
			  
	 $avg_price = ($final / 100) * $currentraprate;
	 $total_value=($currentraprate+$avg_price)*$caret;
	 $cartitemtotal++;
   $finalcarattotal=$finalcarattotal+$caret;
   $finalraptotal=$finalraptotal+$rap;
   $lastvaluetotal=$lastvaluetotal+$total_value;
						
}
   }
    
  if($lastvaluetotal!=''){
          $lastavgdiscounttotal=100-(($lastvaluetotal/$finalraptotal)*100);
  }
   if($lastavgdiscounttotal>0)
  {
   $lastavgdiscounttotal='-'.abs((-1)*sprintf("%.2f",$lastavgdiscounttotal));
  }
  else
  {
   $lastavgdiscounttotal='+'.abs((-1)*sprintf("%.2f",$lastavgdiscounttotal));
  }
		   ?>
			 <?php
			 if($cartitemtotal == 0){
?>
<h3 class="text-center">Your Watchlist is empty</h3>
<p class="text-center">Please go to search diamond add items in watchlist to move futher</p>
<?php

			 }else{
			 ?>


		   <div id="wait" style="display:none;width:69px;height:89px;position: fixed;left: 50%;top: 50%;background-size: cover;z-index: 1001;"><img src='../images/demo_wait.gif' width="64" height="64" /></div>
		   <?php
		   if($_POST['watchlist']!='')
			{ ?>
		<center>
		   <div id="carttable">
			<?php
        echo '<table class="table table-bordered carttable" align="center" id="carttatble" style="font-size:12px;">
            <tr><th></th><th>PCS</th><th>Carat</th><th>Rap Value</th><th>Avg. Discount</th><th>Avg. Price</th><th>Value</th></tr>
			
            <tr><td>Total</td><td>'.$cartitemtotal.'</td><td>'.$finalcarattotal.'</td><td>'.sprintf("%.2f",$finalraptotal).'</td><td>'.$lastavgdiscounttotal.'</td><td>'.sprintf("%.2f",($lastvaluetotal/$finalcarattotal)).'</td><td>'.sprintf("%.2f",$lastvaluetotal).'</td></tr>
			
			<!--<tr><td>Selected</td><td id="cartitem">'.$cartitem.'</td><td id="finalcarat">'.$finalcarat.'</td><td id="finalrap">'.sprintf("%.2f",$finalrap).'</td><td id="lastavgdiscount">'.$lastavgdiscount.'</td><td id="avgprice">'.sprintf("%.2f",($lastvalue/$finalcarat)).'</td><td id="lastvalue">'.sprintf("%.2f",$lastvalue).'</td></tr>-->
			<tr><td>Selected</td><td id="cartitem"></td><td id="finalcarat"></td><td id="finalrap"></td><td id="lastavgdiscount"></td><td id="avgprice"></td><td id="lastvalue"></td></tr>
         </table>';
                ?>
		  </div>
		</center>
		<?php } ?>
	<form action="wishlist.php" method="post">
	  <div class="col-sm-12 form-group">	  
		<label><input type ="radio" name="showWatchlistDivName" value="existingWatchlist" onclick="showWatchlistDiv();" required <?php if($_POST['showWatchlistDivName']=='existingWatchlist'){echo 'checked';}?>> Existing Watchlist</label>
		<label><input type ="radio" name="showWatchlistDivName" value="newWatchlist"  onclick="showWatchlistDiv();" required <?php if($_POST['showWatchlistDivName']=='newWatchlist'){echo 'checked';}?>>All Watchlist</label>
	  </div>
	  <div class="col-sm-4 form-group" style="display:none" id="existingWatchlistDIV">	  
		<select class="form-control" name="existingValue" id="existingValue">
		 <option value="">Select Watchlist</option>
		 <?php
		 $getExistingWatchlist=mysqli_query($con,"select distinct watchlistName from wishlist where userid='$userid' and wishstatus='1'");
		 while($row=mysqli_fetch_assoc($getExistingWatchlist))
		 {
			if($row['watchlistName']!='')
			{
			 echo '<option value="'.$row['watchlistName'].'">'.$row['watchlistName'].'</option>';
			}
		 }
		 ?>
	   </select>
      </div>
	    <div class="col-sm-4 form-group">	  
		  <input type="submit" class="btn btn-success" value="submit" name="watchlist">
		  <input type="submit" class="btn btn-danger" value="Remove" name="watchlistRemove">
		</div>
	</form>
      <div class="clearfix"></div>
	  <?php
	  if($_POST['watchlist']!='')
	  {
		?>
	  <div class="table-responsive">
		<form id="movieForm" action="removewishlist.php" method="post">
		<table class="table table-condensed" id="table" data-height="400" data-toggle="table" data-search="true">
	   <thead style="font-size:8px;padding: 0px;">
           <tr>
              <th><input type="checkbox" id="check_all" ></th>
             <!-- <th data-sortable="true">Sr.No.</th>-->
              <th data-sortable="true">View</th>
				 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="PG Stock Id">PG Stock Id</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Shape">Shape</th>
				 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Lab">Lab</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Certificate Number">Cert No.</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Size">Size</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Color">Color</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Clarity">Clarity</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Cut">Cut</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Polish">Plsh</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Symmetry">Sym</th>
				 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Fluorsence">Flr</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Rap Rate">Rap $</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Discount">&#177; Dis</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Old Discount">Old Dis</th>
				 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Per Carat Rate">P/C $</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Amount">Amt$</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Depth">Dpth</th> 
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Table">Tble</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Measurement">Measurement</th>       
				<th   data-sortable="true" data-container='body' data-toggle='tooltip' title="H & A">H & A</th>              
				<th   data-sortable="true" data-container='body' data-toggle='tooltip' title="Milky">Milky</th>             
				<th   data-sortable="true" data-container='body' data-toggle='tooltip' title="Brown Inclusion">Br.I</th>             
				<th   data-sortable="true" data-container='body' data-toggle='tooltip' title="Black Inclusion">Bl.I</th>             
				<th   data-sortable="true" data-container='body' data-toggle='tooltip' title="Location">Loc.</th>
                 <th data-sortable="true" data-container='body' data-toggle='tooltip' title="Date Added">Date Added</th>
				 <?php if($_POST['watchlist']!='')
						{
						  echo '<th data-sortable="true">Watchlist Name</th>';
						}
				  ?>
        </tr>
        </thead>
        <tbody  style="font-size:8px;padding: 0px;">
          <?php
            $i=1;
			
            $certificteqry1="select i.*,d.*,dp.rap,dp.discount1,dp.discount2,dp.discount3,dp.final from wishlist i,diamond_master d,diamond_sale dp where 1 $watchlistQry and d.diamond_id=dp.diamond_id and i.diamondid=d.diamond_id and i.userid='$userid' and i.wishstatus='1'";
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
                     $wishqry="select * from wishlist where diamondid=$did and userid=$userid and wishstatus=1";
                     $wishresult=mysqli_query($con,$wishqry);
                     $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
                     $statusqryresult=mysqli_query($con,$statusqry);
                     $diamondstatusqry="select * from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
                     if(mysqli_num_rows($dstatusqryresult) > 0){
                        $class="warning-hold";$checked='';
                     }
                     elseif( $row['diamond_status']=='1'){
                        $class="";
						$checked='';
                     }
                     else{
                        $class="";$checked='';
                     }
                     $chevkcart="select * from add_to_cart_wishlist where diamondid=$did and userid=$userid  and wishstatus='1'";
                     $cartresult=mysqli_query($con,$chevkcart);
                     $keyquery="select * from diamond_keysymbol where diamond_id=$did";
                     $keyres=mysqli_query($con,$keyquery);$ks=1;
                     while($ksm=mysqli_fetch_assoc($keyres)){
						if($ks==1)
						{
							$kysymbol=$ksm['kysymbol'];
						}
						else
						{
							$kysymbol=$kysymbol.','.$ksm['kysymbol'];
						}
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
						
						$getoldraprates="SELECT * FROM `diamond_sale_edit` where diamond_id=$did";
						$getoldrapratesresult=mysqli_query($con,$getoldraprates);
						$oldraprow=mysqli_fetch_assoc($getoldrapratesresult);
						if($oldraprow['final']!=$raprow['final'])
						{
						  $olddiscount=$oldraprow['final'].'<br>';
						}
						else{$olddiscount='';}
						
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
						
						$carat=$row["weight"]; 
						$rap=($row["weight"]*$currentraprate);
						
						if($userdiscount==''){$userdiscount=0;}
						$final=$row['final']+$userdiscount;						
						$avg_price = ($final / 100) * $currentraprate;
						$total_value=($currentraprate-$avg_price)*$carat;
						
					  $finalcarat=$finalcarat+$carat;
					  $finalrap=$finalrap+$rap;
					  //$lastfinalvalue=$lastfinalvalue+$total_value;
					  $firstDiscount=$raprow['final'];
					 if($firstDiscount < 0)
						{
						 $explodeFirstDiscount=explode('-',$firstDiscount);
						 $Discount='+'.$explodeFirstDiscount[1]; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
						
						if($olddiscount > 0)
						{
						  $olddiscount='-'.$olddiscount;
						  $oldDiscount=($Discount-$olddiscount);
						}
						else{						 
						  $explodeOldDiscount=explode('-',$olddiscount);
						  $olddiscount='+'.$explodeOldDiscount[1];
						  $oldDiscount=($Discount-$olddiscount);
						}
						$newDiscount=$Discount+$userdiscount;
if($newDiscount > 0)
						{
						 $newDiscount='+'.$newDiscount ;
						}
						else
						{
						  $newDiscount=$newDiscount;
						}
						if($oldDiscount > 0)
						{
						 $oldDiscount='+'.$oldDiscount ;
						}
						else
						{
						  $oldDiscount=$oldDiscount;
						}
						if(mysqli_num_rows($statusqryresult) > 0){}else{
						if($raprow['rap']!='0'){
                      echo "<tr style='cursor:pointer;font-size:10px;' class='$class'>";
					 //echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case" '.$checked.' /></td>';
					 echo '<td>';
					if(mysqli_num_rows($cartresult) > 0)
						    { ?>
							   <input type="checkbox" class="filter case" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart_wishlist('remove','<?php echo $did; ?>','<?php echo $currentraprate;?>')"  /><br>
					  <?php }
					        else
							{ ?>
								 <input type="checkbox" class="filter case" name="check[]"  id="<?php echo $did; ?>" value="<?php echo $did; ?>" onclick="addtocart_wishlist('add','<?php echo $did; ?>','<?php echo $currentraprate;?>')" /><br>
					   <?php }
					   echo '</td>';
              echo "<td>";
				  if($certiimage!=''){
				  echo "<a href=".$certiimage." target='_blank'data-container='body' data-toggle='tooltip' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;";
				  }if($row['videolink']!=''){
				  echo "<a href='".$row['videolink']."' target='_blank' title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a>";
				  }
				  echo "</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='PG Stock Id'>".$row['referenceno']."</td>";
                  echo "<td data-container='body' data-toggle='tooltip' title='Shape'>".$row['diamond_shape']."</td>";
				   echo "<td data-container='body' data-toggle='tooltip' title='Lab'>".$lab."</td>";
                  echo '<td data-container="body" data-toggle="tooltip" title="'.$kysymbol.'"><a  href="javascript:;" data-id='.$row['certificate_id'].' onclick="showAjaxModal('.$row['certificate_id'].');">'.$certi_no.'</a></td>';
                  echo "<td data-container='body' data-toggle='tooltip' title='Size'>".$row['weight']."</td>";
                  echo "<td data-container='body' data-toggle='tooltip' title='Color'>".$row['color']."</td>";
                  echo "<td data-container='body' data-toggle='tooltip' title='Clarity'>".$row['clarity']."</td>";
                  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Cut'>".$cutrow['semicut']."</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Polish'>".$polishrow['semipolish']."</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Symmetry'>".$symhrow['semisymmetry']."</td>";
				  echo "<td data-container='body' data-toggle='tooltip' title='Flurosence'>".$row['fluoresence']."</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Rap Rate'>".$currentraprate."</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Discount'>".$newDiscount."</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Old Discount'><font color='red'>".$oldDiscount."</font></td>";
				   $temprapRate=$currentraprate * ($newDiscount / 100);
						$finalRapRate=$currentraprate + $temprapRate;
				  echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='PC'>".$finalRapRate."</td>";
				  if($raprow['usd']==''){$rowUSD='-';}else{$rowUSD=$raprow['usd'];}
						$rowUSD=$finalRapRate * $row['weight'];
					  $lastfinalvalue=$lastfinalvalue+$rowUSD;
                  echo "<td data-container='body' data-toggle='tooltip' title='Amount'>".sprintf("%.2f",$rowUSD)."</td>";
                  echo "<td data-container='body' data-toggle='tooltip' title='Depth'>".$row['depth']."%</td>";
                  echo "<td data-container='body' data-toggle='tooltip' title='Table'>".$row['table']."%</td>";
				  echo "<td data-container='body' data-toggle='tooltip' class='center' title='Measurement'>".$measurement."</td>";
				  if($row['H_A']==''){$rowH_A='-';}else{$rowH_A=$row['H_A'];}
				  echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='H & A'>".$rowH_A."</td>";
				  if($row['milky']==''){$rowMilky='-';}else{$rowMilky=$row['milky'];}
				  echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Milky'>".$rowMilky."</td>";
				  if($row['brown_inclusion']==''){$rowBrownInclusion='-';}else{$rowBrownInclusion=$row['brown_inclusion'];}
				  echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Brown Inclusion'>".$rowBrownInclusion."</td>";		
				  if($row['black_inclusion']==''){$rowBlackInclusion='-';}else{$rowBlackInclusion=$row['black_inclusion'];}	 
				  echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Black Inclusion'>".$rowBlackInclusion."</td>";		
				  if($row['location']==''){$rowLocation='-';}else{$rowLocation=$row['location'];}	 		 
				  echo "<td data-container='body' data-toggle='tooltip' class='center tdPlus' title='Location'>".$rowLocation."</td>";
                echo "<td data-container='body' data-toggle='tooltip' title='Date Added'>".date('d-m-Y g:i: A',strtotime($row['timestamp']))."</td>";
				if($_POST['watchlist']!='')
				  {
					echo "<td>".$row['watchlistName']."</td>";
				  }
                ?>
		<input type="text" style="display: none;" name="amount[]"   value="<?php echo $rowUSD;?>"  />
		<input type="text" style="display: none;" name="userdiscount[]"   value="<?php echo $newDiscount;?>"  />
		<input type="text" style="display: none;" name="rapRate[]"   value="<?php echo $currentraprate;?>"  />
            <input type="hidden" name="quantity" id="quantity" value="1"/>
          <?php
            echo "</tr>";
            $i++;}}
              }
            ?>
		<input type="text" style="display: none;" name="finalamount"  value="<?php echo sprintf("%.2f",$lastfinalvalue);?>"  />
           <tr>
              <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			  <td><b>Total</b></td><td><b><?php echo sprintf("%.2f",$lastfinalvalue);?></b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			  <?php if($_POST['watchlist']!='')
				  { echo '<td></td>';} ?>
            </tr>
        </tbody>
      </table>
	  <?php if($i > 1){ ?>
	   <center>
		<button type="button" class="btn btn-primary"  onclick="return atleast_onecheckbox1()">Place Order</button>
		<button style="display: none" type="button" id="button" href='javascript:;' class='btn btn-success' onclick='showconfirmmodal();' >HiddenButton</button>
		<button type="submit" class="btn btn-danger" name="remove_wish" value="remove_wish">Remove</button>
		</center>
	   <?php } ?>
	   <div class="modal fade" id="confirmModal" role="dialog" style="z-index: 10000;">
		  <div class="modal-dialog" style="width: 80%;">
			<!-- Modal content-->
			<div class="modal-content border-radius0">
			  <div class="modal-body" style="padding: 0px;">
			  </div>
			</div>
		  </div>
		</div>
	    </form>
	  </div>
	  <?php } ?>
  </section>
</body>
<?php } ?>
<script>
  function showWatchlistDiv() {    
   showWatchlist=$("input[name='showWatchlistDivName']:checked"). val();
   if (showWatchlist=='existingWatchlist') {
    $("#existingWatchlistDIV").css("display","block");
    $("#newWatchlistDIV").css("display","none");
    $("#existingValue").attr("required", true);
    $("#newValue").attr("required", false);
   }
   else if (showWatchlist=='newWatchlist')
   {
   $("#existingWatchlistDIV").css("display","none"); 
   $("#newWatchlistDIV").css("display","block"); 
    $("#existingValue").attr("required", false);
    $("#newValue").attr("required", true);
   }
   else
   {
    $("#existingWatchlistDIV").css("display","none"); 
    $("#newWatchlistDIV").css("display","none"); 
    $("#existingValue").attr("required", false);
    $("#newValue").attr("required", false);
   }
}
  function atleast_onecheckbox1() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Atleast One Item");
  return false;
  }
  else
  {	
  document.getElementById('button').click();
  }
  }
  
  function showAjaxModal(uid)
         {
    $.get('viewcertificate.php?certi_id=' + uid, function(html){
                  $('#myModal .modal-body').html(html);
                  $('#myModal').modal('show', {backdrop: 'static'});
              });
   }
   
   function showconfirmmodal()
          {
			if ($("input[name='check[]']:checked").length === 0) { 
			bootbox.alert("Please Select atleast One Diamond");
			return false;
			}
			else
			{
			var did = [];
			$. each($("input[name='check[]']:checked"), function(){
			did. push($(this). val());
			});
           $.get('viewwishlistconfirmmodal.php?did=' + did, function(html){
                   $('#confirmModal .modal-body').html(html);
                   $('#confirmModal').modal('show', {backdrop: 'static'});
               });
			}
          }
		  
		  $(document).ready(function() {
	$.ajax({
    url:"../search/sendaction_wishlist.php?action=reset",  
    success:function(data) {
		
	}
	});
$('[data-toggle="tooltip"]').tooltip();  
     container : 'body' 	
});
		  
</script>
<script type="text/javascript">
  /*setTimeout(function(){
    location = ''
  },60000)//1 min*/
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
  include '../common/footer.php';
  ?>