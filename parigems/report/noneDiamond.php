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
      <li class="active">View All Non-Purchased Diamonds</li>
   </ol>
         <h3 align="center">View All Non-Purchased Diamonds</h3>
			<div  style="overflow-x: auto;font-size:small">
		  <div class="table-responsive">
		  <table  cellspacing="0" cellpadding="0" border="0" width="325" class="table_mt">
		  <tr>
			<td>

	    <div style="width:1342px;font-size:small">
				<table class="table table-stripped" cellspacing="0" cellpadding="0" style="font-size:10px;">
       <thead class="tableHead">
						  <tr>
						   <th><input type="checkbox" id="check_all" ></th>
                           <th class="thPlus" data-sortable="true">Sr.No.</th>
                           <th class="thPlus" data-sortable="true">PG Stock Id</th>
							<th class="thPlus" data-sortable="true">Cert.No.</th>
							<th class="thPlus" data-sortable="true">Shape</th>
							<th class="thPlus" data-sortable="true">Size</th>
							<th class="thPlus" data-sortable="true">Color</th>
							<th class="thPlus" data-sortable="true">Clarity</th>
							<th class="thPlus" data-sortable="true">Cut</th>
							<th class="thPlus" data-sortable="true">Polish</th>
							 <th class="thPlus" data-sortable="true">Symm</th>
							 <th class="thPlus" data-sortable="true">Flr</th>
							 <th class="thPlus" data-sortable="true">Rap $</th>
							 <th class="thPlus" data-sortable="true">Dis. %</th>
							 <th class="thPlus" data-sortable="true">P/C</th>
							 <th class="thPlus" data-sortable="true">Less</th>
							 <th class="thPlus" data-sortable="true">Exp.</th>
							 <th class="thPlus" data-sortable="true">Final</th>
							 <th class="thPlus" data-sortable="true">USD</th>
							 <th class="thPlus" data-sortable="true">Conv</th>
							 <th class="thPlus" data-sortable="true">INR</th>
							 <th class="thPlus" data-sortable="true">Stock Id</th>
							 <th class="thPlus" data-sortable="true">Comment</th>
							 <th class="thPlus" data-sortable="true">Measurement</th>
							 <th class="thPlus" data-sortable="true">Table %</th>
							 <th class="thPlus" data-sortable="true">Depth %</th>
							 <th class="thPlus" data-sortable="true">KeyToSymbols</th>
                             <th class="thPlus" data-sortable="true">Date</th>
						   <?php if($role=='SUPERADMIN'){ ?>
							  <th class="thPlus" data-sortable="true">Added By</th>
							<?php } ?>
							<th class="thPlus" data-sortable="true">Location</th>
                           <th class="thPlus" data-sortable="true">Status</th>
                         </tr>
				</table>
			</div>
		  </td>
	  </thead>
	  <tr>
	  <td>
	  <div style="width:1366px; height:300px; overflow:auto;font-size:small;margin-top:-20px;">
			<table class="table table-stripped" cellspacing="0" cellpadding="0" style="font-size:8px;">
			 <tbody>
                        <?php
                           $i=1;
                          $certificteqry1=mysqli_query($con,"select d.*,l.* from diamond_master d,login l where d.added_by=l.userid and d.diamond_id NOT IN (select pp.diamond from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid)");
							 while($row=mysqli_fetch_assoc($certificteqry1))
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
						    echo "<tr  class='$class'>";
							echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case"  />'?><br>
							<a  data-toggle="collapse" href="#collapseExample<?php echo $did; ?>" aria-expanded="false" aria-controls="collapseExample"  onclick="$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle')" title="purchase & sell details"><i class="fa fa-plus-circle fa-lg"></i></a>
							<?php
							echo '</td>';
                           	echo "<td>".$i++."</td>";
							echo "<td class='center tdPlus' title='PG Stock Id'>".$row['referenceno']."</td>";
							//echo "<td class='center'>".$vatrow['companyname'];if($vatrow['companyname']!=''){ echo '('.$vatrow['referenceno'].')';}"</td>";
                           	echo '<td><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
							echo "<td>".$row['diamond_shape']."</td>";
							echo "<td class='tdPlus'>".$row['weight']."</td>";
							echo "<td class='tdPlus'>".$row['color']."</td>";
							echo "<td class='tdPlus'>".$row['clarity']."</td>";
							echo "<td class='center tdPlus '>".$cutrow['semicut']."</td>";
							echo "<td class='center tdPlus'>".$polishrow['semipolish']."</td>";
							echo "<td class='center tdPlus'>".$symhrow['semisymmetry']."</td>";
							echo "<td>".$row['fluoresence']."</td>";
							echo "<td class='center tdPlus'>$".$raprow['rap']."</td>";
							echo "<td class='center tdPlus'>".$Discount."</td>";
							echo "<td class='center tdPlus'>".($raprow['pc'])."</td>";
							echo "<td class='center tdPlus'>".($raprow['discount2']+$raprow['discount3']+$raprow['discount4']+$raprow['discount5'])."</td>";
							echo "<td class='center tdPlus'>".($raprow['discount6']+$raprow['discount7']+$raprow['discount8']+$raprow['discount9'])."</td>";
							echo "<td class='center tdPlus'>".$raprow['final']."</td>";
							echo "<td class='center tdPlus'>$".$raprow['usd']."</td>";
							echo "<td class='center tdPlus'>".($raprow['conv']+$raprow['extraconv'])."</td>";
							echo "<td class='center tdPlus'>".$raprow['inr']."</td>";
							echo "<td class='center tdPlus'>".$row['purchase_stockid']."</td>";
							echo "<td class='center tdPlus'>".$row['comments']."</td>";
							echo "<td class='center tdPlus'>".$measurement."</td>";
							echo "<td class='center tdPlus'>".$row['table']."</td>";
							echo "<td class='center tdPlus'>".$row['depth']."</td>";
							echo "<td class='center tdPlus'>".$kysymbol."</td>";
							echo "<td class='center tdPlus'> ".date('d-m-Y g:i: A',strtotime($row['entrydate']))."</td>";
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
                           echo "</tr>";
                           ?>
                        <tr  class="accordian-body collapse" id="collapseExample<?php echo $did; ?>">
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
					   </tr>
					   <?php } ?>
                     </tbody>
                  </table>
		  </div>
			</div>
	
</div>
 </section>
</body>
</html>

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