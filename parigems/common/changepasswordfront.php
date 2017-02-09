<?php
  ob_start();
  error_reporting(0);
  session_start();
  
  include "header.php";
  $role = $_SESSION['role'];
  $username = $_SESSION['username'];
  $userid = $_SESSION['userid'];
  $getpassword="select * from login where userid=$userid and usertype='$role'";
  $passwordresult=mysqli_query($con,$getpassword);
  $psrow=mysqli_fetch_assoc($passwordresult);
  $oldpassword=$psrow['password'];
?>
<section class="main-section">
  <div class="container-fluid crumb_top">
    <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Change Password</li>
    </ol>  
    <form method="post" action="changepasswordback.php" id="" class="form-horizontal max-width700">
      <fieldset>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label class="control-label col-sm-4">Old Password</label>
              <div class="col-sm-8 ">
                <input type="password" class="form-control pwd1 pos-relative padding-right35" name="oldpassword" id="oldpassword" tabindex="1" required autocomplete="off">              
                <span class="glyphicon glyphicon-eye-open glyp-icon" onclick="show1();"  aria-hidden="true" id="eyeopen"></span>
                <span class="glyphicon glyphicon-eye-close glyp-icon" onclick="show1();"  aria-hidden="true" id="eyeclose" style="display: none;"></span>
                <input id="oldpasswordhidden" class="form-control" type="hidden" value="<?php echo $oldpassword;?>" name="oldpasswordhidden" required>
              </div>
            </div>
          </div>
        </div>
        <div id="show">
          <div class="row" >
            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label col-sm-4">New Password</label>
                <div class="col-sm-8 ">
                  <input type="password" class="form-control pwd2 pos-relative padding-right35" name="newpassword"  onkeyup="checkPwd();" id="newpassword" tabindex="2" required >         
                  <span class="glyphicon glyphicon-eye-open glyp-icon" onclick="show2();"  aria-hidden="true" id="eyeopen2"></span>
                  <span class="glyphicon glyphicon-eye-close glyp-icon" onclick="show2();"  aria-hidden="true" id="eyeclose2" style="display: none;"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label col-sm-4">Confirm New Password</label>
                <div class="col-sm-8 ">
                  <input type="password" class="form-control pwd3 pos-relative" name="confirmpassword" id="comfirmpassword" tabindex="3" required>                     
                  <span class="glyphicon glyphicon-eye-open glyp-icon" onclick="show3();" aria-hidden="true" id="eyeopen3"></span>
                  <span class="glyphicon glyphicon-eye-close glyp-icon" onclick="show3();" aria-hidden="true" id="eyeclose3" style="display: none;"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="errorBox" style="color: red;font-weight: bold"></div>
        <div class="row">
          <div class="col-sm-12">
            <center>
              <a class="hover-none" href="../common/homepage.php" >
                <input type="button" class="action-button" value="Cancel"/>
              </a>
              <input type="submit" class="action-button" value="Change"/>
            </center>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</section>
<script>
  $(document).ready(function(){
   $(".dropdown-toggle").addClass("active");
  });

function show1(){
  var pwd1 = document.getElementById('oldpassword').getAttribute("type");
  if (pwd1 === 'password') {
    $('#oldpassword').attr('type', 'text');
    $('#eyeclose').show();
    $('#eyeopen').hide();
  } 
  else {
    $('#oldpassword').attr('type', 'password');
    $('#eyeclose').hide();
    $('#eyeopen').show();
  }
}
  
function show2(){
  var $pwd = document.getElementById('newpassword').getAttribute("type");
  if ($pwd === 'password') {
    $('#newpassword').attr('type', 'text');
    $('#eyeclose2').show();
    $('#eyeopen2').hide();
  } else {
    $('#newpassword').attr('type', 'password');
    $('#eyeclose2').hide();
    $('#eyeopen2').show();
  }
}
  
function show3(){
  var pwd2 =document.getElementById('comfirmpassword').getAttribute("type");
  if (pwd2 === 'password') {
    $('#comfirmpassword').attr('type', 'text');
    $('#eyeclose3').show();
    $('#eyeopen3').hide();
  } 
  else {
    $('#comfirmpassword').attr('type', 'password');
    $('#eyeclose3').hide();
    $('#eyeopen3').show();
  }
}

function showdiv()
  {
  
  var oldpswd=document.getElementById('oldpassword').value;
  var oldpasswordhidden=document.getElementById('oldpasswordhidden').value;
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
                if (oldpasswordhidden==respo)
                {
                  document.getElementById('show').style.display='block';
                }
                else
                {
         alert("Old Password doesn't match.");
               document.getElementById('show').style.display='none';  
                }
            
      }      
  }
   http2.open("GET","encryptpassword.php?oldpswd="+oldpswd, true);
     http2.send(null);
  
  }
</script>
<?php include "footer.php";?>