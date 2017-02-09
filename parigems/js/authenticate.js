function authenticate()
 {
   var username =document.getElementById('username').value;
   var password =document.getElementById('password').value;
var res="&username="+username+"&password="+password;

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
    window.location.href="../common/homepage.php";                
                }
                 if (respo==2) {
                  bootbox.alert('Invalid Password');
                }
                if (respo==3) {      
     bootbox.alert("Invalid Username");
                }
                 if (respo==4) {      
     bootbox.alert("Your Account is Blocked.Please Contact Parigem's Admin.");
                }
                if (respo==5) {      
     bootbox.alert("Your Approval is Pending..Please Contact Parigem's Admin.");
                }
    
    }
   }
   //alert(res);
   http2.open("GET","authenticate.php?res="+res, true);
      http2.send(null);
    }
   
     function showAjaxModal(){
   	$.get('forgot_password.php', function(html){
              $('#myModal .modal-body').html(html);
              $('#myModal').modal('show', {backdrop: 'static'});
          });
   }
  
  function guestlogin()
 {
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
    window.location.href="../search/search.php";                
                }
                
    }
   }
   http2.open("GET","insertguest.php", true);
      http2.send(null);
    }


    function uniKeyCode(event) {
  var charr = event.which || event.keyCode;
   if (charr == 13) {
    authenticate();	
   }
}
function show1(){
  var pwd1 = document.getElementById('password').getAttribute("type");
  if (pwd1 === 'password') {
    $('#password').attr('type', 'text');
    $('#eyeclose').show();
    $('#eyeopen').hide();
  } 
  else {
    $('#password').attr('type', 'password');
    $('#eyeclose').hide();
    $('#eyeopen').show();
  }
}