<?php include '../common/header.php';

$diamondid=$_POST['check'];
    $hold=$_POST['hold'];
   $edit=$_POST['edit'];
   
   if(isset($edit)){
   foreach($diamondid as $key => $value)
	{
//$getid = encrypt_decrypt('decrypt', $_GET['id']);
$getid = $diamondid[$key];
$diamond_master="select * from diamond_master where diamond_id=".$getid;
$res=mysqli_query($con,$diamond_master);
$row=mysqli_fetch_assoc($res);

$certi_master="select * from certificate_master where certificateid=".$row['certificate_id'];
$certires=mysqli_query($con,$certi_master);
$crow=mysqli_fetch_assoc($certires);

$rapquery="select * from diamond_purchase where diamond_id=".$row['diamond_id'];
$rapres=mysqli_query($con,$rapquery);
$rrow=mysqli_fetch_assoc($rapres);

$salequery="select * from diamond_sale where diamond_id=".$row['diamond_id'];
$saleres=mysqli_query($con,$salequery);
$srow=mysqli_fetch_assoc($saleres);

$splitName = explode(".", $crow['logo']);
$type=$splitName[1];

$diamondPurchaseInvoice="select pp.* from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1' and pp.diamond=".$row['diamond_id'];
$purchaseReult=mysqli_query($con,$diamondPurchaseInvoice);
if(mysqli_num_rows($purchaseReult) > 0)
{
	$readonly=" style='pointer-Events:none;' readonly";
}
else{
	$readonly="";
}
?>
<section class="main-section">
	<div class="container-fluid">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	      	<li><a href="../common/homepage.php">Home</a></li>
	      	<li class="active">Edit Diamond</li>
	   	</ol>
  		<h3 class="text-left">Edit Diamond</h3>
  		<hr>
		<div class="tab-content">
  			<div id="indian-registered-companies" class="tab-pane fade in active">
				<form  action="inserteditdiamond.php" method="post" enctype="multipart/form-data">
					<input class="form-control" value="india" type="hidden" name="countrytype" id="countrytype" >
					<input class="form-control" value="<?php echo $getid;?>" type="hidden" name="diamondid" id="diamondid" >
	  				<fieldset>
	    				<div class="row">
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>PG Stock ID</label>
			  						<input class="form-control" type="text" value="<?php echo $row['referenceno'];?>" name="referenceno" id="referenceno" readonly>
			  					</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Lab Report</label>
									<select name="certi_name" id="certi_name" class="form-control" style='pointer-Events:none;' readonly>
										<option value="">Lab Report</option>
										<?php
										echo '<option value="'.$crow['certi_name'].'" selected>'.$crow['certi_name'].'</option>';
										$getcerti="select * from certificates where status='1' and cerificatename!='".$crow['certi_name']."'";
										$certi=mysqli_query($con,$getcerti);
										while($c=mysqli_fetch_assoc($certi)){
										echo '<option value="'.$c['cerificatename'].'">'.$c['cerificatename'].'</option>';
										} ?>										
									</select>
								</div>
							</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Certificate Number</label>
			  						<input class="form-control" type="text" value="<?php echo $crow['certi_no'];?>" name="certi_no" id="certi_no" style='pointer-Events:none;' readonly>		  						
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Certificate Date</label>
	    							<input type="text" value="<?php echo date('d/m/Y',strtotime($crow['certi_date']));?>" name="certi_date" class="form-control datepicker">
								</div>
	    					</div>	
							<div class="clearfix"></div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Certificate Upload</label>
									<?php
									if($type!=''){
									if($type=='jpg' || $type=='png' || $type=='gif'|| $type=='jpeg'){ ?>
									<a href="<?php echo $crow['logo'];?>" target="_blank"><img src="<?php echo $crow['logo'];?>" style="height: 20px;width: 100px;"> View</a>
									<?php }else{?>
									<a href="<?php echo $crow['logo'];?>" target="_blank">
									<object data="<?php echo $crow['logo'];?>" type="application/pdf" style="height: 20px;width: 100px;">
									 </object> View</a>
						           <?php } } ?>
			  						<input class="form-control" type="file" name="logo" id="logo" accept=".png,.jpg,.jpeg,.pdf,.gif">
			  						<input class="form-control" type="hidden" name="logo1" id="logo1" value="<?php echo $crow['logo'];?>" >
								</div>
	    					</div>	    					
	    				
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Location</label>
									<input class="form-control" type="text" name="location" id="location" value="<?php echo $row['location'];?>" >
									<!--<select class="countries form-control" id="location" name="location" >
										<option value="<?php echo trim($row['location']);?>" selected><?php echo $row['location'];?></option>
			  							<option value="">Select Location</option>
			  						</select>-->
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group highlight">
	    							<label><b>Diamond Shape</b></label>
									<select name="diamond_shape" id="diamond_shape1" class="dropdownselect2" required style='pointer-Events:none;' readonly>
										<option value="">Select Diamond Shape</option>
										<?php
										echo '<option value="'.$row['diamond_shape'].'" selected>'.$row['diamond_shape'].'</option>';
										$getshape="select * from shape_master where status='1' and  shapename!='".$row['diamond_shape']."'";
										$shpe=mysqli_query($con,$getshape);
										while($s=mysqli_fetch_assoc($shpe)){
										echo '<option value="'.$s['shapename'].'">'.$s['shapename'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group highlight">
	    							<label><b>Size/Carat</b></label>
			  						<input class="form-control" value="<?php echo $row['weight'];?>" type="text" name="weight" id="weight1" required onkeypress="return IsNumeric(event);" style='pointer-Events:none;' readonly>
								</div>
	    					</div>							
							<?php
							if($row['cut']=='Excellent' && $row['polish']=='Excellent' && $row['symmetry']='Excellent')
							{
								$exllent='checked';
							}
							if($row['cut']=='Verygood' && $row['polish']=='Verygood' && $row['symmetry']='Verygood')
							{
								$Verygood='checked';
							}
							if($row['cut']=='Good' && $row['polish']=='Good' && $row['symmetry']='Good')
							{
								$Good='checked';
							}
							?>
							<div class="col-sm-3">
	    						<div class=" form-group ">
	    							<label>3EX</label>
									<input type="radio" name="3ex" id="3ex" onclick="checkexcellent();" <?php echo $exllent;?>>
	    							<label>3VG</label>
									<input type="radio" name="3ex" id="3vg" onclick="checkexcellent();" <?php echo $Verygood;?>>
									<label>3G</label>
									<input type="radio" name="3ex" id="3g" onclick="checkexcellent();" <?php echo $Good;?>>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Cut</label>
									<select name="cut" id="cut" class="form-control" onchange="uncheckexcellent()">
										<option value="">Select CUT</option>
										<?php
										echo '<option value="'.$row['cut'].'" selected>'.$row['cut'].'</option>';
										$qry="select * from  cut_polish_sym where status='1' and title!='".$row['cut']."'";
										$run=mysqli_query($con,$qry);
										while($cps=mysqli_fetch_assoc($run)){
										echo '<option value="'.$cps['title'].'">'.$cps['title'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Polish</label>
									<select name="polish" id="polish" class="form-control" onchange="uncheckexcellent()">
										<option value="">Select Polish</option>
										<?php
										echo '<option value="'.$row['polish'].'" selected>'.$row['polish'].'</option>';
										$qry="select * from  cut_polish_sym where status='1' and title!='".$row['polish']."'";
										$run=mysqli_query($con,$qry);
										while($cps=mysqli_fetch_assoc($run)){
										echo '<option value="'.$cps['title'].'">'.$cps['title'].'</option>';
										} ?>									
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Symmetry</label>
									<select name="symmetry" id="symmetry" class="form-control" onchange="uncheckexcellent()">
										<option value="">Select Symmetry</option>
										<?php
										echo '<option value="'.$row['symmetry'].'" selected>'.$row['symmetry'].'</option>';
										$qry="select * from  cut_polish_sym where  status='1' and title!='".$row['symmetry']."'";
										$run=mysqli_query($con,$qry);
										while($cps=mysqli_fetch_assoc($run)){
										echo '<option value="'.$cps['title'].'">'.$cps['title'].'</option>';
										} ?>
									</select>			  						
								</div>
	    					</div>				
	    						<div class="col-sm-3">
	    						<div class=" form-group highlight">
	    							<label><b>Diamond Color</b></label>
									<select name="color" id="color1" class="dropdownselect2" required style='pointer-Events:none;' readonly>
										<option value="">Select Diamond Color</option>
										<?php
										echo '<option value="'.$row['color'].'" selected>'.$row['color'].'</option>';
										$color="select * from  color where status='1' and  colorname!='".$row['color']."'";
										$clr=mysqli_query($con,$color);
										while($cr=mysqli_fetch_assoc($clr)){
										echo '<option value="'.$cr['colorname'].'">'.$cr['colorname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
	    				
							<div class="col-sm-3">
	    						<div class=" form-group highlight">
	    							<label><b>Diamond Clarity</b></label>
									<select name="clarity" id="clarity1" class="dropdownselect2" required style='pointer-Events:none;' readonly>
										<option value="">Select Diamond Clarity</option>
										<?php
										echo '<option value="'.$row['clarity'].'" selected>'.$row['clarity'].'</option>';
										$clarity="select * from  clarity where status='1' and clarityname!='".$row['clarity']."'";
										$clrit=mysqli_query($con,$clarity);
										while($cl=mysqli_fetch_assoc($clrit)){
										echo '<option value="'.$cl['clarityname'].'">'.$cl['clarityname'].'</option>';
										} ?>										
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Diamond Fluorescence</label>
									<select name="fluoresence" id="fluoresence" class="dropdownselect2">
										<option value="">Select Diamond Fluorescence</option>
										<?php
										echo '<option value="'.$row['fluoresence'].'" selected>'.$row['fluoresence'].'</option>';
										$fluorescense="select * from fluorescense where status='1' and  fluorescence!='".$row['fluoresence']."'";
										$fluro=mysqli_query($con,$fluorescense);
										while($f=mysqli_fetch_assoc($fluro)){
										echo '<option value="'.$f['fluorescence'].'">'.$f['fluorescence'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Diamond Tinge</label>
									<select name="tinge" id="tinge" class="dropdownselect2">
										<option value="">Select Diamond Tinge</option>
										<?php
										echo '<option value="'.$row['tinge'].'" selected>'.$row['tinge'].'</option>';
										$tinge="select * from tinge where status='1' and  tingename!='".$row['tinge']."'";
										$tng=mysqli_query($con,$tinge);
										while($tg=mysqli_fetch_assoc($tng)){
										echo '<option value="'.$tg['tingename'].'">'.$tg['tingename'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
	    				
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>D1</label>
			  						<input class="form-control" value="<?php echo $row['diameter_max'];?>" type="text" name="diameter_max" id="diameter_max" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>	    				
	    					<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>D2</label>
			  						<input class="form-control" value="<?php echo $row['diameter_min'];?>" type="text" name="diameter_min" id="diameter_min" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Height</label>	    						
			  						<input class="form-control" value="<?php echo $row['height'];?>" type="text" name="height" id="height" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>DR</label>
			  						<input class="form-control" value="<?php echo $row['diameter_ratio'];?>" type="text" name="dratio" id="dratio" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
	    					
							<div class="col-sm-3">
	    						<div class=" form-group">	    							
			  						<label>Table %</label>
			  						<input class="form-control" value="<?php echo $row['table'];?>" type="text" name="table" id="table" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Depth %</label>
			  						<input class="form-control" value="<?php echo $row['depth'];?>" type="text" name="depth" id="depth" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Girdle %</label>
			  						<input class="form-control" type="text" value="<?php echo $row['girdlevalue'];?>" name="girdlevalue" id="girdlevalue" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>	
							<div class="col-sm-3">
	    						<div class=" form-group">	    							
			  						<label>Girdle Condition</label>
									<select name="giddle" id="giddle" class="form-control">
										<option value="">Select</option>
									<?php
									   echo '<option value="'.$row['giddle'].'" selected>'.$row['giddle'].'</option>';
										$girdle="select * from  girdle where status='1' and  girdlename!='".$row['giddle']."'";
										$grdl=mysqli_query($con,$girdle);
										while($gd=mysqli_fetch_assoc($grdl)){
										echo '<option value="'.$gd['girdlename'].'">'.$gd['girdlename'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">	    							
			  						<label>Girdle Min/Max</label>
			  						<div class="row">
			  							<div class="col-sm-6">
			  								<select name="giddlemin" id="giddlemin" class="form-control">
												<option value="">Select</option>
												<?php
												echo '<option value="'.$row['girdlemin'].'" selected>'.$row['girdlemin'].'</option>';
													$girdle_min="select * from  girdle_min_max where status='1' and girldle_min!='".$row['girdlemin']."'";
													$grdlmin=mysqli_query($con,$girdle_min);
													while($gdmin=mysqli_fetch_assoc($grdlmin)){
													echo '<option value="'.$gdmin['girldle_min'].'">'.$gdmin['girldle_min'].'</option>';
													} ?>
											</select>
			  							</div>
			  							<div class="col-sm-6">
			  								<select name="giddlemax" id="giddlemax" class="form-control">
												<option value="">Select</option>
												<?php
												   echo '<option value="'.$row['girdlemax'].'" selected>'.$row['girdlemax'].'</option>';
													$girdle_max="select * from  girdle_min_max where status='1' and girldle_min!='".$row['girdlemax']."'";
													$grdlmax=mysqli_query($con,$girdle_max);
													while($gdmax=mysqli_fetch_assoc($grdlmax)){
													echo '<option value="'.$gdmax['girldle_min'].'">'.$gdmax['girldle_min'].'</option>';
													} ?>
											</select>
			  							</div>
			  						</div>								
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">	    							
			  						<label>Culet</label>
									<select name="cutlet" id="cutlet" class="form-control">
										<option value="">Select</option>
									<?php
									echo '<option value="'.$row['cutlet'].'" selected>'.$row['cutlet'].'</option>';
										$cutlet="select * from  cutlet where status='1' and cutname!='".$row['cutlet']."'";
										$cutl=mysqli_query($con,$cutlet);
										while($ct=mysqli_fetch_assoc($cutl)){
										echo '<option value="'.$ct['cutname'].'">'.$ct['cutname'].'</option>';
										} ?>
										</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Crown Angle &deg;</label>
			  						<input class="form-control" value="<?php echo $row['crown_angle'];?>" type="text" name="crown_angle" id="crown_angle" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
	    					<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Crown Height %</label>
			  						<input class="form-control" value="<?php echo $row['crown_height'];?>" type="text" name="crown_height" id="crown_height" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Pavilion Angle &deg;</label>
			  						<input class="form-control" value="<?php echo $row['pavilion_angle'];?>" type="text" name="pavilion_angle" id="pavilion_angle" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
	    					<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Pavilion Depth %</label>
			  						<input class="form-control" value="<?php echo $row['pavilion_height'];?>" type="text" name="pavilion_height" id="pavilion_height" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
	    				
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label> Star Length %</label>
			  						<input class="form-control" value="<?php echo $row['length'];?>" type="text" name="length" id="length" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Lower Half %</label>
			  						<input class="form-control" value="<?php echo $row['lower_half'];?>" type="text" name="lowerhalf" id="lowerhalf" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>H & A / Others</label>
			  						<input class="form-control" value="<?php echo $row['H_A'];?>" type="text" name="H_A" id="H_A" >
								</div>
	    					</div>
	    					
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Milky</label>
									<select name="milky" id="milky" class="form-control">
										<option value="">Select</option>
										<?php
										echo '<option value="'.$row['milky'].'" selected>'.$row['milky'].'</option>';
										$milky="select * from  milky where status='1' and milkyname!='".$row['milky']."'";
										$mlk=mysqli_query($con,$milky);
										while($ml=mysqli_fetch_assoc($mlk)){
										echo '<option value="'.$ml['milkyname'].'">'.$ml['milkyname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Black Inclusion</label>
									<select name="black_inclusion" id="black_inclusion" class="form-control">
										<option value="">Select</option>
									<?php
									echo '<option value="'.$row['black_inclusion'].'" selected>'.$row['black_inclusion'].'</option>';
										$black_inclusion="select * from  black_inclusion where status='1' and blackinclusionname!='".$row['black_inclusion']."'";
										$blckincl=mysqli_query($con,$black_inclusion);
										while($b=mysqli_fetch_assoc($blckincl)){
										echo '<option value="'.$b['blackinclusionname'].'">'.$b['blackinclusionname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Brown Inclusion</label>
									<select name="brown_inclusion" id="brown_inclusion" class="form-control">
										<option value="">Select</option>
									<?php
									  echo '<option value="'.$row['brown_inclusion'].'" selected>'.$row['brown_inclusion'].'</option>';
										$brown_inclusion="select * from  brown_inclusion where status='1' and browninclusionname!='".$row['brown_inclusion']."'";
										$brownincl=mysqli_query($con,$brown_inclusion);
										while($br=mysqli_fetch_assoc($brownincl)){
										echo '<option value="'.$br['browninclusionname'].'">'.$br['browninclusionname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Inclusion Visibility</label>
			  						<div>
									<?php
									    echo '<label class="radio-inline"><input type="radio" value="'.$row['inclusive_visibility'].'" checked name="inclusive_visibility" id="inclusive_visibility" >'.$row['inclusive_visibility'].'</label>';
										$inclusion_visibility="select * from  inclusion_visibility where status='1' and inclusionname!='".$row['inclusive_visibility']."'";
										$incl=mysqli_query($con,$inclusion_visibility);
										while($in=mysqli_fetch_assoc($incl)){
										echo '<label class="radio-inline"><input type="radio" value="'.$in['inclusionname'].'" name="inclusive_visibility" id="inclusive_visibility" >'.$in['inclusionname'].'</label>';
										} ?>
										</div>
								</div>
	    					</div>
	    					<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Type II A</label>
			  						<div>
										<label><input type="radio" name="type_IIA" value="yes" <?php if($row['type_IIA']=='yes'){ echo 'checked';}?>> Yes</label>
										<label><input type="radio" name="type_IIA" value="no" <?php if($row['type_IIA']=='no'){ echo 'checked';}?>> No</label>
									</div>
								</div>
	    					</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
			  						<label>Type II B</label>
			  						<div>
										<label><input type="radio" name="type_IIB" value="yes" <?php if($row['type_IIB']=='yes'){ echo 'checked';}?>> Yes</label>
										<label><input type="radio" name="type_IIB" value="no" <?php if($row['type_IIB']=='no'){ echo 'checked';}?>> No</label>
									</div>
								</div>
	    					</div>
							<div class="col-sm-12">
	    						<div class=" form-group">
									<label>Key To Symbol</label>
									<div class="row">
										<div class="col-sm-12">
											<ul class="symbol-ul">
											<?php
													
												        
													$key_symbol="select * from key_symbol";
													$ksmbl=mysqli_query($con,$key_symbol);
													while($ks=mysqli_fetch_assoc($ksmbl)){
													$keyquery="select * from diamond_keysymbol where diamond_id=".$row['diamond_id']." and kysymbol='".$ks['keysymbol']."'";
                                                       $keyres=mysqli_query($con,$keyquery);
														if(mysqli_num_rows($keyres)  > 0)
														{
														echo '<li><label class="font-noraml"><input type="checkbox" name="key_to_symbol[]" id="key_to_symbol" value="'.$ks['keysymbol'].'" checked> &nbsp;&nbsp;'.$ks['keysymbol'].'</label></li>';
														}
														else
														{
														echo '<li><label class="font-noraml"><input type="checkbox" name="key_to_symbol[]" id="key_to_symbol" value="'.$ks['keysymbol'].'"> &nbsp;&nbsp;'.$ks['keysymbol'].'</label></li>';	
														}
													}
													?>
											</ul>
										</div>
									</div>
								</div>
	    					</div>
	    					<div class="clearfix"></div>
							<div class="col-sm-6">
	    						<div class=" form-group">
			  						<label>Additional Comments</label>
			  						<input class="form-control" value="<?php echo $row['comments'];?>" type="text" name="comments" id="comments" >
								</div>
	    					</div>
							<div class="col-sm-6">
	    						<div class=" form-group">
			  						<label>Video Link</label>
			  						<input class="form-control" type="text" value="<?php echo $row['videolink'];?>" name="videolink" id="videolink" >			  						
								</div>
	    					</div>
							<div class="col-sm-6">
							<div class=" form-group">
						  <label for="invoiceno">Purchase Stock Id</label>
								<input class="form-control" type="text" value="<?php echo $row['purchase_stockid'];?>" name="purchase_stockid" id="purchase_stockid" >
							</div>
						</div>
							<div class="col-sm-3">
	    						<div class=" form-group">
	    							<label>Laser Inscript</label>
	    							<div>
										<?php if($row['isledger']=='yes'){ ?>
											<label class="radio-inline">
					  							<input type="radio" name="ledger" value="yes" checked>Yes
					  						</label>
					  						<label class="radio-inline">		  						
				  								<input type="radio" name="ledger" value="no">No
				  							</label>
										<?php }
										else{ ?>
											<label class="radio-inline">
												<input type="radio" name="ledger" value="yes">Yes
											</label>
											<label class="radio-inline">
					  							<input type="radio" name="ledger" value="no" checked>No
					  						</label>	
										<?php } ?>
									</div>
								</div>
	    					</div>
	    				</div>
						<div class="row">
							<div class="col-sm-12">
	    						<div class=" form-group">
			  						<label>Fancy Colour</label>
			  						<div>
									<?php if($row['isfancy']=='yes'){ ?>
										<label class="radio-inline">
										 	<input type="radio" name="fancy" value="no" onclick="document.getElementById('showfancy').style.opacity='0.3';$('#fancyintensity').val('');$('#fancyovertone').val('');$('#fancycolor1').val('');document.getElementById('showfancy').style.pointerEvents = 'none';$('#color1').prop('required', true);$('#clarity1').prop('required', true);$('#diamond_shape1').prop('required', true);" > No
										 </label>
										 <label class="radio-inline">
										 	<input type="radio" name="fancy" id="fancyyes" value="yes" onclick="document.getElementById('showfancy').style.opacity='1';document.getElementById('showfancy').style.pointerEvents = 'auto';$('#color1').prop('required', false);$('#clarity1').prop('required', false);$('#diamond_shape1').prop('required', false);" checked> Yes
										 </label>
									<?php }
									else{ ?>
										<label class="radio-inline">
									 		<input type="radio" name="fancy" value="no" onclick="document.getElementById('showfancy').style.opacity='0.3';$('#fancyintensity').val('');$('#fancyovertone').val('');$('#fancycolor1').val('');document.getElementById('showfancy').style.pointerEvents = 'none';$('#color1').prop('required', true);$('#clarity1').prop('required', true);$('#diamond_shape1').prop('required', true);" checked > No
									 	</label>
									 	<label class="radio-inline">
									 		<input type="radio" name="fancy" id="fancyyes" value="yes" onclick="document.getElementById('showfancy').style.opacity='1';document.getElementById('showfancy').style.pointerEvents = 'auto';$('#color1').prop('required', false);$('#clarity1').prop('required', false);$('#diamond_shape1').prop('required', false);" > Yes
									 	</label>
									<?php } ?>
								</div>
							</div>
								<?php if($row['isfancy']=='yes'){ ?>
								<div id="showfancy" style="opacity: 1;" onclick="document.getElementById('fancyyes').checked='true';document.getElementById('showfancy').style.opacity='1'">
									<?php }else{ ?> <div id="showfancy" style="opacity: 0.3;pointer-Events:none;"> <?php } ?>
									<div class="row">
										<div class="col-sm-4">
											<label>Fancy Color Intensity</label>
					  						<select class="form-control" name="fancyintensity" id="fancyintensity">
												<option value="">Select</option>
											<?php
											echo '<option value="'.$row['fancyintensity'].'" selected>'.$row['fancyintensity'].'</option>';
												$fancy_color_intensity="select * from  fancy_color_intensity where status='1' and fancy_intensity!='".$row['fancyintensity']."'";
												$fancyclrintense=mysqli_query($con,$fancy_color_intensity);
												while($fcns=mysqli_fetch_assoc($fancyclrintense)){
												echo '<option value="'.$fcns['fancy_intensity'].'">'.$fcns['fancy_intensity'].'</option>';
												} ?>
											</select>						
									    </div>
										<div class="col-sm-4">
											<label>Fancy Color Overtone</label>
											<select class="form-control" name="fancyovertone" id="fancyovertone">
												<option value="">Select</option>
												<?php
												echo '<option value="'.$row['fancyovertone'].'" selected>'.$row['fancyovertone'].'</option>';
												$fancy_overtone="select * from  fancy_overtone where status='1' and overtone!='".$row['fancyovertone']."'";
												$fancyclrovertone=mysqli_query($con,$fancy_overtone);
												while($fcnsovr=mysqli_fetch_assoc($fancyclrovertone)){
												echo '<option value="'.$fcnsovr['overtone'].'">'.$fcnsovr['overtone'].'</option>';
												} ?>
											</select>		
									    </div>
										<div class="col-sm-4">
											<label>Fancy Color </label>
					  						<select class="form-control" name="fancycolor1" id="fancycolor1">
												<option value="">Select</option>
											<?php
											echo '<option value="'.$row['fancycolor1'].'" selected>'.$row['fancycolor1'].'</option>';
												$fancy_color="select * from  fancy_color where status='1' and fancycolor!='".$row['fancycolor1']."'";
												$fancyclr=mysqli_query($con,$fancy_color);
												while($fc=mysqli_fetch_assoc($fancyclr)){
												echo '<option value="'.$fc['fancycolor'].'">'.$fc['fancycolor'].'</option>';
												} ?>
											</select>			  						
									    </div>
								    </div>
								</div>
	    					</div>
						</div>
						<h3 class="text-left">Purchase Details</h3>
						<hr>
						<div class="row" <?php echo $readonly;?>>
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Purchase Type</label><br>
									<?php
									if($rrow['ratetype']=='percarat'){
									echo '<input type="radio" name="rapratecarat" value="percarat" checked required>Per Carat
									<input type="radio" name="rapratecarat" value="raprate" required>RAP';
									}else{
										echo '<input type="radio" name="rapratecarat" value="percarat" required>Per Carat
									<input type="radio" name="rapratecarat" value="raprate" checked required>RAP';
									} ?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Current RAP Rate</label>
									<?php
									if($rrow['currentpurchaserap']=='yes'){$checked="checked";}else{$checked="";}?>
									<input type="checkbox" id="currentrap2" name="currentpurchaserap" value="yes" onclick="change();" <?php echo $checked;?>>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Per Carat/RAP Rate</label>
									<input type="text" value="<?php echo $rrow['rap'];?>" name="rap" id="rap" class="form-control cal1" required onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount %</label>
									<input type="text" value="<?php echo $rrow['discount1'];?>" name="discount1" id="discount1" class="form-control cal1" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>P/C</label>
									<input type="text" value="<?php echo $rrow['pc'];?>" tabindex="-1" name="pc" id="pc" class="form-control" required onkeypress="return IsNumeric(event);" readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>LESS</label>
									<input type="text" value="<?php echo $rrow['discount2'];?>" name="discount2" id="discount2" class="form-control cal1" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>P A D</label>
									<input type="text" value="<?php echo $rrow['pad'];?>" name="pad" id="pad" class="form-control cal1" onkeypress="return IsNumeric(event);" tabindex="-1" readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount 1</label>
									<input type="text" value="<?php echo $rrow['discount3'];?>" name="discount3" id="discount3" class="form-control cal1" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>D A 1</label>
									<input type="text" value="<?php echo $rrow['extraamount1'];?>" name="extraamt" id="extraamt" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount 2</label>
									<input type="text" value="<?php echo $rrow['discount4'];?>" name="discount4" id="discount4" class="form-control cal1">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>D A 2</label>
									<input type="text" value="<?php echo $rrow['extraamount2'];?>" name="extraamt2" id="extraamt2" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount 3</label>
									<input type="text" value="<?php echo $rrow['discount5'];?>" name="discount5" id="discount5" class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>D A 3</label>
									<input type="text" value="<?php echo $rrow['extraamount3'];?>" name="extraamt3" id="extraamt3" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense 1</label>
									<input type="text" value="<?php echo $rrow['discount6'];?>" name="discount6" id="discount6" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 1</label>
									<input type="text" value="<?php echo $rrow['expense1'];?>" name="expamt1" id="expamt1" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense2</label>
									<input type="text" value="<?php echo $rrow['discount7'];?>" name="discount7" id="discount7" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 2</label>
									<input type="text" value="<?php echo $rrow['expense2'];?>" name="expamt2" id="expamt2" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense3</label>
									<input type="text" value="<?php echo $rrow['discount8'];?>" name="discount8" id="discount8" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 3</label>
									<input type="text" value="<?php echo $rrow['expense3'];?>" name="expamt3" id="expamt3" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense4</label>
									<input type="text" value="<?php echo $rrow['discount9'];?>" name="discount9" id="discount9" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 4</label>
									<input type="text" value="<?php echo $rrow['expense4'];?>" name="expamt4" id="expamt4" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>FINAL</label>
									<input type="text" value="<?php echo $rrow['final'];?>" name="final" id="final" class="form-control cal1 highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>USD</label>
									<input type="text" value="<?php echo $rrow['usd'];?>" name="usd" id="usd" tabindex="-1" readonly class="form-control cal1 highlight"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Conv</label>
									<input type="text" value="<?php echo $rrow['conv'];?>" name="conv" id="conv" class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Extra Conv</label>
									<input type="text" value="<?php echo $rrow['extraconv'];?>" name="extraconv" id="extraconv" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Total Conv</label>
									<input type="text" value="<?php echo ($rrow['conv']+$rrow['extraconv']);?>" name="totalconv" id="totalconv" class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>INR</label>
									<input type="text" value="<?php echo $rrow['inr'];?>" name="inr" id="inr" class="form-control highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
						</div>
						<hr>
						<h3>Selling Details</h3>
						<div class="row">
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Sale Type</label><br>
									<?php
									if($srow['ratetype']=='percarat'){
									echo '<input type="radio" name="slrapratecarat" value="percarat" checked >Per Carat
									<input type="radio" name="slrapratecarat" value="raprate" >RAP';
									}else{
										echo '<input type="radio" name="slrapratecarat" value="percarat" >Per Carat
									<input type="radio" name="slrapratecarat" value="raprate" checked >RAP';
									} ?>
									
								</div>
							</div>
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Current RAP Rate</label>
									<?php
									if($srow['currentsalerap']=='yes'){$chacked="checked";}else{$chacked="";}?>
									<input type="checkbox" id="currentrap3"  name="currentsalerap" value="yes" onclick="change();" <?php echo $chacked;?>>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Per Carat/RAP Rate</label>
									<input type="text" value="<?php echo $srow['rap'];?>" name="slrap" id="slrap1" class="form-control slcal1"  onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount %</label>
									<input type="text" value="<?php echo $srow['discount1'];?>" name="sldiscount1" id="sldiscount1" class="form-control slcal1" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>P/C</label>
									<input type="text" value="<?php echo $srow['pc'];?>" tabindex="-1" name="slpc" id="slpc" class="form-control"  onkeypress="return IsNumeric(event);" readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>LESS</label>
									<input type="text" value="<?php echo $srow['discount2'];?>" name="sldiscount2" id="sldiscount2" class="form-control slcal1">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>P A D</label>
									<input type="text" value="<?php echo $srow['pad'];?>" name="slpad" id="slpad" class="form-control slcal1" onkeypress="return IsNumeric(event);" tabindex="-1" readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount 1</label>
									<input type="text" value="<?php echo $srow['discount3'];?>" name="sldiscount3" id="sldiscount3" class="form-control slcal1">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>D A 1</label>
									<input type="text" value="<?php echo $srow['extraamount1'];?>" name="slextraamt" id="slextraamt" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount 2</label>
									<input type="text" value="<?php echo $srow['discount4'];?>" name="sldiscount4" id="sldiscount4" class="form-control slcal1">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>D A 2</label>
									<input type="text" value="<?php echo $srow['extraamount2'];?>" name="slextraamt2" id="slextraamt2" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount 3</label>
									<input type="text" value="<?php echo $srow['discount5'];?>" name="sldiscount5" id="sldiscount5" class="form-control slcal1" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>D A 3</label>
									<input type="text" value="<?php echo $srow['extraamount3'];?>" name="slextraamt3" id="slextraamt3" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense 1</label>
									<input type="text" value="<?php echo $srow['discount6'];?>" name="sldiscount6" id="sldiscount6" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 1</label>
									<input type="text" value="<?php echo $srow['expense1'];?>" name="slexpamt1" id="slexpamt1" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense2</label>
									<input type="text" value="<?php echo $srow['discount7'];?>" name="sldiscount7" id="sldiscount7" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 2</label>
									<input type="text" value="<?php echo $srow['expense2'];?>" name="slexpamt2" id="slexpamt2" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense3</label>
									<input type="text"  value="<?php echo $srow['discount8'];?>" name="sldiscount8" id="sldiscount8" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 3</label>
									<input type="text" value="<?php echo $srow['expense3'];?>" name="slexpamt3" id="slexpamt3" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense4</label>
									<input type="text" value="<?php echo $srow['discount9'];?>" name="sldiscount9" id="sldiscount9" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 4</label>
									<input type="text" value="<?php echo $srow['expense4'];?>" name="slexpamt4" id="slexpamt4" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>FINAL</label>
									<input type="text" value="<?php echo $srow['final'];?>" name="slfinal" id="slfinal" class="form-control slcal1 highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>USD</label>
									<input type="text" value="<?php echo $srow['usd'];?>" name="slusd" id="slusd" tabindex="-1" readonly class="form-control slcal1 highlight"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Conv</label>
									<input type="text" value="<?php echo $srow['conv'];?>" name="slconv" id="slconv" class="form-control slcal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Extra Conv</label>
									<input type="text" value="<?php echo $srow['extraconv'];?>" name="slextraconv" id="slextraconv" class="form-control slcal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Total Conv</label>
									<input type="text" value="<?php echo $srow['conv']+$srow['extraconv'];?>" name="sltotalconv" id="sltotalconv" class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>INR</label>
									<input type="text" value="<?php echo $srow['inr'];?>" name="slinr" id="slinr" class="form-control highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
						</div>
						<div class="row">
						 <div class="col-sm-12">
								<label>Upload this Diamond to Portal ?</label>
								<div>
								<?php if($row['portalshow']=='portalyes'){ ?>
								<label class="radio-inline">
								<input type="radio" name="portalshow" id="portalyes" value="portalyes" required checked>YES
								</label>
								<label class="radio-inline">
								<input type="radio" name="portalshow" id="portalno" value="portalno" required>NO
								</label>
								<?php }else{ ?>
								<label class="radio-inline">
								<input type="radio" name="portalshow" id="portalyes" value="portalyes" required >YES
								</label>
								<label class="radio-inline">
								<input type="radio" name="portalshow" id="portalno" value="portalno" required checked>NO
								</label>
								<?php } ?>
								</div>
							</div>
						</div>
								<div class="row">
									<div class="col-sm-12">
										<label>In Stock ?</label>
										<div>
										<?php if($row['instock']=='instockyes'){ ?>
										<label class="radio-inline">
										<input type="radio" name="instock" id="instockyes" value="instockyes" required checked onclick="showDateDiv()">YES
										</label>
										<label class="radio-inline">
										<input type="radio" name="instock" id="instockno" value="instockno" required onclick="showDateDiv()">NO
										</label><br>
										<div id="showDateDiv" style="display: none;" class="col-sm-4">
											<label>Arrival Date:</label>
											<input type="text" name="arrivaldate" value="<?php echo $row['arrivaldate'];?>" class="form-control datepicker">
										</div>
										<?php }else{ ?>
										<label class="radio-inline">
										<input type="radio" name="instock" id="instockyes" value="instockyes" required onclick="showDateDiv()">YES
										</label>
										<label class="radio-inline">
										<input type="radio" name="instock" id="instockno" value="instockno" required checked onclick="showDateDiv()">NO
										</label><br>
										<div id="showDateDiv" style="display: block;" class="col-sm-4">
											<label>Arrival Date:</label>
											<input type="text" name="arrivaldate" value="<?php echo $row['arrivaldate'];?>" class="form-control datepicker">
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col-sm-6">
								<h3>Summary(in USD)</h3>
								<hr>
								<table class="carttable carttable2 table table-bordered table-shadow" align="left">
									<thead>
										<tr>
											<th>Sale</th>
											<th>Purchase</th>
											<th>Result in $</th>
										</tr>
									</thead>
									<?php $resultval1= $srow['usd']-$rrow['usd'];?>
									<tbody>
										<tr>
											<td id="salevalueusd" class="sale"><?php echo $srow['usd'];?></td>
											<td id="purchasevalueusd" class="purchase"><?php echo $rrow['usd'];?></td>
											<?php if($resultval1 > 0){ ?>
											<td id="resultvalueusd" class="profit"><?php echo $resultval1;?></td>
											<?php }else{ ?>
											<td id="resultvalueusd" class="loss"><?php echo $resultval1;?></td>
											<?php } ?>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-sm-6">
								<h3>Summary(in INR)</h3>
								<hr>
								<table class="carttable carttable2 table table-bordered table-shadow" align="left">
									<thead>
										<tr>
											<th>Sale</th>
											<th>Purchase</th>
											<th>Result in INR</th>
										</tr>
									</thead>
									<?php $resultval2= $srow['inr']-$rrow['inr'];?>
									<tbody>
										<tr>
											<td id="salevalueinr" class="sale"><?php echo $srow['inr'];?></td>
											<td id="purchasevalueinr" class="purchase"><?php echo $rrow['inr'];?></td>
											<?php if($resultval2 > 0){ ?>
											<td id="resultvalueinr" class="profit"><?php echo $resultval2;?></td>
											<?php }else{ ?>
											<td id="resultvalueinr" class="loss"><?php echo $resultval2;?></td>
											<?php } ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						
			    		<button type="submit" class="btn btn-success">Submit</button>
			  		</fieldset>
				</form>
  			</div>
		</div>
	</div>
	</div>
</section>
<?php }
   }
   
   //for hold
   if(isset($hold)){
   foreach($diamondid as $key => $value)
	{
		$did = $diamondid[$key];
		$getholdcount="select * from diamond_status where diamondid=$did";
		$countres=mysqli_query($con,$getholdcount);
		while($ccn=mysqli_fetch_assoc($countres))
		{
			$holdcount1=$holdcount1+$ccn['holdcount'];
		}
		$holdcount=$holdcount1+1;
	  $currenttime=date("Y-m-d H:i:s");
			$plcaeorder2="update diamond_status set diamond_status='HOLD',holdcount='$holdcount',holdtime='$currenttime' where diamondid='$did'";
			if(mysqli_query($con,$plcaeorder2))
			{
			$minus_stock="update diamond_master set diamond_user_status='HOLD' where diamond_id='$did'";
			$stockres=mysqli_query($con,$minus_stock);
			}
	}
	
	$reminderdate=date("Y-m-d");
	   $text='Diamond Holded';
	   
	$insertmessage="INSERT INTO `notification`( `message`, `userid`, `status`, `entrydate`,`reminderdate`) VALUES ('$text','$userid','1',NOW(),'$reminderdate')";
	 if(mysqli_query($con,$insertmessage))
	 {
	   $notificationid=mysqli_insert_id($con);
	    $getAdminId=mysqli_query($con,"Select * from login where usertype='ADMIN'");
	   $adminRow=mysqli_fetch_array($getAdminId);
	   $adminId=$adminRow['userid'];
	   
	   $insertuser="INSERT INTO `notification_user`(`userid`, `notificationid`,`status`) VALUES ('$adminId','$notificationid','1')";
	   $result1=mysqli_query($con,$insertuser);
	 }
	?>
   <body onload="bootbox.alert('Diamond has been Holded.', function() {
            window.location.href='../report/viewalldiamonds.php';
				});"></body>
<?php
   }
   ?>
<?php include '../common/footer.php';?>