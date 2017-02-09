<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";

							
?>
<section class="main-section">
	<div class="container-fluid">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
		    <li><a href="../common/homepage.php">Home</a></li>
			 <li class="active">Stock Report</li>
		</ol>
		
	   
		<!-- <p  style="margin-top: -20px;"></p>-->  
		<h3 align="center">Stock Report</h3>
		<form action="stock.php" method="post">
			 <?php
			  //if(isset($_POST['go']))
                           //{
							$startdate='2010-01-01';
                               if ($_POST['fromDate']!="" && $_POST['toDate']=="") {
                               //$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
							   $date2 =  explode('/',$_POST['fromDate']);
								$fromDate=$date2[2].'-'.$date2[1].'-'.$date2[0];
								
                               $from="and d.entrydate between '$fromDate' and  '$today'";
                                }
                                else{
                               $from= "";		
                                }
                               if ($_POST['toDate']!="" && $_POST['fromDate']=="") {
                               // $toDate = date('Y-m-d',strtotime($_POST['toDate']));
								
								$date3 =  explode('/',$_POST['toDate']);
								$toDate=$date3[2].'-'.$date3[1].'-'.$date3[0];
                                 $to="and d.entrydate between '$startdate' and  '$toDate'";
                                }
                                else{
                                 $to = "";
                                 }
                                 if ($_POST['toDate']!="" && $_POST['fromDate']!="") {
                                //$toDate = date('Y-m-d',strtotime($_POST['toDate']));
                                //$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
								
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
                           //}
						   if($wvat!='' || $vat!='' || $regular!='' || $hform!=''){
			$certificteqry1="select d.*,l.*,p.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where 1 $from $to $both $shapeqry $wvat $vat $hform $regular and p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and d.diamond_status='1' order by d.entrydate ASC";
						   }
						   else if($none!=''){
						  $certificteqry1="select d.*,l.* from diamond_master d,login l where 1 $from $to $both $shapeqry and d.added_by=l.userid and d.diamond_status='1' and d.diamond_id NOT IN (select pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid)";						  
						   }
						   else{
			$certificteqry1="select distinct(d.diamond_id),d.*,l.username from  diamond_master d,login l where 1 $from $to $both $shapeqry and  d.added_by=l.userid and d.diamond_status='1' order by d.entrydate ASC";
						   }
			$certificteqry2="select d.*,l.username from  diamond_master d,login l where 1 $from $to $both $shapeqry and  d.added_by=l.userid and d.diamond_status='1' order by d.entrydate ASC";
						   //echo $certificteqry1;
			$certiresult1=mysqli_query($con,$certificteqry1);
			$certiresult12=mysqli_query($con,$certificteqry2);
			$totalnonediamond=mysqli_num_rows($certiresult12);
		$getcount1="select d.*,l.*,p.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='wvat' and d.diamond_status='1'";
		$result1=mysqli_query($con,$getcount1);
		$getcount2="select d.*,l.*,p.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='vat' and d.diamond_status='1'";
		$result2=mysqli_query($con,$getcount2);
		$getcount3="select d.*,l.*,p.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='hform' and d.diamond_status='1'";
		$result3=mysqli_query($con,$getcount3);
		$getcount4="select d.*,l.*,p.* from diamond_master d,login l,purchaseinvoice_product pp,purchaseinvoice p,party pt,location_master lm where p.purchase_invoiceid=pp.purchase_invoiceid and d.added_by=l.userid and pp.diamond=d.diamond_id and p.partyid=pt.partyid and p.locationid=lm.locationid and p.ptype='regular' and d.diamond_status='1'";
		$result4=mysqli_query($con,$getcount4);
		$getcount5="select d.*,l.* from diamond_master d,login l where 1 and d.added_by=l.userid and d.diamond_status='1' and d.diamond_id NOT IN (select pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid)";
		$result5=mysqli_query($con,$getcount5);
		?>
		<span class="">
         <p class="btn btn-default">
            <label for="wvat"><input type="checkbox" onclick="this.form.submit();" name="wvat" value="wvat" id="wvat" style="display: none;" ><span  style="background-color: #dff0d8;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Witout VAT (<b><?php echo mysqli_num_rows($result1);?></b>)</label>
            <label for="vat"><input type="checkbox" onclick="this.form.submit();" name="vat" value="vat" id="vat" style="display: none;"><span  style="background-color: #f2dede;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;VAT (<b><?php echo mysqli_num_rows($result2);?></b>)</label>
            <label for="hform"><input type="checkbox"  onclick="this.form.submit();" name="hform" value="hform" id="hform" style="display: none;"><span style="background-color: #d9edf7;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;H-Form (<b><?php echo mysqli_num_rows($result3);?></b>)</label>
            <label for="regular"><input type="checkbox" onclick="this.form.submit();" name="regular" value="regular" id="regular" style="display: none;"><span  style="background-color: #faf2cc;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;Regular (<b><?php echo mysqli_num_rows($result4);?></b>)</label>
			<label for="none"><input type="checkbox" onclick="this.form.submit();" name="none" value="none" id="none" style="display: none;"><span  style="background-color: #ffffff;border: 1px solid gray;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;None (<b><?php echo (mysqli_num_rows($result5));?></b>)</label>
         </p>
      </span>
</form>
		
		<div id="toolbar">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>
	    <table id="table"
      data-height="550"
      data-show-columns="true"
      data-toggle="table"
      data-search="true"
      data-show-export="true"
      data-pagination="true"
      data-click-to-select="true"
      data-toolbar="#toolbar"
      data-show-refresh="true"
      data-show-toggle="true"
      data-show-columns="true"
      data-url="../json/data1.json" >
      <thead>
			  <tr>
						  <th data-field="state" data-checkbox="true" ></th>
                           <th data-sortable="true">Sr.No.</th>
                           <th data-sortable="true">PG Stock Id</th>
							<!--<th data-sortable="true">Party</th>-->
							<th data-sortable="true">Cert. No.</th>
							<th data-sortable="true">Shape</th>
							<th data-sortable="true">Size</th>
							<th data-sortable="true">Color</th>
							<th data-sortable="true">Clarity</th>
							<th data-sortable="true">Cut</th>
							<th data-sortable="true">Polish</th>
							<th data-sortable="true">Symmetry</th>
							 <th data-sortable="true">Fluorescence</th>
							 <th data-sortable="true">Rap</th>
							 <th data-sortable="true">Dis</th>
							 <th data-sortable="true">P/C</th>
							 <th data-sortable="true">LESS</th>
							<!-- <th data-sortable="true">P A D</th>
							 <th data-sortable="true">EXTRA</th>
							 <th data-sortable="true">EXTRA</th>-->
							 <th data-sortable="true">Final</th>
							 <th data-sortable="true">USD</th>
							 <th data-sortable="true">Conv</th>
							 <th data-sortable="true">INR</th>
							 <th data-sortable="true">STOCK ID</th>
							 <th data-sortable="true">COMMENT</th>
							 <th data-sortable="true">MEASUREMENT</th>
							 <th data-sortable="true">TABLE</th>
							 <th data-sortable="true">DEPTH</th>
                           <th data-sortable="true">Date</th>
						   <?php if($role=='SUPERADMIN'){ ?>
							<th id="superadmin" data-sortable="true">Added By</th> 
							<?php } ?>
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
							$kysymbol='';$kr=1;
							$keyquery="select * from diamond_keysymbol where diamond_id=$did";
                     $keyres=mysqli_query($con,$keyquery);
                     while($ksm=mysqli_fetch_assoc($keyres)){
					  if($kr==1)
					  {
                        $kysymbol=$ksm['kysymbol'];
					  }else{
                        $kysymbol=$kysymbol.','.$ksm['kysymbol'];
					  }
						$kr++;
                     }
						   if($diamond_status=='0')
							{
								$note='Out Of Stock';
								//$class="danger";
							}
							else{$note='';//$class="";
							}
							$getid1="select p.*,pt.companyname,pt.referenceno from purchaseinvoice_product pp,purchaseinvoice p,party pt where 1 $wvat $vat $hform $regular and p.purchase_invoiceid=pp.purchase_invoiceid and pt.partyid=p.partyid and  pp.diamond=$did";
							//echo $getid1.'<br>';
	                    $result1=mysqli_query($con,$getid1);
	                    $vatrow=mysqli_fetch_assoc($result1);
						if(mysqli_num_rows($result1) > 0){
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
						    echo "<tr class='$class'>";
							?><td></td>
							<?php
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
							echo "<td class='center'>$".$raprow['rap']."</td>";
							echo "<td class='center'>".$raprow['discount1']."</td>";
							echo "<td class='center'>".($raprow['pc'])."</td>";
							echo "<td class='center'>".$raprow['discount2']."</td>";
							//echo "<td class='center'>".$raprow['discount4']."</td>";
							//echo "<td class='center'>".$raprow['discount5']."</td>";
							//echo "<td class='center'>".$raprow['discount6']."</td>";
							echo "<td class='center'>".$raprow['final']."</td>";
							echo "<td class='center'>$".$raprow['usd']."</td>";
							echo "<td class='center'>".($raprow['conv']+$raprow['extraconv'])."</td>";
							echo "<td class='center'>".$raprow['inr']."</td>";
							echo "<td class='center'>".$row['purchase_stockid']."</td>";
							echo "<td class='center'>".$row['comments']."</td>";
							echo "<td class='center'>".$measurement."</td>";
							echo "<td>".$row['table']."</td>";
							echo "<td>".$row['depth']."</td>";
							echo "<td>".date('d-m-Y g:i: A',strtotime($row['entrydate']))."</td>";
							if($role=='SUPERADMIN'){
							$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['added_by']);
							$empname=mysqli_fetch_assoc($getempname);
						    echo "<td id='superadmin'>".$empname['username']."</td>";
							}
							$encrypted_txt = encrypt_decrypt('encrypt', $did);
							echo "<td class='center'><a href='../diamond_upload/view_diamond.php?id=$encrypted_txt' class='btn btn-info'>View</a></td>";
							echo "</tr>";
					}
				?>
		 </tbody>
		</table>
	</div>
</section>

<?php
include "../common/footer.php";
?>
	