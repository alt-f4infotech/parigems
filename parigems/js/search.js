$(".cert-btn").click(function() {
    $(this).toggleClass('active');
});

$(".push-btn").click(function() {
    $(this).toggleClass('active');
});
$(".shape-btn").click(function() {
    $(this).toggleClass('active');
});



$(".selectallbtn").click(function() {
    $(this).parent().siblings().children().find("button").toggleClass('active');
});

function checkexc()
{
   $('input[id="cutExcellent"]').prop('checked', false);
    $(".cutExcellent").removeClass("active");
    $('input[id="polishExcellent"]').prop('checked', false);
    $(".polishExcellent").removeClass("active");
    $('input[id="symmExcellent"]').prop('checked', false);
    $(".symmExcellent").removeClass("active");
    
    $('input[id="cutVerygood"]').prop('checked', false);
    $(".cutVerygood").removeClass("active");
    $('input[id="polishVerygood"]').prop('checked', false);
    $(".polishVerygood").removeClass("active");
    $('input[id="symmVerygood"]').prop('checked', false);
    $(".symmVerygood").removeClass("active");
    
  var check = $("#excellent").is(":checked");
  var check2 = $("#excellent2").is(":checked");
  var check3 = $("#excellentvg").is(":checked");
  
    
  if(check==true && check2==false && check3==false) {//1 0 0
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', false);
  $(".cutVerygood").removeClass("active");
  $('input[id="polishVerygood"]').prop('checked', false);
  $(".polishVerygood").removeClass("active");
  $('input[id="symmVerygood"]').prop('checked', false);
  $(".symmVerygood").removeClass("active");
  }
  else if(check==true && check2==true && check3==false) {//1 1 0
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', false);
  $(".cutVerygood").removeClass("active");
  $('input[id="polishVerygood"]').prop('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').prop('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else if(check==true && check2==true && check3==true) {//1 1 1
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', true);
  $(".cutVerygood").addClass("active");
  $('input[id="polishVerygood"]').prop('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').prop('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else if(check==false && check2==true && check3==true) {//0 1 1
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', true);
  $(".cutVerygood").addClass("active");
  $('input[id="polishVerygood"]').prop('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').prop('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else if(check==false && check2==false && check3==true) {//0 0 1
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', true);
  $(".cutVerygood").addClass("active");
  $('input[id="polishVerygood"]').prop('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').prop('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else if(check==false && check2==true && check3==false) {//0 1 0
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', false);
  $(".cutVerygood").removeClass("active");
  $('input[id="polishVerygood"]').prop('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').prop('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else if(check==true && check2==false && check3==true) {//1 0 1
  $('input[id="cutExcellent"]').prop("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').prop('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').prop('checked', true);
  $(".symmExcellent").addClass("active");
  
  $('input[id="cutVerygood"]').prop('checked', true);
  $(".cutVerygood").addClass("active");
  $('input[id="polishVerygood"]').prop('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').prop('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else
  {//0 0 0
    $('input[id="cutExcellent"]').prop('checked', false);
    $(".cutExcellent").removeClass("active");
    $('input[id="polishExcellent"]').prop('checked', false);
    $(".polishExcellent").removeClass("active");
    $('input[id="symmExcellent"]').prop('checked', false);
    $(".symmExcellent").removeClass("active");
    
    $('input[id="cutVerygood"]').prop('checked', false);
    $(".cutVerygood").removeClass("active");
    $('input[id="polishVerygood"]').prop('checked', false);
    $(".polishVerygood").removeClass("active");
    $('input[id="symmVerygood"]').prop('checked', false);
    $(".symmVerygood").removeClass("active");
    
   
  }  
}

function uncheckexc()
{  
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
  if (cut[0]=='Excellent' && polish[0]=='Excellent' && symmetry[0]=='Excellent')
  {
    $('#excellent').prop('checked', true);
    $(".excellent").addClass("active");
  }
  else{
    $('input[id="excellent"]').prop('checked', false);
    $(".excellent").removeClass("active");
  }
   if (cut[0]=='Excellent' && polish[0]=='Excellent' && symmetry[0]=='Excellent' && polish[1]=='Verygood' && symmetry[1]=='Verygood' )
  {
    $('input[id="excellent2"]').prop('checked', true);
    $(".excellent2").addClass("active");
  }
  else{
    $('input[id="excellent2"]').prop('checked', false);
    $(".excellent2").removeClass("active");
  }
  if (cut[0]=='Excellent' && polish[0]=='Excellent' && symmetry[0]=='Excellent' && cut[1]=='Verygood' && polish[1]=='Verygood' && symmetry[1]=='Verygood' ) { 
    $('input[id="excellentvg"]').prop('checked', true);
    $(".excellentvg").addClass("active");
  }
   else{
    $('input[id="excellentvg"]').prop('checked', false);
    $(".excellentvg").removeClass("active");
  }
  //checkexc();
}

/*
function checkexc2()
{
     var check2 = $("#excellent2").is(":checked");
  if(check2) {
  $('input[id="cutExcellent"]').attr('checked', true);
   $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').attr('checked', true);
   $(".polishExcellent").addClass("active");
   $('input[id="symmExcellent"]').attr('checked', true);
  $(".symmExcellent").addClass("active");
  $('input[id="polishVerygood"]').attr('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').attr('checked', true);
  $(".symmVerygood").addClass("active");
  }
  else
  {
    $('input[id="cutExcellent"]').attr('checked', false);
    $(".cutExcellent").removeClass("active");
    $('input[id="polishExcellent"]').attr('checked', false);
    $(".polishExcellent").removeClass("active");
    $('input[id="symmExcellent"]').attr('checked', false);
    $(".symmExcellent").removeClass("active");
    $('input[id="polishVerygood"]').attr('checked', false);
    $(".polishVerygood").removeClass("active");
    $('input[id="symmVerygood"]').attr('checked', false);
    $(".symmVerygood").removeClass("active");
  }
}

function checkexc3()
{
     var check3 = $("#excellentvg").is(":checked");
  if(check3) {
  $('input[id="cutVerygood"]').attr('checked', true);
  $(".cutVerygood").addClass("active");
  $('input[id="polishVerygood"]').attr('checked', true);
  $(".polishVerygood").addClass("active");
  $('input[id="symmVerygood"]').attr('checked', true);
  $(".symmVerygood").addClass("active");
  
  $('input[id="cutExcellent"]').attr("checked", true);
  $(".cutExcellent").addClass("active");
  $('input[id="polishExcellent"]').attr('checked', true);
  $(".polishExcellent").addClass("active");
  $('input[id="symmExcellent"]').attr('checked', true);
  $(".symmExcellent").addClass("active");
  }
  else
  {
    $('input[id="cutVerygood"]').attr('checked', false);
  $(".cutVerygood").removeClass("active");
  $('input[id="polishVerygood"]').attr('checked', false);
  $(".polishVerygood").removeClass("active");
  $('input[id="symmVerygood"]').attr('checked', false);
  $(".symmVerygood").removeClass("active");
  
    $('input[id="cutExcellent"]').attr('checked', false);
    $(".cutExcellent").removeClass("active");
    $('input[id="polishExcellent"]').attr('checked', false);
    $(".polishExcellent").removeClass("active");
    $('input[id="symmExcellent"]').attr('checked', false);
    $(".symmExcellent").removeClass("active");
  }
}
*/
/*function check_all(chk)
{

var cbox=document.getElementsByName('check[]');
//var chk= document.getElementById('chk');
var chk=$("#chk").is(":checked");
if(chk)
{
for (var i =0; i <cbox.length ; i++)
{
cbox[i].checked=true;
 $(".shape-btn").addClass("active");
}
}	
else
{
	for (var i =0; i <cbox.length ; i++)
    {
      cbox[i].checked=false;
      $(".shape-btn").removeClass("active");
    }
}
}
*/
function sendaction(a,i,r) {
    $("#wait").css("display", "block");
    var result="&action="+a+"&code="+i+"&raprate="+r;
   $.ajax({
    url:"../search/sendaction.php?res="+result,
    cache: false, 
    success:function(data) {
        var response=data.split('@');
        /*var splitExists=response[0].split('#');
        //if(splitExists[0]=='EXISTS')
        var n = splitExists[0].includes("EXISTS");
        if(n==true)
        {
          bootbox.alert("Diamond Already Added in Cart.");
          $("#"+i).attr("checked", false);
        }
        else
        {*/
        document.getElementById('cartitem').innerHTML=response[0];
        document.getElementById('finalcarat').innerHTML=response[1];
        document.getElementById('finalrap').innerHTML=response[2];
        document.getElementById('lastavgdiscount').innerHTML=response[3];
        document.getElementById('avgprice').innerHTML=response[4];
        document.getElementById('lastvalue').innerHTML=response[5];
       // }
        $("#wait").css("display", "none");
    }
  });
}

function addtocart_wishlist(a,i,r) {
    $("#wait").css("display", "block");
    cartcheck= $("#"+i).prop("checked"); 
        if (cartcheck)
        {
        a='add';
        }
        else
        {
         a='remove';      
        }
    var result="&action="+a+"&code="+i+"&raprate="+r;
   $.ajax({
    url:"../search/sendaction_wishlist.php?res="+result,
    cache: false, 
    success:function(data) {
        var response=data.split('@');
        document.getElementById('cartitem').innerHTML=response[0];
        document.getElementById('finalcarat').innerHTML=response[1];
        document.getElementById('finalrap').innerHTML=response[2];
        document.getElementById('lastavgdiscount').innerHTML=response[3];
        document.getElementById('avgprice').innerHTML=response[4];
        document.getElementById('lastvalue').innerHTML=response[5];
        $("#wait").css("display", "none");
    }
  });
}

function addtocart_hold(a,i,r) {
    $("#wait").css("display", "block");
    cartcheck= $("#"+i).prop("checked"); 
        if (cartcheck)
        {
        a='add';
        }
        else
        {
         a='remove';      
        }
    var result="&action="+a+"&code="+i+"&raprate="+r;
   $.ajax({
    url:"../search/sendaction_hold.php?res="+result,
    cache: false, 
    success:function(data) {
        var response=data.split('@');
        document.getElementById('cartitem').innerHTML=response[0];
        document.getElementById('finalcarat').innerHTML=response[1];
        document.getElementById('finalrap').innerHTML=response[2];
        document.getElementById('lastavgdiscount').innerHTML=response[3];
        document.getElementById('avgprice').innerHTML=response[4];
        document.getElementById('lastvalue').innerHTML=response[5];
        $("#wait").css("display", "none");
    }
  });
}

function addtocart_temp(a,i,r) {
    $("#wait").css("display", "block");
    cartcheck= $("#"+i).prop("checked"); 
        if (cartcheck)
        {
        a='add';
        }
        else
        {
         a='remove';      
        }
    var result="&action="+a+"&code="+i+"&raprate="+r;
   $.ajax({
    url:"../search/sendaction_temp.php?res="+result,
    cache: false, 
    success:function(data) {
        var response=data.split('@');
        document.getElementById('cartitem').innerHTML=response[0];
        document.getElementById('finalcarat').innerHTML=response[1];
        document.getElementById('finalrap').innerHTML=response[2];
        document.getElementById('lastavgdiscount').innerHTML=response[3];
        document.getElementById('avgprice').innerHTML=response[4];
        document.getElementById('lastvalue').innerHTML=response[5];
        $("#wait").css("display", "none");
    }
  });
}

function addtocart(actn,i,r) {

   cartcheck= $("#"+i).prop("checked"); 
        if (cartcheck)
        {
        a='add';
        }
        else
        {
         a='remove';      
        }
       //alert(actn);
        if (actn=='removehold') {
           a='add';
          if (cartcheck)
        {
         document.getElementById('holdid').style.display='none';
        }
        else
        {
        document.getElementById('holdid').style.display='inline';
        }
        }
   $.ajax({
    url:"../search/checkbalance.php",
    cache: false, 
    success:function(data) {
        if (data==2) {
                bootbox.alert("Please Clear Your Payment");
               }
               else if (data==1)
               {              
                sendaction(a,i,r);
               }
               else{
                bootbox.alert("Please Select Checkbox");
               }
    }
  });
}

function hidehold(diamndId) {
   cartcheck= $("#"+diamndId).prop("checked");
        if (cartcheck)
        {
         document.getElementById('holdid').style.display='none';
        }
        else
        {
        document.getElementById('holdid').style.display='inline';
        }
}

function showhold(diamndId) {
  document.getElementById('holdid').style.display='inline';
}

function proccedbilling(a,i)
{
     bootbox.confirm("Are you sure?", function(result) {
	  if (result==true) {
    if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
    http2=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
    http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {
   
   if (http2.readyState==4 )
   		 {
   				var respoo=http2.responseText;
                 bootbox.alert("Your Order Placed Successfully.");
                }
   			}			 
         var res="&action="+a+"&code="+i;
   		 http2.open("GET","../search/sendaction.php?res="+res, true);
   		 http2.send(null);
      }
     });
}


 
//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
	
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;

}

//It restrict the non-numbers
var specialKeys1 = new Array();
specialKeys1.push(8,46,45,32); //Backspace and dash
function IsNumeric1(e) {
    var keyCode1 = e.which ? e.which : e.keyCode1;
    console.log( keyCode1 );
    var ret1 = ((keyCode1 >= 48 && keyCode1 <= 57) || specialKeys1.indexOf(keyCode1) != -1);
    return ret1;
}

function checkexcellent()
{
  var check3ex = $("#3ex").is(":checked");
  //alert(check3ex);
  var check3vg = $("#3vg").is(":checked");
  var check3g = $("#3g").is(":checked");
  if(check3ex) {
 document.getElementById('cut').value='Excellent';
 document.getElementById('polish').value='Excellent';
 document.getElementById('symmetry').value='Excellent';
  }
  else if(check3vg) {
 document.getElementById('cut').value='Verygood';
 document.getElementById('polish').value='Verygood';
 document.getElementById('symmetry').value='Verygood';
  }
  else if(check3g) {
 document.getElementById('cut').value='Good';
 document.getElementById('polish').value='Good';
 document.getElementById('symmetry').value='Good';
  }
  else
  {
  document.getElementById('cut').value=''; 
  document.getElementById('polish').value=''; 
  document.getElementById('symmetry').value=''; 
  }
}

function uncheckexcellent()
{
  var check3ex = document.getElementById('3ex').checked;
  var check3vg = document.getElementById('3vg').checked;
  var check3g = document.getElementById('3g').checked;

 var cut=document.getElementById('cut').value;
 var polish=document.getElementById('polish').value;
 var symmetry=document.getElementById('symmetry').value;
 if (cut!='Excellent') {
   document.getElementById('3ex').checked=false;
 }
 else if (polish!='Excellent') {
   document.getElementById('3ex').checked=false;
 }
  else if (symmetry!='Excellent') {
   document.getElementById('3ex').checked=false;
 }
 else
 {
    document.getElementById('3ex').checked=true; 
 }
 
  if (cut!='Verygood') {
   document.getElementById('3vg').checked=false;
 }
 else if (polish!='Verygood') {
   document.getElementById('3vg').checked=false;
 }
  else if (symmetry!='Verygood') {
   document.getElementById('3vg').checked=false;
 }
 else
 {
    document.getElementById('3vg').checked=true; 
 }
 
 if (cut!='Good') {
   document.getElementById('3g').checked=false;
 }
 else if (polish!='Good') {
   document.getElementById('3g').checked=false;
 }
  else if (symmetry!='Good') {
   document.getElementById('3g').checked=false;
 }
 else
 {
    document.getElementById('3g').checked=true; 
 }
 
}

function uncheckfancy() {    
    var fancyclr=document.getElementsByName('fancycolor[]');
    for (var i =0; i <fancyclr.length ; i++)
    {
      fancyclr[i].checked=false;
    }
}
function reactivate() {
    $("#caretfrom").keyup();
}
/*function reactivate() {
    $("#caretfrom").keyup();
  var check = [];
$. each($("input[name='check[]']:checked"), function()
        {
          check. push($(this). attr('id'));
           
            //$("#ROUND").addClass('active');
       // $('#ROUND').addClass('shape-btn active').removeClass('shape-btn');
      // $("label").removeClass("shape-btn");
      
            $("label[for='ROUND']").click();
            
        });
  $('input[name="check[] "]').not(this).next().removeClass('active');
        $(this).next().toggleClass('active', this.checked)
       // alert('hi');
}
*/
$('#newsearch').click(function(){
$("#searchName").attr("required", false);
$('#searchAction').prop('action', 'searchdiamond.php');
});

$('#advancesearch').click(function(){
$('#searchAction').prop('action', 'searchdiamond.php');
});

$('#saveSearch').click(function(){
$("#searchName").attr("required", true);
$('#searchAction').prop('action', 'saveSearch.php');
});
	 
  function autounhold() {
    if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
    http2=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
    http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {
   if (http2.readyState==4 )
   		 {
   				var respo=http2.responseText;
				//alert(respo);
				if (respo==1)
				{
                window.location.reload();
                }
                //$('#priceFrom').keyup();
   			}			 
   	}
	
		 http2.open("GET","../search/autounhold.php", true);
   		 http2.send(null);
  }
	$( document ).ready(function() {
        autounhold();
    });
   // setInterval(function(){ autounhold(); }, 100);
    //to check all checkboxes
    $(document).on('click','#check_all',function(){
    var checkAll = $("#check_all").is(":checked");
    if(checkAll==false)
    {
      $('.case:checkbox').click();
	  $('.case:checkbox').prop("checked", $(this).is(':checked'));
    }
    else{
    }
	
});


	  /* $(".counter").on('keyup click blur ', function() {
    //alert('hi');
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
//document.getElementById('countershow').innerHTML='';
 if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
    http2=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
    http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {
   
   if (http2.readyState==4 )
   		 {
   				var respoo=http2.responseText;
               document.getElementById('countershow').innerHTML=respoo;
               //document.getElementById('countershow2').innerHTML=respoo;
                }
   			}			 
         var res="&cerificate="+cerificate+"&check="+check+"&cut="+cut+"&polish="+polish+"&symmetry="+symmetry+"&color="+color+"&fluor="+fluor+"&tinge="+tinge+"&clarity="+clarity+"&caretfrom="+caretfrom+"&caretto="+caretto+"&referenceno="+referenceno+"&certificateno="+certificateno+"&key_to_symbol="+key_to_symbol+"&fancycolor="+fancycolor+"&keycontain="+keycontain+"&culet="+culet+"&inclusive_visibility="+inclusive_visibility+"&fancyintensity="+fancyintensity+"&fancyovertone="+fancyovertone+"&blackinclfrom="+blackinclfrom+"&blackinclto="+blackinclto+"&tablefrom="+tablefrom+"&tableto="+tableto+"&depthfrom="+depthfrom+"&depthto="+depthto+"&lengthfrom="+lengthfrom+"&lengthto="+lengthto+"&crheightfrom="+crheightfrom+"&crheightto="+crheightto+"&cranglefrom="+cranglefrom+"&crangleto="+crangleto+"&pavdepthfrom="+pavdepthfrom+"&pavdepthto="+pavdepthto+"&pavanglefrom="+pavanglefrom+"&pavangleto="+pavangleto+"&ratiofrom="+ratiofrom+"&ratioto="+ratioto+"&giddlemin="+giddlemin+"&giddlemax="+giddlemax+"&milkyfrom="+milkyfrom+"&milkyto="+milkyto+"&diameter_max="+diameter_max+"&diameter_min="+diameter_min+"&heightfrom="+heightfrom+"&heightto="+heightto+"&ratetype="+ratetype+"&pointer="+pointer+"&lowerHalffrom="+lowerHalffrom+"&lowerHalfto="+lowerHalfto+"&newArrival="+newArrival+"&priceTo="+priceTo+"&priceFrom="+priceFrom+"&discountFrom="+discountFrom+"&discountTo="+discountTo+"&stockId="+stockId+"&browninclfrom="+browninclfrom+"&browninclto="+browninclto+"&H_A="+HA+"&type_IIA="+type_IIA+"&type_IIB="+type_IIB;
   		//alert(res);
         http2.open("GET","getcounter.php?res="+res, true);
   		 http2.send(null);
});
  */
      
       