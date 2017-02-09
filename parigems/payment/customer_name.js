$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='productname' )autoTypeNo=1;
	if(type =='productname' )autoTypeNo=1; 	
	
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'party_details.php',
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
		minLength: 1,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");
		   $('#party_id').val( names[0]);			
			
		}		      	
	});

});
