//adds extra table rows
var i=$('.table1 tr').length+1;
function addrow(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" name="bankname[]" id="bankname_'+i+'" class="form-control" required></td>';
	html += '<td><input type="text" name="bankaddr[]" id="bankaddr_'+i+'" class="form-control"></td>';
	html += '<td><input type="text" name="branch[]" id="branch_'+i+'" class="form-control" required></td>';
	html += '<td><input type="text" name="ifccode[]" id="ifccode_'+i+'" class="form-control" required></td>';
	html += '<td><input type="text" name="swiftcode[]" id="swiftcode_'+i+'" class="form-control"></td>';
	html += '<td><input type="text" name="accountno[]" id="accountno_'+i+'" class="form-control" required onkeypress="return IsNumeric(event);" ></td>';
	html += '<td><input type="text" name="benificiary[]" id="benificiary_'+i+'" class="form-control"></td>';
	html += '<td><input type="text" name="accdescription[]" id="accdescription_'+i+'" class="form-control"></td>';
	html += '<td><input type="text" name="country[]" id="country_'+i+'" class="form-control"></td>';
	html += '</tr>';
	$('.table1').append(html);
	document.getElementById("bankname_"+i).focus();
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

//adds extra table rows
var j=$('.tablebank tr').length+1;
function addmorebank(){
	html = '<tr>';
	html += '<td><input class="casebank" type="checkbox"/></td>';
	html += '<td><input type="text" name="bankname2[]" id="bankname2_'+j+'" class="form-control" ></td>';
	html += '<td><input type="text" name="swiftcode2[]" id="swiftcode2_'+j+'" class="form-control"></td>';
	html += '</tr>';
	$('.tablebank').append(html);
	document.getElementById("bankname2_"+j).focus();
	j++;
};

$(document).on('click','.addmorebank',function(){
	addmorebank();
});

//to check all checkboxes
$(document).on('change','#check_allbank',function(){
	$('input[class=casebank]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".deletebank").on('click', function() {
	$('.casebank:checkbox:checked').parents("tr").remove();
	$('#check_allbank').prop("checked", false); 
});

function removebank() {
 $('.casebank:checkbox:checked').parents("tr").remove();
 $('#check_allbank').prop("checked", false);
};

function validateparty() {
   companyname = encodeURIComponent($('#companyname').val());
   
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
						 //bootbox.alert('Compnay Name Already Exists.');
						 document.getElementById('danger-alert').style.display='block';
						 $('#companyname').focus();
                         $('#submit').prop('disabled', true);
                        }
                        else{
							document.getElementById('danger-alert').style.display='none';
							$('#submit').prop('disabled', false);
						}
   					}			 
   			}
			
	http2.open("GET","checkparty.php?companyname="+companyname, true);
	http2.send(null);
}