<?php
include '../common/config.php';

error_reporting(0);

$login=$_GET['login'];
$cerificate=explode(',',$_GET['cerificate']);
$check=explode(',',$_GET['check']);
$referenceno=$_GET['referenceno'];
$certificateno=$_GET['certificateno'];
$caretfrom=$_GET['caretfrom'];
$caretto=$_GET['caretto'];
$cut=explode(',',$_GET['cut']);
$polish=explode(',',$_GET['polish']);
$symmetry=explode(',',$_GET['symmetry']);
$color=explode(',',$_GET['color']);
$fluor=explode(',',$_GET['fluor']);
$tinge=explode(',',$_GET['tinge']);
$clarity=explode(',',$_GET['clarity']);
$newsearch=$_GET['newsearch'];
$keycontain=$_GET['keycontain'];
$key_to_symbol=explode(',',$_GET['key_to_symbol']);
$fancycolor=explode(',',$_GET['fancycolor']);
$culet=explode(',',$_GET['culet']);
$fancyintensity=explode(',',$_GET['fancyintensity']);
$fancyovertone=explode(',',$_GET['fancyovertone']);
$inclusive_visibility=explode(',',$_GET['inclusive_visibility']);
$blackinclfrom=$_GET['blackinclfrom'];
$blackinclto=$_GET['blackinclto'];
$browninclfrom=$_GET['browninclfrom'];
$browninclto=$_GET['browninclto'];
$tablefrom=$_GET['tablefrom'];
$tableto=$_GET['tableto'];
$depthfrom=$_GET['depthfrom'];
$depthto=$_GET['depthto'];
$lengthfrom=$_GET['lengthfrom'];
$lengthto=$_GET['lengthto'];
$crheightfrom=$_GET['crheightfrom'];
$crheightto=$_GET['crheightto'];
$cranglefrom=$_GET['cranglefrom'];
$crangleto=$_GET['crangleto'];
$pavdepthfrom=$_GET['pavdepthfrom'];
$pavdepthto=$_GET['pavdepthto'];
$pavanglefrom=$_GET['pavanglefrom'];
$pavangleto=$_GET['pavangleto'];
$ratiofrom=$_GET['ratiofrom'];
$ratioto=$_GET['ratioto'];
$giddlemin=$_GET['giddlemin'];
$giddlemax=$_GET['giddlemax'];
$milkyfrom=$_GET['milkyfrom'];
$milkyto=$_GET['milkyto'];
$diameter_min=$_GET['diameter_min'];
$diameter_max=$_GET['diameter_max'];
$heightfrom=$_GET['heightfrom'];
$heightto=$_GET['heightto'];
$lowerHalffrom=$_GET['lowerHalffrom'];
$lowerHalfto=$_GET['lowerHalfto'];
$priceFrom=$_GET['priceFrom'];
$priceTo=$_GET['priceTo'];
$discountFrom=$_GET['discountFrom'];
$discountTo=$_GET['discountTo'];

$pointer=explode(',',$_GET['pointer']);

