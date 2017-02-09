//adds extra table rows
var i=$('table tr').length+1;
function addrow(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" name="description[]" id="description_'+i+'" class="form-control" ></td>';
	html += '<td><input type="text" name="carat[]" id="carat_'+i+'" class="form-control d2" onkeypress="return IsNumeric(event);"></td>';
	html += '<td><input type="text" name="rate[]" id="rate_'+i+'" class="form-control d2" onkeypress="return IsNumeric(event);"></td>';
	html += '<td><input type="text" name="amount[]" id="amount_'+i+'" class="form-control totalgrossadd" onkeypress="return IsNumeric(event);"></td>';
	html += '</tr>';
	$('table').append(html);
	document.getElementById("description_"+i).focus();
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

$(document).on('keyup','.d2',function(){
    id_arr = $(this).attr('id');
	id = id_arr.split("_");
	carat = $('#carat_'+id[1]).val();
	if (carat=='') {
       carat=0;
    }	
	rate = $('#rate_'+id[1]).val();
	if (rate=='') {
       rate=0;
    }	
	amount  = rate * carat;
	
	$('#amount_'+id[1]).val((Math.round(amount)).toFixed(2));
	calculateTotal();
});

function calculateTotal(){
	grossamt=0;discount=0;
	
		$('.totalgrossadd').each(function(){
				if($(this).val() != '' )grossamt += parseFloat( $(this).val());		
			});
		  $('#subtotal').val(grossamt);   
		 gross=grossamt;    
	
		conversion = $('#conversion').val();
		if (conversion=='') {
            conversion=1;
        }		
		extraconversion= $('#extraconversion').val();
		if (extraconversion=='') {
            extraconversion=0;
        }
		totalconversion = parseFloat(conversion) + parseFloat(extraconversion);
		$('#totalconversion').val(totalconversion);
		inrupee = totalconversion * gross;
		
	discount =$('#discount').val();if (discount=='') {
       discount=0;
    }
	
    subtotal=inrupee-discount;
    
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
		
		
        $('#total').val((Math.round(finaltotal)).toFixed(2));
		
		abc=inrupee;		
	roundoff = (abc - Math.round(inrupee));
	$('#roundoff').val(Math.abs(roundoff.toFixed(2)));
}