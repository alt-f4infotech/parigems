//purchase calculation
$(document).on('keyup','.cal1',function dis1(){
	rap = $('#rap').val();
	discount1 = $('#discount1').val();
	pc =rap- ((rap * discount1)/100);
	$('#pc').val(pc.toFixed(2));
    dis2();
});

function dis2(){
	pc = $('#pc').val();
	discount2 = $('#discount2').val();
	pad =pc- ((pc * discount2)/100);
	$('#pad').val(pad.toFixed(2));
    dis3();
}

function dis3(){
	pad = $('#pad').val();
	discount3 = $('#discount3').val();
	extraamt =pad- ((pad * discount3)/100);
	$('#extraamt').val(extraamt.toFixed(2));
    dis4();
}

function dis4(){
	extraamt = $('#extraamt').val();
	discount4 = $('#discount4').val();
	extraamt2 =extraamt- ((extraamt * discount4)/100);
	$('#extraamt2').val(extraamt2.toFixed(2));
    dis5();
}

function dis5(){
	extraamt2 = $('#extraamt2').val();
	discount5 = $('#discount5').val();
	extraamt3 =extraamt2- ((extraamt2 * discount5)/100);
	$('#extraamt3').val(extraamt3.toFixed(2));
    dis6();
}

function dis6(){
	extraamt3 = $('#extraamt3').val();
	discount6 = $('#discount6').val();
	expamt1 =parseFloat(extraamt3) + parseFloat((extraamt3 * discount6)/100);
	$('#expamt1').val(expamt1.toFixed(2));
    dis7();
}

function dis7(){
	expamt1 = $('#expamt1').val();
	discount7 = $('#discount7').val();
	expamt2 =parseFloat(expamt1) + parseFloat((expamt1 * discount7)/100);
	$('#expamt2').val(expamt2.toFixed(2));
    dis8();
}
function dis8(){
	expamt2 = $('#expamt2').val();
	discount8 = $('#discount8').val();
	expamt3 =parseFloat(expamt2) + parseFloat((expamt2 * discount8)/100);
	$('#expamt3').val(expamt3.toFixed(2));
    dis9();
}
function dis9(){
	expamt3 = $('#expamt3').val();
	discount9 = $('#discount9').val();
	expamt4 =parseFloat(expamt3) + parseFloat((expamt3 * discount9)/100);
	$('#expamt4').val(expamt4.toFixed(2));
    dis10();
}
function dis10(){
	expamt4 = $('#expamt4').val();
	rap = $('#rap').val();
	finall =100- ((expamt3 / rap) * 100);
	var finallcheck=isNaN(finall);
      if (finallcheck==true) {
       finall=0
      }
	$('#final').val(finall.toFixed(2));
    dis11();
}

function dis11(){
	expamt4 = $('#expamt4').val();
	weight = $('#weight1').val();
	
	usd =weight * expamt4;
	$('#usd').val(usd.toFixed(2));
    dis12();
}


function dis12(){
	usd = $('#usd').val();
	conv = $('#conv').val();
	inr =conv * usd;
	$('#inr').val(inr.toFixed(2));
	dis13();
}

function dis13(){
	usd = $('#usd').val();
	conv = $('#conv').val();
	extraconv = $('#extraconv').val();
	if (extraconv=='') {
        extraconv='0';
    }
	if (conv=='') {
        conv='0';
    }
	totalconv =(parseFloat(conv) + parseFloat(extraconv));
	$('#totalconv').val(totalconv.toFixed(2));
	inr2=totalconv * usd;
	$('#inr').val(Math.round(inr2));
	if (inr2=='0') {
      // inr2=$('#usd').val();
    }
	document.getElementById('purchasevalueusd').innerHTML=Math.round(usd);
	document.getElementById('purchasevalueinr').innerHTML=Math.round(inr2);
	profit();
}


//sale calculation

$(document).on('keyup','.slcal1',function dis11(){
	slrap = $('#slrap1').val();
	sldiscount1 = $('#sldiscount1').val();
	slpc =slrap- ((slrap * sldiscount1)/100);
	$('#slpc').val(slpc.toFixed(2));
    sldis2();
});

function sldis2(){
	slpc = $('#slpc').val();
	sldiscount2 = $('#sldiscount2').val();
	slpad =slpc- ((slpc * sldiscount2)/100);
	$('#slpad').val(slpad.toFixed(2));
    sldis3();
}

