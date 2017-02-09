function optionvalidate(a) {
    shapename=$('#shapename').val();
    name=$('#name').val();
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
							if (respo==1) {
                                bootbox.alert("This Shape Already Exists.")
                                $('#shapename').focus();
                                $('#shapename').val('');                                
                            }
                            if (respo==2) {
                                bootbox.alert("This Certificate name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==3) {
                                bootbox.alert("This Option Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==4) {
                                bootbox.alert("This Key to Symbol Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==5) {
                                bootbox.alert("This Color Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==6) {
                                bootbox.alert("This Fancy Color Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==7) {
                                bootbox.alert("This Fancy Color Intensity Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==8) {
                                bootbox.alert("This Fancy Color Overtone Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==9) {
                                bootbox.alert("This Tinge Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==10) {
                                bootbox.alert("This Fluorescence Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==11) {
                                bootbox.alert("This Clarity Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==12) {
                                bootbox.alert("This Culet Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==13) {
                                bootbox.alert("This Black Inclusion Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==14) {
                                bootbox.alert("This Milky Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==15) {
                                bootbox.alert("This Girdle Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==16) {
                                bootbox.alert("This Girdle Condition Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
                            if (respo==17) {
                                bootbox.alert("This Inclusion Visibility Name Already Exists.")
                                $('#name').focus();
                                $('#name').val('');                                
                            }
						}			 
				}
                
			      var res="&a="+a+"&shapename="+shapename+"&name="+name;
					 http2.open("GET","optionvalidate.php?res="+res, true);
					 http2.send(null);
}