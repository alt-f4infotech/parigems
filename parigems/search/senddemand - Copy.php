<?php
  include '../common/header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/search.css"/>
<body onload="reactivate();">
  <section class="main-section">
    <div class="container-fluid">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Search</li>
      </ol>
<form class="form-horizontal" action="submitdemand.php" method="post">
<div class="panel panel-default">
  <div class="panel-body">
  <div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-11">
		<div class="shape">
		  <ul class="list-shape">
			<li>
			  <div class="selectallbtn allbtn">
				<label for="chk">
				<span class="all font25">
				ALL                         
				</span>
				<small>SHAPES</small>
				</label>
				<input type="checkbox" style="display: none;"  id="chk" name="chk" value="chk" onclick="check_all(chk);" class="counter">
			  </div>
			</li>
			<?php
				$getshape2="select distinct shapename,image1 from shape_master where status='1'";
			  $shpe2=mysqli_query($con,$getshape2);
			  while($s=mysqli_fetch_assoc($shpe2)){
			  ?>
			<li>
			  <div class="">
				<label for="<?php echo trim($s['shapename'])?>"  class="shape-btn ">
				  <div class="bg-img1"  style="background: url('<?php echo $s['image1']?>') no-repeat left top;height: 42px;margin: 0 auto;width: 42px;"></div>
				  <small><?php echo $s['shapename']?></small>
				</label>
				<input type="checkbox"  style="display: none;" name="check[]" id="<?php echo trim($s['shapename'])?>" value="<?php echo trim($s['shapename'])?>" class="counter"  />
			  </div>
			</li>
			<?php }
			?>
		  </ul>
		</div>
	</div>
  </div>
</div>
<div class="row">
  <div class="col-sm-1">
	<label>Pointer</label>
  </div>
  <div class="col-sm-11">
  <label for="0.30-0.34" class="btn push-btn">0.30-0.34</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.30 AND 0.34" id="0.30-0.34" class="counter">
  <label for="0.35-0.39" class="btn push-btn">0.35-0.39</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.35 AND 0.39" id="0.35-0.39" class="counter">
  <label for="0.40-0.49" class="btn push-btn">0.40-0.49</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.40 AND 0.49" id="0.40-0.49" class="counter">
  <label for="0.50-0.59" class="btn push-btn">0.50-0.59</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.50 AND 0.59" id="0.50-0.59" class="counter">
  <label for="0.60-0.69" class="btn push-btn">0.60-0.69</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.60 AND 0.69" id="0.60-0.69" class="counter">
  <label for="0.70-0.79" class="btn push-btn">0.70-0.79</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.70 AND 0.79" id="0.70-0.79" class="counter">
  <label for="0.80-0.89" class="btn push-btn">0.80-0.89</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.80 AND 0.89" id="0.80-0.89" class="counter">
  <label for="0.90-0.94" class="btn push-btn">0.90-0.94</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.90 AND 0.94" id="0.90-0.94" class="counter">
  <label for="0.95-0.99" class="btn push-btn">0.95-0.99</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="0.95 AND 0.99" id="0.95-0.99" class="counter">
  <label for="1.00-1.09" class="btn push-btn">1.00-1.09</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.00 AND 1.09" id="1.00-1.09" class="counter">
  <label for="1.10-1.19" class="btn push-btn">1.10-1.19</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.10 AND 1.19" id="1.10-1.19" class="counter"><br>
  <label for="1.20-1.29" class="btn push-btn">1.20-1.29</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.20 AND 1.29" id="1.20-1.29" class="counter">
  <label for="1.30-1.39" class="btn push-btn">1.30-1.39</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.30 AND 1.39" id="1.30-1.39" class="counter">
  <label for="1.40-1.49" class="btn push-btn">1.40-1.49</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.40 AND 1.49" id="1.40-1.49" class="counter">
  <label for="1.50-1.69" class="btn push-btn">1.50-1.69</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.50 AND 1.69" id="1.50-1.69" class="counter">
  <label for="1.70-1.99" class="btn push-btn">1.70-1.99</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="1.70 AND 1.99" id="1.70-1.99" class="counter">
  <label for="2.00-2.49" class="btn push-btn">2.00-2.49</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="2.00 AND 2.49" id="2.00-2.49" class="counter">
  <label for="2.50-2.99" class="btn push-btn">2.50-2.99</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="2.50 AND 2.99" id="2.50-2.99" class="counter">
  <label for="3.00-3.99" class="btn push-btn">3.00-3.99</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="3.00 AND 3.99" id="3.00-3.99" class="counter">
  <label for="4.00-4.99" class="btn push-btn">4.00-4.99</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="4.00 AND 4.99" id="4.00-4.99" class="counter">
  <label for="5.00-5.99" class="btn push-btn">5.00-5.99</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="5.00 AND 5.99" id="5.00-5.99" class="counter">
  <label for="6+" class="btn push-btn">6+</label>
  <input type="checkbox" style="display: none;" name="pointer[]" value="6" id="6+" class="counter">
  </div>
