<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   $encrypted_txt = encrypt_decrypt('decrypt', $_GET['partyid']);
   $partyid=$encrypted_txt;
   $getdetails1="select * from party where partystatus=1 and partyid='$partyid'";
   $result1=mysqli_query($con,$getdetails1);
   $row1=mysqli_fetch_assoc($result1);
?>
<section class="main-section">
	<div class="container crumb_top"> 
	   <ol class="breadcrumb" id="breadcrumb" style="color: black">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li class="active">Edit Party</li>
	   </ol>
	   <h3 class="text-left">Edit Party</h3>
	   <hr>
		<div class="tab-content">
	  		<div id="indian-registered-companies" class="tab-pane fade in active">
				<form id="" action="inserteditparty.php" method="post" enctype="multipart/form-data">
					<fieldset>
		   				<div class="row">
						   <div class="col-sm-6">
		   						<div class="form-group">	   							
			  						<label for="companyname">Company Reference Number</label>
			  						<input class="form-control" type="text" value="<?php echo $row1['referenceno'];?>" tabindex="-1" name="referenceno" id="referenceno" readonly >
								</div>
		    				</div>
							<div class="col-sm-6">
		   						<div class="form-group">	   							
			  						<label for="companyname">Company Name</label>
			  						<input class="form-control" type="text" value="<?php echo $row1['companyname'];?>" name="companyname" id="companyname" required>
			  						<input class="form-control" type="hidden" value="<?php echo $partyid;?>" name="partyid" id="partyid" >
								</div>
		    				</div>
		    				<div class="col-sm-12">
		    					<div class="form-group">
				  					<label for="companyaddress">Company Address</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['compnayaddress'];?>" name="companyaddress" id="companyaddress" >
								</div>
		    				</div>
		    			</div>
						<div class="row">
	                    	<div class="col-sm-3">								
				  				<label for="contactnumber">Primary Landline Number</label>
		    					<div class="form-group">
				  					<input class="form-control" type="text" value="<?php echo $row1['contactnumber'];?>" name="contactnumber" id="contactnumber" onkeypress="return IsNumeric1(event);" >	
								</div>
		    				</div>
							<div class="col-sm-3">								
				  				<label for="contactnumber">Secondary Landline Number</label>
		    					<div class="form-group">
				  					<input class="form-control" type="text" value="<?php echo $row1['contactnumber2'];?>" name="contactnumber2" id="contactnumber2" onkeypress="return IsNumeric1(event);" >	
								</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="email">Primary Email ID</label>
				  					<input class="form-control" type="email" value="<?php echo $row1['email'];?>" name="email" id="email" >
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="email">Secondary Email ID</label>
				  					<input class="form-control" type="email" value="<?php echo $row1['email2'];?>" name="email2" id="email2" >
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Website</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['website'];?>" name="website" id="website">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Rapnet Id</label>
				  					<input class="form-control" type="text"  value="<?php echo $row1['rapnetid'];?>" name="rapnetid" id="rapnetid">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Skype Id</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['skypid'];?>" name="skypeid" id="skypeid">
				  				</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contactperson">Contact Person</label>
				  					<input class="form-control" type="contactperson" value="<?php echo $row1['contactperson'];?>" name="contactperson" id="contactperson" >
				  				</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Contact Person Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['contact'];?>" name="contact" id="contact"  onkeypress="return IsNumeric1(event);" >
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Broker Name</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['brokername'];?>" name="brokename" id="brokename">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Broker Contact Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['brokercontact'];?>" name="brokenumber" id="brokenumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="cstnumber">CST Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['cst'];?>" name="cstnumber" id="cstnumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="vattin">VATTIN Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['vattin'];?>" name="vattin" id="vattin">	
								</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="pannumber">PAN Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['pan'];?>" name="pannumber" id="pannumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">CIN Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['cinnumber'];?>" name="cinnumber" id="cinnumber">
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">IEC Code</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['ieccode'];?>" name="ieccode" id="ieccode">
				  				</div>
		    				</div>
						<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">GST Number</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['gstnumber'];?>" name="gstnumber" id="gstnumber">
				  				</div>
		    				</div>
						<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">RBI Code</label>
				  					<input class="form-control" type="text" value="<?php echo $row1['rbicode'];?>" name="rbicode" id="rbicode">
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
							  <?php
							  $i=1;
							  $getdetails2="select * from party_bankdetails where  partyid='$partyid'";
							  $result2=mysqli_query($con,$getdetails2);
							  while($row2=mysqli_fetch_assoc($result2)){
                              ?>
				                	<tr>
				                	<td><input class="case" type="checkbox"/></td>
				                  	<td><input type="text" name="bankname[]" value="<?php echo $row2['bankname'];?>" id="bankname_<?php echo $i?>" class="form-control" ></td>
									<td><input type="text" name="bankaddr[]" value="<?php echo $row2['bankaddr'];?>" id="bankaddr_<?php echo $i?>" class="form-control"></td>
				                  	<td><input type="text" name="branch[]" value="<?php echo $row2['branch'];?>" id="branch_<?php echo $i?>" class="form-control" ></td>
				                  	<td><input type="text" name="ifccode[]" value="<?php echo $row2['bank_ifccode'];?>" id="ifccode_<?php echo $i?>" class="form-control" ></td>
				                  	<td><input type="text" name="swiftcode[]" value="<?php echo $row2['swiftcode'];?>" id="swiftcode_<?php echo $i?>" class="form-control"></td>
				                  	<td><input type="text" name="accountno[]" value="<?php echo $row2['account_number'];?>" id="accountno_<?php echo $i?>" class="form-control"  onkeypress="return IsNumeric(event);" ></td>
									<td><input type="text" name="benificiary[]" value="<?php echo $row2['benificiary'];?>" id="benificiary_<?php echo $i?>" class="form-control"></td>
				                  	<td><input type="text" name="accdescription[]" value="<?php echo $row2['accdescription'];?>" id="accdescription_<?php echo $i?>" class="form-control"></td>
				                  	<td><input type="text" name="country[]" value="<?php echo $row2['country'];?>" id="country_<?php echo $i?>" class="form-control"></td>
				                   <tr>
						    <?php $i++;} ?>
				            </tbody>
	                    </table>
	                    <div class='row'>
	            			<div class='col-xs-12 col-sm-4 col-md-3 col-lg-3'>
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
							  <?php
							  $j=1;
							  $getdetails3="select * from party_bankdetails_other where  partyid='$partyid'";
							  $result3=mysqli_query($con,$getdetails3);
							  while($row3=mysqli_fetch_assoc($result3)){
                              ?>
				               	<tr>
				                	<td><input class="casebank" type="checkbox"/></td>
				                  	<td><input type="text" name="bankname2[]" value="<?php echo $row3['bankname2'];?>" id="bankname2_<?php echo $j?>" class="form-control"></td>
				                  	<td><input type="text" name="swiftcode2[]" value="<?php echo $row3['swiftcode2'];?>" id="swiftcode2_<?php echo $j?>" class="form-control"></td>
				                <tr>
								<?php $j++;} ?>
				            </tbody>
	                    </table>
	                    <div class='row'>
	            			<div class='col-xs-12 col-sm-4 col-md-3 col-lg-3'>
	         					<button class="btn btn-danger deletebank"   type="button">- Delete</button>
	         					<button class="btn btn-success addmorebank"  type="button">+ Add More</button>
		  					</div>
		  				</div>
		  				<center>
				    		<button type="submit" class="action-button">Submit</button>
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