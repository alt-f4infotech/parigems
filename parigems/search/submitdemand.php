<?php
include '../common/header.php';
$userid = $_SESSION['userid'];
error_reporting(0);
$postsearch=$_POST['search'];
$postmydemand=$_POST['mydemand'];
$login=$_POST['login'];
$cerificate=$_POST['cerificate'];
$check=$_POST['check'];
$referenceno=$_POST['referenceno'];
$certificateno=$_POST['certificateno'];
$caretfrom=$_POST['caretfrom'];
$caretto=$_POST['caretto'];
$cut=$_POST['cut'];
$polish=$_POST['polish'];
$symmetry=$_POST['symmetry'];
$color=$_POST['color'];
$fluor=$_POST['fluor'];
$tinge=$_POST['tinge'];
$clarity=$_POST['clarity'];
$key_to_symbol=$_POST['key_to_symbol'];
$keycontain=$_POST['keycontain'];
$fancycolor=$_POST['fancycolor'];
$culet=$_POST['culet'];
$newsearch=$_POST['newsearch'];
$fancyintensity=$_POST['fancyintensity'];
$fancyovertone=$_POST['fancyovertone'];
$inclusive_visibility=$_POST['inclusive_visibility'];
$blackinclfrom=$_POST['blackinclfrom'];
$blackinclto=$_POST['blackinclto'];
$tablefrom=$_POST['tablefrom'];
$tableto=$_POST['tableto'];
$depthfrom=$_POST['depthfrom'];
$depthto=$_POST['depthto'];
$lengthfrom=$_POST['lengthfrom'];
$lengthto=$_POST['lengthto'];
$crheightfrom=$_POST['crheightfrom'];
$crheightto=$_POST['crheightto'];
$cranglefrom=$_POST['cranglefrom'];
$crangleto=$_POST['crangleto'];
$pavdepthfrom=$_POST['pavdepthfrom'];
$pavdepthto=$_POST['pavdepthto'];
$pavanglefrom=$_POST['pavanglefrom'];
$pavangleto=$_POST['pavangleto'];
$ratiofrom=$_POST['ratiofrom'];
$ratioto=$_POST['ratioto'];
$giddlemin=$_POST['giddlemin'];
$giddlemax=$_POST['giddlemax'];
$milkyfrom=$_POST['milkyfrom'];
$milkyto=$_POST['milkyto'];
$diameter_min=$_POST['diameter_min'];
$diameter_max=$_POST['diameter_max'];
$heightfrom=$_POST['heightfrom'];
$heightto=$_POST['heightto'];
$ratetype=$_POST['ratetype'];
$pointer=$_POST['pointer'];
$priceFrom=$_POST['priceFrom'];
$discountFrom=$_POST['discountFrom'];
$discountTo=$_POST['discountTo'];
$newArrival=$_POST['newArrival'];