function sldis3(){
	slpad = $('#slpad').val();
	sldiscount3 = $('#sldiscount3').val();
	slextraamt =slpad- ((slpad * sldiscount3)/100);
	$('#slextraamt').val(slextraamt.toFixed(2));
    sldis4();
}

function sldis4(){
	slextraamt = $('#slextraamt').val();
	sldiscount4 = $('#sldiscount4').val();
	slextraamt2 =slextraamt- ((slextraamt * sldiscount4)/100);
	$('#slextraamt2').val(slextraamt2.toFixed(2));
    sldis5();
}

function sldis5(){
	slextraamt2 = $('#slextraamt2').val();
	sldiscount5 = $('#sldiscount5').val();
	slextraamt3 =slextraamt2- ((slextraamt2 * sldiscount5)/100);
	$('#slextraamt3').val(slextraamt3.toFixed(2));
    sldis6();
}

function sldis6(){
	slextraamt3 = $('#slextraamt3').val();
	sldiscount6 = $('#sldiscount6').val();
	slexpamt1 =parseFloat(slextraamt3) + parseFloat((slextraamt3 * sldiscount6)/100);
	$('#slexpamt1').val(slexpamt1.toFixed(2));
    sldis7();
}

function sldis7(){
	slexpamt1 = $('#slexpamt1').val();
	sldiscount7 = $('#sldiscount7').val();
	slexpamt2 =parseFloat(slexpamt1) + parseFloat((slexpamt1 * sldiscount7)/100);
	$('#slexpamt2').val(slexpamt2.toFixed(2));
    sldis8();
}
function sldis8(){
	slexpamt2 = $('#slexpamt2').val();
	sldiscount8 = $('#sldiscount8').val();
	slexpamt3 =parseFloat(slexpamt2) + parseFloat((slexpamt2 * sldiscount8)/100);
	$('#slexpamt3').val(slexpamt3.toFixed(2));
    sldis9();
}
function sldis9(){
	slexpamt3 = $('#slexpamt3').val();
	sldiscount9 = $('#sldiscount9').val();
	slexpamt4 =parseFloat(slexpamt3) + parseFloat((slexpamt3 * sldiscount9)/100);
	
	$('#slexpamt4').val(slexpamt4.toFixed(2));
    sldis10();
}
function sldis10(){
	slexpamt4 = $('#slexpamt4').val();
	slrap = $('#slrap1').val();
	slfinall =100- ((slexpamt3 / slrap) * 100);
	var slfinallcheck=isNaN(slfinall);
      if (slfinallcheck==true) {
       slfinall=0
      }
	$('#slfinal').val(slfinall.toFixed(2));
    sldis11();
}

function sldis11(){
	slexpamt4 = $('#slexpamt4').val();
	slweight = $('#weight1').val();
	slusd =slweight * slexpamt4;
	$('#slusd').val(slusd.toFixed(2));
    sldis12();
}


function sldis12(){
	slusd = $('#slusd').val();
	slconv = $('#slconv').val();
	slinr =slconv * slusd;
	$('#slinr').val(slinr.toFixed(2));
	sldis13();
}

function sldis13(){
	slusd = $('#slusd').val();
	slconv = $('#slconv').val();
	slextraconv = $('#slextraconv').val();
	if (slextraconv=='') {
        slextraconv='0';
    }
	if (slconv=='') {
        slconv='0';
    }
	sltotalconv =(parseFloat(slconv) + parseFloat(slextraconv));
	$('#sltotalconv').val(sltotalconv.toFixed(2));
	slinr2=sltotalconv * slusd;
	$('#slinr').val(Math.round(slinr2));
	if (slinr2=='0') {
       //slinr2=$('#slusd').val();
    }
	document.getElementById('salevalueusd').innerHTML=Math.round(slusd);
	document.getElementById('salevalueinr').innerHTML=Math.round(slinr2);
	profit();
}

