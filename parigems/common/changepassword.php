<?php
   ob_start();
   session_start();
      error_reporting(0);
 include 'http://parigems.co/beta/common/config.php';

    date_default_timezone_set("Asia/Kolkata");
   $userid=$_GET['id'];
   function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
  $decrypted_txt = encrypt_decrypt('decrypt', $userid);
   ?>
   <!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://parigems.co/beta/css/animsition.min.css" rel="stylesheet">
   
	<link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/jquery-ui.min.css" />
	<!--datepicker--><link rel="stylesheet" href="http://parigems.co/beta/css/datepicker.css"><!--datepicker-->
  <link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/jcarousel.responsive.css">
	<link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/parigems.css">
	<link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/responsive.css"/>
	<!--<link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/loginstyle.css"/>-->
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://parigems.co/beta/assets/bootstrap-table/src/bootstrap-table.css">
	<link href="http://parigems.co/beta/css/select2.css" rel="stylesheet"/>
	<script src="http://parigems.co/beta/assets/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://demo.phpgang.com/html-select-box-searching-support-jquery/select2.js"></script>
	<script type="text/javascript" src="http://parigems.co/beta/libs/jsPDF/jspdf.min.js"></script>
  <script type="text/javascript" src="http://parigems.co/beta/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
  <script type="text/javascript" src="http://parigems.co/beta/libs/html2canvas/html2canvas.min.js"></script>
  <script src="http://parigems.co/beta/assets/bootstrap-table/src/bootstrap-table.js"></script>
  <script src="http://parigems.co/beta/assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
  <script src="http://parigems.co/beta/assets/tableExport.js"></script>
  <script src="http://parigems.co/beta/assets/ga.js"></script>
  
  <script src="http://parigems.co/beta/js/location.js"></script>
	<!-- <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'> -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	  <script type="text/javascript" src="http://parigems.co/beta/js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="http://parigems.co/beta/js/bootstrap.min.js"></script>

  <!--<link href="http://parigems.co/beta/css/demo-page.css" rel="stylesheet" media="all">-->
	<link href="http://parigems.co/beta/css/hover.css" rel="stylesheet" media="all">
	<script src="http://parigems.co/beta/js/animsition.min.js" charset="utf-8"></script>
	 <!--datepicker--><script src="http://parigems.co/beta/js/bootstrap-datepicker.js"></script><!--datepicker-->
	<script src="http://parigems.co/beta/js/search.js" charset="utf-8"></script>
	<script src="http://parigems.co/beta/js/calculation.js" charset="utf-8"></script>
	<script src="http://parigems.co/beta/js/optionvalidation.js" charset="utf-8"></script>
	<script src="http://parigems.co/beta/js/bootbox.min.js"></script>
</head>
 <div class="wpf-container container">
   <img class="img-responsive navbrandlogo" width="250px" src="http://parigems.co/beta/images/parigem_logo.png"><br>
   <div id="pfmaincontent" class="wpf-container-inner">
						<br><br><br>
						<div class="form-group row">
						    <div class="col-lg-3 ">
						  <label class="control-label">New Password:</label>
							</div>
						  <div class="col-lg-4">
                        <input id="newpassword" class="form-control" type="password" name="newpassword"  placeholder="New Password" required>
                        <input id="userid" class="form-control" type="hidden" value="<?php echo $decrypted_txt;?>" name="userid" required>
						  </div>
						</div>						
						<div class="form-group row">
						    <div class="col-lg-3 ">
						  <label class="control-label">Confirm New Password:</label>
							</div>
						  <div class="col-lg-4">
                        <input id="confirmnewpassword" class="form-control" type="password" name="confirmnewpassword"  placeholder="Confirm New Password" required>
						  </div>
						</div>
						<center> <button type="button" class="btn btn-primary" onclick="change();" style="width:10%">SUBMIT</button></center>
					  </div>
               </div>
         <div class="pf-page-spacing"></div>
		 
		 <script>
                              function change() {								
                                var newpassword=document.getElementById('newpassword').value;
                                var confirmnewpassword=document.getElementById('confirmnewpassword').value;
                                var userid=document.getElementById('userid').value;
                                if (newpassword==confirmnewpassword)
								{
								 var res="&newpassword="+newpassword+"&confirmnewpassword="+confirmnewpassword+"&userid="+userid;
                                        $.ajax({
										  url:"http://parigems.co/beta/common/passwordchange.php?res="+res,  
										  success:function(data) {
											  if (data==1) {
												alert("Password Updated Successfully.");
												 window.location.href="index.php";
											}
										  }
										});
                                }
                                else
                                {
                                 alert("New Password doesnt match");
                                }
                              }
                           </script>
<?php
include "http://parigems.co/beta/common/footer.php";
?>