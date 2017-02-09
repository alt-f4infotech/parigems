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
        <li><a href="../search/search.php">Search</a></li>
        <li class="active">User's Watchlist / Cart</li>
      </ol>
      
      <div class="clearfix"></div>
      <form action="userInformation.php" method="post">
             <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <select id="partyid2" name="userid" class="dropdownselect2" >
                              <option value=""> Select Customer</option>
                              <?php 
                                $query = "SELECT distinct w.userid,b.companyname FROM basic_details b,wishlist w where b.userid=w.userid and b.userstatus=1 and b.usertype='USER' and w.wishstatus='1'";
                                $execute = mysqli_query($con,$query);
                                while ($row = mysqli_fetch_array($execute))
                                {
                                    if($_POST['userid']==$row['userid'])
                                    {
                                    echo "<option value='".$row['userid']."' selected>".$row['companyname']."</option>";
                                    }else{
                                     echo "<option value='".$row['userid']."'>".$row['companyname']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group"><br>
                          <label><input type="radio" name="option" value="watchlist" required> Watchlist</label>
                          <label><input type="radio" name="option" value="cart" required> Cart</label>
                          <label><input type="radio" name="option" value="both" required> Both</label>
                        </div>
                    </div>
                <div class="col-sm-3">
                   <div class="form-group"><br>
                      <button type="submit" class="btn btn-success">Submit</button> <button type="button" class="btn btn-danger" onclick="window.location.href='userInformation.php'">Reset</button>
                    </div>
                </div>
             </div>
            </form>
      <?php if($_POST['option']=='watchlist' || $_POST['option']=='both')
      {?>
      <h3 align="center">User's Watchlist</h3>
	  <div class="table-responsive">
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
             <!-- <th data-sortable="true">Sr.No.</th>-->
              <th data-sortable="true">View</th>
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
                 <th data-sortable="true">Old Dis</th>
                 <th data-sortable="true">Dis</th>
				 <th data-sortable="true">PG Stock Id</th>
                <th data-sortable="true">Measurement</th>
                 <th data-sortable="true">Table</th>
                 <th data-sortable="true">Depth</th> 
              <th data-sortable="true">Amount $</th>
          <th data-sortable="true">Date Added</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
            $certificteqry1="select i.*,d.*,dp.rap,dp.discount1,dp.discount2,dp.discount3,dp.final from wishlist i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id and i.diamondid=d.diamond_id and i.userid='".$_POST['userid']."' and i.wishstatus='1'";
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
                     $wishqry="select * from wishlist where diamondid=$did and userid=".$_POST['userid']." and wishstatus=1";
                     $wishresult=mysqli_query($con,$wishqry);
                     $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
                     $statusqryresult=mysqli_query($con,$statusqry);
                     $diamondstatusqry="select * from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
                     if(mysqli_num_rows($dstatusqryresult) > 0){
                        $class="warning";$checked='';
                     }
                     elseif( $row['diamond_status']=='1'){
                        $class="";
						$checked='';
                     }
                     else{
                        $class="";$checked='';
                     }
                     $chevkcart="select * from add_to_cart where diamondid=$did and userid=".$_POST['userid']."  and wishstatus='1'";
                     $cartresult=mysqli_query($con,$chevkcart);
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
						
						$getuserdiscount="select userdiscount,countrytype from basic_details where userid='".$_POST['userid']."' and userstatus='1'";
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
					  $lastfinalvalue=$lastfinalvalue+$total_value;
					  $firstDiscount=$raprow['final'];
						if($firstDiscount < 0)
						{
						 $Discount=$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
						if(mysqli_num_rows($statusqryresult) > 0){}else{
						if($raprow['rap']!='0'){
                     echo "<tr class='".$class."' style='cursor:pointer;font-size:10px;'>";
					 echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case" '.$checked.' /></td>';
               // echo "<td>".$i++."</td>";
                  echo "<td>";
				  if($certiimage!=''){
				  echo "<a href=".$certiimage." target='_blank' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;";
				  }if($row['videolink']!=''){
				  echo "<a href='".$row['videolink']."' target='_blank' title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a>";
				  }
				  echo "</td>";
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
				  echo "<td class='center'><font color='red'>".$olddiscount."</font></td>";
				  echo "<td class='center'>".$Discount."</td>";
				  echo "<td class='center'>".$row['referenceno']."</td>";
				  echo "<td class='center'>".$measurement."</td>";
                  echo "<td>".$row['table']."%</td>";
                  echo "<td>".$row['depth']."%</td>";
                echo "<td>".sprintf("%.2f",$total_value)."</td>";
                echo "<td>".date('d-m-Y g:i: A',strtotime($row['timestamp']))."</td>";
                ?>
		<input type="text" style="display: none;" name="amount[]"   value="<?php echo $total_value;?>"  />
            <input type="hidden" name="quantity" id="quantity" value="1"/>
          <?php
            echo "</tr>";
            $i++;}}
              }
            ?>
		<input type="text" style="display: none;" name="finalamount"  value="<?php echo sprintf("%.2f",$lastfinalvalue);?>"  />
            <tr>
             <td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
              <td><b>Total</b></td>
              <td><b><?php echo sprintf("%.2f",$lastfinalvalue);?></b></td>
            </tr>
        </tbody>
      </table>
	  </div>
      <?php }
      if($_POST['option']=='cart' || $_POST['option']=='both')
      {
      ?>
      <div class="table-responsive">
        <h3 align="center">User's Cart</h3>
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
             <!-- <th data-sortable="true">Sr.No.</th>-->
              <th data-sortable="true">View</th>
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
                 <th data-sortable="true">Old Dis</th>
                 <th data-sortable="true">Dis</th>
				 <th data-sortable="true">PG Stock Id</th>
                <th data-sortable="true">Measurement</th>
                 <th data-sortable="true">Table</th>
                 <th data-sortable="true">Depth</th> 
              <th data-sortable="true">Amount $</th>
              <!--<th data-sortable="true">Action</th>-->
            </tr>
          </thead>
          <tbody>
            <?php
              $i=1;
              $certificteqry1="select i.*,d.*,dp.rap,dp.final from add_to_cart i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id and  i.cartstatus='1' and i.diamondid=d.diamond_id and i.userid='".$_POST['userid']."' ";
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
                     $wishqry="select * from wishlist where diamondid=$did and userid=".$_POST['userid']." and wishstatus=1";
                     $wishresult=mysqli_query($con,$wishqry);
                     $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
                     $statusqryresult=mysqli_query($con,$statusqry);
                     $diamondstatusqry="select * from diamond_status where diamondid=$did and diamond_status='HOLD'";
                     $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
                     if(mysqli_num_rows($dstatusqryresult) > 0){
                        $class="warning";
                     }
                     elseif(mysqli_num_rows($statusqryresult) > 0){
                        $class="danger";
                     }
                     else{
                        $class="";
                     }
                     $chevkcart="select * from add_to_cart where diamondid=$did and userid=".$_POST['userid']."  and wishstatus='1'";
                     $cartresult=mysqli_query($con,$chevkcart);
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
						
						$getuserdiscount="select userdiscount,countrytype from basic_details where userid='".$_POST['userid']."' and userstatus='1'";
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
					  $lastvalue=$lastvalue+$total_value;
					  $firstDiscount=$raprow['final'];
						if($firstDiscount < 0)
						{
						 $Discount=$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
			  $statusqry="select * from invoice_product where diamondid=$did and pstatus=1";
              $statusqryresult=mysqli_query($con,$statusqry);
              if(mysqli_num_rows($statusqryresult) > 0){}else{
			  if($raprow['rap']!='0'){              
              echo "<tr class='$class'>";
              echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case"  /></td>';
               // echo "<td>".$i++."</td>";
                  echo "<td>";
				  if($certiimage!=''){
				  echo "<a href=".$certiimage." target='_blank' title='View Certificate'><i class='fa fa-certificate' aria-hidden='true'></i></a>&nbsp;";
				  }if($row['videolink']!=''){
				  echo "<a href='".$row['videolink']."' target='_blank' title='View Video'><i class='fa fa-video-camera' aria-hidden='true'></i></a>";
				  }
				  echo "</td>";
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
				  echo "<td class='center'><font color='red'>".$olddiscount."</font></td>";
				  echo "<td class='center'>".$Discount."</td>";
				  echo "<td class='center'>".$row['referenceno']."</td>";
				  echo "<td class='center'>".$measurement."</td>";
                  echo "<td>".$row['table']."%</td>";
                  echo "<td>".$row['depth']."%</td>";
                echo "<td>".sprintf("%.2f",$total_value)."</td>";
                ?>
            <input type="text" style="display: none;" name="amount[]"   value="<?php echo $total_value;?>"  />
            <input type="hidden" name="quantity" id="quantity" value="1"/>
            <!--<td><a class="btn btn-danger"  onclick="sendaction('removecart','<?php //echo $did;?>','<?php //echo $currentraprate;?>')" ><i class="fa fa-trash"></i></a></td>-->
            <?php
              echo "</tr>";
              $i++;}
             }
			  }
            $j=$i-1;
              if($i > 1){
            ?>
			<input type="text" style="display: none;" name="finalamount"   value="<?php echo sprintf("%.2f",$lastvalue);?>"  />
            <tr>
              <td></td><td></td><td></td><td></td><td></td><td><?php echo sprintf("%.2f",$finalcarat);?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
              <td><b>Total</b></td>
              <td><b><?php echo sprintf("%.2f",$lastvalue);?></b></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <?php } ?>
    </div>
  </section>
</body>
</html>
<script type="text/javascript" src="../js/search.js"></script>
<script>
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
  
   $(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

  function showAjaxModal(uid)
         {
    $.get('viewcertificate.php?certi_id=' + uid, function(html){
                  $('#myModal .modal-body').html(html);
                  $('#myModal').modal('show', {backdrop: 'static'});
              });
   }
   
   function showconfirmmodal()
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