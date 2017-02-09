<?php
  include '../common/header.php';
?>
<style>
.row {
	padding: 1.5px;
}
</style>
<link rel="stylesheet" type="text/css" href="../css/search.css"/>
<body>
    <section class="main-section">
        <div class="container-fluid">
            <form class="form-horizontal" action="submitdemand.php" method="post">
                 <div class="panel panel-default panel_top">
                    <div class="panel-body">
                        <div class="row">                           
                            <div class="col-xs-12 col-sm-10">
                                <div class="shape">
                                    <ul class="list-shape">
                                        <li>
                                            <div class="selectallbtn allbtn col-xs-12">
                                                <label for="chk">
                                                    <span class="all font25">ALL</span>
                                                    <small>SHAPES</small>
                                                </label>
                                                <input type="checkbox" style="display: none;" id="chk" name="chk" value="chk" onclick="check_all(chk);" class="counter">
                                            </div>
                                        </li>
                                        <?php 
										 $getshape2="select distinct shapename,image1 from shape_master where status='1'" ;
										$shpe2=mysqli_query($con,$getshape2);
										while($s=mysqli_fetch_assoc($shpe2)){ ?>
                                        <li>
                                            <div class="">
                                                <label for="<?php echo trim($s['shapename'])?>" class="shape-btn ">
                                                    <div class="bg-img1" style="background: url('<?php echo $s['image1']?>') no-repeat left top;height: 42px;margin: 0 auto;width: 42px;"></div>
                                                    <small><?php echo $s['shapename']?></small>
                                                </label>
                                                <input type="checkbox" style="display: none;" name="check[]" id="<?php echo trim($s['shapename'])?>" value="<?php echo trim($s['shapename'])?>" class="counter" />
                                            </div>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label>Pointer</label>
                            </div>
                            <div class="col-sm-11">
                                <?php 
								 $getPointers=mysqli_query($con, "select distinct pointerName,pointer_id from pointers where status='1'");
								 while($ptRow=mysqli_fetch_assoc($getPointers)){ ?>
                                <label for="<?php echo $ptRow['pointer_id'];?>" class="btn push-btn">
                                    <?php echo $ptRow[ 'pointer_id'];?>
                                </label>
                                <input type="checkbox" style="display: none;" name="pointer[]" value="<?php echo $ptRow['pointer_id'];?>" id="<?php echo $ptRow['pointer_id'];?>" class="counter">
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Carat</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class=" counter" name="caretfrom" id="caretfrom" />
                                        <span>&nbsp;TO&nbsp;</span>
                                        <input type="text" class=" counter" name="caretto" id="caretto" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Color</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <?php 
										 $color="select * from  color where status='1'" ;
										 $clr=mysqli_query($con,$color);
										 while($cr=mysqli_fetch_assoc($clr)){ ?>
										 <label for="color<?php echo $cr['colorname'];?>" class="btn push-btn ">
                                            <?php echo $cr[ 'colorname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="color[]" value="<?php echo $cr['colorname'];?>" id="color<?php echo $cr['colorname'];?>" class="counter" >
                                       <?php
										}?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Ex. Search</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <label for="excellent" class="excellent btn push-btn">3 EX</label>
                                        <input type="checkbox" style="display: none;" onclick="checkexc()" name="ex[]" value="3EX" id="excellent" class="counter">
                                        <label for="excellent2" class="excellent2 btn push-btn">2 EX</label>
                                        <input type="checkbox" style="display: none;" onclick="checkexc()" name="ex[]" value="2EX" id="excellent2" class="counter">
                                        <label for="excellentvg" class="excellentvg btn push-btn">3 VG <i class="fa fa-long-arrow-up"></i></label>
                                        <input type="checkbox" style="display: none;" onclick="checkexc()" name="ex[]" value="3VG" id="excellentvg" class="counter">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Cut</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <?php 
										 $qry="select * from  cut_polish_sym where status='1'" ;
										 $run=mysqli_query($con,$qry);
										 while($cps=mysqli_fetch_assoc($run)){ ?>
                                        <label for="cut<?php echo $cps['title'];?>" class="btn push-btn cut<?php echo $cps['title'];?>" >
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="cut[]" value="<?php echo $cps['title'];?>" id="cut<?php echo $cps['title'];?>"   onclick="uncheckexc();" class="counter">
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Polish</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <?php 
										 $qry="select * from  cut_polish_sym where status='1'" ;
										 $run=mysqli_query($con,$qry);
										 while($cps=mysqli_fetch_assoc($run)){ ?>
                                        <label for="polish<?php echo $cps['title'];?>" class="btn push-btn polish<?php echo $cps['title'];?>">
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="polish[]" value="<?php echo $cps['title'];?>" id="polish<?php echo $cps['title'];?>"   onclick="uncheckexc();" class="counter">
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Symmetry</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <?php 
										 $qry="select * from  cut_polish_sym where status='1'" ;
										 $run=mysqli_query($con,$qry);
										 while($cps=mysqli_fetch_assoc($run)){ ?>
                                        <label for="symm<?php echo $cps['title'];?>" class="btn push-btn symm<?php echo $cps['title'];?>">
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="symmetry[]" value="<?php echo $cps['title'];?>" id="symm<?php echo $cps['title'];?>" onclick="uncheckexc();" class="counter">
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Fluorescence</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <?php 
										 $fluorescense="select * from fluorescense where status='1'" ;
										 $fluro=mysqli_query($con,$fluorescense);
										 while($f=mysqli_fetch_assoc($fluro)){ ?>
                                        <label for="fluor<?php echo $f['fluorescence'];?>" class="btn push-btn">
                                            <?php echo $f[ 'semi'];?>
                                        </label>
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
										 $tinge=mysqli_query($con, "select * from tinge where status='1'");
										 while($tg=mysqli_fetch_assoc($tinge)){ ?>
                                        <label for="tinge<?php echo $tg['tingename'];?>" class="btn push-btn">
                                            <?php echo $tg[ 'tingename'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="tinge[]" value="<?php echo $tg['tingename'];?>" id="tinge<?php echo $tg['tingename'];?>" class="counter">
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Price</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="counter" name="priceFrom" id="priceFrom">
                                        <input type="text" class="counter" name="priceTo" id="priceTo">
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-sm-2">
                                        <label>Discount</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="counter" name="discountFrom" id="discountFrom">
                                        <input type="text" class="counter" name="discountTo" id="discountTo">
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
										 $getcerti2="select  distinct cerificatename,image from certificates  where status='1'" ;
										 $certi2=mysqli_query($con,$getcerti2);
										 while($c=mysqli_fetch_assoc($certi2)){ ?>
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
										 $clarity="select * from  clarity where status='1'" ;
										 $clrit=mysqli_query($con,$clarity);
										 while($cl=mysqli_fetch_assoc($clrit)){ ?>
                                        <label for="clarity<?php echo $cl['clarityname'];?>" class="btn push-btn">
                                            <?php echo $cl[ 'clarityname'];?>
                                        </label>
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
										 $cutlet="select * from  cutlet  where status='1'" ;
										 $cutl=mysqli_query($con,$cutlet);
										 while($ct=mysqli_fetch_assoc($cutl)){ ?>
                                        <label for="culet<?php echo $ct['cutname'];?>" class="btn push-btn">
                                            <?php echo $ct[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="culet[]" value="<?php echo $ct['cutname'];?>" id="culet<?php echo $ct['cutname'];?>" class="counter">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>PG Stock Id</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="counter" name="stockId" id="stockId">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>ReportNumber</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="counter" name="certificateno" id="certificateno">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Black Inclusion</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="counter" name="blackinclfrom" id="blackinclfrom">
                                            <option value="">Select</option>
                                            <?php $black_inclusion="select * from  black_inclusion  where status='1'"; $blckincl=mysqli_query($con,$black_inclusion); while($b=mysqli_fetch_assoc($blckincl)){?>
                                            <option value="<?php echo $b['blackinclusionname'];?>"><?php echo $b[ 'blackinclusionname'];?></option>
                                            <?php } ?>
                                        </select>
                                        <select class=" counter" name="blackinclto" id="blackinclto">
                                            <option value="">Select</option>
                                            <?php $black_inclusion="select * from  black_inclusion  where status='1'"; $blckincl=mysqli_query($con,$black_inclusion); while($b=mysqli_fetch_assoc($blckincl)){?>
                                            <option value="<?php echo $b['blackinclusionname'];?>"><?php echo $b[ 'blackinclusionname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-sm-3">
                                        <label>Brown Inclusion</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="counter" name="browninclfrom" id="browninclfrom">
                                            <option value="">Select</option>
                                            <?php $brown_inclusion="select * from   brown_inclusion  where status='1'"; $brownincl=mysqli_query($con,$brown_inclusion); while($br=mysqli_fetch_assoc($brownincl)){?>
                                            <option value="<?php echo $br['browninclusionname'];?>"><?php echo $br[ 'browninclusionname'];?></option>
                                            <?php } ?>
                                        </select>
                                        <select class=" counter" name="browninclto" id="browninclto">
                                            <option value="">Select</option>
                                            <?php $brown_inclusion="select * from  brown_inclusion  where status='1'"; $brownincl=mysqli_query($con,$brown_inclusion); while($br=mysqli_fetch_assoc($brownincl)){?>
                                            <option value="<?php echo $br['browninclusionname'];?>"><?php echo $br[ 'browninclusionname'];?></option>
                                            <?php } ?>
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
                                            <?php $milky="select * from  milky  where status='1'"; $mlk=mysqli_query($con,$milky); while($ml=mysqli_fetch_assoc($mlk)){ ?>
                                            <option value="<?php echo $ml['milkyname'];?>"><?php echo $ml[ 'milkyname'];?></option>
                                            <?php } ?>
                                        </select>
                                        <select class=" counter" id="milkyto" name="milkyto">
                                            <option value="">Select</option>
                                            <?php $milky="select * from  milky  where status='1'"; $mlk=mysqli_query($con,$milky); while($ml=mysqli_fetch_assoc($mlk)){ ?>
                                            <option value="<?php echo $ml['milkyname'];?>"><?php echo $ml[ 'milkyname'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Inclusion Visibility</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php $inclusion_visibility="select * from  inclusion_visibility  where status='1'" ; $incl=mysqli_query($con,$inclusion_visibility); while($in=mysqli_fetch_assoc($incl)){ echo '<label><input type="radio" value="'.$in[ 'inclusionname']. '" name="inclusive_visibility" class="counter" > '.$in[ 'inclusionname']. '</label>';  } ?>
                                    </div>

                                </div>
								 <div class="row">
                                    <div class="col-sm-3">
                                        <label>H & A</label>
                                    </div>
                                    <div class="col-sm-9">
										<label><input type="radio" class="counter" name="H_A" value="yes">Yes</label>
										<label><input type="radio" class="counter" name="H_A" value="no">No</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
					<div class="row">
						  <div class="col-md-12 text-center">
							<button type="submit" name="mydemand" class="btn btn-primary text-left">
							<i class="fa fa-envelope-o"></i> 
							My Demand 
							</button>
						  </div>
					</div>
                    </div>
                </div>
        </form>
        </div>
    </section>
    <!--<script type="text/javascript" src="../js/search.js"></script>-->
</body>

</html>
<?php include '../common/footer.php'; ?>