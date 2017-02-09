<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  ?>
  
<body>
  <section class="main-section">
    <div class="container-fluid">
         <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Stock Report</li>
   </ol>
         <form action="stock.php" method="post">
              <div class="row">
         <div class="form-group col-lg-2 col-md-6">
            <label>From</label>
            <input type="text" name="fromDate" class="form-control datepicker">
         </div>
         <div class="form-group col-lg-2 col-md-6">
            <label>To</label>
            <input type="text" name="toDate"  class="form-control datepicker">
         </div>
		  <div class="form-group col-lg-2 col-md-6">
            <label>Diamond Shape</label>
            <select name="shape" id="dropdown" class="dropdownselect2">
			   <option value=""> Select Shape </option>
			<?php 
                        $query = "SELECT
                        distinct(diamond_shape)
                        FROM
                         diamond_master
                        where
                       status=1";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
						  if($_POST['shape']==$row['diamond_shape']){
                        echo "<option value='".$row['diamond_shape']."' selected>".$row['diamond_shape']."</option>";
						  }else{
                        echo "<option value='".$row['diamond_shape']."'>".$row['diamond_shape']."</option>";
						  }
                        }
                        ?>
			</select>
         </div>
		  <div class="form-group col-lg-2 col-md-6">
            <label>Diamond Color</label>
            <select name="color" id="color1" class="dropdownselect2" >
				<option value="">Select Diamond Color</option>
				<?php
				$color="select distinct(color) from diamond_master where status=1";
				$clr=mysqli_query($con,$color);
				while($cr=mysqli_fetch_assoc($clr)){
				echo '<option value="'.$cr['color'].'">'.$cr['color'].'</option>';
				} ?>
			</select>
         </div>
		  <div class="form-group col-lg-2 col-md-6">
            <label>Certificate Number</label>
            <input type="text" name="certino" id="ceritno" class="form-control">
          </div>
          <div class="form-group col-lg-3 col-md-6">
            <button class="btn btn-success" name="go" type="submit">Go</button>
            <a class="btn btn-success"  onClick="window.location.href='stock.php';">RESET ALL</a>
      </div>
	   </div>
			 <?php
							   $startdate='2010-01-01';
                               if ($_POST['fromDate']!="" && $_POST['toDate']=="") {
							   $date2 =  explode('/',$_POST['fromDate']);
								$fromDate=$date2[2].'-'.$date2[1].'-'.$date2[0];
                               $from="and d.entrydate between '$fromDate' and  '$today'";
                                }
                                else{
                               $from= "";		
                                }
                               if ($_POST['toDate']!="" && $_POST['fromDate']=="") {
								$date3 =  explode('/',$_POST['toDate']);
								$toDate=$date3[2].'-'.$date3[1].'-'.$date3[0];
                                 $to="and d.entrydate between '$startdate' and  '$toDate'";
                                }
                                else{
                                 $to = "";
                                 }
                                 if ($_POST['toDate']!="" && $_POST['fromDate']!="") {
								$date2 =  explode('/',$_POST['fromDate']);
								$fromDate=$date2[2].'-'.$date2[1].'-'.$date2[0];
								$date3 =  explode('/',$_POST['toDate']);
								$toDate=$date3[2].'-'.$date3[1].'-'.$date3[0];
                                $both="and d.entrydate between '$fromDate' and  '$toDate'";
                                }
                                else{
                                 $both = "";
                                 }
                                 if ($_POST['shape']!="") {
                                $shape= $_POST['shape'];
                                     $shapeqry="and d.diamond_shape='$shape'";
                                }
                                else{
                                 $shapeqry = "";
                                 }
								 
								 if ($_POST['color']!="") {
                                $color= $_POST['color'];
                                     $colorqry="and d.color='$color'";
                                }
                                else{
                                 $colorqry = "";
                                 }
								 
                                  if ($_POST['certino']!="") {
                                      $certino= $_POST['certino'];
                                     $certiqry="and c.certi_no='$certino'";
                                }
                                else{
                                 $certiqry = "";
                                 }
								 
						  if (isset($_POST['wvat'])) {
							 if($_POST['wvat']!=''){
							$wvat=" and p.ptype='wvat'";
							$empty='1';
							 }
						  }
						  else
						  {$wvat="";}
						  
						  if (isset($_POST['vat'])) {
							 if($_POST['vat']!=''){
							$vat=" and p.ptype='vat'";
							$empty='1';
							 }
						  }
						  else
						  {$vat="";}
						  
						  if (isset($_POST['hform'])) {
							 if($_POST['hform']!=''){
							$hform=" and p.ptype='hform'";
							$empty='1';
							 }
						  }
						  else
						  {$hform="";}
						  
						  if (isset($_POST['regular'])) {
							 if($_POST['regular']!=''){
							$regular=" and p.ptype='regular'";
							$empty='1';
							 }
						  }
						  else
						  {$regular="";}
						  
						  if (isset($_POST['none'])) {
							 if($_POST['none']!=''){
							$none="none";
							 }
						  }
						  else
						  {$none="";}
						  
						  if (isset($_POST['saleinvoice'])) {
							 if($_POST['saleinvoice']!=''){
							$saleinvoiceqry="saleinvoice";
							 }
						  }
						  else
						  {$saleinvoiceqry="";}
						  
						   if($wvat!='' || $vat!='' || $regular!='' || $hform!=''){
			$certificteqry1="select distinct p.invoiceno,d.*,l.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $colorqry $wvat $vat $hform $regular and p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and d.diamond_status='1'  order by d.entrydate ASC";
						   }
						   else if($none!=''){
						  $certificteqry1="select d.*,l.* from diamond_master d,login l where 1 $from $to $both $shapeqry $colorqry and d.diamond_status='1'  and d.added_by=l.userid and d.diamond_id NOT IN (select pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid)";						  
						   }
						   else if($saleinvoiceqry!=''){
						  $certificteqry1="select d.*,l.* from diamond_master d,login l,invoice_product i where 1 $from $to $both $shapeqry $colorqry and d.diamond_status='1'  and d.added_by=l.userid and d.diamond_id=i.diamondid and i.pstatus='2'";
						   }
						   else{
			$certificteqry1="select d.*,l.username from  diamond_master d,login l,certificate_master c where 1 $from $to $both $shapeqry $colorqry $certiqry and d.diamond_status='1' and  d.added_by=l.userid and c.certificateid=d.certificate_id order by d.entrydate ASC";
						   }
			$certificteqry2="select d.*,l.username from  diamond_master d,login l where 1 $from $to $both $shapeqry $colorqry and d.diamond_status='1'  and  d.added_by=l.userid order by d.entrydate ASC";
						  //echo $certificteqry1;
			$certiresult1=mysqli_query($con,$certificteqry1);
			$certiresult12=mysqli_query($con,$certificteqry2);
			$totalnonediamond=mysqli_num_rows($certiresult12);
		$getcount1="select distinct p.invoiceno,d.*,l.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='wvat' and d.diamond_status='1'";
		$result1=mysqli_query($con,$getcount1);
		$getcount2="select distinct p.invoiceno,d.*,l.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='vat' and d.diamond_status='1'";
		$result2=mysqli_query($con,$getcount2);
		$getcount3="select distinct p.invoiceno,d.*,l.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='hform' and d.diamond_status='1'";
		$result3=mysqli_query($con,$getcount3);
		$getcount4="select distinct p.invoiceno,d.*,l.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='regular' and d.diamond_status='1'";
		$result4=mysqli_query($con,$getcount4);
		
		$getcount5="select d.*,l.* from diamond_master d,login l where 1  and d.added_by=l.userid and d.diamond_status='1' and d.diamond_id NOT IN (select pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid)";
		$result6=mysqli_query($con,$getcount5);
		
		$totalsaleinvoice="select * from invoice_product where pstatus='2'";
		$result5=mysqli_query($con,$totalsaleinvoice);
		?>
		<span class="">
         <p class="btn btn-default">
            <label for="wvat"><input type="checkbox" onclick="this.form.submit();" name="wvat" value="wvat" id="wvat" style="display: none;" ><span  style="background-color: #dff0d8;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Without VAT (<b><?php echo mysqli_num_rows($result1);?></b>)</label>
            <label for="vat"><input type="checkbox" onclick="this.form.submit();" name="vat" value="vat" id="vat" style="display: none;"><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;VAT (<b><?php echo mysqli_num_rows($result2);?></b>)</label>
            <label for="hform"><input type="checkbox"  onclick="this.form.submit();" name="hform" value="hform" id="hform" style="display: none;"><span style="background-color: #d9edf7;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;H-Form (<b><?php echo mysqli_num_rows($result3);?></b>)</label>
            <label for="regular"><input type="checkbox" onclick="this.form.submit();" name="regular" value="regular" id="regular" style="display: none;"><span  style="background-color: #faf2cc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Regular (<b><?php echo mysqli_num_rows($result4);?></b>)</label>
			<label for="none"><input type="checkbox" onclick="this.form.submit();" name="none" value="none" id="none" style="display: none;"><span  style="background-color: #ffffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;None (<b><?php echo mysqli_num_rows($result6);?></b>)</label>
			<label><span  style="background-color: #ec4d49;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Not Sold(+90 Days)</label>
         </p>
      </span>