$qry1='';
$scerti='';
$certiCount=0;
foreach($cerificate as $key => $value)
   {
	 $forcerificate=$cerificate[$key];
	
	 if(isset($forcerificate))
   {
	if($certiCount==0)
	{
	 $demand1=$forcerificate;
	}
	else
	{
	  $demand1=$demand1.','.$forcerificate;
	}
	$getcertificatelist="select * from certificate_master where certi_name='$forcerificate'";
	$listrun=mysqli_query($con,$getcertificatelist);
	if(mysqli_num_rows($listrun)  > 0){
	while($ccr=mysqli_fetch_assoc($listrun))
	{
	$certiqry=" d.certificate_id='".$ccr['certificateid']."'";
	$qry1=$qry1.' OR '.$certiqry;
	
	$scerti=$scerti.','.$forcerificate;
	}
	}else{
	 $certiqry=" d.certificate_id=''";
	$qry1=$qry1.' OR '.$certiqry;
	}
   }
   else
   {
	$qry1="";
   }
   $certiCount++;
   }
    
   if($qry1!='')
   {
	$tqry1= substr($qry1, 4);
	$qry1=' and  ('.$tqry1.')';
   }
   
   $shape='';$shapeCount=0;
   foreach($check as $checkkey => $value)
   {
	$forshape=$check[$checkkey];
	$shape=$shape.','.$forshape;
	if($shapeCount==0)
	{	 
	$demand2=$forshape;
	}
	else
	{	 
	$demand2=$demand2.','.$forshape;
	}
	 if(isset($forshape))
   {
	$shapeqry=" d.diamond_shape='$forshape'";
	$qry2=$qry2.' OR '.$shapeqry;
   }
   else
   {
	$qry2="";
   }
   $shapeCount++;
   }
   if($qry2!='')
   {
	$tqry2 = substr($qry2, 4);
	$qry2=' and ('.$tqry2.')';
   }
   
   if($referenceno!='')
   {
	//$qry3="and d.referenceno='$referenceno'";
	$qry3="";
   }
   else
   {
	$qry3="";
   }
   
   if($caretfrom!='')
   {
	$qry4="and d.weight >= $caretfrom";
   }
   if($caretto!='')
   {
	$qry5="and d.weight <= $caretto";
   }
   $demand3=$caretfrom.'-'.$caretto;
   
   $scut='';$cutCount=0;
    foreach($cut as $cutkey => $value)
   {
	$forcut=$cut[$cutkey];
	if($cutCount==0)
	{	 
	$demand4=$forcut;
	}
	else
	{	 
	$demand4=$demand4.','.$forcut;
	}	
	 if(isset($forcut))
   {
	if($forcut!=''){
	$forcut=" d.cut='$forcut'";
	$qry6=$qry6.' OR '.$forcut;
	$scut=$scut.','.$cut[$cutkey];
	}
   }
   else
   {
	$qry6="";
   }
   $cutCount++;
   }
   if($qry6!='')
   {
	$tqry6 = substr($qry6, 4);
	$qry6=' and ('.$tqry6.')';
   }
   
   $spolish='';$polishCount=0;
   foreach($polish as $polishkey => $value)
   {
	$forpolish=$polish[$polishkey];
	$spolish=$spolish.','.$forpolish;
	
	if($polishCount==0)
	{	 
	$demand7=$forpolish;
	}
	else
	{	 
	$demand7=$demand7.','.$forpolish;
	}
	 if(isset($forpolish))
   {
	if($forpolish!=''){
	$forpolish=" d.polish='$forpolish'";
	$qry7=$qry7.' OR '.$forpolish;
	}
   }
   else
   {
	$qry7="";
   }
   $polishCount++;
   }
   if($qry7!='')
   {
	$tqry7 = substr($qry7, 4);
	$qry7=' and ('.$tqry7.')';
   }
   
   $ssymmetry='';$symmCount=0;
   foreach($symmetry as $symmetrykey => $value)
   {
	$forsymmetry=$symmetry[$symmetrykey];
	$ssymmetry=$ssymmetry.','.$forsymmetry;
	
	if($symmCount==0)
	{	 
	$demand8=$forsymmetry;
	}
	else
	{	 
	$demand8=$demand8.','.$forsymmetry;
	}
	 if(isset($forsymmetry))
   {
	if($forsymmetry!=''){
	$forsymmetry=" d.symmetry='$forsymmetry'";
	$qry8=$qry8.' OR '.$forsymmetry;
	}
   }
   else
   {
	$qry8="";
   }
   $symmCount++;
   }
   if($qry8!='')
   {
	$tqry8 = substr($qry8, 4);
	$qry8=' and ('.$tqry8.')';
   }
   
   $scolor='';$colorCount=0;
   foreach($color as $colorkey => $value)
   {
	$forcolor=$color[$colorkey];
	$scolor=$scolor.','.$forcolor;
	
	if($colorCount==0)
	{	 
	$demand9=$forcolor;
	}
	else
	{	 
	$demand9=$demand9.','.$forcolor;
	}
	 if(isset($forcolor))
   {
	if($forcolor!=''){
	$forcolor=" d.color='$forcolor'";
	$qry9=$qry9.' OR '.$forcolor;
	}
   }
   else
   {
	$qry9="";
   }
   $colorCount++;
   }
   if($qry9!='')
   {
	$tqry9 = substr($qry9, 4);
	$qry9=' and ('.$tqry9.')';
   }
   
   $sfluor='';$fluroCount=0;
   foreach($fluor as $fluorkey => $value)
   {
	$forfluor=$fluor[$fluorkey];
	$sfluor=$sfluor.','.$forfluor;
	
	if($fluroCount==0)
	{	 
	$demand10=$forfluor;
	}
	else
	{	 
	$demand10=$demand10.','.$forfluor;
	}
	 if(isset($forfluor))
   {
	if($forfluor!=''){
	$forfluor=" d.fluoresence='$forfluor'";
	$qry10=$qry10.' OR '.$forfluor;
	}
   }
   else
   {
	$qry10="";
   }
   $fluroCount++;
   }
   if($qry10!='')
   {
	$tqry10 = substr($qry10, 4);
	$qry10=' and ('.$tqry10.')';
   }
   
   $stinge='';$tingeCount=0;
   foreach($tinge as $tingekey => $value)
   {
	$fortinge=$tinge[$tingekey];
	$stinge=$stinge.','.$fortinge;
	
	if($tingeCount==0)
	{	 
	$demand11=$fortinge;
	}
	else
	{	 
	$demand11=$demand11.','.$fortinge;
	}
	 if(isset($fortinge))
   {
	if($fortinge!=''){
	$fortinge=" d.tinge='$fortinge'";
	$qry11=$qry11.' OR '.$fortinge;
	}
   }
   else
   {
	$qry11="";
   }
   $tingeCount++;
   }
   if($qry11!='')
   {
	$tqry11 = substr($qry11, 4);
	$qry11=' and ('.$tqry11.')';
   }
   
   $sclarity='';$clarityCount=0;
   foreach($clarity as $claritykey => $value)
   {
	$forclarity=$clarity[$claritykey];
	$sclarity=$sclarity.','.$forclarity;
	
	if($clarityCount==0)
	{	 
	$demand12=$forclarity;
	}
	else
	{	 
	$demand12=$demand12.','.$forclarity;
	}
	 if(isset($forclarity))
   {
	if($forclarity!=''){
	$forclarity=" d.clarity='$forclarity'";
	$qry12=$qry12.' OR '.$forclarity;
	}
   }
   else
   {
	$qry12="";
   }
   $clarityCount++;
   }
   if($qry12!='')
   {
	$tqry12 = substr($qry12, 4);
	$qry12=' and ('.$tqry12.')';
   }
   
    $skey_to_symbol='';$keyCount=0;
   foreach($key_to_symbol as $key_to_symbolkey => $value)
   {
	$forkey_to_symbol=$key_to_symbol[$key_to_symbolkey];
	$skey_to_symbol=$key_to_symbol.','.$forkey_to_symbol;
	
	if($keyCount==0)
	{	 
	$demand13=$forkey_to_symbol;
	}
	else
	{	 
	$demand13=$demand13.','.$forkey_to_symbol;
	}
	 if(isset($forkey_to_symbol))
   {
	if($forkey_to_symbol!=''){
		if($keycontain=='doesnot')
	 {
	$getkysymbollist="select * from diamond_keysymbol where kysymbol='$forkey_to_symbol'";
	$symbollistrun=mysqli_query($con,$getkysymbollist);
	if(mysqli_num_rows($symbollistrun)  > 0){
	while($ksr=mysqli_fetch_assoc($symbollistrun))
	{
	$forkey_to_symbol=" d.diamond_id!='".$ksr['diamond_id']."'";
	$qry13=$qry13.' AND '.$forkey_to_symbol;
	}
	}else{
	 $forkey_to_symbol=" d.diamond_id!=''";
	$qry13=$qry13.' AND '.$forkey_to_symbol;
	}
	 }
	 else
	 {
	$getkysymbollist="select * from diamond_keysymbol where kysymbol='$forkey_to_symbol'";
	$symbollistrun=mysqli_query($con,$getkysymbollist);
	if(mysqli_num_rows($symbollistrun)  > 0){
	while($ksr=mysqli_fetch_assoc($symbollistrun))
	{
	$forkey_to_symbol=" d.diamond_id='".$ksr['diamond_id']."'";
	$qry13=$qry13.' OR '.$forkey_to_symbol;
	}
	}
	else{
	 $forkey_to_symbol=" d.diamond_id=''";
	$qry13=$qry13.' AND '.$forkey_to_symbol;
	}
	 }
	}
   }
   else
   {
	$qry13="";
   }
   $keyCount++;
   }
   if($qry13!='')
   {
	$tqry13 = substr($qry13, 4);
	$qry13=' and ('.$tqry13.')';
   }
   
   $fncyclr='';$fancyCount=0;
	foreach($fancycolor as $fancycolorkey => $value)
   {
	$forfancycolor=$fancycolor[$fancycolorkey];
	$fncyclr=$fncyclr.','.$forfancycolor;
	
	if($fancyCount==0)
	{	 
	$demand14=$forfancycolor;
	}
	else
	{	 
	$demand14=$demand14.','.$forfancycolor;
	}
	 if(isset($forfancycolor))
   {
	if($forfancycolor!=''){
	$forfancycolor=" d.fancycolor1='$forfancycolor'";
	$qry14=$qry14.' OR '.$forfancycolor;
	}
   }
   else
   {
	$qry14="";
   }
   $fancyCount++;
   }
   if($qry14!='')
   {
	$tqry14= substr($qry14, 4);
	$qry14=' and ('.$tqry14.')';
   }
   
   $cutlet='';$culetCount=0;
	foreach($culet as $culetkey => $value)
   {
	$forculet=$culet[$culetkey];
	$cutlet=$cutlet.','.$forculet;
	
	
	if($culetCount==0)
	{	 
	$demand15=$forculet;
	}
	else
	{	 
	$demand15=$demand15.','.$forculet;
	}
	 if(isset($forculet))
   {
	if($forculet!=''){
	$forculet=" d.cutlet='$forculet'";
	$qry15=$qry15.' OR '.$forculet;
	}
   }
   else
   {
	$qry15="";
   }
   $culetCount++;
   }
   if($qry15!='')
   {
	$tqry15= substr($qry15, 4);
	$qry15=' and ('.$tqry15.')';
   }
  
   
   if($inclusive_visibility!=''){
	$demand18=$demand18.','.$inclusive_visibility;
	$inclusive_visibility=" d.inclusive_visibility='$inclusive_visibility'";
	$qry18=$qry18.' OR '.$inclusive_visibility;
	}
   else
   {
	$qry18="";
   }
   if($qry18!='')
   {
	$tqry18= substr($qry18, 4);
	$qry18=' and ('.$tqry18.')';
   }
   $inetnsityCount=0;
   foreach($fancyintensity as $fancyintensitykey => $value)
   {
	$forfancyintensity=$fancyintensity[$fancyintensitykey];	
	
	if($inetnsityCount==0)
	{	 
	$demand19=$forfancyintensity;
	}
	else
	{	 
	$demand19=$demand19.','.$forfancyintensity;
	}
	
	 if(isset($forfancyintensity))
   {
	if($forfancyintensity!=''){
	$forfancyintensity=" d.fancyintensity='$forfancyintensity'";
	$qry19=$qry19.' OR '.$forfancyintensity;
	}
   }
   else
   {
	$qry19="";
   }
   $inetnsityCount++;
   }
   if($qry19!='')
   {
	$tqry19= substr($qry19, 4);
	$qry19=' and ('.$tqry19.')';
   }
   $overtToneCount=0;
   foreach($fancyovertone as $fancyovertonekey => $value)
   {
	$forfancyovertone=$fancyovertone[$fancyovertonekey];
	
	if($overtToneCount==0)
	{	 
	$demand20=$forfancyovertone;
	}
	else
	{	 
	$demand20=$demand20.','.$forfancyovertone;
	}
	 if(isset($forfancyovertone))
   {
	if($forfancyovertone!=''){
	$forfancyovertone=" d.fancyovertone='$forfancyovertone'";
	$qry20=$qry20.' OR '.$forfancyovertone;
	}
   }
   else
   {
	$qry20="";
   }
   $overtToneCount++;
   }
   if($qry20!='')
   {
	$tqry20= substr($qry20, 4);
	$qry20=' and ('.$tqry20.')';
   }
   
   if($tablefrom!='')
   {
	$qry21="and d.table >= $tablefrom";
   }
  
   if($tableto!='')
   {
	$qry22="and d.table <= $tableto";
   }
   $demand21=$tablefrom.'-'.$tableto;
   if($depthfrom!='')
   {
	$qry23="and d.depth >= $depthfrom";
   }
   if($depthto!='')
   {
	$qry24="and d.depth <= $depthto";
   }
   $demand24=$depthfrom.'-'.$depthto;
    if($lengthfrom!='')
   {
	$qry25="and d.length >= $lengthfrom";
   }
   if($lengthto!='')
   {
	$qry26="and d.length <= $lengthto";
   }
   $demand26=$lengthfrom.'-'.$lengthto;
 if($crheightfrom!='')
   {
	$qry27="and d.crown_height >= $crheightfrom";
   }
   if($crheightto!='')
   {
	$qry28="and d.crown_height <= $crheightto";
   }
   $demand28=$crheightfrom.'-'.$crheightto;