</div>
<div class="row">
  <div class="col-sm-6 col-xs-12">
	  <div class="row">
			<div class="col-sm-2">
			  <label>Carat</label>
			</div>
			<div class="col-sm-10">
			  <input type="text" class=" counter" value="<?php echo $searchResult['caret_from'];?>" name="caretfrom" id="caretfrom" />
			  <span>&nbsp;TO&nbsp;</span>
			  <input type="text" class=" counter" value="<?php echo $searchResult['caret_to'];?>" name="caretto" id="caretto"/>
			</div>
		</div>
	  <div class="row">
		   <div class="col-sm-2">
			 <label>Color</label>
		   </div>
		   <div class="col-sm-10">
			<?php
			$color="select * from  color where status='1'";
			$clr=mysqli_query($con,$color);
			while($cr=mysqli_fetch_assoc($clr)){
			?>
		  <label for="color<?php echo $cr['colorname'];?>" class="btn push-btn"><?php echo $cr['colorname'];?></label>
		  <input type="checkbox" style="display: none;" name="color[]" value="<?php echo $cr['colorname'];?>" id="color<?php echo $cr['colorname'];?>" class="counter">
		  <?php }?>
			  </div>
			  </div>

			      <div class="row">
							<div class="col-sm-2">
<label>Ex. Search</label>
							</div>
							<div class="col-sm-10">
<label for="excellent" class="btn push-btn">3 EX</label>
                      <input type="checkbox" onclick="checkexc()" style="display: none;" name="ex[]" value="3EX" id="excellent"  class="counter">
                      <label for="excellent2" class="btn push-btn">2 EX</label>
                      <input type="checkbox" onclick="checkexc2()" style="display: none;" name="ex[]" value="2EX" id="excellent2"  class="counter">
                      <label for="excellentvg" class="btn push-btn">3 VG <i class="fa fa-long-arrow-up"></i></label>
                      <input type="checkbox" onclick="checkexc3()" style="display: none;" name="ex[]" value="3VG" id="excellentvg"  class="counter">
							</div>

				  </div>
			      <div class="row">
							<div class="col-sm-2">
<label>Cut</label>
							</div>
<div class="col-sm-10">
 <?php
  $qry="select * from  cut_polish_sym where status='1'";
  $run=mysqli_query($con,$qry);
  while($cps=mysqli_fetch_assoc($run)){ ?>
<label for="cut<?php echo $cps['title'];?>" class="btn push-btn cut<?php echo $cps['title'];?>"><?php echo $cps['semi'];?></label>
<input type="checkbox" style="display: none;" name="cut[]" value="<?php echo $cps['title'];?>" id="cut<?php echo $cps['title'];?>"  class="counter">
<?php }?>
</div>
				  </div>
			      <div class="row">
							<div class="col-sm-2">
							<label>Polish</label>
							</div>
							<div class="col-sm-10">
<?php			
$qry="select * from  cut_polish_sym where status='1'";
$run=mysqli_query($con,$qry);
while($cps=mysqli_fetch_assoc($run)){ ?>
<label for="polish<?php echo $cps['title'];?>" class="btn push-btn polish<?php echo $cps['title'];?>"><?php echo $cps['semi'];?></label>
<input type="checkbox" style="display: none;" name="polish[]" value="<?php echo $cps['title'];?>" id="polish<?php echo $cps['title'];?>" class="counter">
<?php }?>
</div>

				  </div>
			      <div class="row">
							<div class="col-sm-2">
<label>Symmetry</label>
							</div>
							<div class="col-sm-10">
	<?php
