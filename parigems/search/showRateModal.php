<?php
ob_start();
   session_start();
include '../common/config.php';
   error_reporting(0);
   $userid = $_SESSION['userid'];
   $diamondId = $_GET['diamondId'];
    
  $certificteqry1="select d.*,l.username from  diamond_master d,login l,certificate_master c where  d.added_by=l.userid and c.certificateid=d.certificate_id  and d.diamond_id='$diamondId'";
 $certiresult1=mysqli_query($con,$certificteqry1);
   ?>
  
	<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>        
  <div class="clearfix"></div>
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
						 $Discount='+'.$explodeFirstDiscount[1]; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
						
						$salefirstDiscount=$srrow['discount1'];
						if($salefirstDiscount < 0)
						{
						  $explodeSaleDiscount=explode('-',$salefirstDiscount);
						 $SaleDiscount='+'.$explodeSaleDiscount[1]; 
						}
						else{
						 $SaleDiscount='-'.$salefirstDiscount; 
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
						?>
				  <div class="row">
					 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
						</div>
					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
						</div>
                  </div>
		 <?php }
               ?>
</tbody>
        </table>
	   </center>
  	  </div>
    </div>
  
</div>