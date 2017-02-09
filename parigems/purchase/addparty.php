<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
$party="select * from  party";
$res=mysqli_query($con,$party);
//while($pp=mysqli_fetch_assoc($res))
//{
//   $rfno='P-'.$pp['partyid'];
//   $update="update party set referenceno='$rfno' where partyid=".$pp['partyid'];
//   $run=mysqli_query($con,$update);
//}
$yrow=mysqli_num_rows($res);
$newreferenceno='P-'.($yrow+1);
?>
<section class="main-section">
	<div class="container crumb_top"> 
	   <ol class="breadcrumb" id="breadcrumb" style="color: black">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li class="active">Add Party</li>
	   </ol>
	   <h3 class="text-left">Add Party</h3>
	   <hr>
		<div class="tab-content">
	  		<div id="indian-registered-companies" class="tab-pane fade in active">
				<form id="" action="insertparty.php" method="post" enctype="multipart/form-data">
					<fieldset>
		   				<div class="row">
						   <div class="col-sm-6">
		   						<div class="form-group">	   							
			  						<label for="companyname">Company Reference Number</label>
			  						<input class="form-control" type="text" value="<?php echo $newreferenceno;?>" tabindex="-1" name="referenceno" id="referenceno" readonly >
								</div>
		    				</div>
							<div class="col-sm-6">
		   						<div class="form-group">	   							
			  						<label for="companyname">Company Name</label>
			  						<input class="form-control" type="text" tabindex="1" onblur="validateparty();" name="companyname" id="companyname" required >
									<div class="alert alert-danger" id="danger-alert" style="display: none;">
									<strong>Error!</strong> Compnay Name Already Exists
								  </div>
								</div>
		    				</div>
		    				<div class="col-sm-12">
		    					<div class="form-group">
				  					<label for="companyaddress">Company Address</label>
				  					<input class="form-control" type="text" tabindex="2" name="companyaddress" id="companyaddress"  >
								</div>
		    				</div>
		    			</div>
						<div class="row">
	                    	<div class="col-sm-3">								
				  				<label for="contactnumber">Primary Landline Number</label>
		    					<div class="form-group">
				  					<input class="form-control" type="text" tabindex="3" name="contactnumber" id="contactnumber" onkeypress="return IsNumeric1(event);"  >	
								</div>
		    				</div>
							<div class="col-sm-3">								
				  				<label for="contactnumber">Secondary Landline Number</label>
		    					<div class="form-group">
				  					<input class="form-control" type="text" tabindex="4" name="contactnumber2" id="contactnumber2" onkeypress="return IsNumeric1(event);"  >	
								</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="email">Primary Email ID</label>
				  					<input class="form-control" type="email" tabindex="5" name="email" id="email"  >
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="email">Secondary Email ID</label>
				  					<input class="form-control" type="email" tabindex="6" name="email2" id="email2"  >
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Website</label>
				  					<input class="form-control" type="text" tabindex="7" name="website" id="website">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Rapnet Id</label>
				  					<input class="form-control" type="text" tabindex="8" name="rapnetid" id="rapnetid">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Skype Id</label>
				  					<input class="form-control" type="text" tabindex="9" name="skypeid" id="skypeid">
				  				</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contactperson">Contact Person</label>
				  					<input class="form-control"  tabindex="10" type="contactperson" name="contactperson" id="contactperson"  >
				  				</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Contact Person Number</label>
				  					<input class="form-control" type="text" tabindex="11" name="contact" id="contact"   onkeypress="return IsNumeric1(event);" >
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Broker Name</label>
				  					<input class="form-control" type="text" tabindex="12" name="brokename" id="brokename">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Broker Contact Number</label>
				  					<input class="form-control" type="text" tabindex="13" name="brokenumber" id="brokenumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="cstnumber">CST Number</label>
				  					<input class="form-control" type="text" tabindex="14" name="cstnumber" id="cstnumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="vattin">VATTIN Number</label>
				  					<input class="form-control" type="text" tabindex="15" name="vattin" id="vattin">	
								</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="pannumber">PAN Number</label>
				  					<input class="form-control" type="text" tabindex="16" name="pannumber" id="pannumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">CIN Number</label>
				  					<input class="form-control" type="text" tabindex="17" name="cinnumber" id="cinnumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">IEC Code</label>
				  					<input class="form-control" type="text" tabindex="18" name="ieccode" id="ieccode">
				  				</div>
		    				</div>
						   <div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">GST Number</label>
				  					<input class="form-control" type="text" tabindex="19" name="gstnumber" id="gstnumber">
				  				</div>
		    				</div>
						   <div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">RBI Code</label>
				  					<input class="form-control" type="text" tabindex="20" name="rbicode" id="rbicode">
				  				</div>
		    				</div>
		    			</div>
						<h3>Bank Details</h3>
	                    <table class="table table1 table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th><input id="check_all" class="formcontrol" type="checkbox"/></th>
				                  	<th width="25%">Bank Name</th>
									<th>Bank Address</th>
				                  	<th>Branch / Branch Code</th>
				                  	<th>IFSC Code / Bank Code</th>
									<th>Swift Code</th>
				                  	<th>Account Number</th>
									<th>Beneficiary Name</th>
									<th>Account Description</th>
				                  	<th>Country</th>
				               	</tr>
				            </thead>
				            <tbody>
				               	<tr>
				                	<td><input class="case" type="checkbox"/></td>
				                  	<td><input type="text" tabindex="21" name="bankname[]" id="bankname_1" class="form-control"  ></td>
									<td><input type="text" tabindex="22" name="bankaddr[]" id="bankaddr_1" class="form-control"></td>
				                  	<td><input type="text" tabindex="23" name="branch[]" id="branch_1" class="form-control"  ></td>
				                  	<td><input type="text" tabindex="24" name="ifccode[]" id="ifccode_1" class="form-control"  ></td>
									<td><input type="text" tabindex="25" name="swiftcode[]" id="swiftcode_1" class="form-control"></td>
				                  	<td><input type="text" tabindex="26" name="accountno[]" id="accountno_1" class="form-control"   onkeypress="return IsNumeric(event);" ></td>
				                  	<td><input type="text" tabindex="27" name="benificiary[]" id="benificiary_1" class="form-control"></td>
									<td><input type="text" tabindex="28" name="accdescription[]" id="accdescription_1" class="form-control"></td>
				                  	<td><input type="text" tabindex="29" name="country[]" id="country_1" class="form-control"></td>
				                <tr>
				            </tbody>
	                    </table>
	                    <div class='row'>
	            			<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>
	         					<button class="btn btn-danger delete"   type="button">- Delete</button>
	         					<button class="btn btn-success addmore"  type="button">+ Add More</button>
		  					</div>
		  				</div>
						<h3>Intermediary Details</h3>
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th><input id="check_allbank" class="formcontrol" type="checkbox"/></th>
				                  	<th width="25%">Intermediary Bank</th>
				                  	<th>Swift Code</th>
				               	</tr>
				            </thead>
				            <tbody>
				               	<tr>
				                	<td><input class="casebank" type="checkbox"/></td>
				                  	<td><input type="text" tabindex="30" name="bankname2[]" id="bankname2_1" class="form-control"></td>
				                  	<td><input type="text" tabindex="31" name="swiftcode2[]" id="swiftcode2_1" class="form-control"></td>
				                <tr>
				            </tbody>
	                    </table>
	                    <div class='row'>
	            			<div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>
	         					<button class="btn btn-danger deletebank"   type="button">- Delete</button>
	         					<button class="btn btn-success addmorebank"  type="button">+ Add More</button>
		  					</div>
		  				</div>
		  				<center>
				    		<button type="submit" tabindex="32" class="action-button" id="submit">Submit</button>
				    	</center>
				  	</fieldset>
				</form>
	  		</div>
		</div>
	</div>
</section>
<?php
   include "../common/footer.php";
?>
<script src="../js/party.js"></script>