$qry="select * from  cut_polish_sym where status='1'";
$run=mysqli_query($con,$qry);
while($cps=mysqli_fetch_assoc($run)){ ?>
<label for="symm<?php echo $cps['title'];?>" class="btn push-btn symm<?php echo $cps['title'];?>"><?php echo $cps['semi'];?></label>
<input type="checkbox" style="display: none;" name="symmetry[]" value="<?php echo $cps['title'];?>" id="symm<?php echo $cps['title'];?>" class="counter">
<?php }?>
</div>
</div>
			      <div class="row">
							<div class="col-sm-2">
								<label>Flurosence</label>
							</div>
							<div class="col-sm-10">
						<?php
                          $fluorescense="select * from fluorescense where status='1'";
                          $fluro=mysqli_query($con,$fluorescense);
                          while($f=mysqli_fetch_assoc($fluro)){ ?>
                        <label for="fluor<?php echo $f['fluorescence'];?>" class="btn push-btn"><?php echo $f['semi'];?></label>
                        <input type="checkbox" style="display: none;" name="fluor[]" value="<?php echo $f['fluorescence'];?>" id="fluor<?php echo $f['fluorescence'];?>" class="counter">
                        <?php } ?>
							</div>

				  </div>
			      <div class="row">
							<div class="col-sm-2">
	<label>Tinge</label>
							</div>
							<div class="col-sm-10">
<?php
$tinge=mysqli_query($con,"select * from tinge where  status='1'");
while($tg=mysqli_fetch_assoc($tinge)){ ?>
<label for="tinge<?php echo $tg['tingename'];?>" class="btn push-btn"><?php echo $tg['tingename'];?></label>
<input type="checkbox" style="display: none;" name="tinge[]" value="<?php echo $tg['tingename'];?>" id="tinge<?php echo $tg['tingename'];?>" class="counter">
<?php }?>
	</div>

				  </div>				
				<div class="row">
				  <div class="col-sm-2">
					<label>Price</label>
				  </div>
				  <div class="col-sm-10">
					<input type="text" class="counter" name="priceFrom" id="priceFrom" value="<?php echo $priceFrom;?>">
					  <input type="text" class="counter" name="priceTo" id="priceTo" value="<?php echo $priceTo;?>">
				  </div>
				</div>
			  </div>
			<div class="col-sm-6 col-xs-12">
   <div class="row">
						<div class="col-sm-1">
						<label>Lab</label>
						</div>
						<div class="col-sm-11">
<?php	
$getcerti2="select * from certificates  where status='1'";
$certi2=mysqli_query($con,$getcerti2);
while($c=mysqli_fetch_assoc($certi2)){
?>
<div class="col-sm-3">
<label for="<?php echo $c['cerificatename'];?>" class="btn btn-default cert-btn">
<img class="cert-img img-responsive" src="<?php echo $c['image'];?>">
</label>
<input type="checkbox" style="display: none;" name="cerificate[]" id="<?php echo $c['cerificatename'];?>" value="<?php echo $c['cerificatename'];?>" class="counter" />
</div>
<?php } ?>
</div>
</div>
				  <div class="row">
						<div class="col-sm-1">
<label>Clarity</label>
						</div>
						<div class="col-sm-11">
 <?php
$clarity="select * from  clarity where status='1'";
$clrit=mysqli_query($con,$clarity);
while($cl=mysqli_fetch_assoc($clrit)){ ?>
<label for="clarity<?php echo $cl['clarityname'];?>" class="btn push-btn"><?php echo $cl['clarityname'];?></label>
<input type="checkbox" style="display: none;" name="clarity[]" value="<?php echo $cl['clarityname'];?>" id="clarity<?php echo $cl['clarityname'];?>" class="counter">
<?php } ?>
</div>
</div>
				  <div class="row">
						<div class="col-sm-1">
							<label>Culet</label>
						</div>
						<div class="col-sm-10">
<?php
$cutlet="select * from  cutlet  where  status='1'";
$cutl=mysqli_query($con,$cutlet);
while($ct=mysqli_fetch_assoc($cutl)){ ?>
<label for="culet<?php echo $ct['cutname'];?>" class="btn push-btn"><?php echo $ct['semi'];?></label>
<input type="checkbox" style="display: none;" name="culet[]" value="<?php echo $ct['cutname'];?>" id="culet<?php echo $ct['cutname'];?>" class="counter">
<?php }?>
</div>
</div>

			      <div class="row">
							<div class="col-sm-2">
	<label>PG Stock Id</label>
							</div>
							<div class="col-sm-10">
