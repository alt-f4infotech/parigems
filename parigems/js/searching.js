$(".counter").on('keyup click blur', function()
{
         $("#wait").css("display", "block");
         randomNumber=$("#randomNumber").val();
          var cerificate = [];
$. each($("input[name='cerificate[]']:checked"), function(){
cerificate. push($(this). val());
});
 var check = [];
$. each($("input[name='check[]']:checked"), function(){
check. push($(this). val());
});
var cut = [];
$. each($("input[name='cut[]']:checked"), function(){
cut. push($(this). val());
});
var polish = [];
$. each($("input[name='polish[]']:checked"), function(){
polish. push($(this). val());
});
var symmetry = [];
$. each($("input[name='symmetry[]']:checked"), function(){
symmetry. push($(this). val());
});
var color = [];
$. each($("input[name='color[]']:checked"), function(){
color. push($(this). val());
});
var fluor = [];
$. each($("input[name='fluor[]']:checked"), function(){
fluor. push($(this). val());
});
var tinge = [];
$. each($("input[name='tinge[]']:checked"), function(){
tinge. push($(this). val());
});
var clarity = [];
$. each($("input[name='clarity[]']:checked"), function(){
clarity. push($(this). val());
});
var key_to_symbol = [];
$. each($("input[name='key_to_symbol[]']:checked"), function(){
key_to_symbol. push($(this). val());
});
var fancycolor = [];
$. each($("input[name='fancycolor[]']:checked"), function(){
fancycolor. push($(this). val());
});
var culet = [];
$. each($("input[name='culet[]']:checked"), function(){
culet. push($(this). val());
});
var fancyintensity = [];
$. each($("input[name='fancyintensity[]']:checked"), function(){
fancyintensity. push($(this). val());
});
var fancyovertone = [];
$. each($("input[name='fancyovertone[]']:checked"), function(){
fancyovertone. push($(this). val());
});

var pointer = [];
$. each($("input[name='pointer[]']:checked"), function(){
pointer. push($(this). val());
});

var inclusive_visibility = [];
$. each($("input[name='inclusive_visibility[]']:checked"), function(){
inclusive_visibility. push($(this). val());
});

  //var fancyovertone=$('#fancyovertone').val();
var caretfrom=$('#caretfrom').val();
var caretto=$('#caretto').val();
var referenceno=$('#referenceno').val();
var certificateno=$('#certificateno').val();
var keycontain=$("input[name='keycontain']:checked"). val();
//var inclusive_visibility=$("input[name='inclusive_visibility']:checked"). val();
var blackinclfrom=$('#blackinclfrom').val();
var blackinclto=$('#blackinclto').val();
var browninclfrom=$('#browninclfrom').val();
var browninclto=$('#browninclto').val();
var tablefrom=$('#tablefrom').val();
var tableto=$('#tableto').val();
var depthfrom=$('#depthfrom').val();
var depthto=$('#depthto').val();
var lengthfrom=$('#lengthfrom').val();
var lengthto=$('#lengthto').val();
var crheightfrom=$('#crheightfrom').val();
var crheightto=$('#crheightto').val();
var cranglefrom=$('#cranglefrom').val();
var crangleto=$('#crangleto').val();
var pavdepthfrom=$('#pavdepthfrom').val();
var pavdepthto=$('#pavdepthto').val();
var pavanglefrom=$('#pavanglefrom').val();
var pavangleto=$('#pavangleto').val();
var ratiofrom=$('#ratiofrom').val();
var ratioto=$('#ratioto').val();
var giddlemin=$('#giddlemin').val();
var giddlemax=$('#giddlemax').val();
var milkyfrom=$('#milkyfrom').val();
var milkyto=$('#milkyto').val();
var diameter_min=$('#diameter_min').val();
var diameter_max=$('#diameter_max').val();
var heightfrom=$("#heightfrom").val();
var heightto=$("#heightto").val();
var lowerHalffrom=$("#lowerHalffrom").val();
var lowerHalfto=$("#lowerHalfto").val();
var priceFrom=$("#priceFrom").val();
var priceTo=$("#priceTo").val();
var discountFrom=$("#discountFrom").val();
var discountTo=$("#discountTo").val();
var stockId=$("#stockId").val();
//var HA=escape($("#H_A").val());
//if (inclusive_visibility==undefined) {
   //inclusive_visibility='';
//}

var ratetype=$("input[name='ratetype']:checked"). val();
if (ratetype==undefined) {
   ratetype='';
}

var newArrival=$("input[name='newArrival']:checked"). val();
if (newArrival==undefined) {
   newArrival='both';
}

var type_IIA=$("input[name='type_IIA']:checked"). val();
if (type_IIA==undefined) {
   type_IIA='';
}

var type_IIB=$("input[name='type_IIB']:checked"). val();
if (type_IIB==undefined) {
   type_IIB='';
}

var HA=$("input[name='H_A']:checked"). val();
if (HA==undefined) {
   HA='';
}
var result="&cerificate="+cerificate+"&check="+check+"&cut="+cut+"&polish="+polish+"&symmetry="+symmetry+"&color="+color+"&fluor="+fluor+"&tinge="+tinge+"&clarity="+clarity+"&caretfrom="+caretfrom+"&caretto="+caretto+"&referenceno="+referenceno+"&certificateno="+certificateno+"&key_to_symbol="+key_to_symbol+"&fancycolor="+fancycolor+"&keycontain="+keycontain+"&culet="+culet+"&inclusive_visibility="+inclusive_visibility+"&fancyintensity="+fancyintensity+"&fancyovertone="+fancyovertone+"&blackinclfrom="+blackinclfrom+"&blackinclto="+blackinclto+"&tablefrom="+tablefrom+"&tableto="+tableto+"&depthfrom="+depthfrom+"&depthto="+depthto+"&lengthfrom="+lengthfrom+"&lengthto="+lengthto+"&crheightfrom="+crheightfrom+"&crheightto="+crheightto+"&cranglefrom="+cranglefrom+"&crangleto="+crangleto+"&pavdepthfrom="+pavdepthfrom+"&pavdepthto="+pavdepthto+"&pavanglefrom="+pavanglefrom+"&pavangleto="+pavangleto+"&ratiofrom="+ratiofrom+"&ratioto="+ratioto+"&giddlemin="+giddlemin+"&giddlemax="+giddlemax+"&milkyfrom="+milkyfrom+"&milkyto="+milkyto+"&diameter_max="+diameter_max+"&diameter_min="+diameter_min+"&heightfrom="+heightfrom+"&heightto="+heightto+"&ratetype="+ratetype+"&pointer="+pointer+"&lowerHalffrom="+lowerHalffrom+"&lowerHalfto="+lowerHalfto+"&newArrival="+newArrival+"&priceTo="+priceTo+"&priceFrom="+priceFrom+"&discountFrom="+discountFrom+"&discountTo="+discountTo+"&stockId="+stockId+"&browninclfrom="+browninclfrom+"&browninclto="+browninclto+"&H_A="+HA+"&type_IIA="+type_IIA+"&type_IIB="+type_IIB;
  $.ajax({
    url:"getcounter.php?res="+result,
    cache: false, 
    success:function(searchCount) {
         var response=searchCount.split('@');
         $("#countershow").html(response[0]);
        $("#wait").css("display", "none");
    }
  });   
});
    