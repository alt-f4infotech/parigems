<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta name=viewport content="width=device-width, initial-scale=1"/>
      <title>Parigems</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="../css/loginstyle.css"/>
      <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	  <link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	 <script src="../js/bootstrap.min.js"></script>
	   <script src="../js/authenticate.js"></script>
	<script src="../js/bootbox.min.js"></script>
	  
   </head>
   <body>
      <div class="container-fluid">
         <a class="navbar-brand" href="#"><img src="../images/parigems_logo.png" class="img-responsive"></a>  
      </div>
	  
      <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 box">
            <div class="form-group">
               <h1 class="center">LOGIN</h1>
            </div>
            <div class="form-group">
               <input  type="text"  class="form-control"  id="username" placeholder="Username" onkeydown="uniKeyCode(event)">
            </div>
            <div class="form-group">
               <input class="form-control" type="password" id="password"  placeholder="Password" onkeydown="uniKeyCode(event)">
			   <span class="glyphicon glyphicon-eye-open glyp-icon" onclick="show1();"  aria-hidden="true" id="eyeopen"></span>
                <span class="glyphicon glyphicon-eye-close glyp-icon" onclick="show1();"  aria-hidden="true" id="eyeclose" style="display: none;"></span>
            </div>
            <div class="pull-left">
               <div class="form-group">
                 <a data-toggle="tooltip" title="Edit" href="javascript:;" data-id="" onclick="showAjaxModal();" >Forgot Password?</a>
               </div>
            </div>
            <div class="pull-right">
               <div class="form-group">
                  <a href="../signup/index.php">Register Now!</a>                  
               </div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left">
               <div class="form-group">
                  <input type="button" class="btn" onclick="authenticate()"  value="Login" />
               </div>
            </div>
            <div class="pull-right">
			      <div class="form-group">
                  <input type="button" class="btn" onclick="guestlogin()"  value="Guest Login" />      
               </div>
            </div>
            <div class="clearfix "></div>
      </div>
      </div>
   </body>
</html>
<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
         <div class="modal-body" style="padding: 0px;">
         </div>
      </div>
   </div>
</div>