if($cranglefrom!='')
   {
	$qry29="and d.crown_angle >= $cranglefrom";
   }
   if($crangleto!='')
   {
	$qry30="and d.crown_angle <= $crangleto";
   }
    $demand30=$cranglefrom.'-'.$crangleto;
if($pavdepthfrom!='')
   {
	$qry31="and d.pavilion_height >= $pavdepthfrom";
   }
   if($pavdepthto!='')
   {
	$qry31="and d.pavilion_height <= $pavdepthto";
   }
    $demand31=$pavdepthfrom.'-'.$pavdepthto;
   if($pavanglefrom!='')
   {
	$qry33="and d.pavilion_angle >= $pavanglefrom";
   }
   if($pavangleto!='')
   {
	$qry34="and d.pavilion_angle <= $pavangleto";
   }
$demand34=$pavanglefrom.'-'.$pavangleto;
  if($ratiofrom!='')
   {
	$qry35="and d.diameter_ratio >= $ratiofrom";
   }
   if($ratioto!='')
   {
	$qry36="and d.diameter_ratio <= $ratioto";
   }
 $demand36=$ratiofrom.'-'.$ratioto;
 if($giddlemin!='')
   {
	$qry37="and d.girdlemin = '$giddlemin'";
   }
   if($giddlemax!='')
   {
	$qry38="and d.girdlemax = '$giddlemax'";
   }
    $demand38=$giddlemin.'-'.$giddlemax;
   if($blackinclfrom!='' && $blackinclto!='')
   {
	$blres1=mysqli_query($con,"select * from black_inclusion where blackinclusionname='$blackinclfrom'");
	$r1=mysqli_fetch_assoc($blres1);
	$id1=$r1['id'];
	$blres2=mysqli_query($con,"select * from black_inclusion where blackinclusionname='$blackinclto'");
	$r2=mysqli_fetch_assoc($blres2);
	$id2=$r2['id'];
	$blres=mysqli_query($con,"select * from black_inclusion where  status='1' and id BETWEEN $id1 AND $id2");
	while($r=mysqli_fetch_assoc($blres))
	{
	 $forblckincl=" d.black_inclusion='".$r['blackinclusionname']."'";
	$qry39=$qry39.' OR '.$forblckincl;
	}
   }
   else if($blackinclfrom!='' && $blackinclto==''){
	$qry39="and d.black_inclusion='$blackinclfrom'";
	}
	else if($blackinclto!='' && $blackinclfrom==''){
	$qry39="and d.black_inclusion='$blackinclto'";
	}
   $demand39=$blackinclfrom.'-'.$blackinclto;
