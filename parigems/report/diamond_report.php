<?php
  include '../common/header.php';
?>
<section class="main-section">
 <div class="container-fluid crumb_top">
   <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Diamond Report</li>
   </ol>
  <h3 align="center">Diamond Report</h3>
	 <!--<div  style="overflow-y: scroll;height: 400px;">-->
		<div class="table-responsive">
			<table class="table table-striped"  data-height="400" data-show-columns="true" data-toggle="table" data-search="true" data-show-export="true">
                       <thead>
						  <tr style="font-size:10px !important;">
						   <th><input type="checkbox" ></th>
                           <!--<th data-sortable="true">Sr.No.</th>-->
                           <th data-sortable="true">PG Stock Id</th>
							<th data-sortable="true">Cert.No.</th>
							<th data-sortable="true">Shape</th>
							<th data-sortable="true">Carat</th>
							<th data-sortable="true">Color</th>
							<th data-sortable="true">Clarity</th>
							<th data-sortable="true">Cut</th>
							<th data-sortable="true">Polish</th>
							 <th data-sortable="true">Symm</th>
							 <th data-sortable="true">Flr</th>
							 <th data-sortable="true">Measurement</th>
							 <!--<th data-sortable="true">Table</th>
							 <th data-sortable="true">Depth</th>-->
							 <!--<th data-sortable="true">KeyToSymbols</th>-->
						   <?php if($role=='SUPERADMIN'){ ?>
							  <th data-sortable="true">Added By</th>
							<?php } ?>
							<!--<th data-sortable="true">Location</th>-->
                             <th data-sortable="true">Purchased From</th>
                             <!--<th data-sortable="true">Purchased From(Dummy)</th>-->
                             <th data-sortable="true">Sold To</th>
                             <th data-sortable="true">Sold To(Dummy)</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i=1;
                          $certificteqry1="select d.*,l.username from  diamond_master d,login l,certificate_master c where 1 and d.added_by=l.userid and c.certificateid=d.certificate_id order by d.entrydate ASC";
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
                        
                        $purchasedFromSelect="SELECT  pt.companyname,p.invoiceno FROM `purchaseinvoice_product` pp,purchaseinvoice p,party pt where pp.diamond=$did and p.partyid=pt.partyid and p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1'";
                        $purchasedFromResult=mysqli_query($con,$purchasedFromSelect);
                        $partyRow=mysqli_fetch_assoc($purchasedFromResult);
						if(mysqli_num_rows($purchasedFromResult) > 0)
						{
                        $invoiceno='[PG-'.$partyRow['invoiceno'].']';
                        $partyName=$partyRow['companyname'].' '.$invoiceno;
						}
						else{
						  $partyName='';
						}
						
						$purchasedFromSelectDummy="SELECT  pt.companyname,p.invoiceno FROM `purchaseinvoice_product_dummy` pp,purchaseinvoice_dummy p,party pt where pp.diamond=$did and p.partyid=pt.partyid and p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1'";
                        $purchasedFromResultDummy=mysqli_query($con,$purchasedFromSelectDummy);
                        $partyRowDummy=mysqli_fetch_assoc($purchasedFromResultDummy);
						if(mysqli_num_rows($purchasedFromResultDummy) > 0)
						{
						$invoicenoDummy='[PG-'.$partyRow['invoiceno'].']';
                        $partyNameDummy=$partyRowDummy['companyname'].''.$invoicenoDummy;
						}
                        else{
						  $partyNameDummy='';
						}
                        
	                    $getsaleinvoicedetails="SELECT b.username,i.invoiceno FROM saleinvoice i,basic_details b,saleinvoice_product sp where b.userid=i.userid and i.invoiceno=sp.invoiceno and i.status='1' and sp.diamondid=".$did;
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
						    echo "<tr  class='$class'>";
							echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case"  />'?>
							<?php
							echo '</td>';
                           //	echo "<td>".$i++."</td>";
							echo "<td>".$row['referenceno']."</td>";
                           	echo '<td><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
							echo "<td>".$row['diamond_shape']."</td>";
							echo "<td>".$row['weight']."</td>";
							echo "<td>".$row['color']."</td>";
							echo "<td>".$row['clarity']."</td>";
							echo "<td class='center'>".$cutrow['semicut']."</td>";
							echo "<td class='center'>".$polishrow['semipolish']."</td>";
							echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
							echo "<td class='center'>".$row['fluoresence']."</td>";
							
							echo "<td class='center'>".$measurement."</td>";
							//echo "<td>".$row['table']."</td>";
							//echo "<td>".$row['depth']."</td>";
							//echo "<td>".$kysymbol."</td>";
							if($role=='SUPERADMIN'){
							  $getempname=mysqli_query($con,"select username from basic_details where userid=".$row['added_by']);
							  $empname=mysqli_fetch_assoc($getempname);
							echo "<td id='superadmin'>".$empname['username']."</td>";
							}							
							//echo "<td class='center'>".$row['location']."</td>";	
							echo "<td class='center'>".$partyName."</td>";	
							//echo "<td class='center'>".$partyNameDummy."</td>";	
							echo "<td class='center'>".$customerName."</td>";	
							echo "<td class='center'>".$customerNameDummy."</td>";	
                            ?>
					   <?php } ?>
                     </tbody>
                  </table>
		  </div>
			</div>
<!--</div>-->
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