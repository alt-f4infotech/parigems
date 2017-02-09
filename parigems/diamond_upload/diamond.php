<?php include '../common/header.php';
$diamond_master="select * from  diamond_master";
$res=mysqli_query($con,$diamond_master);
while($yrow=mysqli_fetch_assoc($res))
{
	$referencenoo=explode('/',$yrow['referenceno']);
}
$refno=mysqli_num_rows($res)+1;

$curdate=strtotime(date('d-m-Y'));
$mydate=strtotime('01-04-'.date('Y'));
if($curdate < $mydate)
{
	$currentyear=date('y');
	$nextyear=date('Y', strtotime('-1 year'));
	$year=$nextyear.'-'.$currentyear;
}
else
{
   $currentyear=date('Y');
   $nextyear=date('y', strtotime('+1 year'));
   $year=$currentyear.'-'.$nextyear;
}

if($year==$referencenoo[0])
{
$newreferenceno	=$year.'/'.$refno;
}
else
{
$newreferenceno	=$year.'/1';	
}

?>
<section class="main-section">
	<div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
	      	<li><a href="../common/homepage.php" tabindex="-1">Home</a></li>
	      	<li class="active">Upload Diamond</li>
	   	</ol>
	</div>
	<div class="container-fluid">
		
  		<h3 class="text-left">Upload Diamond</h3>
  		<hr>
		<div class="tab-content">
  			<div id="indian-registered-companies" class="tab-pane fade in active">
				<form  action="insertdiamond.php" method="post" enctype="multipart/form-data">
					<input class="form-control" value="india" type="hidden" name="countrytype" id="countrytype" >
	  				<fieldset>
	    				<div class="row">
							 <!--<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>PG Stock ID</label>
			  						<input class="form-control" type="text" value="<?php //echo $newreferenceno;?>" name="referenceno" id="referenceno" readonly tabindex="-1">
			  					</div>
	    					</div> -->
							<div class="col-md-4 col-sm-4">
	    						<div class=" form-group">
	    							<label>Lab Report</label>
									<select name="certi_name" id="certi_name" onchange="validatecertinumber();" class="form-control" >
										<option value="">Lab Report</option>
										<?php
										$getcerti="select * from certificates where status='1'";
										$certi=mysqli_query($con,$getcerti);
										while($c=mysqli_fetch_assoc($certi)){
										echo '<option value="'.$c['cerificatename'].'">'.$c['cerificatename'].'</option>';
										} ?>										
									</select>
									<div class="alert alert-danger" id="danger-alert-lab" style="display: none;">
									<strong>Error!</strong> Select Lab
								  </div>
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
	    						<div class=" form-group">
	    							<label>Certificate Number</label>
			  						<input class="form-control" type="text" onkeyup="validatecertinumber();" onblur="validatecertinumber();" name="certi_no" id="certi_no" >		  			 <div class="alert alert-danger" id="danger-alert" style="display: none;">
									<strong>Error!</strong> Certificate Number Already Exists
								  </div>
								</div>
	    					</div>
							<div class="col-md-4 col-sm-4">
	    						<div class=" form-group">
	    							<label>Certificate Date</label>
	    							<input type="text" name="certi_date" id="certi_date" class="form-control datepicker">
								</div>
	    					</div>							
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Certificate Upload</label>
			  						<input class="form-control" type="file" name="logo" id="logo" accept=".png,.jpg,.jpeg,.pdf,.gif" >
								</div>
	    					</div>	
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Location</label>
									<select class="countries form-control" id="location" name="location"  onchange="$('#location1').val(this.value);" >
			  							<option value="">Select Location</option>
			  						</select>
									<input type="hidden" id="location1">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4" >
	    						<div class=" form-group highlight">
	    							<label><b>Diamond Shape</b></label>
									<select name="diamond_shape" id="diamond_shape1" class="dropdownselect2" required>
										<option value="">Select Diamond Shape</option>
										<?php
										$getshape="select * from shape_master  where status='1'";
										$shpe=mysqli_query($con,$getshape);
										while($s=mysqli_fetch_assoc($shpe)){
										echo '<option value="'.$s['shapename'].'">'.$s['shapename'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4 ">
	    						<div class=" form-group highlight">
	    							<label><b>Size/Carat</b></label>
			  						<input class="form-control cal1 slcal1" type="text" name="weight" id="weight1" required onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group  highlight">
	    							<label><b>Diamond Color</b></label>
									<select name="color" id="color1" class="dropdownselect2   highlight"  required>
										<option value="">Select Diamond Color</option>
										<?php
										$color="select * from  color  where status='1'";
										$clr=mysqli_query($con,$color);
										while($cr=mysqli_fetch_assoc($clr)){
										echo '<option value="'.$cr['colorname'].'">'.$cr['colorname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group highlight">
	    							<label><b>Diamond Clarity</b></label>
									<select name="clarity" id="clarity1" class="dropdownselect2"  required>
										<option value="">Select Diamond Clarity</option>
										<?php
										$clarity="select * from  clarity  where status='1'";
										$clrit=mysqli_query($con,$clarity);
										while($cl=mysqli_fetch_assoc($clrit)){
										echo '<option value="'.$cl['clarityname'].'">'.$cl['clarityname'].'</option>';
										} ?>										
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Diamond Fluorescence</label>
									<select name="fluoresence" id="fluoresence" class="dropdownselect2">
										<option value="">Select Diamond Fluorescence</option>
										<?php
										$fluorescense="select * from fluorescense  where status='1'";
										$fluro=mysqli_query($con,$fluorescense);
										while($f=mysqli_fetch_assoc($fluro)){
										echo '<option value="'.$f['fluorescence'].'">'.$f['fluorescence'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Diamond Tinge</label>
									<select name="tinge" id="tinge" class="dropdownselect2">
										<option value="">Select Diamond Tinge</option>
										<?php
										$tinge="select * from tinge  where status='1'";
										$tng=mysqli_query($con,$tinge);
										while($tg=mysqli_fetch_assoc($tng)){
										echo '<option value="'.$tg['tingename'].'">'.$tg['tingename'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4 min-height74">
	    						<div class=" form-group ">
	    							<label>3EX</label>
									<input type="radio" name="3ex" id="3ex" onclick="checkexcellent();">
	    							<label>3VG</label>
									<input type="radio" name="3ex" id="3vg" onclick="checkexcellent();">
									<label>3G</label>
									<input type="radio" name="3ex" id="3g" onclick="checkexcellent();">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Cut</label>
									<select name="cut" id="cut" class="form-control" onchange="uncheckexcellent()">
										<option value="">Select CUT</option>
										<?php
										$qry="select * from  cut_polish_sym  where status='1'";
										$run=mysqli_query($con,$qry);
										while($cps=mysqli_fetch_assoc($run)){
										echo '<option value="'.$cps['title'].'">'.$cps['title'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Polish</label>
									<select name="polish" id="polish" class="form-control" onchange="uncheckexcellent()">
										<option value="">Select Polish</option>
										<?php
										$qry="select * from  cut_polish_sym  where status='1'";
										$run=mysqli_query($con,$qry);
										while($cps=mysqli_fetch_assoc($run)){
										echo '<option value="'.$cps['title'].'">'.$cps['title'].'</option>';
										} ?>									
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Symmetry</label>
									<select name="symmetry" id="symmetry" class="form-control" onchange="uncheckexcellent()">
										<option value="">Select Symmetry</option>
										<?php
										$qry="select * from  cut_polish_sym  where status='1'";
										$run=mysqli_query($con,$qry);
										while($cps=mysqli_fetch_assoc($run)){
										echo '<option value="'.$cps['title'].'">'.$cps['title'].'</option>';
										} ?>
									</select>			  						
								</div>
	    					</div>
							
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>D1</label>
			  						<input class="form-control" type="text" name="diameter_max" id="diameter_max" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>	    				
	    					<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>D2</label>
			  						<input class="form-control" type="text" name="diameter_min" id="diameter_min" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Height</label>	    						
			  						<input class="form-control" type="text" name="height" id="height" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>DR</label>
			  						<input class="form-control" type="text" name="dratio" id="dratio" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label>Table %</label>
			  						<input class="form-control" type="text" name="table" id="table" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Depth %</label>
			  						<input class="form-control" type="text" name="depth" id="depth" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Girdle %</label>
			  						<input class="form-control" type="text" name="girdlevalue" id="girdlevalue" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>	
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label>Girdle Condition</label>
									<select name="giddle" id="giddle" class="form-control">
										<option value="">Select</option>
									<?php
										$girdle="select * from  girdle  where status='1'";
										$grdl=mysqli_query($con,$girdle);
										while($gd=mysqli_fetch_assoc($grdl)){
										echo '<option value="'.$gd['girdlename'].'">'.$gd['girdlename'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label>Girdle Min/Max</label>
			  						<div class="row">
			  							<div class="col-sm-6">
			  								<select name="giddlemin" id="giddlemin" class="form-control">
												<option value="">Select</option>
												<?php
												$girdle_min="select * from  girdle_min_max  where status='1'";
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
												$girdle_max="select * from  girdle_min_max  where status='1'";
												$grdlmax=mysqli_query($con,$girdle_max);
												while($gdmax=mysqli_fetch_assoc($grdlmax)){
												echo '<option value="'.$gdmax['girldle_min'].'">'.$gdmax['girldle_min'].'</option>';
												} ?>
											</select>
			  							</div>
			  						</div>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label>Culet</label>
									<select name="cutlet" id="cutlet" class="form-control">
										<option value="">Select</option>
									<?php
										$cutlet="select * from  cutlet  where status='1'";
										$cutl=mysqli_query($con,$cutlet);
										while($ct=mysqli_fetch_assoc($cutl)){
										echo '<option value="'.$ct['cutname'].'">'.$ct['cutname'].'</option>';
										} ?>
										</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Crown Angle &deg;</label>
			  						<input class="form-control" type="text" name="crown_angle" id="crown_angle" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
	    					<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Crown Height %</label>
			  						<input class="form-control" type="text" name="crown_height" id="crown_height" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Pavilion Angle &deg;</label>
			  						<input class="form-control" type="text" name="pavilion_angle" id="pavilion_angle" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
	    					<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Pavilion Depth %</label>
			  						<input class="form-control" type="text" name="pavilion_height" id="pavilion_height" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label> Star Length %</label>
			  						<input class="form-control" type="text" name="length" id="length" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Lower Half %</label>
			  						<input class="form-control" type="text" name="lowerhalf" id="lowerhalf" onkeypress="return IsNumeric(event);">
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>H & A / Others</label>
			  						<input class="form-control" type="text" name="H_A" id="H_A" >
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Milky</label>
									<select name="milky" id="milky" class="form-control">
										<option value="">Select</option>
										<?php
										$milky="select * from  milky  where status='1'";
										$mlk=mysqli_query($con,$milky);
										while($ml=mysqli_fetch_assoc($mlk)){
										echo '<option value="'.$ml['milkyname'].'">'.$ml['milkyname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Black Inclusion</label>
									<select name="black_inclusion" id="black_inclusion" class="form-control">
										<option value="">Select</option>
									<?php
										$black_inclusion="select * from  black_inclusion  where status='1'";
										$blckincl=mysqli_query($con,$black_inclusion);
										while($b=mysqli_fetch_assoc($blckincl)){
										echo '<option value="'.$b['blackinclusionname'].'">'.$b['blackinclusionname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Brown Inclusion</label>
									<select name="brown_inclusion" id="brown_inclusion" class="form-control">
										<option value="">Select</option>
									<?php
										$brown_inclusion="select * from  brown_inclusion  where status='1'";
										$brownincl=mysqli_query($con,$brown_inclusion);
										while($br=mysqli_fetch_assoc($brownincl)){
										echo '<option value="'.$br['browninclusionname'].'">'.$br['browninclusionname'].'</option>';
										} ?>
									</select>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Inclusion Visibility</label>
			  						<div>
									<?php
										$inclusion_visibility="select * from  inclusion_visibility  where status='1'";
										$incl=mysqli_query($con,$inclusion_visibility);
										while($in=mysqli_fetch_assoc($incl)){
										echo '<label class="radio-inline"><input type="radio" value="'.$in['inclusionname'].'" name="inclusive_visibility">'.$in['inclusionname'].'</label>';
										} ?>
									</div>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Type II A</label>
			  						<div>
										<label><input type="radio" name="type_IIA" value="yes"> Yes</label>
										<label><input type="radio" name="type_IIA" value="no"> No</label>
									</div>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label>Type II B</label>
			  						<div>
										<label><input type="radio" name="type_IIB" value="yes"> Yes</label>
										<label><input type="radio" name="type_IIB" value="no"> No</label>
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
													$key_symbol="select * from  key_symbol  where status='1'";
													$ksmbl=mysqli_query($con,$key_symbol);
													while($ks=mysqli_fetch_assoc($ksmbl)){
														echo '<li><label class="font-noraml"><input type="checkbox" name="key_to_symbol[]" id="key_to_symbol" value="'.$ks['keysymbol'].'"> &nbsp;&nbsp;'.$ks['keysymbol'].'</label></li>';
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
			  						<input class="form-control" type="text" name="comments" id="comments" >			  						
								</div>
	    					</div>
							<div class="col-sm-6">
	    						<div class=" form-group">
			  						<label>Video Link</label>
			  						<input class="form-control" type="text" name="videolink" id="videolink" >			  						
								</div>
	    					</div>
							<div class="col-sm-6">
								<div class=" form-group">
							  		<label for="invoiceno">Purchase Stock Id</label>
									<input class="form-control" type="text" name="purchase_stockid" id="purchase_stockid" >
								</div>
							</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label>Laser Inscript</label>
	    							<div class="min-height34">
				  						<label class="radio-inline">
				  							<input type="radio" name="ledger" value="yes" >Yes
				  						</label>
				  						<label class="radio-inline">				
				  							<input type="radio" name="ledger" value="no" checked>No
				  						</label>
			  						</div>
								</div>
	    					</div>
	    				</div>
						<div class="row">
							<div class="col-sm-12">
	    						<div class=" form-group">
			  						<label>Fancy Color</label>
			  						<div >
			  							<label class="radio-inline">
									 		<input type="radio" name="fancy" value="no" onclick="document.getElementById('showfancy').style.opacity='0.3';$('#fancyintensity').val('');$('#fancyovertone').val('');$('#fancycolor1').val('');document.getElementById('showfancy').style.pointerEvents = 'none';$('#color1').prop('required', true);$('#clarity1').prop('required', true);$('#diamond_shape1').prop('required', true);" checked> No 
									 	</label>
									 	<label class="radio-inline">
									 		<input type="radio" name="fancy" id="fancyyes" value="yes" onclick="document.getElementById('showfancy').style.opacity='1';document.getElementById('showfancy').style.pointerEvents = 'auto';$('#color1').prop('required', false);$('#clarity1').prop('required', false);$('#diamond_shape1').prop('required', false);"> Yes 
									 	</label>
									 </div>
								</div>
								<div id="showfancy" class="row" style="opacity: 0.3;pointer-Events:none;">
									<div class="col-sm-4">
										<label>Fancy Color Intensity</label>
				  						<select class="form-control" name="fancyintensity" id="fancyintensity">
											<option value="">Select</option>
										<?php
											$fancy_color_intensity="select * from  fancy_color_intensity  where status='1'";
											$fancyclrintense=mysqli_query($con,$fancy_color_intensity);
											while($fcns=mysqli_fetch_assoc($fancyclrintense)){
											echo '<option value="'.$fcns['fancy_intensity'].'">'.$fcns['fancy_intensity'].'</option>';
											} ?>
										</select>						
								     </div>
									<div class="col-sm-4">
										<label>Overtone / Modifier</label>
										<select class="form-control" name="fancyovertone" id="fancyovertone">
											<option value="">Select</option>
										<?php
											$fancy_overtone="select * from  fancy_overtone  where status='1'";
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
											$fancy_color="select * from  fancy_color  where status='1'";
											$fancyclr=mysqli_query($con,$fancy_color);
											while($fc=mysqli_fetch_assoc($fancyclr)){
											echo '<option value="'.$fc['fancycolor'].'">'.$fc['fancycolor'].'</option>';
											} ?>
										</select>			  						
								     </div>
								</div>
	    					</div>
						</div>
						<h3 class="text-left">Purchase Details</h3>
						<hr>					
						<div class="row">
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Purchase Type</label><br>
									<label><input type="radio" name="rapratecarat" value="percarat" required>Per Carat</label>
									<label><input type="radio" name="rapratecarat" value="raprate" required>RAP</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Current RAP Rate
									<input type="checkbox" id="currentrap2" name="currentpurchaserap" value="yes" onclick="change();"></label>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Per Carat/RAP Rate</label>
									<input type="text" name="rap" id="rap" class="form-control cal1" required onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount %</label>
									<input type="text" name="discount1" id="discount1" class="form-control cal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>P/C</label>
									<input type="text" tabindex="-1" name="pc" id="pc" class="form-control" required onkeypress="return IsNumeric(event);" readonly>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>LESS</label>
									<input type="text" name="discount2" id="discount2" class="form-control cal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>P A D</label>
									<input type="text" name="pad" id="pad" class="form-control cal1" onkeypress="return IsNumeric(event);" tabindex="-1" readonly>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount 1</label>
									<input type="text" name="discount3" id="discount3" class="form-control cal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>D A 1</label>
									<input type="text" name="extraamt" id="extraamt" tabindex="-1" readonly class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount 2</label>
									<input type="text" name="discount4" id="discount4" class="form-control cal1" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>D A 2</label>
									<input type="text" name="extraamt2" id="extraamt2" tabindex="-1" readonly class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount 3</label>
									<input type="text" name="discount5" id="discount5" class="form-control cal1" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>D A 3</label>
									<input type="text" name="extraamt3" id="extraamt3" tabindex="-1" readonly class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense 1</label>
									<input type="text" name="discount6" id="discount6" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 1</label>
									<input type="text" name="expamt1" id="expamt1" tabindex="-1" readonly class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense2</label>
									<input type="text" name="discount7" id="discount7" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 2</label>
									<input type="text" name="expamt2" id="expamt2" tabindex="-1" readonly class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense3</label>
									<input type="text" name="discount8" id="discount8" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 3</label>
									<input type="text" name="expamt3" id="expamt3" tabindex="-1" readonly class="form-control cal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense4</label>
									<input type="text" name="discount9" id="discount9" class="form-control cal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 4</label>
									<input type="text" name="expamt4" id="expamt4" tabindex="-1" readonly class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>FINAL</label>
									<input type="text" name="final" id="final" class="form-control cal1 highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>USD</label>
									<input type="text" name="usd" id="usd" tabindex="-1" readonly class="form-control cal1 highlight"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Conv</label>
									<input type="text" name="conv" id="conv" class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Extra Conv</label>
									<input type="text" name="extraconv" id="extraconv" class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Total Conv</label>
									<input type="text" name="totalconv" id="totalconv" class="form-control cal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>INR</label>
									<input type="text" name="inr" id="inr" class="form-control highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
						</div>
						<hr>
						<h3>Selling Details</h3>
						<div class="row">
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Sell Type</label><br>
									<label><input type="radio" name="slrapratecarat" value="percarat" >Per Carat</label>
									<label><input type="radio" name="slrapratecarat" value="raprate" >RAP</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label>Current RAP Rate
									<input type="checkbox" id="currentrap3" name="currentsalerap" value="yes" onclick="change();"></label>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Per Carat/RAP Rate</label>
									<input type="text" name="slrap" id="slrap1" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount %</label>
									<input type="text" name="sldiscount1" id="sldiscount1" class="form-control slcal1">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>P/C</label>
									<input type="text" tabindex="-1" name="slpc" id="slpc" class="form-control"  onkeypress="return IsNumeric(event);" readonly>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>LESS</label>
									<input type="text" name="sldiscount2" id="sldiscount2" class="form-control slcal1" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>P A D</label>
									<input type="text" name="slpad" id="slpad" class="form-control slcal1" onkeypress="return IsNumeric(event);" tabindex="-1" readonly>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount 1</label>
									<input type="text" name="sldiscount3" id="sldiscount3" class="form-control slcal1">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>D A 1</label>
									<input type="text" name="slextraamt" id="slextraamt" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount 2</label>
									<input type="text" name="sldiscount4" id="sldiscount4" class="form-control slcal1">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>D A 2</label>
									<input type="text" name="slextraamt2" id="slextraamt2" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Discount 3</label>
									<input type="text" name="sldiscount5" id="sldiscount5" class="form-control slcal1">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>D A 3</label>
									<input type="text" name="slextraamt3" id="slextraamt3" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense 1</label>
									<input type="text" name="sldiscount6" id="sldiscount6" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 1</label>
									<input type="text" name="slexpamt1" id="slexpamt1" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense2</label>
									<input type="text" name="sldiscount7" id="sldiscount7" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 2</label>
									<input type="text" name="slexpamt2" id="slexpamt2" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense3</label>
									<input type="text" name="sldiscount8" id="sldiscount8" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 3</label>
									<input type="text" name="slexpamt3" id="slexpamt3" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense4</label>
									<input type="text" name="sldiscount9" id="sldiscount9" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Expense Amount 4</label>
									<input type="text" name="slexpamt4" id="slexpamt4" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>FINAL</label>
									<input type="text" name="slfinal" id="slfinal" class="form-control slcal1 highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>USD</label>
									<input type="text" name="slusd" id="slusd" tabindex="-1" readonly class="form-control slcal1 highlight"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Conv</label>
									<input type="text" name="slconv" id="slconv" class="form-control slcal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Extra Conv</label>
									<input type="text" name="slextraconv" id="slextraconv" class="form-control slcal1"  onkeypress="return IsNumeric(event);">
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>Total Conv</label>
									<input type="text" name="sltotalconv" id="sltotalconv" class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label>INR</label>
									<input type="text" name="slinr" id="slinr" class="form-control highlight" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<label>Upload this Diamond to Portal ?</label>
								<div>
									<label class="radio-inline">
										<input type="radio" name="portalshow" id="portalyes" value="portalyes" required>YES
									</label>
									<label class="radio-inline">
										<input type="radio" name="portalshow" id="portalno" value="portalno" required>NO
									</label>
								</div>
							</div>
							<div class="col-sm-6">
								<label>In Stock ?</label>
								<div>
									<label class="radio-inline">
										<input type="radio" name="instock" id="instockyes" value="instockyes" required onclick="showDateDiv()">YES
									</label>
									<label class="radio-inline">
										<input type="radio" name="instock" id="instockno" value="instockno" required onclick="showDateDiv()">NO
									</label>
								</div>
								<div id="showDateDiv" style="display: none;" class="col-sm-4">
									<label>Arrival Date:</label>
									<input type="text" name="arrivaldate" class="form-control datepicker">
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
											<th>Sell</th>
											<th>Purchase</th>
											<th>Result in $</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td id="salevalueusd" class="sale"></td>
											<td id="purchasevalueusd" class="purchase"></td>
											<td id="resultvalueusd"></td>
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
											<th>Sell</th>
											<th>Purchase</th>
											<th>Result in INR</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td id="salevalueinr" class="sale"></td>
											<td id="purchasevalueinr" class="purchase"></td>
											<td id="resultvalueinr"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
			    		<!--<button type="submit" class="btn btn-success">Submit</button>-->
			    		<button type="button" id="confirmbutton" onclick="showdiamondModal();" class="btn btn-success">Confirm Details</button>
						<script>
		function showdiamondModal()
        {
		referenceno = $('#referenceno').val();
		certi_name = $('#certi_name').val();
		certi_no = $('#certi_no').val();
		certi_date = $('#certi_date').val();
		location1 = $('#location1').val();
		diamond_shape1 = $('#diamond_shape1').val();
		weight1 = $('#weight1').val();
		color1 = $('#color1').val();
		clarity1 = $('#clarity1').val();
		fluoresence = $('#fluoresence').val();
		tinge = $('#tinge').val();
		cut = $('#cut').val();
		polish = $('#polish').val();
		symmetry = $('#symmetry').val();
		diameter_max = $('#diameter_max').val();
		diameter_min = $('#diameter_min').val();
		height = $('#height').val();
		dratio = $('#dratio').val();
		table = $('#table').val();
		depth = $('#depth').val();
		girdlevalue = $('#girdlevalue').val();
		giddle = $('#giddle').val();
		giddlemin = $('#giddlemin').val();
		giddlemax = $('#giddlemax').val();
		cutlet = $('#cutlet').val();
		crown_angle = $('#crown_angle').val();
		crown_height = $('#crown_height').val();
		pavilion_angle = $('#pavilion_angle').val();
		pavilion_height = $('#pavilion_height').val();
		length = $('#length').val();
		lowerhalf = $('#lowerhalf').val();
		H_A = $('#H_A').val();
		milky = $('#milky').val();
		black_inclusion = $('#black_inclusion').val();
		brown_inclusion = $('#brown_inclusion').val();
		comments = $('#comments').val();
		videolink = $('#videolink').val();
		purchase_stockid = $('#purchase_stockid').val();
		fancyintensity = $('#fancyintensity').val();
		fancyovertone = $('#fancyovertone').val();
		fancycolor1 = $('#fancycolor1').val();
		inclusive_visibility=$('input[name=inclusive_visibility]:checked').val();
		ledger=$('input[name=ledger]:checked').val();
		var keysymbol = [];
            $.each($("input[name='key_to_symbol[]']:checked"), function(){            
                keysymbol.push($(this).val());
            });
		//purchase
		rapratecarat=$('input[name=rapratecarat]:checked').val();
		rap = $('#rap').val();
		discount1 = $('#discount1').val();
		pc = $('#pc').val();
		discount2 = $('#discount2').val();
		pad = $('#pad').val();
		discount3 = $('#discount3').val();
		extraamt = $('#extraamt').val();
		discount4 = $('#discount4').val();
		extraamt2 = $('#extraamt2').val();
		discount5 = $('#discount5').val();
		extraamt3 = $('#extraamt3').val();
		discount6 = $('#discount6').val();
		expamt1 = $('#expamt1').val();
		discount7 = $('#discount7').val();
		expamt2 = $('#expamt2').val();
		discount8 = $('#discount8').val();
		expamt3 = $('#expamt3').val();
		discount9 = $('#discount9').val();
		expamt4 = $('#expamt4').val();
		final = $('#final').val();
		usd = $('#usd').val();
		conv = $('#conv').val();
		extraconv = $('#extraconv').val();
		totalconv = $('#totalconv').val();
		inr = $('#inr').val();
		
		//sale
		slrapratecarat=$('input[name=slrapratecarat]:checked').val();
		slrap = $('#slrap1').val();
		sldiscount1 = $('#sldiscount1').val();
		slpc = $('#slpc').val();
		sldiscount2 = $('#sldiscount2').val();
		slpad = $('#slpad').val();
		sldiscount3 = $('#sldiscount3').val();
		slextraamt = $('#slextraamt').val();
		sldiscount4 = $('#sldiscount4').val();
		slextraamt2 = $('#slextraamt2').val();
		sldiscount5 = $('#sldiscount5').val();
		slextraamt3 = $('#slextraamt3').val();
		sldiscount6 = $('#sldiscount6').val();
		slexpamt1 = $('#slexpamt1').val();
		sldiscount7 = $('#sldiscount7').val();
		slexpamt2 = $('#slexpamt2').val();
		sldiscount8 = $('#sldiscount8').val();
		slexpamt3 = $('#slexpamt3').val();
		sldiscount9 = $('#sldiscount9').val();
		slexpamt4 = $('#slexpamt4').val();
		slfinal = $('#slfinal').val();
		slusd = $('#slusd').val();
		slconv = $('#slconv').val();
		slextraconv = $('#slextraconv').val();
		sltotalconv = $('#sltotalconv').val();
		slinr = $('#slinr').val();
		
		res="&referenceno="+referenceno+"&certi_name="+certi_name+"&certi_no="+certi_no+"&certi_date="+certi_date+"&diamond_shape1="+diamond_shape1+"&weight1="+weight1+"&color1="+color1+"&clarity1="+clarity1+"&fluoresence="+fluoresence+"&tinge="+tinge+"&cut="+cut+"&polish="+polish+"&symmetry="+symmetry+"&diameter_max="+diameter_max+"&diameter_min="+diameter_min+"&height="+height+"&dratio="+dratio+"&table="+table+"&depth="+depth+"&girdlevalue="+girdlevalue+"&giddle="+giddle+"&giddlemin="+giddlemin+"&giddlemax="+giddlemax+"&cutlet="+cutlet+"&crown_angle="+crown_angle+"&crown_height="+crown_height+"&pavilion_angle="+pavilion_angle+"&pavilion_height="+pavilion_height+"&length="+length+"&lowerhalf="+lowerhalf+"&H_A="+H_A+"&milky="+milky+"&black_inclusion="+black_inclusion+"&comments="+comments+"&videolink="+videolink+"&purchase_stockid="+purchase_stockid+"&fancyintensity="+fancyintensity+"&fancyovertone="+fancyovertone+"&fancycolor1="+fancycolor1+"&inclusive_visibility="+inclusive_visibility+"&ledger="+ledger+"&keysymbol="+keysymbol+"&rapratecarat="+rapratecarat+"&rap="+rap+"&discount1="+discount1+"&pc="+pc+"&discount2="+discount2+"&pad="+pad+"&discount3="+discount3+"&extraamt="+extraamt+"&discount4="+discount4+"&extraamt2="+extraamt2+"&discount5="+discount5+"&extraamt3="+extraamt3+"&discount6="+discount6+"&expamt1="+expamt1+"&discount7="+discount7+"&expamt2="+expamt2+"&discount8="+discount8+"&expamt3="+expamt3+"&discount9="+discount9+"&expamt4="+expamt4+"&final="+final+"&usd="+usd+"&conv="+conv+"&extraconv="+extraconv+"&totalconv="+totalconv+"&inr="+inr+"&slrapratecarat="+slrapratecarat+"&slrap="+slrap+"&sldiscount1="+sldiscount1+"&slpc="+slpc+"&sldiscount2="+sldiscount2+"&slpad="+slpad+"&sldiscount3="+sldiscount3+"&slextraamt="+slextraamt+"&sldiscount4="+sldiscount4+"&slextraamt2="+slextraamt2+"&sldiscount5="+sldiscount5+"&slextraamt3="+slextraamt3+"&sldiscount6="+sldiscount6+"&slexpamt1="+slexpamt1+"&sldiscount7="+sldiscount7+"&slexpamt2="+slexpamt2+"&sldiscount8="+sldiscount8+"&slexpamt3="+slexpamt3+"&sldiscount9="+sldiscount9+"&slexpamt4="+slexpamt4+"&slfinal="+slfinal+"&slusd="+slusd+"&slconv="+slconv+"&slextraconv="+slextraconv+"&sltotalconv="+sltotalconv+"&slinr="+slinr+"&location="+location1+"&brown_inclusion="+brown_inclusion;
		//alert(res);
		 $.get('confirmdetails.php?res='+res, function(html){
                $('#myModalconfirm .modal-body').html(html);
               $('#myModalconfirm').modal('show', {backdrop: 'static'});
            });
		
		}
	</script>
	<div class="modal fade" id="myModalconfirm" role="dialog" style="z-index: 10000;">
    <div class="modal-dialog" style="width: 80%;">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
	       <div class="modal-body" style="z-index: 10000;">
		   </div>
	    </div>
	  </div>
	</div>
			  		</fieldset>
				</form>
  			</div>
		</div>
	</div>
</section>
<?php include '../common/footer.php';?>