if($milkyfrom!='' && $milkyto!='')
   {
	$mlres1=mysqli_query($con,"select * from milky where milkyname='$milkyfrom'");
	$mr1=mysqli_fetch_assoc($mlres1);
	$mid1=$mr1['id'];
	$mlres2=mysqli_query($con,"select * from milky where milkyname='$milkyto'");
	$mr2=mysqli_fetch_assoc($mlres2);
	$mid2=$mr2['id'];
	$mlres=mysqli_query($con,"select * from milky where  status='1' and id BETWEEN $mid1 AND $mid2");
	while($mr=mysqli_fetch_assoc($mlres))
	{
	 $forml=" d.milky='".$mr['milkyname']."'";
	$qry40=$qry40.' OR '.$forml;
	}
   }
   else if($milkyfrom!='' && $milkyto==''){
	$qry40="and d.milky='$milkyfrom'";
	}
	else if($milkyto!='' && $milkyfrom==''){
	$qry40="and d.milky='$milkyto'";
	}
   $demand40=$milkyfrom.'-'.$milkyto;
   if($diameter_min!='')
   {
	$qry41="and d.diameter_min >= '$diameter_min'";
   }
   if($diameter_max!='')
   {
	$qry42="and d.diameter_max <= '$diameter_max'";
   }
   $demand42=$diameter_min.'-'.$diameter_max;
   if($heightfrom!='')
   {
	$qry43="and d.height >= '$heightfrom'";
   }
   if($heightto!='')
   {
	$qry44="and d.height <= '$heightto'";
   }
   $demand44=$heightfrom.'-'.$heightto;
   
   if($ratetype!=''){
	if($ratetype=='both'){
	 $qry45=" and (ratetype='percarat' OR ratetype='raprate')";
	}
	else{
	 $qry45=" and ratetype='$ratetype'";
	}
	}
   else
   {
	$qry45="";
   }
   $pointerCount=0;
   for($pointerKey=0;$pointerKey < count($pointer);$pointerKey++)
   {
	$pointerWight=$pointer[$pointerKey];
	 if($pointerWight!=''){	  
	 
	  if($pointerCount==0)
	 {	 
	 $demand45=$pointerWight;
	 }
	 else
	 {	 
	 $demand45=$demand45.','.$pointerWight;
	 }
	
	 }
	else
	{
	 $demand45="";
	}
	$pointerCount++;
   }
   
  $demand46=$newArrival;
   $demand47=$priceFrom.'-'.$priceTo;
   $demand48=$discountFrom.'-'.$discountTo;
