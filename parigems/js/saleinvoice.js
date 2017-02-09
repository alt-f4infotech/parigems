function calculateTotal(){
	grossamt=0;discount=0
    gross=$('#subtotal').val();
    
	
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