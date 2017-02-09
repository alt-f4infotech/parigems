<?php
  include "../common/header.php";
     ob_start();
     session_start();
     error_reporting(0);
     $role = $_SESSION['role'];
     $username = $_SESSION['username'];
     $userid = $_SESSION['userid'];  
     ?>
<body>
  <section class="main-section">
    <div class="container-fluid crumb_tp">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Add Sub-Admin</li>
      </ol>
    </div>
    <div class="container">
    <h2 style="text-align: center">Add Sub-Admin</h2>
    <form id="" class="form-horizontal" action="insertsubadmin.php" onsubmit="return checkpass()" enctype="multipart/form-data" method="post" >
      <div id="errorBox"></div>
      <br>
      <fieldset >
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Username</label>
                  <div class="col-sm-10">   
                    <input type="text" name="username" id="username" onblur="checkusername();"  tabindex="1" required class="form-control">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Email Id</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" id="email" tabindex="2"  required class="form-control">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Contact Number</label>
                  <div class="col-sm-10">
                    <input type="text" name="phoneno" id="phoneno" tabindex="3"   onkeypress="return IsNumeric(event);"  class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Address</label>
                  <div class="col-sm-10">
                    <input type="text" name="address" id="address" class="form-control"  tabindex="4" required >
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Skype Id</label>
                  <div class="col-sm-10">
                    <input type="text" name="skypeId" id="skypeId" class="form-control"  tabindex="4" >
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="newpassword" id="newpassword" class="form-control"  tabindex="4" required >
                    <span class="glyphicon glyphicon-eye-open glyp-icon " onclick="show1();" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-xs-12">
                <div class="form-group">
                  <label class="control-label col-sm-2">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"  tabindex="4" required >
                    <span class="glyphicon glyphicon-eye-open glyp-icon" onclick="show3();"  aria-hidden="true"></span>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <center>
          <a href="../common/homepage.php" >
            <input type="button" class="action-button" value="Cancel"/>
          </a>
          <input type="submit" name="submit" class="submit action-button" value="Save" />
        </center>
      </fieldset>
    </form>
  </div>
  </section>
  <script>
    function show1(){
      var pwd1 = document.getElementById('newpassword').getAttribute("type");
      if (pwd1 === 'password') {
           $('#newpassword').attr('type', 'text');
      } else {
          $('#newpassword').attr('type', 'password');
      }
    }
     
      function show3(){
      var pwd2 =document.getElementById('confirmpassword').getAttribute("type");
      if (pwd2 === 'password') {
          $('#confirmpassword').attr('type', 'text');
      } else {
          $('#confirmpassword').attr('type', 'password');
      }
      }
      function checkpass()
      {
      var newpassword=document.getElementById('newpassword').value;
      var confirmpassword=document.getElementById('confirmpassword').value;
     if (newpassword!=confirmpassword)
     {
      bootbox.alert("Enter Correct Password.");
      return false;
     }
      }
  </script>
  <script type="text/javascript" src="../js/multi-step-form.js"></script>
  <?php include "../common/footer.php";?>