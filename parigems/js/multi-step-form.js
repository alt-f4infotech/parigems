
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$(".next1").click(function(){
	 companyname = $('#companyname').val();
	  if (companyname=='')
	{
	 document.getElementById('companyname').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Compnay Name</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('companyname').style.borderColor= "#ccc";
	}
	
	 countryCode = $('#countryCode').val();
	 if (countryCode=='')
	{
	 document.getElementById('countryCode').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Select Country Code</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('companyaddress').style.borderColor= "#ccc";
	}
    
	 phonenumber = $('#phonenumber').val();
	 if (phonenumber=='')
	{
	 document.getElementById('phonenumber').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Phone Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('companyaddress').style.borderColor= "#ccc";
	}
     companyaddress = $('#companyaddress').val();
	  if (companyaddress=='')
	{
	 document.getElementById('companyaddress').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Company Address</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('companyaddress').style.borderColor= "#ccc";
	}
     emailaddress = $('#emailaddress').val();
	  var atpos = emailaddress.indexOf("@");
    var dotpos = emailaddress.lastIndexOf(".");
	 if (emailaddress=='')
	{
	 document.getElementById('emailaddress').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Email Id</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
    else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailaddress.length) {
		 document.getElementById('emailaddress').focus() ;
        document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Valid Email Id</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
        return false;
    }
	else
	{
	 document.getElementById('emailaddress').style.borderColor= "#ccc";
	}
	 countryId = $('#countryId').val();
	 if (countryId=='')
	{
	 document.getElementById('countryId').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Select Country</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('countryId').style.borderColor= "#ccc";
	}
	 /*stateId = $('#stateId').val();
	 if (stateId=='')
	{
	 document.getElementById('stateId').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Select State</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('stateId').style.borderColor= "#ccc";
	}*/
	 cityId = $('#cityId').val();
	 if (cityId=='')
	{
	 document.getElementById('cityId').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Select City</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('cityId').style.borderColor= "#ccc";
	}
	 zipcode = $('#zipcode').val();
	 if (zipcode=='')
	{
	 document.getElementById('zipcode').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Zip Code</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('zipcode').style.borderColor= "#ccc";
	}
	pannumber = $('#pannumber').val();
	 if (pannumber=='')
	{
	 document.getElementById('pannumber').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter PAN Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('pannumber').style.borderColor= "#ccc";
	}
	 cstnumber = $('#cstnumber').val();
	 if (cstnumber=='')
	{
	 document.getElementById('cstnumber').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter CST Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('cstnumber').style.borderColor= "#ccc";
	}
	 vattinnumber = $('#vattinnumber').val();
	 if (vattinnumber=='')
	{
	 document.getElementById('vattinnumber').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter VATTIN Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('vattinnumber').style.borderColor= "#ccc";
	}
	 naturebusinessstructure=$("input[name='naturebusinessstructure[]']:checked").length;
     if ($("input[name='naturebusinessstructure[]']:checked").length === 0) { 
	  document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Select Nature of Business Activity</div>";
       $('html, body').animate({scrollTop: '0px'}, 300);
	   return false;
  }
  else
  {
	
  }
   businessstructure=$("input[name='businessstructure[]']:checked").length;
     if ($("input[name='businessstructure[]']:checked").length === 0) { 
	  document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Select Business structures</div>";
       $('html, body').animate({scrollTop: '0px'}, 300);
	   return false;
  }
  else
  {
	
  }
	 bankname = $('#bankname').val();
	 if (bankname=='')
	{
	 document.getElementById('bankname').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Bank Name</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('bankname').style.borderColor= "#ccc";
	}
	 branchname = $('#branchname').val();
	 if (branchname=='')
	{
	 document.getElementById('branchname').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Bank Branch</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);;
	return false;
    }
	else
	{
	 document.getElementById('branchname').style.borderColor= "#ccc";
	}
    bankaccountnumber=$('#bankaccountnumber').val();
     if (bankaccountnumber=='')
	{
	 document.getElementById('bankaccountnumber').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Bank Account Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);;
	return false;
    }
	else
	{
	 document.getElementById('bankaccountnumber').style.borderColor= "#ccc";
	}
    
    username = $('#username').val();
   
	  if (username=='')
	{
	 document.getElementById('username').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Username</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);

	return false;
    }
	else
	{
	 document.getElementById('username').style.borderColor= "#ccc";
	}
	
	 //checkusername();
	if (username!='') {
     
      document.getElementById("errorBox").innerHTML = "";
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			top = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        		'transform': 'scale('+scale+')',
        		'position': 'absolute'
      		});
			next_fs.css({'top': top, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}
   
});

