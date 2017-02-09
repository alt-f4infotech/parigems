//adds extra table rows
var i=$('table tr').length+1;
function addrow(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><a data-toggle="tooltip"  href="javascript:;" data-id="'+i+'" onclick="showAjaxModal('+i+');"><input type="hidden" name="certi[]" id="certi_'+i+'"><input type="text" id="certino_'+i+'" class="form-control" required readonly placeholder="Click to Select Certificate"></a></a></td>';
	html += '<td><input type="text" name="certitype[]" id="certitype_'+i+'" class="form-control" required readonly></td>';
	html += '<td><input type="text" name="description[]" id="description_'+i+'" class="form-control" required></td>';
	html += '<td><input type="text" name="carat[]" id="carat_'+i+'" class="form-control" required  onkeypress="return IsNumeric(event);"></td>';
	html += '<td><input type="text" name="rate[]" id="rate_'+i+'" class="form-control eachAmount" required onkeypress="return IsNumeric(event);"></td>';
	html += '<td><input type="text" name="amount[]" id="amount_'+i+'" class="form-control totalgrossadd" readonly required onkeypress="return IsNumeric(event);"></td>';
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
	 calculateTotal();
});

function remove() {
 $('.case:checkbox:checked').parents("tr").remove();
 $('#check_all').prop("checked", false);

};

function showAjaxModal(uid){
			   var certino=document.getElementById('certi_'+uid).value;
		 		$.get('diamondList.php?id=' + uid+'&certino='+certino, function(html){
                	$('#certimodal .modal-body').html(html);
                	$('#certimodal').modal('show', {backdrop: 'static'});
            	});
			}
            
function putid(p,j){
	certiid='';certi_no='';certitype='';weight='';clarity='';cut='';polish='';symmetry='';pcscount=0;;
   for(var k=1;k < j;k++)
   {
	var a = $("#certiid_"+k).is(":checked");
       if(a) {
        pcscount=pcscount+1;
		aa =$('#certiid_'+k).val();
		certiid =certiid+','+ aa;
        
		bb =$('#certi_no_'+k).val();
		certi_no =certi_no+','+ bb;
		
		cc =$('#certi_name_'+k).val();
		certitype =certitype+','+ cc;
		
		dd =$('#weight_'+k).val();
		weight =weight+','+ dd;		
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
	$('#carat_'+p).val(carat2.toFixed(2));
   }   
   calculateTotal();
}

$(document).on('keyup','.eachAmount',function(){
    id_arr = $(this).attr('id');
	id = id_arr.split("_");
	
	rate = $('#rate_'+id[1]).val();
	if (rate=='') {
       rate=0;
    }
	carat = $('#carat_'+id[1]).val();
	if (carat=='') {
       carat=0;
    }
	amount  = ( rate * carat);
	$('#amount_'+id[1]).val((Math.round(amount)).toFixed(2));
	calculateTotal();
});

function calculateTotal(){
	grossamt=0;discount=0;
    
    $('.totalgrossadd').each(function(){
		if($(this).val() != '' )grossamt += parseFloat( $(this).val());		
	});
    $('#subtotal').val(grossamt.toFixed(2));
    
	discount =$('#discount').val();
    if (discount=='') {
       discount=0;
    }
    subtotal=grossamt-discount;
    
    vat = $('#vat').val();
    
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
		
		conversion = $('#conversion').val();
		if (conversion=='') {
            conversion=1;
        }		
		extraconversion= $('#extraconversion').val();
		if (extraconversion=='') {
            extraconversion=0;
        }
		totalconversion = parseFloat(conversion) + parseFloat(extraconversion);
		inrupee = totalconversion * finaltotal;
		
        $('#total').val((Math.round(inrupee)).toFixed(2));
}

//ajax call for Customer Name
$(document).on('focus','.customerName',function(){    
	type = $(this).data('type');
	if(type =='username' )autoTypeNo=0;
	if(type =='companyname' )autoTypeNo=1;
	if(type =='phoneno' )autoTypeNo=2;
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'customerAjax.php',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {                   
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");
			$('#username').val(names[0]);
			$('#companyname').val(names[1]);
			$('#phoneno').val(names[2]);
			$('#address').val(names[3]);
			$('#cstnumber').val(names[4]);
			$('#vattinnumber').val(names[5]);
			$('#pannumber').val(names[6]);
		}		      	
	});
});