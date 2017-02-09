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
      <li class="active">View All Diamonds</li>
   </ol>
         <form action="viewalldiamonds.php" method="post">
             <div class="row">
         <!--<div class="form-group col-lg-2 col-md-6">
            <label>From</label>
            
         </div>
         <div class="form-group col-lg-2 col-md-6">
            <label>To</label>
            
         </div>-->
		  <div class="form-group col-lg-2 col-md-6">
			<input type="hidden" name="fromDate" value="<?php echo $_POST['fromDate'];?>" class="form-control datepicker none">
			<input type="hidden" name="toDate" value="<?php echo $_POST['toDate'];?>"  class="form-control datepicker none">
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
				  if($_POST['color']==$cr['color']){
                        echo "<option value='".$cr['color']."' selected>".$cr['color']."</option>";
						  }else{
				        echo '<option value="'.$cr['color'].'">'.$cr['color'].'</option>';
						  }
				} ?>
			</select>
         </div>
		  <div class="form-group col-lg-2 col-md-6">
            <label>Certificate Number</label>
            <input type="text" name="certino" id="ceritno" value="<?php echo $_POST['certino'];?>" class="form-control">
          </div>
		  <div class="form-group col-lg-2 col-md-6">
            <label>Carat/Size</label>
            <input type="text" name="weight" id="weight" value="<?php echo $_POST['weight'];?>" class="form-control">
          </div>
          <div class="form-group col-lg-3 col-md-6"><br>
            <button class="btn btn-success" name="go" type="submit">Go</button>
            <a class="btn btn-success"  onClick="window.location.href='viewalldiamonds.php';">RESET ALL</a>
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
								 
								 if ($_POST['weight']!="") {
                                $weight= $_POST['weight'];
                                     $weightqry="and d.weight='$weight'";
                                }
                                else{
                                 $weightqry = "";
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
						  
						  if (isset($_POST['salepending'])) {
							 if($_POST['salepending']!=''){
							$salepending="salepending";
							 }
						  }
						  else
						  {$salepending="";}
						  
						  if (isset($_POST['saleinvoice'])) {
							 if($_POST['saleinvoice']!=''){
							$saleinvoiceqry="saleinvoice";
							 }
						  }
						  else
						  {$saleinvoiceqry="";}
						  
						  if (isset($_POST['nonsaleinvoice'])) {
							 if($_POST['nonsaleinvoice']!=''){
							$nonsaleinvoiceQry="nonsaleinvoice";
							 }
						  }
						  else
						  {$nonsaleinvoiceQry="";}
						  
						   if($wvat!='' || $vat!='' || $regular!='' || $hform!=''){
			$certificteqry1="select distinct p.invoiceno,d.*,l.*  from diamond_master d,certificate_master c,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry $wvat $vat $hform $regular  and p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and c.certificateid=d.certificate_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.purchasestatus='1' order by d.entrydate ASC";
						   }
						   else if($none!=''){
						  $certificteqry1="select d.*,l.* from diamond_master d,certificate_master c,login l where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and d.added_by=l.userid  and c.certificateid=d.certificate_id and d.diamond_id NOT IN (select distinct pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1')";						  
						   }
						   else if($salepending!=''){
						  $certificteqry1="select d.*,l.* from diamond_master d,certificate_master c,login l where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and d.added_by=l.userid and c.certificateid=d.certificate_id and d.diamond_id IN (select distinct ds.diamond_id from diamond_sale ds where ds.rap='0')";						  
						   }
						   else if($saleinvoiceqry!=''){
						  $certificteqry1="select distinct i.diamondid ,d.*,l.* from diamond_master d,certificate_master c,login l,invoice_product i where 1 $from $to $both $shapeqry $colorqry  $weightqry $certiqry and d.added_by=l.userid and d.diamond_id=i.diamondid and c.certificateid=d.certificate_id and i.pstatus='2' and (i.deliverystatus is NULL OR i.deliverystatus='1')  and i.diamondid NOT IN (select distinct diamondid from diamond_status where diamond_status='HOLD')";
						   }
						   else if($nonsaleinvoiceQry!=''){
						  //$certificteqry1="select d.*,l.* from diamond_master d,login l where 1 $from $to $both $shapeqry $colorqry $weightqry and d.added_by=l.userid and d.diamond_id NOT IN (select distinct diamondid from invoice_product where pstatus='2')";
						  $certificteqry1="select d.*,l.* from diamond_master d,certificate_master c,login l where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and d.added_by=l.userid and d.diamond_status='1' and c.certificateid=d.certificate_id";
						   }
						   else{
			$certificteqry1="select d.*,l.username from  diamond_master d,login l,certificate_master c where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and  d.added_by=l.userid and c.certificateid=d.certificate_id order by d.entrydate ASC";
						   }
			$certificteqry2="select d.*,l.username from  diamond_master d,certificate_master c,login l where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and  d.added_by=l.userid and c.certificateid=d.certificate_id order by d.entrydate ASC";
						  //echo $certificteqry1;
			$certiresult1=mysqli_query($con,$certificteqry1);
			$certiresult12=mysqli_query($con,$certificteqry2);
			$totalnonediamond=mysqli_num_rows($certiresult12);
		$getcount1="select distinct p.invoiceno,d.*,l.* from diamond_master d,certificate_master c,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='wvat' and p.purchasestatus='1' and c.certificateid=d.certificate_id";
		$result1=mysqli_query($con,$getcount1);
		$getcount2="select distinct p.invoiceno,d.*,l.*  from diamond_master d,certificate_master c,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='vat' and p.purchasestatus='1' and c.certificateid=d.certificate_id";
		$result2=mysqli_query($con,$getcount2);
		$getcount3="select distinct p.invoiceno,d.*,l.* from diamond_master d,certificate_master c,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='hform' and p.purchasestatus='1' and c.certificateid=d.certificate_id";
		$result3=mysqli_query($con,$getcount3);
		$getcount4="select distinct p.invoiceno,d.*,l.* from diamond_master d,certificate_master c,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and  p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='regular' and p.purchasestatus='1' and c.certificateid=d.certificate_id";
		$result4=mysqli_query($con,$getcount4);
		
		$getcount5="select d.*,l.* from diamond_master d,certificate_master c,login l where  1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and d.added_by=l.userid and c.certificateid=d.certificate_id and d.diamond_id NOT IN (select distinct pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1')"; 
		$result6=mysqli_query($con,$getcount5);
		
		$getcount6="select d.*,l.* from diamond_master d,certificate_master c,login l where  1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and d.added_by=l.userid and c.certificateid=d.certificate_id and d.diamond_id IN (select distinct ds.diamond_id from diamond_sale ds where ds.rap='0')"; 
		$result7=mysqli_query($con,$getcount6);
		
		//$totalsaleinvoice="select * from invoice_product where pstatus='2' and (deliverystatus is NULL OR deliverystatus='1')";
		$totalsaleinvoice="select distinct diamondid from invoice_product ip,diamond_master d,certificate_master c where  1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and ip.diamondid=d.diamond_id and c.certificateid=d.certificate_id and ip.pstatus='2' and (ip.deliverystatus is NULL OR ip.deliverystatus='1') and ip.diamondid NOT IN (select distinct diamondid from diamond_status where diamond_status='HOLD')";
		$result5=mysqli_query($con,$totalsaleinvoice);
		
		//$getcount7="select d.*,l.* from diamond_master d,login l where 1  and d.added_by=l.userid and d.diamond_id NOT IN (select distinct diamondid from invoice_product where pstatus='2')";
		$getcount7="select d.*,l.* from diamond_master d,certificate_master c,login l where 1 $from $to $both $shapeqry $colorqry $weightqry $certiqry and  d.added_by=l.userid and d.diamond_status='1' and c.certificateid=d.certificate_id";
		//echo $totalsaleinvoice.'<br>';
		//echo $getcount7;
		$result8=mysqli_query($con,$getcount7);
		?>
		<span class="">
         <p class="btn btn-default view_all_diamond">
            <label for="wvat"><input type="checkbox" onclick="this.form.submit();" name="wvat" value="wvat" id="wvat" style="display: none;" ><span  style="background-color: #dff0d8;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Without VAT (<b><?php echo mysqli_num_rows($result1);?></b>)</label>
            <label for="vat"><input type="checkbox" onclick="this.form.submit();" name="vat" value="vat" id="vat" style="display: none;"><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;VAT (<b><?php echo mysqli_num_rows($result2);?></b>)</label>
            <label for="hform"><input type="checkbox"  onclick="this.form.submit();" name="hform" value="hform" id="hform" style="display: none;"><span style="background-color: #d9edf7;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;H-Form (<b><?php echo mysqli_num_rows($result3);?></b>)</label>
            <label for="regular"><input type="checkbox" onclick="this.form.submit();" name="regular" value="regular" id="regular" style="display: none;"><span  style="background-color: #faf2cc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Regular (<b><?php echo mysqli_num_rows($result4);?></b>)</label>
			<label for="none"><input type="checkbox" onclick="this.form.submit();" name="none" value="none" id="none" style="display: none;"><span  style="background-color: #ffffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;None (<b><?php echo mysqli_num_rows($result6);?></b>)</label>
		 </p>
		</span>
		<span class="">
         <p class="btn btn-default">
			<label for="saleinvoice"><input type="checkbox" onclick="this.form.submit();" name="saleinvoice" value="saleinvoice" id="saleinvoice" style="display: none;"><span  style="background-color: #0275d8;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Sold (<b><?php echo mysqli_num_rows($result5);?></b>)</label>
			<label for="nonsaleinvoice"><input type="checkbox" onclick="this.form.submit();" name="nonsaleinvoice" value="nonsaleinvoice" id="nonsaleinvoice" style="display: none;"><span  style="background-color: #ffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Unsold (<b><?php echo mysqli_num_rows($result8);?></b>)</label>
         </p>
      </span>
		<span><p class="btn btn-default">
		<label for="salepending"><input type="checkbox" onclick="this.form.submit();" name="salepending" value="salepending" id="salepending" style="display: none;"><span  style="background-color: #ffffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Pending Sale Details (<b><?php echo mysqli_num_rows($result7);?></b>)</label>
		</p></span>
</form>
       <!-- <h3 align="center">View All Diamonds</h3>-->
		
		<form id="movieForm" action="../diamond_upload/editdiamond.php" method="post">
		  
	   <center>
		<!--<button type="submit" class="btn btn-success"  onclick="return atleast_onecheckbox1()" name="hold">Hold</button>-->
		<button type="submit" class="btn btn-danger" onclick="return atleast_onecheckbox1()" name="edit">Edit</button>
		</center><br>
			
		  <div class="table-responsive">
			<div id="toolbar">
	        <select class="form-control">
	            <option value="">Export Basic</option>
	            <option value="all">Export All</option>
	            <option value="selected">Export Selected</option>
	        </select>
	    </div>
		
		 <table class="table" id="table" data-height="400" data-show-columns="true" 
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
		data-toolbar="#toolbar" data-show-refresh="true" >
				  <thead style="font-size:10px;padding: 0px;">
					   <tr>
						   <th data-sortable="true" ><input type="checkbox" id="check_all" ></th>
                           <th data-sortable="true" >Sr.No.</th>
                           <th data-sortable="true" >PG Stock Id</th>
							<th  data-sortable="true">Cert.No.</th>
							<th data-sortable="true" >Shape</th>
							<th data-sortable="true" >Size</th>
							<th data-sortable="true" >Color</th>
							<th data-sortable="true" >Clarity</th>
							<th data-sortable="true" >Cut</th>
							<th data-sortable="true" >Polish</th>
							 <th data-sortable="true" >Symm</th>
							 <th data-sortable="true" >Flr</th>
							 <th data-sortable="true" >Rap $</th>
							 <th data-sortable="true" >P.Dis. %</th>
							 <th data-sortable="true" >P.P/C $</th>
							 <th data-sortable="true" >P.Less</th>
							 <th data-sortable="true" >P.Exp.</th>
							 <!--<th data-sortable="true" >User Dis. %</th>-->
							 <th data-sortable="true" >P.Final</th>
							 <th data-sortable="true" >P.USD $</th>
							 <th data-sortable="true" >P.Conv</th>
							 <th data-sortable="true" >P.INR</th>
							 <th data-sortable="true" >S.INR</th>
							 <th data-sortable="true" >S.Conv</th>
							 <th data-sortable="true" >S.USD $</th>
							 
							 <th data-sortable="true" >Current Rap $</th>
							 <th data-sortable="true" >S.Dis. %</th>
							 <th data-sortable="true" >SI.Dis. %</th>
							 <th data-sortable="true" >SI.Rap. $</th>
							 <!--<th data-sortable="true" >Stock Id</th>-->
							 <!--<th data-sortable="true" >Comment</th>-->
							 <th data-sortable="true" >Measurement</th>
							 <th data-sortable="true" >Table %</th>
							 <th data-sortable="true" >Depth %</th>
							<!-- <th data-sortable="true" >KeyToSymb</th>-->
                             <th data-sortable="true" >Date</th>
						   <?php if($role=='SUPERADMIN'){ ?>
							  <th data-sortable="true" >Added By</th>
							<?php } ?>
							<th data-sortable="true" >Location</th>
                            <th data-sortable="true" >Status</th>
						    <th data-sortable="true" >Purchased From</th>
						    <th data-sortable="true" >Sold To</th>
                            <!--<th data-sortable="true">Sold To(Dummy)</th>-->
                        </tr>
					   </thead>
				  <tbody  style="font-size:10px;padding: 0px;">
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
							
							$saleinvoice="select * from invoice_product where diamondid='$did' and pstatus='2'  and diamondid NOT IN (select distinct diamondid from diamond_status where diamond_status='HOLD')";
							$invoiceresult=mysqli_query($con,$saleinvoice);
							$soldRow=mysqli_fetch_assoc($invoiceresult);
							
							$getid1="select p.*,pt.companyname,pt.referenceno from purchaseinvoice_product pp,purchaseinvoice p,party pt where 1 $wvat $vat $hform $regular and p.purchase_invoiceid=pp.purchase_invoiceid and pt.partyid=p.partyid and  pp.diamond=$did";
	                    $result1=mysqli_query($con,$getid1);
	                    $vatrow=mysqli_fetch_assoc($result1);
						 if(mysqli_num_rows($invoiceresult) > 0)
							{
							  //$saleinvoicecss="style='background: #ff5555 !important;'";
							  $class="bg-primary";
							  $checked='disabled';
							}
						 else if(mysqli_num_rows($result1) > 0){
						    if($vatrow['ptype']=='wvat'){
								$class="success";
								$checked='';
							}
							if($vatrow['ptype']=='vat'){
								$class="danger";
								$checked='';
							}
							if($vatrow['ptype']=='hform'){
								$class="info";
								$checked='';
							}
							if($vatrow['ptype']=='regular'){
								$class="warning";
								$checked='';
							}
						}else{ $class='';$empty='0';$checked='';}
						
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

						$getuserdiscount="select userdiscount,countrytype from basic_details where userstatus='1'";
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
						 $explodeFirstDiscount=explode('-',$firstDiscount);
						 $Discount='+'.$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
						
						$salefirstDiscount=$srrow['discount1'];
						if($salefirstDiscount > 0)
						{
						  $SaleDiscount='+'.$salefirstDiscount;
						  $SaleUserDiscount='+'.('+'.$salefirstDiscount + $userdiscount);
						}
						else{
						  $explodeSaleDiscount=explode('-',$salefirstDiscount);
						 $SaleDiscount=$salefirstDiscount;
						 $SaleUserDiscount=($explodeSaleDiscount[1] + $userdiscount);						 
						}
						$finalValue=$raprow['final'];
						if($finalValue < 0)
						{
						$final=$finalValue;
						}
						else{
						 $final='-'.$finalValue; 
						}
						
						$getsaleinvoicedetails="SELECT b.username,i.invoiceno FROM saleinvoice i,basic_details b,saleinvoice_product sp where b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and sp.diamondid=".$did;
						//echo $getsaleinvoicedetails;
                        $saleToResult=mysqli_query($con,$getsaleinvoicedetails);
                        $customerRow=mysqli_fetch_assoc($saleToResult);
						if(mysqli_num_rows($saleToResult) > 0)
						{
                        $saleinvoiceno='['.$customerRow['invoiceno'].']';
                        $customerName=$customerRow['username'].' '.$saleinvoiceno;
						}
						else{
						  $customerName='';
						}
						
						$getsaleinvoicedetailsDummy="SELECT b.username,i.invoiceno FROM saleinvoice_dummy i,basic_details b,saleinvoice_product_dummy sp where b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and sp.diamondid=".$did;
                        $saleToResultDummy=mysqli_query($con,$getsaleinvoicedetailsDummy);
                        $customerRowDummy=mysqli_fetch_assoc($saleToResultDummy);
						if(mysqli_num_rows($saleToResultDummy) > 0)
						{
                        $saleinvoicenoDummy='['.$customerRowDummy['invoiceno'].']';
                        $customerNameDummy=$customerRowDummy['username'].' '.$saleinvoicenoDummy;
						}
						else{
						  $customerNameDummy='';
						}
						
						if($row['clarity']=='FL')
						{
						 $clarityRow='IF';
						}else{
						 $clarityRow=$row['clarity'];
						}						
						if(trim($row['diamond_shape'])=='ROUND')
						{
						 $shapeRow="BR";   
						}
						else
						{
						 $shapeRow="PS";   
						}
						
						if($row['color']!='')
						{
							$qryRow1="and color='".$row['color']."'";
						}
						else{$qryRow1="";}
						
						if($row['weight']!='')
						{
							$caretRow=sprintf("%.2f",$row['weight']);
							$qryRow2="and '$caretRow' between raprangestart and raprangeend";
						}
						else
						{$qryRow2="";}
						
						if($clarityRow!='')
						{
							$qryRow3="and clarity='$clarityRow'";
						}
						else{$qryRow3="";}
						
						if($shapeRow!='')
						{
							$qryRow4="and shape='$shapeRow'";
						}
						else{$qryRow4="";}
						$currentRapQry="select * from raptable where 1 $qryRow1 $qryRow2 $qryRow3 $qryRow4";						
						$currentRapRes=mysqli_query($con,$currentRapQry);
						while($rapRow=mysqli_fetch_assoc($currentRapRes))
						{
						 $currentRapRate=$rapRow['rate'];
						}
						    echo "<tr  class='$class'>";
							echo '<td><input type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case"   '.$checked.'/>'?><br>
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
							echo "<td  >".$row['color']."</td>";
							echo "<td>".$row['clarity']."</td>";
							echo "<td>".$cutrow['semicut']."</td>";
							echo "<td>".$polishrow['semipolish']."</td>";
							echo "<td>".$symhrow['semisymmetry']."</td>";
							echo "<td>".$row['fluoresence']."</td>";
							echo "<td>$".$raprow['rap']."</td>";
							echo "<td>".$Discount."</td>";
							//echo "<td>".$SaleUserDiscount."</td>";
							echo "<td>$".($raprow['pc'])."</td>";
							echo "<td>".($raprow['discount2']+$raprow['discount3']+$raprow['discount4']+$raprow['discount5'])."</td>";
							echo "<td>".($raprow['discount6']+$raprow['discount7']+$raprow['discount8']+$raprow['discount9'])."</td>";
							echo "<td>".$final."</td>";
							echo "<td>$".$raprow['usd']."</td>";
							echo "<td>".($raprow['conv']+$raprow['extraconv'])."</td>";
							echo "<td>".$raprow['inr']."</td>";
							echo "<td>".sprintf("%.2f",$srrow['inr'])."</td>";
							echo "<td>".($srrow['conv']+$srrow['extraconv'])."</td>";
							echo "<td>$".$srrow['usd']."</td>";
							echo "<td>$".$currentRapRate."</td>";							
							echo "<td>".$SaleDiscount."</td>";
							echo "<td>".$soldRow['discount']."</td>";
							echo "<td>".$soldRow['rapRate']."</td>";
							//echo "<td class='center'>".$row['purchase_stockid']."</td>";
							//echo "<td class='center'>".$row['comments']."</td>";
							echo "<td>".$measurement."</td>";
							echo "<td>".$row['table']."</td>";
							echo "<td>".$row['depth']."</td>";
							//echo "<td>".$kysymbol."</td>";
							echo "<td>".date('d-m-Y g:i: A',strtotime($row['entrydate']))."</td>";
							if($role=='SUPERADMIN'){
							  $getempname=mysqli_query($con,"select username from basic_details where userid=".$row['added_by']);
							  $empname=mysqli_fetch_assoc($getempname);
							echo "<td id='superadmin'>".$empname['username']."</td>";
							}							
							echo "<td>".$row['location']."</td>";	
                            ?>
                           <td>
                                <?php if($diamond_status!='0')
							         {
                                       if($row['diamond_user_status']!='HOLD'){ }else{ echo "HOLDED"; }
									 }else{ echo "SOLD"; } ?>
                            </td>
                           <?php
						   echo "<td>".$vatrow['companyname']."</td>";	
						   echo "<td>".$customerName."</td>";	
							//echo "<td>".$customerNameDummy."</td>";	
                           echo "</tr>";
                           ?>
					   <?php } ?>
                      </tbody>
								  </table>
    </div>
		  
	    <!--<center><br>
		<button type="submit" class="btn btn-success"  onclick="return atleast_onecheckbox1()" name="hold">Hold</button>
		<button type="submit" class="btn btn-danger" onclick="return atleast_onecheckbox1()" name="edit">Edit</button>
		</center>-->
		</form>	
				
</div>
 </section>
</body>
</html>
<script>
  
  function atleast_onecheckbox1() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0 || $("input[name='check[]']:checked").length > 1) { 
  bootbox.alert("Please Select One Item");
  return false;
  }
  else
  {
	return true;
  //document.getElementById('button').click();
  }
  }
  $(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});
  
		function showAjaxModal(uid)
         {
    $.get('../search/viewcertificate.php?certi_id=' + uid, function(html){
                  $('#myModal .modal-body').html(html);
                  $('#myModal').modal('show', {backdrop: 'static'});
              });
   }
   function hold(i)
{
   bootbox.confirm("Are you sure?", function(result) {
	  if (result==true) {
      
    if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
    http2=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
    http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {
   
   if (http2.readyState==4 )
   		 {
   				var respoo=http2.responseText;
                if (respoo==1)
                {
                  bootbox.alert("Diamond has been Holded.",function(){
                  window.location.reload();
				  });
                }
                }
   			}			 
         var res="&did="+i;
   		 http2.open("GET","hold.php?res="+res, true);
   		 http2.send(null);
	  }
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