<input type="text">
							</div>

				  </div>
				   <div class="row">
						<div class="col-sm-2">
	<label>ReportNumber</label>
						</div>
						<div class="col-sm-10">
 <input type="text" class="counter" name="certificateno" id="certificateno" value="<?php echo $referenceno;?>">
						</div>

				  </div>
				   <div class="row">
						<div class="col-sm-3">
<label>Black Inclusion</label>
						</div>
						<div class="col-sm-9">
 <select class="counter" name="blackinclfrom" id="blackinclfrom">
                              <option value="">Select</option>
							  <?php 
								$black_inclusion="select * from  black_inclusion  where status='1'";
								$blckincl=mysqli_query($con,$black_inclusion);
								while($b=mysqli_fetch_assoc($blckincl)){?>
                                <option value="<?php echo $b['blackinclusionname'];?>"><?php echo $b['blackinclusionname'];?></option>
                              <?php	} ?>
                            </select>
                            <select class=" counter" name="blackinclto" id="blackinclto">
                              <option value="">Select</option>
							  <?php 
								$black_inclusion="select * from  black_inclusion  where status='1'";
								$blckincl=mysqli_query($con,$black_inclusion);
								while($b=mysqli_fetch_assoc($blckincl)){?>
                                <option value="<?php echo $b['blackinclusionname'];?>"><?php echo $b['blackinclusionname'];?></option>
                              <?php	} ?>
                            </select>
						</div>

				  </div>
				   <div class="row">
						<div class="col-sm-3">
<label>Milky</label>
						</div>
						<div class="col-sm-9">
<select class=" counter" id="milkyfrom" name="milkyfrom">
                              <option value="">Select</option>
							  <?php 
                              $milky="select * from  milky  where status='1'";
                              $mlk=mysqli_query($con,$milky);
                              while($ml=mysqli_fetch_assoc($mlk)){ ?>
                                <option value="<?php echo $ml['milkyname'];?>"><?php echo $ml['milkyname'];?></option>
                              <?php } ?>
                            </select>
                            <select class=" counter" id="milkyto" name="milkyto">
                              <option value="">Select</option>
							 <?php 
                              $milky="select * from  milky  where status='1'";
                              $mlk=mysqli_query($con,$milky);
                              while($ml=mysqli_fetch_assoc($mlk)){ ?>
                                <option value="<?php echo $ml['milkyname'];?>"><?php echo $ml['milkyname'];?></option>
                              <?php } ?>
                            </select>
						</div>

				  </div>
				  <div class="row">
						<div class="col-sm-3">
<label>Inclusion Visibility</label>
						</div>
						<div class="col-sm-9">
	<?php
							  $inclusion_visibility="select * from  inclusion_visibility  where status='1'";
						$incl=mysqli_query($con,$inclusion_visibility);
						while($in=mysqli_fetch_assoc($incl)){
							echo '<label><input type="radio" value="'.$in['inclusionname'].'" name="inclusive_visibility" class="counter" > '.$in['inclusionname'].'</label>';
						} ?>
						</div>

				  </div>
				  <div class="row">
						<div class="col-sm-3">
	<label>New Arrival</label>
						</div>
						<div class="col-sm-9">
					  <label><input type="radio" class="counter" name="newArrival" value="yes">Yes</label>
					  <label><input type="radio" class="counter" name="newArrival" value="no" >No</label>
					  <label><input type="radio" class="counter" name="newArrival" value="both">Both</label>
						</div>

				  </div>
				
			<div class="row">
			  <div class="col-sm-3">
				<label>Discount</label>
			  </div>
			  <div class="col-sm-9">
				<input type="text" class="counter" name="discountFrom" id="discountFrom">
					  <input type="text" class="counter" name="discountTo" id="discountTo">
			  </div>
			</div>
			</div>
				</div>              
            </div>
            
			<hr>
			<div class="row">
			  <div class="col-md-12 text-center">
				<button type="submit" name="mydemand" class="btn btn-primary text-left">
				<i class="fa fa-envelope-o"></i> 
				My Demand 
				</button>
			  </div>
        </div>
		  </div>
      </form>
    </div>
  </section>
<script type="text/javascript" src="../js/search.js"></script>
</body>
</html>