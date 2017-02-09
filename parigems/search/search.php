<?php
 ob_start();
session_start();
 error_reporting(0);
include '../common/header.php';
if (isset($_POST['loadSearch'])) {
    if ($_POST['loadSearch'] != '') {
        $getSearchDetails    = mysqli_query($con, "select * from search_history where search_id='" . $_POST['loadSearch'] . "' and serach_status='1'");
        $searchResult        = mysqli_fetch_assoc($getSearchDetails);
        $shapeexplode        = explode(',', $searchResult['shape']);
        $colorexplode        = explode(',', $searchResult['color']);
        $clarityexplode      = explode(',', $searchResult['clarity']);
        $culetexplode        = explode(',', $searchResult['culet']);
        $certificateexplode  = explode(',', $searchResult['certi_id']);
        $cutexplode          = explode(',', $searchResult['cut']);
        $polishexplode       = explode(',', $searchResult['polish']);
        $symmetryexplode     = explode(',', $searchResult['symmetry']);
        $flurosenceexplode   = explode(',', $searchResult['fluoresence']);
        $tingeexplode        = explode(',', $searchResult['tinge']);
        $pointerexplode      = explode(',', $searchResult['pointer']);
        $priceFrom           = $searchResult['priceFrom'];
        $priceTo             = $searchResult['priceTo'];
        $discountFrom        = $searchResult['discountFrom'];
        $discountTo          = $searchResult['discountTo'];
        $newArrival          = $searchResult['newArrival'];
        $referenceno         = $searchResult['referenceno'];
        $blackInclusionFrom  = $searchResult['blackInclusionFrom'];
        $blackInclusionTo    = $searchResult['blackInclusionTo'];
        $milkyFrom           = $searchResult['milkyFrom'];
        $milkyTo             = $searchResult['milkyTo'];
        $inclusiv_visibility = explode(',', $searchResult['inclusion_visibility']);
		$caret_from			 =$searchResult['caret_from'];
		$caret_to			 =$searchResult['caret_to'];
		$blackinclfrom		 =$_POST['blackinclfrom'];
		$blackinclto		 =$_POST['blackinclto'];
		$browninclfrom       = $_POST['browninclfrom'];
		$browninclto         = $_POST['browninclto'];
		$H_A  				 = $_POST['H_A'];
		$tablefrom			 = $_POST['tablefrom'];
		$tableto     		 = $_POST['tableto'];		
		$depthfrom=$_POST['depthfrom'];
		$depthto=$_POST['depthto'];
		
		$shapeCount=1;
		$pointerCount=1;
		$colorCount=1;
		$cutCount=1;
		$polishCount=1;
		$symmCount=1;
		$fluroCount=1;
		$tingeCount=1;
		$labCount=1;
		$clarityCount=1;
		$culetCount=1;
    }
} else {
 $modify=encrypt_decrypt('decrypt',$_GET['modify']);
 if($modify=='modify')
 {
	if($_SESSION['shape']!='')
	{
		$shapeexplode       = $_SESSION['shape'];
		$shapeCount=0;
	}
	else
	{
		$shapeexplode       = '';
		$shapeCount=1;
	}
	if($_SESSION['pointer']!='')
	{
		$pointerexplode       = $_SESSION['pointer'];
		$pointerCount=0;
	}
	else
	{		
		$pointerexplode       = '';
		$pointerCount=1;
	}
	$caret_from=$_SESSION['caretfrom'];
	$caret_to=$_SESSION['caretto'];
	
	if($_SESSION['color']!='')
	{
		$colorexplode       = $_SESSION['color'];
		$colorCount=0;
	}
	else
	{
		$colorexplode       = '';
		$colorCount=1;
	}
	
	if($_SESSION['cut']!='')
	{
		$cutexplode       = $_SESSION['cut'];
		$cutCount=0;
	}
	else
	{
		$cutexplode       = '';
		$cutCount=1;
	}
	if($_SESSION['polish']!='')
	{
		$polishexplode       = $_SESSION['polish'];
		$polishCount=0;
	}
	else
	{
		$polishexplode       = '';
		$polishCount=1;
	}
	if($_SESSION['symmetry']!='')
	{
		$symmetryexplode       = $_SESSION['symmetry'];
		$symmCount=0;
	}
	else
	{
		$symmetryexplode       = '';
		$symmCount=1;
	}
	if($_SESSION['fluor']!='')
	{
		$flurosenceexplode       = $_SESSION['fluor'];
		$fluroCount=0;
	}
	else
	{
		$flurosenceexplode       = '';
		$fluroCount=1;
	}
	if($_SESSION['tinge']!='')
	{
		$tingeexplode       = $_SESSION['tinge'];
		$tingeCount=0;
	}
	else
	{
		$tingeexplode       = '';
		$tingeCount=1;
	}
	
	if($_SESSION['fancyintensity']!='')
	{
		$fancyintensityExplode       = $_SESSION['fancyintensity'];
	}
	else
	{		
		$fancyintensityExplode       = '';
	}
	
	if($_SESSION['fancyovertone']!='')
	{
		$fancyovertoneExplode       = $_SESSION['fancyovertone'];
	}
	else
	{		
		$fancyovertoneExplode       = '';
	}
	
	if($_SESSION['fancycolor']!='')
	{
		$fancycolorExplode       = $_SESSION['fancycolor'];
	}
	else
	{		
		$fancycolorExplode       = '';
	}
	
	if($_SESSION['key_to_symbol']!='')
	{
		$key_to_symbolExplode       = $_SESSION['key_to_symbol'];
	}
	else
	{		
		$key_to_symbolExplode       = '';
	}
	$priceFrom           = $_SESSION['priceFrom'];
    $priceTo             = $_SESSION['priceTo'];
	$discountFrom        = $_SESSION['discountFrom'];
    $discountTo          = $_SESSION['discountTo'];
	$stokId				 = $_SESSION['stockId'];
	$referenceno         = $_SESSION['referenceno'];
	$blackinclfrom       = $_SESSION['blackinclfrom'];
	$blackinclto         = $_SESSION['blackinclto'];
	$browninclfrom       = $_SESSION['browninclfrom'];
	$browninclto         = $_SESSION['browninclto'];
	$milkyFrom           = $_SESSION['milkyfrom'];
    $milkyTo             = $_SESSION['milkyTo'];
	
	$tablefrom			 = $_SESSION['tablefrom'];
	$tableto     		 = $_SESSION['tableto'];
	     $depthfrom=$_SESSION['depthfrom'];
		 $depthto=$_SESSION['depthto'];		
		 $lengthfrom=$_SESSION['lengthfrom'];
         $lengthto=$_SESSION['lengthto'];
		 $crheightfrom=$_SESSION['crheightfrom'];
		 $crheightto=$_SESSION['crheightto'];
		 $cranglefrom=$_SESSION['cranglefrom'];
		 $crangleto=$_SESSION['crangleto'];
		 $pavdepthfrom=$_SESSION['pavdepthfrom'];
		 $pavdepthto=$_SESSION['pavdepthto'];
		 $pavanglefrom=$_SESSION['pavanglefrom'];
		 $pavangleto=$_SESSION['pavangleto'];
		 $ratiofrom=$_SESSION['ratiofrom'];
		 $ratioto=$_SESSION['ratioto'];
		 $giddlemin=$_SESSION['giddlemin'];
		 $giddlemax=$_SESSION['giddlemax'];
		 $diameter_min=$_SESSION['diameter_min'];
		 $diameter_max=$_SESSION['diameter_max'];
		 $heightfrom=$_SESSION['heightfrom'];
		 $heightto=$_SESSION['heightto'];
		 $starLengthfrom=$_SESSION['starLengthfrom'];
		 $starLengthto=$_SESSION['starLengthto'];
		 $lowerHalffrom=$_SESSION['lowerHalffrom'];
		 $lowerHalfto=$_SESSION['lowerHalfto'];
		 $type_IIA=$_SESSION['type_IIA'];
		 $type_IIB=$_SESSION['type_IIB'];
		 $keycontain=$_SESSION['keycontain'];
	
	if($_SESSION['inclusive_visibility']!='')
	{
		$inclusiv_visibility       = $_SESSION['inclusive_visibility'];
	}
	else
	{
	 $inclusiv_visibility      = '';
	}	
	//$inclusiv_visibility = $_SESSION['inclusive_visibility'];
	$newArrival          = $_SESSION['newArrival'];
	$H_A  				 = $_SESSION['H_A'];	
    
	if($_SESSION['cerificate']!='')
	{
		$certificateexplode       = $_SESSION['cerificate'];
		$labCount=0;
	}
	else
	{
		$certificateexplode       = '';
		$labCount=1;
	}
	if($_SESSION['clarity']!='')
	{
		$clarityexplode       = $_SESSION['clarity'];
		$clarityCount=0;
	}
	else
	{
		$clarityexplode       = '';
		$clarityCount=1;
	}
	if($_SESSION['culet']!='')
	{
		$culetexplode       = $_SESSION['culet'];
		$culetCount=0;
	}
	else
	{
		$culetexplode       = '';
		$culetCount=1;
	}
 }
}
$emptySession=encrypt_decrypt('decrypt', $_GET['r']);
if($emptySession=='emp')
{
 echo '<script>if(window.location.href.substr(-2) !== "?r") {
      window.location = window.location.href + "?r";
    }</script>';
