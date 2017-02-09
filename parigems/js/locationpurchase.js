//adds extra table rows
var j=$('tablel tr').length+2;
function addrowl(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" name="locationname[]" id="locationname_'+j+'" class="form-control location" required><div class="alert alert-danger" id="danger-alert_'+j+'" style="display: none;"><strong>Error!</strong> Location Already Exists</div></td>';
	html += '</tr>';
	$('table').append(html);
	document.getElementById("locationname_"+j).focus();
	j++;
};

$(document).on('click','.addmorel',function(){
	addrowl();
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".deletel").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
});

function remove() {
 $('.case:checkbox:checked').parents("tr").remove();
 $('#check_all').prop("checked", false);
};

$(document).on('keyup','.location',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
   locationname =$('#locationname_'+id[1]).val();
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
						 document.getElementById('danger-alert_'+id[1]).style.display='block';
						 $('#locationname_'+id[1]).focus();
                         $('#submit').prop('disabled', true);
                        }
                        else{
							document.getElementById('danger-alert_'+id[1]).style.display='none';
							$('#submit').prop('disabled', false);
						}
   					}			 
   			}
	http2.open("GET","checkLocation.php?locationname="+locationname, true);
	http2.send(null);
});