function profit(){
	inr = $('#inr').val();
	slinr = $('#slinr').val();
       usd=$('#usd').val();
       slusd=$('#slusd').val();
	resulrvalinr=slinr-inr;
	resulrvalusd=slusd-usd;
	document.getElementById('resultvalueinr').innerHTML=resulrvalinr.toFixed(2);
	document.getElementById('resultvalueusd').innerHTML=resulrvalusd.toFixed(2);
	if (parseInt(resulrvalinr) > 0)
	{
      $("#resultvalueinr").removeClass("loss");
      $("#resultvalueinr").addClass("profit");
    }
	if (parseInt(resulrvalinr) < 0)
	{
		$("#resultvalueinr").removeClass("profit");
	$("#resultvalueinr").addClass("loss");	
	}
	
	if (parseInt(resulrvalusd) > 0)
	{
      $("#resultvalueusd").removeClass("loss");
      $("#resultvalueusd").addClass("profit");
    }
	if (parseInt(resulrvalusd) < 0)
	{
		$("#resultvalueusd").removeClass("profit");
	$("#resultvalueusd").addClass("loss");	
	}
	
}

function change() {
	    var color=document.getElementById('color1').value;
		var caret=document.getElementById('weight1').value;
		var clarity=document.getElementById('clarity1').value;
		var diamond_shape=document.getElementById('diamond_shape1').value;
		
		if (diamond_shape=='') {
           bootbox.alert("Select Diamond Shape");
           document.getElementById("diamond_shape1").focus();
        }
		else if (caret=='') {
           bootbox.alert("Enter Diamond Carat");
		   document.getElementById("weight1").focus();
        }
		else if (color=='') {
           bootbox.alert("Select Diamond Color");
		   document.getElementById("color1").focus();
        }
		else if (clarity=='') {
           bootbox.alert("Select Diamond Clarity");
		   document.getElementById("clarity1").focus();
        }
		else{
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
							if (document.getElementById("currentrap3").checked == true) {
                            document.getElementById('slrap1').value=respo.trim();
							$('#slrap1').keyup();
                            }
							else
							{
							document.getElementById('slrap1').value=0;
							$('#slrap1').keyup();
							}
							
							if (document.getElementById("currentrap2").checked == true) {
							document.getElementById('rap').value=respo.trim();
							$('#rap').keyup();
                            }
							else
							{
							document.getElementById('rap').value=0;
							$('#rap').keyup();
							}
					    	
						}			 
				}
                
			      var res="&color="+color+"&caret="+caret+"&clarity="+clarity+"&diamond_shape="+diamond_shape;
					 http2.open("GET","../search/getraptable.php?res="+res, true);
					 http2.send(null);
		}
                              }
							  
							  function change2() {
	    var color11=document.getElementById('color11').value;
		var caret11=document.getElementById('weight11').value;
		var clarity11=document.getElementById('clarity11').value;
		var diamond_shape11=document.getElementById('diamond_shape11').value;
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
							if (document.getElementById("currentrap33").checked == true) {
                            document.getElementById('slrap11').value=respo;
                            }
							else
							{
							document.getElementById('slrap11').value=0;
							}
							
						}			 
				}
                
			      var res="&color="+color11+"&caret="+caret11+"&clarity="+clarity11+"&diamond_shape="+diamond_shape11;
					 http2.open("GET","../search/getraptable.php?res="+res, true);
					 http2.send(null);
                              
                              }
							  
	function validatecertinumber() {
   certi_no = encodeURIComponent($('#certi_no').val());
   certi_name = encodeURIComponent($('#certi_name').val());
   if (certi_name=='') {
   document.getElementById('danger-alert-lab').style.display='block';
	$('#certi_name').focus();
	$('#confirmbutton').prop('disabled', true);
   }else{
	document.getElementById('danger-alert-lab').style.display='none';
	$('#confirmbutton').prop('disabled', false);
   }
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
                        if (respo==1)
                        {
						 document.getElementById('danger-alert').style.display='block';
						 $('#certi_no').focus();
                         $('#confirmbutton').prop('disabled', true);
                        }
                        else{
							document.getElementById('danger-alert').style.display='none';
                         //$('#confirmbutton').prop('disabled', false);
						}
   					}			 
   			}
			
	http2.open("GET","checkcertificatenumber.php?certi_no="+certi_no+"&certi_name="+certi_name, true);
	http2.send(null);
}

function showDateDiv() {
  if($('#instockno').is(':checked'))
  {
	document.getElementById('showDateDiv').style.display='block';
  }else{
	document.getElementById('showDateDiv').style.display='none';
  }
}