$_SESSION['shape']='';
$_SESSION['pointer']='';
$_SESSION['caretfrom']='';
$_SESSION['caretto']='';
$_SESSION['color']='';
$_SESSION['cut']='';
$_SESSION['polish']='';
$_SESSION['symmetry']='';
$_SESSION['fluor']='';
$_SESSION['tinge']='';
$_SESSION['priceFrom']='';
$_SESSION['priceTo']='';
$_SESSION['discountFrom']='';
$_SESSION['discountTo']='';
$_SESSION['stokId']='';
$_SESSION['referenceno']='';
$_SESSION['blackinclfrom']='';
$_SESSION['blackinclto']='';
$_SESSION['browninclfrom']='';
$_SESSION['browninclto']='';
$_SESSION['milkyfrom']='';
$_SESSION['milkyTo']='';
$_SESSION['inclusive_visibility']='';
$_SESSION['newArrival']='';
$_SESSION['H_A']='';
$_SESSION['cerificate']='';
$_SESSION['clarity']='';
$_SESSION['culet']='';
$_SESSION['stockId']="";
$_SESSION['tablefrom']="";
$_SESSION['tableto']="";
$_SESSION['depthfrom']="";
$_SESSION['depthto']="";
$_SESSION['lengthfrom']="";
$_SESSION['lengthto']="";
$_SESSION['crheightfrom']="";
$_SESSION['crheightto']="";
$_SESSION['cranglefrom']="";
$_SESSION['crangleto']="";
$_SESSION['pavdepthfrom']="";
$_SESSION['pavdepthto']="";
$_SESSION['pavanglefrom']="";
$_SESSION['pavangleto']="";
$_SESSION['ratiofrom']="";
$_SESSION['ratioto']="";
$_SESSION['giddlemin']="";
$_SESSION['giddlemax']="";
$_SESSION['diameter_min']="";
$_SESSION['diameter_max']="";
$_SESSION['heightfrom']="";
$_SESSION['heightto']="";
$_SESSION['starLengthfrom']="";
$_SESSION['starLengthto']="";
$_SESSION['lowerHalffrom']="";
$_SESSION['lowerHalfto']="";
$_SESSION['type_IIA']="";
$_SESSION['type_IIB']="";
$_SESSION['key_to_symbol']="";
$_SESSION['keycontain']="";
$_SESSION['fancycolor']="";
$_SESSION['fancyintensity']="";
$_SESSION['fancyovertone']="";
$_SESSION['inclusive_visibility']="";
}
?>
<style>
.row {
	padding: 1.5px;
}
</style>
<link rel="stylesheet" type="text/css" href="../css/search.css" />
 <?php if($modify=='modify')
 {
echo '<body onload="reactivate();">';
 }else
 {
  echo '<body>';
 }
 ?>
 <div id="wait" style="display:none;width:69px;height:89px;position: fixed;left: 50%;top: 50%;background-size: cover;z-index: 1001;"><img src='../images/demo_wait.gif' width="64" height="64" /></div>
    <section class="main-section">
        <div class="container-fluid">
            <form class="form-horizontal" action="search.php" id="searchAction" method="post">
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
										 $getshape2="select distinct shapename,image1,shapeid from shape_master where status='1'" ;
										$shpe2=mysqli_query($con,$getshape2);
										while($s=mysqli_fetch_assoc($shpe2)){
										 $changedImage=explode('.png',$s['image1']);
										 if (in_array(trim($s['shapename']), $shapeexplode))
										  { ?>
										  <li>
                                            <div class="">
                                                <label for="<?php echo trim($s['shapename'])?>" class="shape-btn active" onclick="undoChangediamond<?php echo $s['shapeid'];?>();">
                                                    <div id="change_<?php echo $s['shapeid'];?>" class="bg-img1" style="background: url('<?php echo $changedImage[0].'-1.png';?>') no-repeat left top;height: 42px;margin: 0 auto;width: 42px;"></div>
                                                    <small><?php echo $s['shapename']?></small>
                                                </label>
                                                <input type="checkbox" style="display: none;" name="check[]" id="<?php echo trim($s['shapename'])?>" value="<?php echo trim($s['shapename'])?>" class="counter" checked/>
                                            </div>
                                        </li>
										  
										<?php }
										else
										  {								 
										 ?>
                                        <li>
                                            <div class="">
                                                <label for="<?php echo trim($s['shapename'])?>" class="shape-btn" onclick="changediamond<?php echo $s['shapeid'];?>()">
                                                    <div id="change_<?php echo $s['shapeid'];?>" class="bg-img1" style="background: url('<?php echo $s['image1']?>') no-repeat left top;height: 42px;margin: 0 auto;width: 42px;"></div>
                                                    <small><?php echo $s['shapename']?></small>
                                                </label>
                                                <input type="checkbox" style="display: none;" name="check[]" id="<?php echo trim($s['shapename'])?>" value="<?php echo trim($s['shapename'])?>" class="counter" />
                                            </div>
                                        </li>
										
                                        <?php }?>
										<script>										   
										 function undoChangediamond<?php echo $s['shapeid'];?>()
										 {
										    if(document.getElementById('change_<?php echo $s['shapeid'];?>').style.backgroundImage=='url("<?php echo $changedImage[0].'-1.png';?>")')
											 {
											 document.getElementById('change_<?php echo $s['shapeid'];?>').style.backgroundImage='url("<?php echo $s['image1'];?>")';
											}
											else{
												document.getElementById('change_<?php echo $s['shapeid'];?>').style.backgroundImage='url("<?php echo $changedImage[0].'-1.png';?>")';
											}
										 }
										 function changediamond<?php echo $s['shapeid'];?>()
										 {
											 if(document.getElementById('change_<?php echo $s['shapeid'];?>').style.backgroundImage=='url("<?php echo $s['image1'];?>")')
											 {
											 document.getElementById('change_<?php echo $s['shapeid'];?>').style.backgroundImage='url("<?php echo $changedImage[0];?>-1.png")';
											}
											else{
												document.getElementById('change_<?php echo $s['shapeid'];?>').style.backgroundImage='url("<?php echo $s['image1'];?>")';
											}
										 }
										    function check_all(chk)
											{											
											var cbox=document.getElementsByName('check[]');
											var chk=$("#chk").is(":checked");
											if(chk)
											{
											for (var i =0; i <cbox.length ; i++)
											{
											 id=i + 1;
											 if (cbox[i].checked==false) {
											 cbox[i].checked=true;
                                             $(".shape-btn").addClass("active");
											 var backImage=$('#change_'+id).css("background-image").trim();
											 var backImageURL = backImage.substring(5, backImage.length - 2);
											 var splitUrl=backImageURL.split('.png');
											 var newUrl=splitUrl[0]+'-1.png';
											 document.getElementById('change_'+id).style.backgroundImage='url("'+newUrl+'")';
                                             }
											 else
											 {
											      cbox[i].checked=true;
												  $(".shape-btn").addClass("active");
												  var backImage=$('#change_'+id).css("background-image").trim();
												  var backImageURL = backImage.substring(5, backImage.length - 2);
												  var splitUrl=backImageURL.split('-1.png');
												  var newUrl=splitUrl[0]+'-1.png';
												  document.getElementById('change_'+id).style.backgroundImage='url("'+newUrl+'")';	
											 }
											}
											}	
											else
											{
												for (var i =0; i <cbox.length ; i++)
												{
												  id=i + 1;
												  
												  if (cbox[i].checked==false) {
												  cbox[i].checked=false;
												  $(".shape-btn").removeClass("active");
												  var backImage=$('#change_'+id).css("background-image").trim();
												  var backImageURL = backImage.substring(5, backImage.length - 2);
												  var splitUrl=backImageURL.split('.png');
												  var newUrl=splitUrl[0]+'.png';
												  document.getElementById('change_'+id).style.backgroundImage='url("'+newUrl+'")';
												  }
												  else
												  {
													   cbox[i].checked=false;
													   $(".shape-btn").removeClass("active");
													   var backImage=$('#change_'+id).css("background-image").trim();
													   var backImageURL = backImage.substring(5, backImage.length - 2);
													   var splitUrl=backImageURL.split('-1.png');
													   var newUrl=splitUrl[0]+'.png';
													   document.getElementById('change_'+id).style.backgroundImage='url("'+newUrl+'")';	
												  }
												  
												}
											}
											}
										 
										</script>
										<?php } ?>
                                    </ul>
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-2">
								<a type="button" href="search.php?r=<?php echo encrypt_decrypt('encrypt', 'emp');?>" class="btn btn-primary text-left reset_mb"><i class="fa fa-refresh "></i> RESET</a>
								<button onclick="$('#newsearch').click();" class="btn btn-primary text-left "><i class="fa fa-search"></i> SEARCH</button>
                            </div>
						</div>
                        <div class="row">
                            <div class="col-sm-1">
                                <label>Pointer</label>
                            </div>
                            <div class="col-sm-11">
                                <?php 
								 $getPointers=mysqli_query($con, "select distinct pointerName,pointer_id from pointers where status='1'");
								 while($ptRow=mysqli_fetch_assoc($getPointers)){
								  if (in_array($ptRow['pointerName'], $pointerexplode)){
								  ?>
                                <label for="<?php echo $ptRow['pointer_id'];?>" class="btn push-btn active">
                                    <?php echo $ptRow[ 'pointer_id'];?>
                                </label>
                                <input type="checkbox" style="display: none;" name="pointer[]" value="<?php echo $ptRow['pointerName'];?>" id="<?php echo $ptRow['pointer_id'];?>" class="counter" checked>
                                <?php
								  }
								else{
								 ?>
                                <label for="<?php echo $ptRow['pointer_id'];?>" class="btn push-btn">
                                    <?php echo $ptRow[ 'pointer_id'];?>
                                </label>
                                <input type="checkbox" style="display: none;" name="pointer[]" value="<?php echo $ptRow['pointerName'];?>" id="<?php echo $ptRow['pointer_id'];?>" class="counter">
                                <?php 
								}
								}?>
                            </div>
                        </div>

                        <input type="hidden" name="login" id="login" value="<?php echo $log;?>">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Carat</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class=" counter" value="<?php echo $caret_from;?>" name="caretfrom" id="caretfrom" />
                                        <span>&nbsp;TO&nbsp;</span>
                                        <input type="text" class=" counter" value="<?php echo $caret_to;?>" name="caretto" id="caretto" />
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
										 while($cr=mysqli_fetch_assoc($clr)){
										  if (in_array($cr['colorname'], $colorexplode)){
										  ?>
                                        <label for="color<?php echo $cr['colorname'];?>" class="btn push-btn active">
                                            <?php echo $cr[ 'colorname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="color[]" value="<?php echo $cr['colorname'];?>" id="color<?php echo $cr['colorname'];?>" class="counter" checked>
                                        <?php }
										else{ ?>
										 <label for="color<?php echo $cr['colorname'];?>" class="btn push-btn ">
                                            <?php echo $cr[ 'colorname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="color[]" value="<?php echo $cr['colorname'];?>" id="color<?php echo $cr['colorname'];?>" class="counter" >
                                       <?php
										}
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
										 while($cps=mysqli_fetch_assoc($run)){
										   if (in_array($cps['title'], $cutexplode)){
										  ?>
										  <label for="cut<?php echo $cps['title'];?>" class="btn push-btn cut<?php echo $cps['title'];?> active">
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="cut[]" value="<?php echo $cps['title'];?>" id="cut<?php echo $cps['title'];?>"  onclick="uncheckexc();" class="counter" checked>
										  <?php }else{ ?>
                                        <label for="cut<?php echo $cps['title'];?>" class="btn push-btn cut<?php echo $cps['title'];?>" >
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="cut[]" value="<?php echo $cps['title'];?>" id="cut<?php echo $cps['title'];?>"   onclick="uncheckexc();" class="counter">
                                        <?php }}?>
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
										 while($cps=mysqli_fetch_assoc($run)){
										  if (in_array($cps['title'], $polishexplode)){  ?>
										  <label for="polish<?php echo $cps['title'];?>" class="btn push-btn polish<?php echo $cps['title'];?> active">
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="polish[]" value="<?php echo $cps['title'];?>" id="polish<?php echo $cps['title'];?>"   onclick="uncheckexc();" class="counter" checked>
										  <?php }else{ ?>
                                        <label for="polish<?php echo $cps['title'];?>" class="btn push-btn polish<?php echo $cps['title'];?>">
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="polish[]" value="<?php echo $cps['title'];?>" id="polish<?php echo $cps['title'];?>"   onclick="uncheckexc();" class="counter">
                                        <?php } }?>
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
										 while($cps=mysqli_fetch_assoc($run)){
										 if (in_array($cps['title'], $symmetryexplode)){  ?>
										 <label for="symm<?php echo $cps['title'];?>" class="btn push-btn symm<?php echo $cps['title'];?> active" >
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="symmetry[]" value="<?php echo $cps['title'];?>" id="symm<?php echo $cps['title'];?>"  onclick="uncheckexc();" class="counter" checked>
										 <?php } else{ ?>
                                        <label for="symm<?php echo $cps['title'];?>" class="btn push-btn symm<?php echo $cps['title'];?>">
                                            <?php echo $cps[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="symmetry[]" value="<?php echo $cps['title'];?>" id="symm<?php echo $cps['title'];?>" onclick="uncheckexc();" class="counter">
                                        <?php }} ?>
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
										 while($f=mysqli_fetch_assoc($fluro)){
										  if (in_array($f['fluorescence'], $flurosenceexplode)){ ?>
										  <label for="fluor<?php echo $f['fluorescence'];?>" class="btn push-btn active">
                                            <?php echo $f[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="fluor[]" value="<?php echo $f['fluorescence'];?>" id="fluor<?php echo $f['fluorescence'];?>" class="counter" checked>
                                        
										  <?php }else{?>
                                        <label for="fluor<?php echo $f['fluorescence'];?>" class="btn push-btn">
                                            <?php echo $f[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="fluor[]" value="<?php echo $f['fluorescence'];?>" id="fluor<?php echo $f['fluorescence'];?>" class="counter">
                                        <?php } } ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Tinge</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <?php 
										 $tinge=mysqli_query($con, "select * from tinge where status='1'");
										 while($tg=mysqli_fetch_assoc($tinge)){
										   if (in_array($tg['tingename'], $tingeexplode)){ ?>
										   <label for="tinge<?php echo $tg['tingename'];?>" class="btn push-btn active">
                                            <?php echo $tg[ 'tingename'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="tinge[]" value="<?php echo $tg['tingename'];?>" id="tinge<?php echo $tg['tingename'];?>" class="counter" checked>                                        
										   <?php }else{ ?>
                                        <label for="tinge<?php echo $tg['tingename'];?>" class="btn push-btn">
                                            <?php echo $tg[ 'tingename'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="tinge[]" value="<?php echo $tg['tingename'];?>" id="tinge<?php echo $tg['tingename'];?>" class="counter">
                                        <?php } } ?>
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
								<div class="row">
                                    <div class="col-sm-2">
                                        <label>Discount</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="counter" name="discountFrom" id="discountFrom" value="<?php echo $discountFrom;?>">
                                        <input type="text" class="counter" name="discountTo" id="discountTo" value="<?php echo $discountTo;?>">
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
										 while($c=mysqli_fetch_assoc($certi2)){
										   if (in_array($c['cerificatename'], $certificateexplode)){ ?>
                                            <label for="<?php echo $c['cerificatename'];?>" class="btn push-btn active">
                                            <b><?php echo $c['cerificatename'];?></b>
										   </label>
										   <input type="checkbox" style="display: none;" name="cerificate[]" value="<?php echo $c['cerificatename'];?>" id="<?php echo $c['cerificatename'];?>" class="counter" checked>                                        
										   <?php }else{ ?>
										 <label for="<?php echo $c['cerificatename'];?>" class="btn push-btn">
                                            <b><?php echo $c['cerificatename'];?></b>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="cerificate[]" value="<?php echo $c['cerificatename'];?>" id="<?php echo $c['cerificatename'];?>" class="counter">                                       
                                        <?php } }?>
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
										 while($cl=mysqli_fetch_assoc($clrit)){
										   if (in_array($cl['clarityname'], $clarityexplode)){ ?>
										   <label for="clarity<?php echo $cl['clarityname'];?>" class="btn push-btn active">
                                            <?php echo $cl[ 'clarityname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="clarity[]" value="<?php echo $cl['clarityname'];?>" id="clarity<?php echo $cl['clarityname'];?>" class="counter" checked>
                                        <?php }else{ ?>
                                        <label for="clarity<?php echo $cl['clarityname'];?>" class="btn push-btn">
                                            <?php echo $cl[ 'clarityname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="clarity[]" value="<?php echo $cl['clarityname'];?>" id="clarity<?php echo $cl['clarityname'];?>" class="counter">
                                        <?php } }?>
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
										 while($ct=mysqli_fetch_assoc($cutl)){
										  if (in_array($ct['cutname'], $culetexplode)){ ?>
										<label for="culet<?php echo $ct['cutname'];?>" class="btn push-btn active">
                                            <?php echo $ct[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="culet[]" value="<?php echo $ct['cutname'];?>" id="culet<?php echo $ct['cutname'];?>" class="counter" checked>
                                        <?php }else{ ?>
                                        <label for="culet<?php echo $ct['cutname'];?>" class="btn push-btn">
                                            <?php echo $ct[ 'semi'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="culet[]" value="<?php echo $ct['cutname'];?>" id="culet<?php echo $ct['cutname'];?>" class="counter">
                                        <?php } }?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>PG Stock Id</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="counter" name="stockId" id="stockId" value="<?php echo $stokId;?>">
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
                                            <?php if($blackinclfrom!='' ){ ?>
                                            <option value="<?php echo $blackinclfrom;?>" selected>
                                                <?php echo $blackinclfrom;?>
                                            </option>
                                            <?php } $black_inclusion="select * from  black_inclusion  where status='1' and blackinclusionname!='" .$blackinclfrom. "'"; $blckincl=mysqli_query($con,$black_inclusion); while($b=mysqli_fetch_assoc($blckincl)){?>
                                            <option value="<?php echo $b['blackinclusionname'];?>" <?php if($blackInclusionFrom==$b[ 'blackinclusionname']){echo 'selected';}?>>
                                                <?php echo $b[ 'blackinclusionname'];?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <select class=" counter" name="blackinclto" id="blackinclto">
                                            <option value="">Select</option>
                                            <?php if($blackinclto!='' ){ ?>
                                            <option value="<?php echo $blackinclto;?>" selected>
                                                <?php echo $blackinclto;?>
                                            </option>
                                            <?php } $black_inclusion="select * from  black_inclusion  where status='1' and blackinclusionname!='" .$blackinclto. "'"; $blckincl=mysqli_query($con,$black_inclusion); while($b=mysqli_fetch_assoc($blckincl)){?>
                                            <option value="<?php echo $b['blackinclusionname'];?>" <?php if($blackInclusionTo==$b[ 'blackinclusionname']){echo 'selected';}?>>
                                                <?php echo $b[ 'blackinclusionname'];?>
                                            </option>
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
                                            <?php if($browninclfrom!='' ){ ?>
                                            <option value="<?php echo $browninclfrom;?>" selected>
                                                <?php echo $browninclfrom;?>
                                            </option>
                                            <?php } $brown_inclusion="select * from   brown_inclusion  where status='1' and browninclusionname!='" .$browninclfrom. "'"; $brownincl=mysqli_query($con,$brown_inclusion); while($br=mysqli_fetch_assoc($brownincl)){?>
                                            <option value="<?php echo $br['browninclusionname'];?>" <?php if($brownInclusionFrom==$br['browninclusionname']){echo 'selected';}?>>
                                                <?php echo $br[ 'browninclusionname'];?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <select class=" counter" name="browninclto" id="browninclto">
                                            <option value="">Select</option>
                                            <?php if($browninclto!='' ){ ?>
                                            <option value="<?php echo $browninclto;?>" selected>
                                                <?php echo $browninclto;?>
                                            </option>
                                            <?php } $brown_inclusion="select * from  brown_inclusion  where status='1' and browninclusionname!='" .$browninclto. "'"; $brownincl=mysqli_query($con,$brown_inclusion); while($br=mysqli_fetch_assoc($brownincl)){?>
                                            <option value="<?php echo $br['browninclusionname'];?>" <?php if($brownInclusionTo==$br[ 'browninclusionname']){echo 'selected';}?>>
                                                <?php echo $br[ 'browninclusionname'];?>
                                            </option>
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
                                            <?php if($milkyFrom!='' ){ ?>
                                            <option value="<?php echo $milkyFrom;?>" selected>
                                                <?php echo $milkyFrom;?>
                                            </option>
                                            <?php } $milky="select * from  milky  where status='1' and milkyname!='" .$milkyFrom. "'"; $mlk=mysqli_query($con,$milky); while($ml=mysqli_fetch_assoc($mlk)){ ?>
                                            <option value="<?php echo $ml['milkyname'];?>" <?php if($milkyFrom==$ml[ 'milkyname']){echo 'selected';}?>>
                                                <?php echo $ml[ 'milkyname'];?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <select class=" counter" id="milkyto" name="milkyto">
                                            <option value="">Select</option>
                                            <?php if($milkyTo!='' ){ ?>
                                            <option value="<?php echo $milkyTo;?>" selected>
                                                <?php echo $milkyTo;?>
                                            </option>
                                            <?php } $milky="select * from  milky  where status='1' and milkyname!='" .$milkyTo. "'"; $mlk=mysqli_query($con,$milky); while($ml=mysqli_fetch_assoc($mlk)){ ?>
                                            <option value="<?php echo $ml['milkyname'];?>" <?php if($milkyTo==$ml[ 'milkyname']){echo 'selected';}?>>
                                                <?php echo $ml[ 'milkyname'];?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>Inclusion Visibility</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php $inclusion_visibility="select * from  inclusion_visibility  where status='1'" ;
										$incl=mysqli_query($con,$inclusion_visibility);
										while($in=mysqli_fetch_assoc($incl))
										{
										 if (in_array($in['inclusionname'], $inclusiv_visibility)){ ?>
										 <label for="<?php echo $in['inclusionname'];?>" class="btn push-btn active">
                                            <?php echo $in['inclusionname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="inclusive_visibility[]" value="<?php echo $in['inclusionname'];?>" id="<?php echo $in['inclusionname'];?>" class="counter" checked>
                                        <?php }else{ ?>
										 <label for="<?php echo $in['inclusionname'];?>" class="btn push-btn">
                                            <?php echo $in['inclusionname'];?>
                                        </label>
                                        <input type="checkbox" style="display: none;" name="inclusive_visibility[]" value="<?php echo $in['inclusionname'];?>" id="<?php echo $in['inclusionname'];?>" class="counter">
										<?php } }?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label>New Arrival</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label>
                                            <input type="radio" class="counter" name="newArrival" value="yes" <?php if($newArrival=='yes'){echo 'checked';}?>>Yes</label>
                                        <label>
                                            <input type="radio" class="counter" name="newArrival" value="no" <?php if($newArrival=='no'){echo 'checked';}?>>No</label>
                                        <label>
                                            <input type="radio" class="counter" name="newArrival" value="both" <?php if($newArrival=='both'){echo 'checked';}?>>Both</label>
                                    </div>
                                </div>
								 <div class="row">
                                    <div class="col-sm-3">
                                        <label>H & A</label>
                                    </div>
                                    <div class="col-sm-9">
                                            <!--<input type="text" class="counter" name="H_A" id="H_A" value="">-->
											<label><input type="radio" class="counter" name="H_A" value="yes" <?php if($H_A=='yes'){echo 'checked';}?>>Yes</label>
											<label><input type="radio" class="counter" name="H_A" value="no" <?php if($H_A=='no'){echo 'checked';}?>>No</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--<hr>-->
                    <div class="row">
                        <div class="col-md-12  text-center">
                            <input type="text" class="search_input" id="searchName"  name="searchName" placeholder="Search Name" value="<?php echo $searchResult['searchname'];?>">
                            <button type="submit" class="btn btn-primary" id="saveSearch"><i class="fa fa-save"></i>  Save Search</button>
                            <select class="load_search"  name="loadSearch" onchange="this.form.submit()">
                                <option value="">Select Search Name</option>
                                <?php $getSeachName=mysqli_query($con, "select searchname,search_id from search_history where serach_status='1'"); while($searchRow=mysqli_fetch_assoc($getSeachName)) { echo '<option value="'.$searchRow[ 'search_id']. '">'.$searchRow[ 'searchname']. '</option>'; } ?>
                            </select>
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="btn btn-primary">Advance Search</a>
                            <a type="button" href="search.php?r=<?php echo encrypt_decrypt('encrypt', 'emp');?>" class="btn btn-primary text-left">
                                <i class="fa fa-refresh"></i>  RESET SEARCH
                            </a>
							<!--<p id="countershow2"></p>-->
                            <button type="submit" name="search" class="btn btn-primary text-left" id="newsearch">
							  <?php
							  $randomNumber=rand(1111, 9999);
							  ?>
							  <input type="text" style="display: none;" id="randomNumber" value="<?php echo $randomNumber;?>">
                                <i class="fa fa-search"></i> SEARCH <span class="badge" id="countershow">
						<?php
						$countdid=0;
						  $mainquery="SELECT distinct(d.diamond_id) FROM `diamond_master` d,certificate_master c,diamond_sale s WHERE d.certificate_id=c.certificateid and d.diamond_status='1' and d.portalshow='portalyes' and d.diamond_id=s.diamond_id  order by d.weight ASC" ;
						  $result=mysqli_query($con,$mainquery);
						 while($mrw=mysqli_fetch_assoc($result))
						 {
						  $getraprates="SELECT * FROM `diamond_sale` where 1  and diamond_id=".$mrw['diamond_id'];
							$getrapratesresult=mysqli_query($con,$getraprates);
							$raprow=mysqli_fetch_assoc($getrapratesresult);
							if(mysqli_num_rows($getrapratesresult) > 0){
							if($raprow['rap']!='0'){
							  $countdid++;
							}
							}
						 }
						 echo $countdid;
						  ?>
						</span>
                            </button>
                        </div>
                    </div>
                    <div class="accordian-body collapse" id="collapseExample">
                        <br>
						<div class="row">
                            <div class="col-sm-2">
                                <label>Fancy Color</label>
                            </div>
                            <div class="col-sm-10">
							<?php
                              $fancy_color="select * from  fancy_color where status='1'";
                              $fancyclr=mysqli_query($con,$fancy_color);
                              while($fc=mysqli_fetch_assoc($fancyclr)){
							   if (in_array($fc['fancycolor'], $fancycolorExplode)){  ?>
                            <label for="fancycolor<?php echo $fc['fancycolor'];?>" class="btn push-btn fancyclrbtn active"><?php echo $fc['fancycolor'];?></label>
                            <input type="checkbox" style="display: none;" name="fancycolor[]" value="<?php echo $fc['fancycolor'];?>" id="fancycolor<?php echo $fc['fancycolor'];?>" class="counter" checked>
							<?php }else{ ?>
							<label for="fancycolor<?php echo $fc['fancycolor'];?>" class="btn push-btn fancyclrbtn"><?php echo $fc['fancycolor'];?></label>
                            <input type="checkbox" style="display: none;" name="fancycolor[]" value="<?php echo $fc['fancycolor'];?>" id="fancycolor<?php echo $fc['fancycolor'];?>" class="counter">
                            <?php } } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label>Overtone / Modifier</label>
                            </div>
                            <div class="col-sm-10">
                                <?php $fancy_overtone="select * from  fancy_overtone  where status='1'" ; $fancyclrovertone=mysqli_query($con,$fancy_overtone); while($fcnsovr=mysqli_fetch_assoc($fancyclrovertone)){
								 if (in_array($fcnsovr['overtone'], $fancyovertoneExplode)){ ?>
                                <label for="fancyovertone<?php echo $fcnsovr['overtone'];?>" class="btn push-btn fancyclrbtn active">
                                    <?php echo $fcnsovr[ 'overtone'];?>
                                </label>
                                <input type="checkbox" style="display: none;" name="fancyovertone[]" value="<?php echo $fcnsovr['overtone'];?>" id="fancyovertone<?php echo $fcnsovr['overtone'];?>" class="counter" checked>
								<?php }else{ ?>
								<label for="fancyovertone<?php echo $fcnsovr['overtone'];?>" class="btn push-btn fancyclrbtn">
                                    <?php echo $fcnsovr[ 'overtone'];?>
                                </label>
                                <input type="checkbox" style="display: none;" name="fancyovertone[]" value="<?php echo $fcnsovr['overtone'];?>" id="fancyovertone<?php echo $fcnsovr['overtone'];?>" class="counter">
                                <?php } } ?>
                            </div>
                        </div>
						 <div class="row">
                            <div class="col-sm-2">
                                <label>Intensity</label>
                            </div>
                            <div class="col-sm-10">
							<?php
						   $fancy_color_intensity="select * from  fancy_color_intensity  where status='1'";
						   $fancyclrintense=mysqli_query($con,$fancy_color_intensity);
						   while($fcns=mysqli_fetch_assoc($fancyclrintense))
						   {
							if (in_array($fcns['fancy_intensity'], $fancyintensityExplode)){							
                            ?>
                            <label for="fancyintensity<?php echo $fcns['fancy_intensity'];?>" class="btn push-btn fancyclrbtn active"><?php echo $fcns['semi'];?></label>
                            <input type="checkbox" style="display: none;" name="fancyintensity[]" value="<?php echo $fcns['fancy_intensity'];?>" id="fancyintensity<?php echo $fcns['fancy_intensity'];?>" class="counter" checked>
							<?php }else{ ?>
							 <label for="fancyintensity<?php echo $fcns['fancy_intensity'];?>" class="btn push-btn fancyclrbtn"><?php echo $fcns['semi'];?></label>
                            <input type="checkbox" style="display: none;" name="fancyintensity[]" value="<?php echo $fcns['fancy_intensity'];?>" id="fancyintensity<?php echo $fcns['fancy_intensity'];?>" class="counter">
                            <?php }							
						   }?>
                            </div>
                        </div>
						 <div class="row">
                            <div class="col-sm-2">
                               <label>Type II A</label>
                            </div>
                            <div class="col-sm-10">
							<label><input type="radio" name="type_IIA" value="yes" class="counter" <?php if($type_IIA=='yes'){echo 'checked';}?>> Yes</label>
							<label><input type="radio" name="type_IIA" value="no" class="counter" <?php if($type_IIA=='no'){echo 'checked';}?>> No</label>
                            </div>
                        </div>
						 <div class="row">
                            <div class="col-sm-2">
                               <label>Type II B</label>
                            </div>
                            <div class="col-sm-10">
							<label><input type="radio" name="type_IIB" value="yes" class="counter" <?php if($type_IIB=='yes'){echo 'checked';}?>> Yes</label>
							<label><input type="radio" name="type_IIB" value="no" class="counter" <?php if($type_IIB=='no'){echo 'checked';}?>> No</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Measurements</h4>
                                <hr>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="control-label">Table</label>
                                        </div>
                                        <div class="col-sm-10">

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $tablefrom;?>" id="tablefrom" name="tablefrom">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $tableto;?>" id="tableto" name="tableto">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="control-label">Depth</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $depthfrom;?>" id="depthfrom" name="depthfrom">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $depthto;?>" id="depthto" name="depthto">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="control-label">Height</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $heightfrom;?>" id="heightfrom" name="heightfrom">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $heightto;?>" id="heightto" name="heightto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm-2">
                                            <label class="control-label">Girdle</label>
                                        </div>

                                        <div class="col-sm-10">

                                            <div class="col-sm-6">
                                                <select name="giddlemin" id="giddlemin" class="form-control counter">
                                                    <option value="">Select</option>
                                                    <?php if($giddlemin!='' ){ echo '<option value="'.$giddlemin. '" selected>'.$giddlemin. '</option>'; } $girdle_min="select * from  girdle_min_max  where status='1' and girldle_min!='" .$giddlemin. "'"; $grdlmin=mysqli_query($con,$girdle_min); while($gdmin=mysqli_fetch_assoc($grdlmin)){ echo '<option value="'.$gdmin[ 'girldle_min']. '">'.$gdmin[ 'girldle_min']. '</option>'; } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <select name="giddlemax" id="giddlemax" class="form-control counter">
                                                    <option value="">Select</option>
                                                    <?php if($giddlemax!='' ){ echo '<option value="'.$giddlemax. '" selected>'.$giddlemax. '</option>'; } $girdle_max="select * from  girdle_min_max  where status='1' and girldle_min!='" .$giddlemax. "'"; $grdlmax=mysqli_query($con,$girdle_max); while($gdmax=mysqli_fetch_assoc($grdlmax)){ echo '<option value="'.$gdmax[ 'girldle_min']. '">'.$gdmax[ 'girldle_min']. '</option>'; } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="control-label">Ratio</label>
                                        </div>

                                        <div class="col-sm-10">

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $ratiofrom;?>" id="ratiofrom" name="ratiofrom">
                                                    <div class="input-group-addon">:1.00</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $ratioto;?>" id="ratioto" name="ratioto">
                                                    <div class="input-group-addon">:1.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label class="control-label">Diameter</label>
                                        </div>

                                        <div class="col-sm-10">

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $diameter_min;?>" id="diameter_min" name="diameter_min">
                                                    <div class="input-group-addon">D1</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $diameter_max;?>" id="diameter_max" name="diameter_max">
                                                    <div class="input-group-addon">D2</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Crown Height</label>
                                        </div>
                                        <div class="col-sm-9">

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $crheightfrom;?>" id="crheightfrom" name="crheightfrom">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $crheightto;?>" id="crheightto" name="crheightto">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Crown Angle</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $cranglefrom;?>" id="cranglefrom" name="cranglefrom">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $crangleto;?>" id="crangleto" name="crangleto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Pavillion Depth</label>
                                        </div>

                                        <div class="col-sm-9">

                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $pavdepthfrom;?>" id="pavdepthfrom" name="pavdepthfrom">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $pavdepthto;?>" id="pavdepthto" name="pavdepthto">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Pavillion Angle</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $pavanglefrom;?>" id="pavanglefrom" name="pavanglefrom">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $pavangleto;?>" id="pavangleto" name="pavangleto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Star Length</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter"  value="<?php echo $lengthfrom;?>" id="lengthfrom" name="lengthfrom">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $lengthto;?>" id="lengthto" name="lengthto">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Lower Half %</label>
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter"  value="<?php echo $lowerHalffrom;?>" id="lowerHalffrom" name="lowerHalffrom">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control counter" value="<?php echo $lowerHalfto;?>" id="lowerHalfto" name="lowerHalfto">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



                        <div class="row">

                            <div class="col-sm-12">
                                <h4>Key To Symbol</h4>
                                <hr>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <label class="radio-inline font-normal">
                                                                <input type="radio" name="keycontain" value="contain" class="counter" <?php if($keycontain=='contain'){echo 'checked';}?>>Contains
                                                            </label>
                                                            <label class="radio-inline font-normal">
                                                                <input type="radio" name="keycontain" value="doesnot" class="counter" <?php if($keycontain=='doesnot'){echo 'checked';}?>>Does Not Contains
                                                            </label>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <ul class="symbol-ul">
                                                    <?php $key_symbol="select * from  key_symbol where status='1'" ; $ksmbl=mysqli_query($con,$key_symbol); while($ks=mysqli_fetch_assoc($ksmbl)){
													 if (in_array($ks[ 'keysymbol'], $key_to_symbolExplode)){
													 echo '<li><label class="font-normal"><input type="checkbox" name="key_to_symbol[]" id="key_to_symbol" value="'.$ks[ 'keysymbol']. '" class="counter" checked> &nbsp;&nbsp;'.$ks[ 'keysymbol']. '</label></li>';
													 }else{
													  echo '<li><label class="font-normal"><input type="checkbox" name="key_to_symbol[]" id="key_to_symbol" value="'.$ks[ 'keysymbol']. '" class="counter"> &nbsp;&nbsp;'.$ks[ 'keysymbol']. '</label></li>';
													 } } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a type="button" href="search.php" class="btn btn-primary text-left">
                                    <i class="fa fa-search"></i> RESET SEARCH
                                </a>
                                <button type="submit" name="search" class="btn btn-primary text-left" id="advancesearch">
                                    <i class="fa fa-search"></i> SEARCH
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </section>

    <script type="text/javascript" src="../js/searching.js?updated=<?php echo $randomNumber;?>"></script>
<?php include '../common/footer.php'; ?>