if(isset($postmydemand))
   {
	if($demand1!=''){ $demand1= 'Certificate:'.$demand1; }else{$demand1="";}
	if($demand2!=''){ $demand2= '<br>Shape:'.$demand2;}else{$demand2="";}
	if($demand3!='-'){ $demand3= '<br>Carat:'.$demand3;}else{$demand3="";}
	if($demand4!=''){ $demand4= '<br>Cut:'.$demand4;}else{$demand4="";}
	if($demand7!=''){ $demand7= '<br>Polish:'.$demand7;}else{$demand7="";}
	if($demand8!=''){ $demand8= '<br>Symmetry:'.$demand8;}else{$demand8="";}
	if($demand9!=''){ $demand9= '<br>Color:'.$demand9;}else{$demand9="";}
	if($demand10!=''){ $demand10= '<br>Flurosence:'.$demand10;}else{$demand10="";}
	if($demand11!=''){ $demand11= '<br>Tinge:'.$demand11;}else{$demand11="";}
	if($demand12!=''){ $demand12= '<br>Clarity:'.$demand12;}else{$demand12="";}
	if($demand13!=''){ $demand13= '<br>Key To Symbols:'.$demand13;}else{$demand13="";}
	if($demand14!=''){ $demand14= '<br>Fancy Color::'.$demand14;}else{$demand14="";}
	if($demand15!=''){ $demand15= '<br>Culet:'.$demand15;}else{$demand15="";}
	if($demand18!=''){ $demand18= '<br>Inclusion Visibility:'.$demand18;}else{$demand18="";}
	if($demand19!=''){ $demand19= '<br>Fancy Color Intensity:'.$demand19;}else{$demand19="";}
	if($demand20!=''){ $demand20= '<br>Fancy Color Overtone:'.$demand20;}else{$demand20="";}
	if($demand21!='-'){ $demand21= '<br>Table:'.$demand21;}else{$demand21="";}
	if($demand24!='-'){ $demand24= '<br>Depth:'.$demand24;}else{$demand24="";}
	if($demand26!='-'){ $demand26= '<br>Star Length:'.$demand26;}else{$demand26="";}
	if($demand28!='-'){ $demand28= '<br>Crown Height:'.$demand28;}else{$demand28="";}
	if($demand30!='-'){ $demand30= '<br>Crown Angle:'.$demand30;}else{$demand30="";}
	if($demand31!='-'){ $demand31= '<br>Pavilion Depth:'.$demand31;}else{$demand31="";}
	if($demand34!='-'){ $demand34= '<br>Pavilion Angle:'.$demand34;}else{$demand34="";}
	if($demand36!='-'){ $demand36= '<br>DR:'.$demand36;}else{$demand36="";}
	if($demand38!='-'){ $demand38= '<br>Girdle Min/Max:'.$demand38;}else{$demand38="";}
	if($demand39!='-'){ $demand39= '<br>Black Inclusion:'.$demand39;}else{$demand39="";}
	if($demand40!='-'){ $demand40= '<br>Milky:'.$demand40;}else{$demand40="";}
	if($demand42!='-'){ $demand42= '<br>Diameter Min/max:'.$demand42;}else{$demand42="";}
	if($demand44!='-'){ $demand44= '<br>Height:'.$demand44;}else{$demand44="";}
	if($demand45!=''){ $demand45= '<br>Pointers:'.$demand45;}else{$demand45="";}
	if($demand46!=''){ $demand46= '<br>New Arrival:'.$demand46;}else{$demand46="";}
	if($demand47!='-'){ $demand47= '<br>Price:'.$demand47;}else{$demand47="";}
	if($demand48!='-'){ $demand48= '<br>Discount:'.$demand48;}else{$demand48="";}
	
	$demand=addslashes( $demand1.$demand2.$demand3.$demand4.$demand7.$demand8.$demand9.$demand10 .$demand11.$demand12.$demand13.$demand14.$demand15.$demand18.$demand19.$demand20.$demand21.$demand24.$demand26.$demand28.$demand30.$demand31.$demand34.$demand36.$demand38.$demand39.$demand40.$demand42.$demand44.$demand45.$demand46.$demand47.$demand48);
	//echo '<br><br><br><br><br><br>'.$demand;
	if($demand1!='' || $demand2!='' || $demand3!='-' || $demand4!='' || $demand7!='' || $demand8!='' || $demand9!='' || $demand10!='' || $demand11!='' || $demand12!='' || $demand13!='' || $demand20!='' || $demand21!='-' || $demand24!='-' || $demand26!='-' || $demand28!='-' || $demand30!='-' || $demand31!='-' || $demand34!='-' || $demand36!='-' || $demand38!='-' || $demand39!='-' || $demand40!='-' || $demand42!='-' || $demand44!='-' || $demand45!='' || $demand46!='' || $demand47!='' || $demand48!='')
	{
	$deleteprevious="INSERT INTO `mydemand`(`description`, `userid`, `entry`, `deamndstatus`) VALUES ('$demand','$userid',NOW(),'1')";
if(mysqli_query($con,$deleteprevious))
{
	$getemail="select * from basic_details where userid='$userid'";
	$result=mysqli_query($con,$getemail);
	 while($row=mysqli_fetch_assoc($result))
	 {
	  $emailid=$row['emailid'];
	  $username=$row['username'];
	 }
$from  ="admin@parigems.com";
$to = $emailid; 
$subject = 'My Demands';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<br><br><br>
 Hello '.$username.',<br><br><br>
Your Demands Sent Successfully.<br>
<br><br>
 <br><br>
<a href="parigems.co">www.parigems.co</a></center>
</div>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
?>
<body onload="bootbox.alert('Your Demand Sent Successfully.', function() {
window.location.href='mydemand.php';
	});"></body>
<?php
}
 // }
	}
   else{
	?>
<body onload="bootbox.alert('Select Items For Search Demand.', function() {
window.location.href='senddemand.php';
	});"></body>
<?php
}
   }
else{
	?>
<body onload="bootbox.alert('Select Items For Search Demand.', function() {
window.location.href='senddemand.php';
	});"></body>
<?php
}
?>
<script type="text/javascript" src="../js/search.js"></script>
</body>
</html>
<?php
include "../common/footer.php";
?>