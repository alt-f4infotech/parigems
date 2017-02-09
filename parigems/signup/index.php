<?php
include '../common/config.php';
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="../css/animsition.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/responsive.css"/>
	<link rel="stylesheet" type="text/css" href="../css/parigems.css"/>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	 <link rel="stylesheet" href="../assets/bootstrap-table/src/bootstrap-table.css">
	  <script src="../assets/jquery.min.js"></script>
	  <script type="text/javascript" src="../libs/jsPDF/jspdf.min.js"></script>
         <script type="text/javascript" src="../libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
         <script type="text/javascript" src="../libs/html2canvas/html2canvas.min.js"></script>
         <script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
         <script src="../assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
         <script src="../assets/tableExport.js"></script>
         <script src="../assets/ga.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="../js/location.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<!--<link href="../css/demo-page.css" rel="stylesheet" media="all">-->
		<link href="../css/hover.css" rel="stylesheet" media="all">
		<script src="../js/animsition.min.js" charset="utf-8"></script>
		<script src="../js/search.js" charset="utf-8"></script>
		<script src="../js/bootbox.min.js"></script>
		<script src="../js/notify.min.js"></script>
		<script type="text/javascript">
   		$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");

	});
</script>
</head>
	 <body style="background-color:#d7dee2 ">
	  
		<header class="hidden-print">
	 
		<nav class="navbar navbar-fixed-top">
        	<div class="container">
          	<div class="navbar-header">
            	<a class="navbar-brand logo_center" href="../common/homepage.php"   tabindex="-1">
                <img class="img-responsive navbrandlogo animated swing" width="250px" src="../images/parigem_logo.png">
              </a>
          	</div>
						  
			
            	</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	
	</header>
		<div class="se-pre-con"></div>
	<div class="container-fluid register_top">		
		<div class="tab-content">
  			<div id="indian-registered-companies" class="tab-pane fade in active" style="margin-bottom:60px">
				<form id="msform" action="signupsubmit.php" method="post" enctype="multipart/form-data">    
    <div id="errorBox"></div><br>
    <fieldset>
	  <div class="row">
	  <h2 class="text-center register_heading">Register Now !</h2>
	  <br/>
            <div class="col-sm-12">
			 <div class=" text-center input input--ruri">
				 <label class="checkbox-title">Company Type [*]</label>
			 <div class="text-left input input--ruri" style="display: inline;">
				<div class="checkbox-inline">
					<label><input  type="radio" name="countrytype" value="India" onclick="document.getElementById('india').style.display='block';document.getElementById('international').style.display='none';$('#countryId').attr('required', false);" checked="checked"  required/> India</label>
				   <label><input  type="radio" name="countrytype" value="International" onclick="document.getElementById('international').style.display='block';document.getElementById('india').style.display='none';$('#countryId').attr('required', true);" required/> International</label>
				</div>
			 </div>
        </div>
	  </div>
	  </div>
	  <br/>
        <div class="row">
            <div class="col-sm-6">
                <span class="input input--ruri">
					<input class="input__field input__field--ruri" type="text" name="companyname" id="companyname" required/>
					<label class="input__label input__label--ruri" for="companyname">
						<span class="input__label-content input__label-content--ruri">Company Name [*]</span>
                </label>
                </span>
            </div>
            <div class="col-sm-6">
                <span class="input input--ruri">
					<input class="input__field input__field--ruri"  type="text" name="phonenumber" id="phonenumber" onkeypress="return IsNumeric(event);" maxlength="10" required />
					<label class="input__label input__label--ruri" for="phonenumber">
						<span class="input__label-content input__label-content--ruri">Phone Number [*]</span>
                </label>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <span class="input input--ruri">
					<input class="input__field input__field--ruri" name="companyaddress" id="companyaddress" required ></input>
					<label class="input__label input__label--ruri" for="companyname">
						<span class="input__label-content input__label-content--ruri">Company Address [*]</span>
                </label>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <span class="input input--ruri">
					<input class="input__field input__field--ruri" type="email" name="emailaddress" id="emailaddress" onkeyup="validateEmailId();" onblur="validateEmailId();"  required/>
					<label class="input__label input__label--ruri" for="emailaddress">
						<span class="input__label-content input__label-content--ruri">Email Address [*]</span>
                </label>
                </span>
            </div>
			 </div>        
        <div class="row" id="india">
            <div class="col-sm-4">
                <span class="input input--ruri">
					<input class="input__field input__field--ruri" type="text" name="pannumber" id="pannumber" />
					<label class="input__label input__label--ruri" for="PAN Card No.">
						<span class="input__label-content input__label-content--ruri">PAN Card Number</span>
                </label>
                </span>
            </div>
            <div class="col-sm-4">
                <span class="input input--ruri"> 
					<input class="input__field input__field--ruri"  type="text" name="cstnumber" id="cstnumber"  />
					<label class="input__label input__label--ruri" for="cst">
						<span class="input__label-content input__label-content--ruri">CST Number</span>
                </label>
                </span>
            </div>
               <div class="col-sm-4">
                <span class="input input--ruri"> 
					<input class="input__field input__field--ruri" type="text" name="vattinnumber" id="vattinnumber" />
					<label class="input__label input__label--ruri" for="VAT">
						<span class="input__label-content input__label-content--ruri">VAT Number</span>
                </label>
                </span>
            </div>
        
            <div class="col-sm-4">
					<input class="input__field input__field--ruri" type="file" name="panno" id="panno" />
            </div>
            <div class="col-sm-4">
					<input class="input__field input__field--ruri"  type="file" name="gst" id="gst"  />
            </div>
               <div class="col-sm-4">
					<input class="input__field input__field--ruri" type="file" name="vatno" id="vatno" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <span class="input input--ruri">
					<input class="input__field input__field--ruri" type="password" name="password" id="ppassword" required />
					<label class="input__label input__label--ruri" for="ppassword">
						<span class="input__label-content input__label-content--ruri">Password [*]</span>
                </label>
                </span>
            </div>
            <div class="col-sm-6">
                <span class="input input--ruri"> 
					<input class="input__field input__field--ruri" type="password" name="confirmpassword" id="cpassword" oncopy="return false" onpaste="return false" onkeyup="matchpassword();"  required/>
					<label class="input__label input__label--ruri" for="cpassword">
						<span class="input__label-content input__label-content--ruri">Confirm Password [*]</span>
                </label>
                </span>
            </div>
        </div>
		<div class="row" id="international" style="display: none;">
			<div class="col-sm-6">
				<div class="question form-group input input--ruri">
					<select class="countries form-control" id="countryId" name="country" >
						<option value="">Select Country [*]</option>
					</select>
					<span class="caret caret2"></span>
					<div class="bar"></div>
				</div>
			</div>
			<div class="col-sm-6">
				<input class="input__field input__field--ruri" type="file" name="governmentapprovedid" id="governmentapprovedid"/>
            </div>
          </div>  
        <a href="../common/">
            <button type="button" class="action-button" value="Cancel">Cancel</button>
        </a>
        <button type="submit" class="action-button" id="disableSubmit">Submit</button>
    </fieldset>
</form>
  			</div>
		
	</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/search.js"></script>
	<script type="text/javascript" src="../js/multi-step-form.js"></script>
	<script type="text/javascript" src="../js/parigemssignup.js"></script>
	<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
	<br>
	<br>
<?php include '../common/footer.php';?>