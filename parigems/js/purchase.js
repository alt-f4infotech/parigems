//adds extra table rows
var i=$('table tr').length+1;
function addrow(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><a data-toggle="tooltip"  href="javascript:;" data-id="'+i+'" onclick="showAjaxModal('+i+');"><input type="hidden" name="certi[]" id="certi_'+i+'"><input type="text" id="certino_'+i+'" class="form-control" required readonly placeholder="Click to Select Certificate"></a></a></td>';
	html += '<td><input type="text" name="certitype[]" id="certitype_'+i+'" class="form-control" required readonly></td>';
	html += '<td><input type="text" name="caret[]" id="caret_'+i+'" class="form-control" readonly></td>';
	//html += '<td><input type="text" name="clarity[]" id="clarity_'+i+'" class="form-control" readonly></td>';
	//html += '<td><input type="text" name="cut[]" id="cut_'+i+'" class="form-control" readonly></td>';
	//html += '<td><input type="text" name="polish[]" id="polish_'+i+'" class="form-control" readonly></td>';
	//html += '<td><input type="text" name="symmetry[]" id="symmetry_'+i+'" class="form-control" readonly></td>';
	html += '<td><input type="text" name="description[]" id="description_'+i+'" class="form-control" required></td>';
	html += '<td><input type="text" name="pcs[]" id="pcs_'+i+'" value="1" class="form-control" required onkeypress="return IsNumeric(event);" readonly></td>';
	html += '<td><input type="text" name="qty[]" id="qty_'+i+'" class="form-control d2" required onkeypress="return IsNumeric(event);"></td>';
	html += '<td><input type="text" name="rate[]" id="rate_'+i+'" class="form-control d2" required onkeypress="return IsNumeric(event);"></td>';
	//html += '<td><input type="text" name="amount1[]" id="amount1_'+i+'" class="form-control d2" readonly onkeypress="return IsNumeric(event);"></td>';
	//html += '<td><input type="text" name="discountt[]" id="discountt_'+i+'" class="form-control d2 totaldiacount" onkeypress="return IsNumeric(event);"></td>';
	//html += '<td><input type="text" name="amount2[]" id="amount2_'+i+'" class="form-control d2" readonly onkeypress="return IsNumeric(event);"></td>';
	//html += '<td><input type="text" name="vatt[]" id="vatt_'+i+'" class="form-control d2" onkeypress="return IsNumeric(event);"></td>';
	//html += '<td><input type="text" name="vattamount[]" id="vattamount_'+i+'" class="form-control d2" readonly onkeypress="return IsNumeric(event);"></td>';
	html += '<td><input type="text" name="amount[]" id="amountt_'+i+'" class="form-control totalgrossadd" readonly required onkeypress="return IsNumeric(event);"></td>';
	html += '</tr>';
	$('table').append(html);
	document.getElementById("certi_"+i).focus();
	i++;
};

$(document).on('click','.addmore',function(){
	addrow();
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
});

function remove() {
 $('.case:checkbox:checked').parents("tr").remove();
 $('#check_all').prop("checked", false);
};

function showAjaxModal(uid){
			   var certino=document.getElementById('certi_'+uid).value;
		 		$.get('getcertiidvat.php?id=' + uid+'&certino='+certino, function(html){
                	$('#certimodal .modal-body').html(html);
                	$('#certimodal').modal('show', {backdrop: 'static'});
            	});
			}