$(".next2").click(function(){
	 person1name = $('#person1name').val();
	  if (person1name=='')
	{
	 document.getElementById('person1name').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Partner's Name</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('person1name').style.borderColor= "#ccc";
	}
	 person1designation = $('#person1designation').val();
	  if (person1designation=='')
	{
	 document.getElementById('person1designation').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Partner's Deasignation</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('person1designation').style.borderColor= "#ccc";
	}
	 person1address = $('#person1address').val();
	  if (person1address=='')
	{
	 document.getElementById('person1address').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Partner's Address</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('person1address').style.borderColor= "#ccc";
	}
	 
	if (person1name!='') {
      document.getElementById("errorBox").innerHTML = "";
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			top = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        		'transform': 'scale('+scale+')',
        		'position': 'absolute'
      		});
			next_fs.css({'top': top, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}
});
$(".next3").click(function(){
	/* panno = $('#panno').val();
     //alert('panno');
     //alert(panno);
	  if (panno=='')
	{
	 document.getElementById('panno').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Upload PAN Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('panno').style.borderColor= "#ccc";
	}
	 vatno = $('#vatno').val();
	  if (vatno=='')
	{
	 document.getElementById('vatno').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Upload VAT Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('vatno').style.borderColor= "#ccc";
	}
	 tinno = $('#tinno').val();
	  if (tinno=='')
	{
	 document.getElementById('tinno').focus() ;
    document.getElementById("errorBox").innerHTML = "Upload TIN Number";
	return false;
    }
	else
	{
	 document.getElementById('tinno').style.borderColor= "#ccc";
	}
	 gst = $('#gst').val();
	  if (gst=='')
	{
	 document.getElementById('gst').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Upload GST Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('gst').style.borderColor= "#ccc";
	}
	passport = $('#passport').val();
	  if (passport=='')
	{
	 document.getElementById('passport').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Upload PASSPORT</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('passport').style.borderColor= "#ccc";
	}*/
	if (person1name!='') {
      document.getElementById("errorBox").innerHTML = "";
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			top = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        		'transform': 'scale('+scale+')',
        		'position': 'absolute'
      		});
			next_fs.css({'top': top, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			top = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'top': top});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity, 'position': 'relative'});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	companyname1 = $('#companyname1').val();
	  if (companyname1=='')
	{
	 document.getElementById('companyname1').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Company Name</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('companyname1').style.borderColor= "#ccc";
	}
	contactperson1 = $('#contactperson1').val();
	  if (contactperson1=='')
	{
	 document.getElementById('contactperson1').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter Company Contact Number</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
	return false;
    }
	else
	{
	 document.getElementById('contactperson1').style.borderColor= "#ccc";
	 document.getElementById("errorBox").innerHTML ="";
	 return true;
	}
	
	
})

var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
	
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;

}

function matchpassword()
  {
    var password = document.getElementById('ppassword').value;
    var cpassword = document.getElementById('cpassword').value;
	
    if (cpassword=='')
	{
	 document.getElementById('cpassword').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter the Password</div>";
    //window.scrollTo(0, 0);
   // $('html, body').animate({scrollTop: '0px'}, 300);
    document.getElementById('cpassword').style.borderColor= "#EFA7A7";
	return false;
    }
	else if (password!=cpassword)
   {
	document.getElementById('cpassword').focus() ;
    document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>Enter the Correct Password</div>";
    //window.scrollTo(0, 0);
   // $('html, body').animate({scrollTop: '0px'}, 300);
   document.getElementById('ppassword').style.borderColor= "#EFA7A7";
   document.getElementById('cpassword').style.borderColor= "#EFA7A7";
   document.getElementById('next1').style.visibility='hidden';
   document.getElementById('disableSubmit').disabled = true;
   return false;
   }
   else
   {
	document.getElementById("errorBox").innerHTML = "";
	document.getElementById('next1').style.visibility='visible';
    document.getElementById('disableSubmit').disabled = false;
   }
   
}

function checkusername(){
	var username=document.getElementById('username').value;
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
               if (respoo==1) {
				//alert("This Username Already Exists");
                //document.getElementById('username').value="";
                document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>This Username Already Exists</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
                document.getElementById('username').focus();
                return false;
               }
               else{document.getElementById("errorBox").innerHTML = "";}
        }
   			}	
   		 http2.open("GET","../signup/checkusername.php?username="+username, true);
   		 http2.send(null);	
}

function validateEmailId(){
	var emailaddress=document.getElementById('emailaddress').value;
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
               if (respoo==1) {
				//alert("This Username Already Exists");
                //document.getElementById('username').value="";
                document.getElementById("errorBox").innerHTML = "<div class='alert alert-warning'>This Email Id Already Exists</div>";
    //window.scrollTo(0, 0);
    $('html, body').animate({scrollTop: '0px'}, 300);
                document.getElementById('emailaddress').focus();
                document.getElementById('disableSubmit').disabled = true;
                return false;
               }
               else{document.getElementById("errorBox").innerHTML = "";
                document.getElementById('disableSubmit').disabled = false;}
        }
   			}	
   		 http2.open("GET","../signup/validateEmailId.php?emailaddress="+emailaddress, true);
   		 http2.send(null);	
}