$newArrival=$_GET['newArrival'];
$stockId=$_GET['stockId'];
$H_A=$_GET['H_A'];
$type_IIA=$_GET['type_IIA'];
$type_IIB=$_GET['type_IIB'];
$qry1='';
$scerti='';

	for($key=0;$key < count($cerificate);$key++)
   {
	$forcerificate=$cerificate[$key];
	 if($forcerificate!='')
   {
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
   }
   
   if($qry1!='')
   {
	$tqry1= substr($qry1, 4);
	$qry1=' and  ('.$tqry1.')';
   }
   
   $shape='';
  
	for($checkkey=0;$checkkey < count($check);$checkkey++)
   {
	$forshape=$check[$checkkey];
	$shape=$shape.','.$forshape;
	 if($forshape!='')
   {
	$shapeqry=" d.diamond_shape='$forshape'";
	$qry2=$qry2.' OR '.$shapeqry;
   }
   else
   {
	$qry2="";
   }
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
   
   $scut='';
   
	for($cutkey=0;$cutkey < count($cut);$cutkey++)
   {
	$forcut=$cut[$cutkey];
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
   }
   if($qry6!='')
   {
	$tqry6 = substr($qry6, 4);
	$qry6=' and ('.$tqry6.')';
   }
   
   $spolish='';
  
	for($polishkey=0;$polishkey < count($polish);$polishkey++)
   {
	$forpolish=$polish[$polishkey];
	$spolish=$spolish.','.$forpolish;
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
   }
   if($qry7!='')
   {
	$tqry7 = substr($qry7, 4);
	$qry7=' and ('.$tqry7.')';
   }
   
   $ssymmetry='';
   
	for($symmetrykey=0;$symmetrykey < count($symmetry);$symmetrykey++)
   {
	$forsymmetry=$symmetry[$symmetrykey];
	$ssymmetry=$ssymmetry.','.$forsymmetry;
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
   }
   if($qry8!='')
   {
	$tqry8 = substr($qry8, 4);
	$qry8=' and ('.$tqry8.')';
   }
   
   $scolor='';
 
	for($colorkey=0;$colorkey < count($color);$colorkey++)
   {
	$forcolor=$color[$colorkey];
	$scolor=$scolor.','.$forcolor;
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
   }
   if($qry9!='')
   {
	$tqry9 = substr($qry9, 4);
	$qry9=' and ('.$tqry9.')';
   }
   
   $sfluor='';
  
	for($fluorkey=0;$fluorkey < count($fluor);$fluorkey++)
   {
	$forfluor=$fluor[$fluorkey];
	$sfluor=$sfluor.','.$forfluor;
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
   }
   if($qry10!='')
   {
	$tqry10 = substr($qry10, 4);
	$qry10=' and ('.$tqry10.')';
   }
   
   $stinge='';
  
	for($tingekey=0;$tingekey < count($tinge);$tingekey++)
   {
	$fortinge=$tinge[$tingekey];
	$stinge=$stinge.','.$fortinge;
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
   }
   if($qry11!='')
   {
	$tqry11 = substr($qry11, 4);
	$qry11=' and ('.$tqry11.')';
   }
   
   $sclarity='';
  
	for($claritykey=0;$claritykey < count($clarity);$claritykey++)
   {
	$forclarity=$clarity[$claritykey];
	$sclarity=$sclarity.','.$forclarity;
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
   }
   if($qry12!='')
   {
	$tqry12 = substr($qry12, 4);
	$qry12=' and ('.$tqry12.')';
   }
   
    $ksmbl='';
	for($key_to_symbolkey=0;$key_to_symbolkey < count($key_to_symbol);$key_to_symbolkey++)
   {
	$forkey_to_symbol=$key_to_symbol[$key_to_symbolkey];
	$ksmbl=$ksmbl.','.$forkey_to_symbol;
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
   }
   
   if($qry13!='')
   {
	$tqry13= substr($qry13, 4);
	$qry13=' and ('.$tqry13.')';
   }
   
    $fncyclr='';
	for($fancycolorkey=0;$fancycolorkey < count($fancycolor);$fancycolorkey++)
   {
	$forfancycolor=$fancycolor[$fancycolorkey];
	$fncyclr=$fncyclr.','.$forfancycolor;
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
   }
   if($qry14!='')
   {
	$tqry14= substr($qry14, 4);
	$qry14=' and ('.$tqry14.')';
   }
   
   $cutlet='';
	for($culetkey=0;$culetkey < count($culet);$culetkey++)
   {
	$forculet=$culet[$culetkey];
	$cutlet=$cutlet.','.$forculet;
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
   }
   if($qry15!='')
   {
	$tqry15= substr($qry15, 4);
	$qry15=' and ('.$tqry15.')';
   }
   
    $inclusive_visibilityNew='';
	for($inclKey=0;$inclKey < count($inclusive_visibility);$inclKey++)
   {
	$forinclusive_visibility=trim($inclusive_visibility[$inclKey]);
	$inclusive_visibilityNew=$inclusive_visibilityNew.','.$forinclusive_visibility;
	 if(isset($forinclusive_visibility))
   {
	if($forinclusive_visibility!=''){
	$forinclusive_visibility=" d.inclusive_visibility='$forinclusive_visibility'";
	$qry18=$qry18.' OR '.$forinclusive_visibility;
	}
   }
   else
   {
	$qry18="";
   }
   }
   if($qry18!='')
   {
	$tqry18= substr($qry18, 4);
	$qry18=' and ('.$tqry18.')';
   }
	/*if($inclusive_visibility!=''){
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
   */
   
	for($fancyintensitykey=0;$fancyintensitykey < count($fancyintensity);$fancyintensitykey++)
   {
	$forfancyintensity=$fancyintensity[$fancyintensitykey];
	if($forfancyintensity!=''){
	$forfancyintensity=" d.fancyintensity='$forfancyintensity'";
	$qry19=$qry19.' OR '.$forfancyintensity;
	}
   else
   {
	$qry19="";
   }
   }
   if($qry19!='')
   {
	$tqry19= substr($qry19, 4);
	$qry19=' and ('.$tqry19.')';
   }
   
   for($fancyovertonekey=0;$fancyovertonekey < count($fancyovertone);$fancyovertonekey++)
   {
	$forfancyovertone=$fancyovertone[$fancyovertonekey];
	if($forfancyovertone!=''){
	$forfancyovertone=" d.fancyovertone='$forfancyovertone'";
	$qry20=$qry20.' OR '.$forfancyovertone;
	}
   else
   {
	$qry20="";
   }
   }
   if($qry20!='')
   {
	$tqry20= substr($qry20, 4);
	$qry20=' and ('.$tqry20.')';
   }
   
//   if($fancyovertone!=''){
//	$qry20=" and d.fancyovertone='$fancyovertone'";
//	}
//	else
//   {
//	$qry20="";
//   }
   
  if($tablefrom!='')
   {
	$qry21="and d.table >= $tablefrom";
   }
  
   if($tableto!='')
   {
	$qry22="and d.table <= $tableto";
   }
   
   if($depthfrom!='')
   {
	$qry23="and d.depth >= $depthfrom";
   }
   if($depthto!='')
   {
	$qry24="and d.depth <= $depthto";
   }
   
    if($lengthfrom!='')
   {
	$qry25="and d.length >= $lengthfrom";
   }
   if($lengthto!='')
   {
	$qry26="and d.length <= $lengthto";
   }
   
 if($crheightfrom!='')
   {
	$qry27="and d.crown_height >= $crheightfrom";
   }
   if($crheightto!='')
   {
	$qry28="and d.crown_height <= $crheightto";
   }
if($cranglefrom!='')
   {
	$qry29="and d.crown_angle >= $cranglefrom";
   }
   if($crangleto!='')
   {
	$qry30="and d.crown_angle <= $crangleto";
   }
if($pavdepthfrom!='')
   {
	$qry31="and d.pavilion_height >= $pavdepthfrom";
   }
   if($pavdepthto!='')
   {
	$qry31="and d.pavilion_height <= $pavdepthto";
   }
   if($pavanglefrom!='')
   {
	$qry33="and d.pavilion_angle >= $pavanglefrom";
   }
   if($pavangleto!='')
   {
	$qry34="and d.pavilion_angle <= $pavangleto";
   }

  if($ratiofrom!='')
   {
	$qry35="and d.diameter_ratio >= $ratiofrom";
   }
   if($ratioto!='')
   {
	$qry36="and d.diameter_ratio <= $ratioto";
   }
 
 if($giddlemin!='')
   {
	$qry37="and d.girdlemin = '$giddlemin'";
   }
   if($giddlemax!='')
   {
	$qry38="and d.girdlemax = '$giddlemax'";
   }
   
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
   
   if($diameter_min!='')
   {
	$qry41="and d.diameter_min >= '$diameter_min'";
   }
   if($diameter_max!='')
   {
	$qry42="and d.diameter_max <= '$diameter_max'";
   }
   
   if($heightfrom!='')
   {
	$qry43="and d.height >= '$heightfrom'";
   }
   if($heightto!='')
   {
	$qry44="and d.height <= '$heightto'";
   }
   
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
   
   for($pointerKey=0;$pointerKey < count($pointer);$pointerKey++)
   {
	$pointerWight=$pointer[$pointerKey];
	 if($pointerWight!=''){
	 if($pointerWight!='6')
		{
		$forWight=" d.weight BETWEEN $pointerWight";
		$qry46=$qry46.' OR '.$forWight;
		}
		else{
		$forWight=" d.weight >=$pointerWight";
		$qry46=$qry46.' OR '.$forWight;	
		}
	 }
	else
	{
	 $qry46="";
	}
   }
   if($qry46!='')
   {
	$tqry46= substr($qry46, 4);
	$qry46=' and ('.$tqry46.')';
   }
   
   if($certificateno!='')
   {
	$qry47=" and c.certi_no='$certificateno'";
   }
   else{
	$qry47='';
   }
   
   
   if($lowerHalffrom!='')
   {
	$qry48="and d.lower_half >= $lowerHalffrom";
   }
   if($lowerHalfto!='')
   {
	$qry49="and d.lower_half <= $lowerHalfto";
   }
   
   
   if($newArrival=='yes')
   {
	$qry50=" and DATE(d.entrydate) >= DATE_SUB(CURDATE(), INTERVAL 2 DAY)";
   }
   else if($newArrival=='no')
   {
	$qry50=" and DATE(d.entrydate) < DATE_SUB(CURDATE(), INTERVAL 2 DAY)";
   }
   else{
	$qry50="";
   }
   
   if($priceFrom!='')
   {
	$qry51="and s.pc >= $priceFrom";
   }
   if($priceTo!='')
   {
	$qry52="and s.pc <= $priceTo";
   }
   
   if($discountFrom!='')
   {
	$qry53="and s.discount1 >= $discountFrom";
   }
   if($discountTo!='')
   {
	$qry54="and s.discount1 <= $discountTo";
   }
   if($stockId!=''){
	$qry55=" and d.referenceno='$stockId'";
   }
   else{$qry55="";}
   
   if($browninclfrom!='' && $browninclto=='')
   {
   $qry56="and d.brown_inclusion='$browninclfrom'";
   }
   else if($browninclto!='' && $browninclfrom=='')
   {
   $qry57="and d.brown_inclusion='$browninclto'";
   }
   else if($browninclto!='' && $browninclfrom!='')
   {
   $qry57="and (d.brown_inclusion='$browninclfrom' OR d.brown_inclusion='$browninclto')";
   }
   else{
	$qry56='';
	$qry57='';
   }
   
   
   if($H_A=='no')
   {
	$qry58=" and d.H_A=''";
   }
   else if($H_A=='yes'){
	$qry58=' and d.H_A!=""';
   }
   else{
	$qry58="";
   }
   
   if($type_IIA!='')
   {
	$qry59=" and d.type_IIA='$type_IIA'";
   }
   else{
	$qry59='';
   }
   if($type_IIB!='')
   {
	$qry60=" and d.type_IIB='$type_IIB'";
   }
   else{
	$qry60='';
   }
   
  $mainquery="SELECT distinct(d.diamond_id) FROM `diamond_master` d,certificate_master c,diamond_sale s WHERE 1  $qry1 $qry2 $qry3 $qry4 $qry5 $qry6 $qry7 $qry8 $qry9 $qry10 $qry11  $qry12 $qry13 $qry14 $qry15  $qry18 $qry19 $qry20 $qry21 $qry22 $qry23 $qry24 $qry25 $qry26 $qry27 $qry28 $qry29 $qry30 $qry31 $qry32 $qry33 $qry34 $qry35 $qry36 $qry37 $qry38 $qry39  $qry40 $qry41 $qry42 $qry43 $qry44 $qry46 $qry47 $qry48 $qry49 $qry50 $qry51 $qry52 $qry53 $qry54 $qry55 $qry56 $qry57 $qry58 $qry59 $qry60 and d.certificate_id=c.certificateid and d.diamond_status='1' and d.portalshow='portalyes' and d.diamond_id=s.diamond_id  order by d.weight ASC" ;
   $result=mysqli_query($con,$mainquery);
   $countdid=0;
   while($mrw=mysqli_fetch_assoc($result))
	{
	 $getraprates="SELECT * FROM `diamond_sale` where 1 $qry45 and diamond_id=".$mrw['diamond_id'];
	   $getrapratesresult=mysqli_query($con,$getraprates);
	   if(mysqli_num_rows($getrapratesresult) > 0){
	   $raprow=mysqli_fetch_assoc($getrapratesresult);
	   if($raprow['rap']!='0')
		{
		  $countdid++;
		}
	   }
	}
                     //echo $countdid;
  //echo $mainquery;
  //$searchCount=mysqli_num_rows($result);
   echo $countdid;
  //echo '10';
      ?> 
		