/*function putid(p,j,n,t,a,b,c,d,e){
	document.getElementById('certi_'+p).value=j;
	document.getElementById('certino_'+p).value=n;
	document.getElementById('certitype_'+p).value=t;
	document.getElementById('caret_'+p).value=a;
	document.getElementById('clarity_'+p).value=b;
	document.getElementById('cut_'+p).value=c;
	document.getElementById('polish_'+p).value=d;
	document.getElementById('symmetry_'+p).value=e;
}
*/
function putidvat(p,j){
	certiid='';certi_no='';certitype='';weight='';clarity='';cut='';polish='';symmetry='';pcscount=0;;
   for(var k=1;k < j;k++)
   {
	var a = $("#certiid_"+k).is(":checked");
       if(a) { pcscount=pcscount+1;
		aa =$('#certiid_'+k).val();
		certiid =certiid+','+ aa;
		
		bb =$('#certi_no_'+k).val();
		certi_no =certi_no+','+ bb;
		
		cc =$('#certi_name_'+k).val();
		certitype =certitype+','+ cc;
		
		dd =$('#weight_'+k).val();
		weight =weight+','+ dd;
		
		ee =$('#clarity_'+k).val();
		clarity =clarity+','+ ee;
		
		ff =$('#cut_'+k).val();
		cut =cut+','+ ff;
		
		gg =$('#polish_'+k).val();
		polish =polish+','+ gg;
		
        hh =$('#symmetry_'+k).val();
		symmetry =symmetry+','+ hh;
        }
	certi_no22='';
	certi_no11=certiid.split(',');
	for( var m2=2; m2< (certi_no11.length);m2++){
		certi_no22=certi_no22+','+certi_no11[m2];
	}
	$('#certi_'+p).val(certi_no11[1]+''+certi_no22);
	
	certi_no2='';
	certi_no1=certi_no.split(',');
	for( var m=2; m< (certi_no1.length);m++){
		certi_no2=certi_no2+','+certi_no1[m];
	}
	$('#certino_'+p).val(certi_no1[1]+''+certi_no2);
	
	certitype2='';
	certitype1=certitype.split(',');
	for( var n=2; n< (certitype1.length);n++){
		certitype2=certitype2+','+certitype1[n];
	}
	$('#certitype_'+p).val(certitype1[1]+''+certitype2);
	
	weight2='';carat=0;
	weight1=weight.split(',');
	for( var n1=2; n1< (weight1.length);n1++){
		weight2=weight2+','+weight1[n1];
		carat = parseFloat(carat) + parseFloat(weight1[n1]); 
	}
	carat2 = carat + parseFloat(weight1[1])
	$('#caret_'+p).val(weight1[1]+''+weight2);
	$('#qty_'+p).val(carat2);
	
	$('#pcs_'+p).val(pcscount);
	
	//$('#clarity_'+p).val(clarity);
	//$('#cut_'+p).val(cut);
	//$('#polish_'+p).val(polish);
	//$('#symmetry_'+p).val(symmetry);
   }
   calculateTotal();
}
$(document).on('keyup','.d2',function(){
id_arr = $(this).attr('id');
	id = id_arr.split("_");
	
	rate = $('#rate_'+id[1]).val();
	qty = $('#qty_'+id[1]).val();
	
	amount1=qty * rate;
	
	/*$('#amount1_'+id[1]).val(amount1.toFixed(2));
	discountt = $('#discountt_'+id[1]).val();
	if (discountt=='') {
      discountt=0;
    }
	amount2  = ( rate * qty)-discountt;
	
	$('#amount2_'+id[1]).val(amount2.toFixed(2));
	
	vat = $('#vatt_'+id[1]).val();
	 vatamount=((rate * vat) / 100);
	$('#vattamount_'+id[1]).val(vatamount);
	amount  = (( rate * qty) + vatamount)-discountt;*/
	
	$('#amountt_'+id[1]).val((Math.round(amount1)).toFixed(2));
   
	calculateTotal();
});
function calculateTotal(){
	grossamt=0;discount=0
$('.totalgrossadd').each(function(){
		if($(this).val() != '' )grossamt += parseFloat( $(this).val());		
	});

	/*$('.totaldiacount').each(function(){
		if($(this).val() != '' )discount += parseFloat( $(this).val());		
	});*/
	discount =$('#discount').val();if (discount=='') {
       discount=0;
    }
vat = $('#vat').val();
gross=parseFloat(grossamt);
subtotal=gross-discount;
$('#subtotal').val((Math.round(subtotal)).toFixed(2));
if (vat !='') {
 vatamount=((subtotal * vat) / 100);
$('#vatamount').val((Math.round(vatamount)).toFixed(2));
}
else
{
	vatamount=0;
	$('#vatamount').val((Math.round(vatamount)).toFixed(2));
}

finaltotal=(subtotal  + parseFloat(vatamount));
//finaltotal.toLocaleString();

$('#total').val((Math.round(finaltotal)).toFixed(2));
//$('#discount').val(discount.toFixed(2));
}

function invoiceenable() {
       var partyNames=document.getElementById('partyid').value;
   if (partyNames!='') {
		    document.getElementById('invoiceno').disabled=false;
			 document.getElementById('checkparty').style.display="none";
       }
else
{
     document.getElementById('invoiceno').disabled=true;
	  document.getElementById('checkparty').style.display="block";
	  document.getElementById('checkinvoice').style.display="none";
}
checkinvoice();

      }
	  
function checkinvoice(){
    
	 var partyid=document.getElementById('partyid').value;
	var invoiceno=document.getElementById('invoiceno').value;
	if (partyid!='') {
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
document.getElementById('checkinvoice').style.display="block";
   }
   else
   {
   document.getElementById('checkinvoice').style.display="none";
  
   }
                }
   			}	
		http2.open("GET","checkinvoiceno.php?invoiceno="+invoiceno+"&partyid="+partyid, true);
   		 http2.send(null);
	}
	else
   {
	 document.getElementById('invoiceno').disabled=true;
	  document.getElementById('checkparty').style.display="block";
	  document.getElementById('checkinvoice').style.display="none";
   }
   }
   
   function getreminderdate() {
   var duedate=document.getElementById('duedate').value;
  
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
                document.getElementById('reminderdate').value=respoo;
                }
   			}	
		http2.open("GET","getreminderdate.php?duedate="+duedate, true);
   		 http2.send(null);
   }
   
   function getpartyname() {
   var partycode=document.getElementById('partycode').value;
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
               document.getElementById('partyidDiv').innerHTML=respoo;
				$("#partyid").select2();
				invoiceenable();
                }
   			}
			
		http2.open("GET","getpartyname.php?partycode="+partycode, true);
   		 http2.send(null);
   }
   
   function getpartycode() {
   var partyid=document.getElementById('partyid').value;
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
               document.getElementById('partycodeDiv').innerHTML=respoo;
				$("#partycode").select2();
				 invoiceenable();
                }
   			}
		http2.open("GET","getpartycode.php?partyid="+partyid, true);
   		 http2.send(null);
		
   }