</form>
        <h3 align="center">Stock Report</h3>
			<div  style="overflow-y: scroll;height: 400px;">
		  <div class="table-responsive">
	     <table id="table"
				   data-height="400"
				   data-toggle="table"
				   data-search="true"
				   data-url="../json/data1.json">
      <thead>
						  <tr>
						   <th><!--<input type="checkbox" >--></th>
                           <th data-sortable="true">Sr.No.</th>
                           <th data-sortable="true">PG Stock Id</th>
							<th data-sortable="true">Cert.No.</th>
							<th data-sortable="true">Shape</th>
							<th data-sortable="true">Size</th>
							<th data-sortable="true">Color</th>
							<th data-sortable="true">Clarity</th>
							<th data-sortable="true">Cut</th>
							<th data-sortable="true">Polish</th>
							 <th data-sortable="true">Symm</th>
							 <th data-sortable="true">Flr</th>
							 <th data-sortable="true">Rap $</th>
							 <th data-sortable="true">Dis.</th>
							 <th data-sortable="true">P/C $</th>
							 <th data-sortable="true">Less</th>
							 <th data-sortable="true">Exp.</th>
							 <th data-sortable="true">Final</th>
							 <th data-sortable="true">USD $</th>
							 <th data-sortable="true">Conv</th>
							 <th data-sortable="true">INR</th>
							 <th data-sortable="true">Stock Id</th>
							 <th data-sortable="true">Comment</th>
							 <th data-sortable="true">Measurement</th>
							 <th data-sortable="true">Table</th>
							 <th data-sortable="true">Depth</th>
							 <th data-sortable="true">KeyToSymbols</th>
                             <th data-sortable="true">Date</th>
						   <?php if($role=='SUPERADMIN'){ ?>
							  <th data-sortable="true">Added By</th>
							<?php } ?>
							<th data-sortable="true">Location</th>
                           <th data-sortable="true">Status</th>
                           <th data-sortable="true">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i=1;
                          
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
							$final=$final+$row['price'];
                            $finalqty=$finalqty+$row['qty'];
							
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
							
						   if($diamond_status=='0')
							{
								$note='Out Of Stock';
							}
							else{$note='';//$class="";
							}
							
							$saleinvoice="select * from invoice_product where diamondid='$did' and pstatus='2'";
							$invoiceresult=mysqli_query($con,$saleinvoice);
							
							$getid1="select p.*,pt.companyname,pt.referenceno from purchaseinvoice_product pp,purchaseinvoice p,party pt where 1 $wvat $vat $hform $regular and p.purchase_invoiceid=pp.purchase_invoiceid and pt.partyid=p.partyid and  pp.diamond=$did";
	                    $result1=mysqli_query($con,$getid1);
	                    $vatrow=mysqli_fetch_assoc($result1);						
						
						$today=date("Y-m-d");
						$date1=date_create($row['entrydate']);
						$date2=date_create($today);
						$diff=date_diff($date1,$date2);
						$dateDiffeterence=$diff->format("%a");
						
						 if(mysqli_num_rows($invoiceresult) > 0)
						 {
						  $class="bg-primary-row";
						 }
						else if($dateDiffeterence >='90')
							{
							  $class="danger-row";
							}
						 else if(mysqli_num_rows($result1) > 0){
						    if($vatrow['ptype']=='wvat'){
								$class="success";
							}
							if($vatrow['ptype']=='vat'){
								$class="danger";
							}
							if($vatrow['ptype']=='hform'){
								$class="info";
							}
							if($vatrow['ptype']=='regular'){
								$class="warning";
							}
						}else{ $class='';$empty='0';}
						
						
						
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
						
						$firstDiscount=$raprow['discount1'];
						if($firstDiscount < 0)
						{
						 $Discount=$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
						$finalValue=$raprow['final'];
						if($finalValue < 0)
						{
						$final=$finalValue;
						}
						else{
						 $final='-'.$finalValue; 
						}
						    echo "<tr  class='$class'>";
							echo '<td>
							<!--<input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case"  />-->'?>
							<!--<a  data-toggle="collapse" href="#collapseExample<?php //echo $did; ?>" aria-expanded="false" aria-controls="collapseExample"  onclick="$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')" title="purchase & sell details"><i class="fa fa-plus-circle fa-lg"></i></a>-->
							<a href="javascript:;" data-id='<?php echo $did;?>' onclick="showRateModal('<?php echo $did;?>')"><i class="fa fa-plus-circle fa-lg"></i></a>
							<?php
							echo '</td>';
                           	echo "<td>".$i++."</td>";
							echo "<td>".$row['referenceno']."</td>";
							//echo "<td class='center'>".$vatrow['companyname'];if($vatrow['companyname']!=''){ echo '('.$vatrow['referenceno'].')';}"</td>";
                           	echo '<td><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
							echo "<td>".$row['diamond_shape']."</td>";
							echo "<td>".$row['weight']."</td>";
							echo "<td>".$row['color']."</td>";
							echo "<td>".$row['clarity']."</td>";
							echo "<td class='center'>".$cutrow['semicut']."</td>";
							echo "<td class='center'>".$polishrow['semipolish']."</td>";
							echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
							echo "<td>".$row['fluoresence']."</td>";
							echo "<td class='center'>".$raprow['rap']."</td>";
							echo "<td class='center'>".$Discount."</td>";
							echo "<td class='center'>".($raprow['pc'])."</td>";
							echo "<td class='center'>".($raprow['discount2']+$raprow['discount3']+$raprow['discount4']+$raprow['discount5'])."</td>";
							echo "<td class='center'>".($raprow['discount6']+$raprow['discount7']+$raprow['discount8']+$raprow['discount9'])."</td>";
							echo "<td class='center'>".$final."</td>";
							echo "<td class='center'>".$raprow['usd']."</td>";
							echo "<td class='center'>".($raprow['conv']+$raprow['extraconv'])."</td>";
							echo "<td class='center'>".$raprow['inr']."</td>";
							echo "<td class='center'>".$row['purchase_stockid']."</td>";
							echo "<td class='center'>".$row['comments']."</td>";
							echo "<td class='center'>".$measurement."</td>";
							echo "<td>".$row['table']."</td>";
							echo "<td>".$row['depth']."</td>";
							echo "<td>".$kysymbol."</td>";
							echo "<td>".date('d-m-Y g:i: A',strtotime($row['entrydate']))."</td>";
							if($role=='SUPERADMIN'){
							  $getempname=mysqli_query($con,"select username from basic_details where userid=".$row['added_by']);
							  $empname=mysqli_fetch_assoc($getempname);
							echo "<td id='superadmin'>".$empname['username']."</td>";
							}							
							echo "<td class='center'>".$row['location']."</td>";	
                            ?>
                           <td>
                                <?php if($diamond_status!='0')
							         {
                                       if($row['diamond_user_status']!='HOLD'){ }else{ echo "HOLDED"; }
									 }else{ echo "SOLD"; } ?>
                            </td>
                           <?php
						   $encrypted_txt = encrypt_decrypt('encrypt', $did);
							echo "<td class='center'><a href='../diamond_upload/view_diamond.php?id=$encrypted_txt' class='btn btn-info'>View</a></td>";
                           echo "</tr>";
                           ?>
                        <!--<tr  class="accordian-body collapse" id="collapseExample<?php echo $did; ?>">
						<td colspan="15" class="hiddenRow">
						 <table class="table table-bordered" >
							<tbody>
							  <tr style="background-color:#D3D3D3">
								<td></td><td></td>
								<td><b>Purchase Details</b></td>
								<td></td><td></td>
							  </tr>
							  <tr>
							  <td><b>Per Carat/ Raprate:</b><?php echo $raprow['rap'];?></td>
							  <td><b>Discount:</b> <?php echo $raprow['discount1'];?></td>
							  <td><b>P/C</b> : <?php echo $raprow['pc'];?></td>
							  <td><b>LESS</b> : <?php echo $raprow['discount2'];?></td>
							  <td><b>P A D</b> : <?php echo $raprow['pad'];?></td>
							  </tr>
							  <tr>
							  <td><b>EXTRA1</b> : <?php echo $raprow['discount3'];?></td>
							  <td><b>EXTRA Amount1</b> : <?php echo $raprow['extraamount1'];?></td>
							  <td><b>EXTRA2</b> : <?php echo $raprow['discount4'];?></td>
							  <td><b>Extra Amount2</b> : <?php echo $raprow['extraamount2'];?></td>
							  <td><b>EXTRA3</b> : <?php echo $raprow['discount5'];?></td>
							  </tr>
							  <tr>
							  <td><b>Extra Amount3</b> : <?php echo $raprow['extraamount3'];?></td>
							  <td><b>Expense1</b> : <?php echo $raprow['discount6'];?></td>
							  <td><b>Expense Amount1</b> : <?php echo $raprow['expense1'];?></td>
							  <td><b>Expense2</b> : <?php echo $raprow['discount7'];?></td>
							  <td><b>Expense Amount2</b> : <?php echo $raprow['expense2'];?></td>
							  </tr>
							  <tr>
							  <td><b>Expense3</b> : <?php echo $raprow['discount8'];?></td>
							  <td><b>Expense Amount3</b> : <?php echo $raprow['expense3'];?></td>
							  <td><b>Expense4</b> : <?php echo $raprow['discount9'];?></td>
							  <td><b>Expense Amount4</b> : <?php echo $raprow['expense4'];?></td>
							  <td><b>FINAL</b> : <?php echo $raprow['final'];?></td>
							  </tr>
							  <tr>
							  <td><b>USD</b> : <?php echo $raprow['usd'];?></td>
							  <td><b>Conv</b> : <?php echo $raprow['conv'];?></td>
							  <td><b>Extra Conv</b> : <?php echo $raprow['extraconv'];?></td>
							  <td><b>Total Conv</b> : <?php echo $raprow['conv']+$raprow['extraconv'];?></td>
							  <td><b>INR</b> : <?php echo $raprow['inr'];?></td>
							  </tr>
							</tbody>
						  </table>
						</td>
						<td colspan="14" class="hiddenRow">
						 <table class="table table-bordered" >
							<tbody>
							  <tr style="background-color:#D3D3D3">
								<td></td><td></td>
								<td><b>Selling Details</b></td>
								<td></td><td></td>
							  </tr>
							  <tr>
							  <td><b>Per Carat/ Raprate:</b><?php echo $srrow['rap'];?></td>
							  <td><b>Discount:</b> <?php echo $srrow['discount1'];?></td>
							  <td><b>P/C</b> : <?php echo $srrow['pc'];?></td>
							  <td><b>LESS</b> : <?php echo $srrow['discount2'];?></td>
							  <td><b>P A D</b> : <?php echo $srrow['pad'];?></td>
							  </tr>
							  <tr>
							  <td><b>EXTRA1</b> : <?php echo $srrow['discount3'];?></td>
							  <td><b>EXTRA Amount1</b> : <?php echo $srrow['extraamount1'];?></td>
							  <td><b>EXTRA2</b> : <?php echo $srrow['discount4'];?></td>
							  <td><b>Extra Amount2</b> : <?php echo $srrow['extraamount2'];?></td>
							  <td><b>EXTRA3</b> : <?php echo $srrow['discount5'];?></td>
							  </tr>
							  <tr>
							  <td><b>Extra Amount3</b> : <?php echo $srrow['extraamount3'];?></td>
							  <td><b>Expense1</b> : <?php echo $srrow['discount6'];?></td>
							  <td><b>Expense Amount1</b> : <?php echo $srrow['expense1'];?></td>
							  <td><b>Expense2</b> : <?php echo $srrow['discount7'];?></td>
							  <td><b>Expense Amount2</b> : <?php echo $srrow['expense2'];?></td>
							  </tr>
							  <tr>
							  <td><b>Expense3</b> : <?php echo $srrow['discount8'];?></td>
							  <td><b>Expense Amount3</b> : <?php echo $srrow['expense3'];?></td>
							  <td><b>Expense4</b> : <?php echo $srrow['discount9'];?></td>
							  <td><b>Expense Amount4</b> : <?php echo $srrow['expense4'];?></td>
							  <td><b>FINAL</b> : <?php echo $srrow['final'];?></td>
							  </tr>
							  <tr>
							  <td><b>USD</b> : <?php echo $srrow['usd'];?></td>
							  <td><b>Conv</b> : <?php echo $srrow['conv'];?></td>
							  <td><b>Extra Conv</b> : <?php echo $srrow['extraconv'];?></td>
							  <td><b>Total Conv</b> : <?php echo $srrow['conv']+$srrow['extraconv'];?></td>
							  <td><b>INR</b> : <?php echo $srrow['inr'];?></td>
							  </tr>
							</tbody>
						  </table>
						</td>
					   </tr>-->
					   <?php } ?>
                     </tbody>
                  </table>
		  </div>
			</div>
</div>
 </section>
</body>
</html>
<script>
		function showAjaxModal(uid)
         {
    $.get('../search/viewcertificate.php?certi_id=' + uid, function(html){
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
<?php
include "../common/footer.php";
?>