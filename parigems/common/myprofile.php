<?php
include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
   $role = $_SESSION['role'];
   $username = $_SESSION['username'];
   $userid = $_SESSION['userid'];
   
    $getdetails="select * from  basic_details where userid=$userid";
    $result=mysqli_query($con,$getdetails);
    $row=mysqli_fetch_assoc($result);
	
	$getnatureBusiness=mysqli_query($con,"select * from  nature_business where userid=$userid");
	$getBusinessStructure=mysqli_query($con,"select * from  business_strucure where userid=$userid");
	$getpartnerDetails=mysqli_query($con,"select * from  partner_details where userid=$userid");
	$getauthorizedDetails=mysqli_query($con,"select * from  authorized_buyer where userid=$userid");
	$athRow=mysqli_fetch_assoc($getauthorizedDetails);
    $getreferenceDetails=mysqli_query($con,"select * from  `references` where userid=$userid");
	$getDocumentsDetails=mysqli_query($con,"select * from  documents where userid=$userid");
	$docRow=mysqli_fetch_assoc($getDocumentsDetails);
	
	
	 ?>
<link rel="stylesheet" type="text/css" href="../css/form.css">
  <section class="main-section">
    <div class="container-fluid">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">My Profile</li>
      </ol>
    </div>
    <div class="container">
      <h2 class="text-center">KYC</h2>
	  <fieldset>
	  <form id="" action="editprofile.php" method="post" enctype="multipart/form-data">
					<input class="form-control" value="india" type="hidden" name="countrytype" id="countrytype" >

					<div id="errorBox"></div><br>
	    				<div class="row">
	    					<div class="col-sm-6">
										<label for="companyname">Compamy Name	</label>
					<input class="form-control" type="text" name="companyname" value="<?php echo $row['companyname'];?>" id="companyname"/>
	    					</div>
	    					<div class="col-sm-6">
								
	<label for="phonenumber">Phone Number [*]</label>
					<input class="form-control" value="<?php echo $row['phoneno'];?>" type="text" name="phonenumber" id="phonenumber" onkeypress="return IsNumeric(event);" maxlength="10" />
	    					</div>
	    				</div>
	    				<div class="row">
	    					<div class="col-sm-12">
	<label for="companyname">Company Address [*]</label>
			  						<input class="form-control"  value="<?php echo $row['office_address'];?>" name="companyaddress" id="companyaddress" ></input>


	    					</div>
	    				</div>
	    				
	    				<div class="row">
	    					<div class="col-sm-6">
	<label for="faxnumber">Fax Number
					</label>
					<input class="form-control" value="<?php echo $row['fax_number'];?>"  type="text" name="faxnumber" id="faxnumber" />
	    					</div>
	    				
	    					<div class="col-sm-6">
								
	<label for="emailaddress">
						Email Address [*]
					</label>
					<input class="form-control" type="email" value="<?php echo $row['emailid'];?>" name="emailaddress" value="<?php echo $row['emailid'];?>" id="emailaddress" />


	    					</div>
							</div>
						<div class="row">
	    					<div class="col-sm-6">
	    						<div class=" form-group ">
										<label>Select Country</label>
			  						<select class="countries form-control" id="countryId" name="country" >
			  							<option value="<?php echo $row['country'];?>" selected><?php echo $row['country'];?></option>
			  							<option value="">Select Country [*]</option>
			  						</select>

								</div>
	    					</div>
							<div class="col-sm-6">
							<div class="form-group ">
									<label>Select State</label>
								<select name="stateId" class="states form-control" tabindex="15" id="stateId">
									<option value="">Select State [*]</option>
								</select>
							</div>
						</div>
						</div>
						<div class="row">
	    					<div class="col-sm-6">
	    						<div class=" form-group ">
											<label>Select City</label>
			  						<select class="cities form-control" id="cityId" name="city" >
									   <option value="<?php echo $row['city'];?>" selected><?php echo $row['city'];?></option>
			  							<option value="">Select City [*]</option>
			  						</select>

								</div>
	    					</div>	    				
	    					<div class="col-sm-6">
<label for="zipcode">
						Zipcode / Pincode [*]
					</label>
					<input class="form-control" type="text" value="<?php echo $row['pincode'];?>" name="zipcode" id="zipcode" onkeypress="return IsNumeric(event);" maxlength="6" />

	    					</div>
							</div>
	    				<div class="row">
	    					<div class="col-sm-6">
<label  for="website">Website</span>
					</label>
					<input class="form-control" type="text" value="<?php echo $row['website'];?>" name="website" id="website" />


	    					</div>	    				
	    					<div class="col-sm-6">
<label  for="pannumber">
					PAN Number [*]
					</label>
					<input class="form-control" value="<?php echo $row['pannumber'];?>" type="text" name="pannumber" id="pannumber" />

	    					</div>
							</div>
	    				<div class="row">
							<div class="col-sm-6">
<label for="cstnumber">
						CST Number [*]
					</label>
					<input class="form-control" value="<?php echo $row['cstnumber'];?>" type="text" name="cstnumber" id="cstnumber" />


	    					</div>
							<div class="col-sm-6">
	<label  for="vattinnumber">
						Vattin Number
					</label>
					<input class="form-control" value="<?php echo $row['vattinnumber'];?>" type="text" name="vattinnumber" id="vattinnumber" />


	    					</div>
						</div>
						<div class="row">							
								<div class="col-sm-6">
								<div>
			  						<label>Nature of Business Activity [*]</label>
								</div>
								<div >
								  <?php
								  while($nrow=mysqli_fetch_assoc($getnatureBusiness))
								  {
									if($nrow['activity_type']=='wholesaler'){$wholesaler="checked";}
									if($nrow['activity_type']=='retailer'){$retailer="checked";}
									if($nrow['activity_type']=='manufacturer'){$manufacturer="checked";}
									if($nrow['activity_type']=='broker'){$broker="checked";}
									if($nrow['activity_type']=='other'){$other="checked";}
								  }
									?>
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="wholesaler" name="naturebusinessstructure[]" style="margin-left: -10px" <?php echo $wholesaler;?>>&nbsp;&nbsp;&nbsp;Wholesaler</label>
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="retailer" name="naturebusinessstructure[]" style="margin-left: -10px" <?php echo $retailer;?>>&nbsp;&nbsp;&nbsp;Retailer</label> 
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="manufacturer" name="naturebusinessstructure[]" style="margin-left: -10px" <?php echo $manufacturer;?>>&nbsp;&nbsp;&nbsp;Manufacturer</label>
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="broker" name="naturebusinessstructure[]" style="margin-left: -10px" <?php echo $broker;?>>&nbsp;&nbsp;&nbsp;Broker</label>
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="other" name="naturebusinessstructure[]" style="margin-left: -10px" <?php echo $other;?>>&nbsp;&nbsp;&nbsp;Other</label>
    							</div>
	    					</div>
								<div class="col-sm-6">
	    						<div>
			  						<label>Business structures [*]</label>
								</div>
								<div>
								<?php
								  while($brow=mysqli_fetch_assoc($getBusinessStructure))
								  {
									if($brow['business_type']=='proprietorship'){$proprietorship="checked";}
									if($brow['business_type']=='partnership'){$partnership="checked";}
									if($brow['business_type']=='company'){$company="checked";}
									if($brow['business_type']=='others'){$others="checked";}
								  }
									?>
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="proprietorship" name="businessstructure[]" style="margin-left: -10px" <?php echo $proprietorship;?>>&nbsp;&nbsp;&nbsp;Proprietorship</label>
      									<label class="font-normal checkbox-inline"><input type="checkbox" value="partnership" name="businessstructure[]" style="margin-left: -10px" <?php echo $partnership;?>>&nbsp;&nbsp;&nbsp;Partnership</label>
      									<label class="font-normal checkbox-inline checkbox-inline"><input type="checkbox" value="company" name="businessstructure[]" style="margin-left: -10px" <?php echo $company;?>>&nbsp;&nbsp;&nbsp;Company</label>
      									<label class="font-normal checkbox-inline checkbox-inline"><input type="checkbox" value="others" name="businessstructure[]" style="margin-left: -10px" <?php echo $others;?>>&nbsp;&nbsp;&nbsp;Others</label>
    							</div>
	    					</div>
	    				
							</div>
						<div class="row">
							<div class="col-sm-6">
	    						
<label for="bankname">Bank Name [*]</span>
					</label>
					<input class="form-control" value="<?php echo $row['bankname'];?>" type="text" name="bankname" id="bankname" />


	    					</div>
								<div class="col-sm-6">
<label for="branchname">
					Bank Branch [*]
					</label>

					<input class="form-control" value="<?php echo $row['branchname'];?>" type="text" name="branchname" id="branchname" />

							</div>
	    				</div>
	    				<div class="row">
	    					<div class="col-sm-6">
	    						
	<label for="bankaccountnumber">
					Bank Account Number [*]
					</label>

					<input class="form-control" value="<?php echo $row['accountid'];?>"  type="text" name="bankaccountnumber" id="bankaccountnumber" onkeypress="return IsNumeric(event);"  />

	    					</div>
							<div class="col-sm-6">
							 
<label for="username" id="user">
						  Username [*]
					   </label>

					   <input class="form-control" onblur="checkusername();"  value="<?php echo $row['username'];?>" type="text" name="username" id="username" />

	    						
	    					</div>
	    				</div>
	    				
						



						<?php
						$persons=1;
						if(mysqli_num_rows($getpartnerDetails) > 0)
					  {
						
						  if(mysqli_num_rows($getpartnerDetails) == 2)
						  {
							while($ptRow=mysqli_fetch_assoc($getpartnerDetails))
						{
						  ?>
	    				<div class="row">
	    					<div class="col-sm-12">
	    						<h2>Person <?php echo $persons;?></h2>
	    						<div class="row">	    							
	    							<div class="col-sm-6">
				<label for="person1name">
						Name
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['partnername'];?>" name="person1name[]" id="person1name" />


	    							</div>
	    							<div class="col-sm-6">
									<label for="person1name">Designation</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['designation'];?>" name="person1designation[]" id="person1designation" />
	    							</div>
	    						</div>
	    						<div class="row">
	    							<div class="col-sm-12">
									<label for="person1name">Address</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['address'];?>" name="person1address[]" id="person1address" />
	    							</div>
	    						</div>
	    					</div>
	    				</div>
				    	<?php $persons++; } }else{
						  while($ptRow=mysqli_fetch_assoc($getpartnerDetails))
						{ ?>
						  <div class="row">
	    					<div class="col-sm-12">
	    						<h2 style="font-weight: normal;" class="text-left fs-subtitle">Person 1</h2>
	    						<div class="row">	    							
	    							<div class="col-sm-6">

											<label  for="person1name">
						Name
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['partnername'];?>" name="person1name[]" id="person1name" />

	    							</div>
	    							<div class="col-sm-6">

											<label  for="person1designation">
						Designation
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['designation'];?>" name="person1designation[]" id="person1designation" />


	    								
	    							</div>
	    						</div>
	    						<div class="row">
	    							<div class="col-sm-12">

										<label  for="person1address">
					Address
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['address'];?>" name="person1address[]" id="person1address" />

	    								
	    							</div>
	    						</div>
	    					</div>
	    				</div>
						<?php }?>
						<div class="row">
	    					<div class="col-sm-12">
	    						<h2 style="font-weight: normal;" class="text-left fs-subtitle">Person 2</h2>
	    						<div class="row">	    							
	    							<div class="col-sm-6">

												<label  for="person1name">
						Name
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['partnername'];?>" name="person1name[]" id="person1name" />

	    							</div>
	    							<div class="col-sm-6">
<label  for="person1designation">
						Designation
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['designation'];?>" name="person1designation[]" id="person1designation" />


	    								
	    							</div>
	    						</div>
	    						<div class="row">
	    							<div class="col-sm-12">

										<label for="person1address">
						Address
					</label>

					<input class="form-control" type="text" value="<?php echo $ptRow['address'];?>" name="person1address[]" id="person1address" />

	    							</div>
	    						</div>
	    					</div>
	    				</div>						
						<?php }}else{ ?>
						<div class="row">
	    					<div class="col-sm-12">
	    						<h2 style="font-weight: normal;" class="text-left fs-subtitle">Person 1</h2>
	    						<div class="row">	    							
	    							<div class="col-sm-6">

											<label for="person1name">Name
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['partnername'];?>" name="person1name[]" id="person1name" />

	    							</div>
	    							<div class="col-sm-6">
	<label  for="person1designation">Designation</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['designation'];?>" name="person1designation[]" id="person1designation" />

	    								
	    							</div>
	    						</div>
	    						<div class="row">
	    							<div class="col-sm-12">

										<label  for="person1address">Address</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['address'];?>" name="person1address[]" id="person1address" />

	    								
	    							</div>
	    						</div>
	    					</div>
	    				</div>
						<div class="row">
	    					<div class="col-sm-12">
	    						<h2 style="font-weight: normal;" class="text-left fs-subtitle">Person 2</h2>
	    						<div class="row">	    							
	    							<div class="col-sm-6">

											<label for="person1name">
						Name
					</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['partnername'];?>" name="person1name[]" id="person1name" />

	    							</div>
	    							<div class="col-sm-6">

										<label  for="person1designation">Designation</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['designation'];?>" name="person1designation[]" id="person1designation" />


	    								
	    							</div>
	    						</div>
	    						<div class="row">
	    							<div class="col-sm-12">
										<label  for="person1address">	Address</label>
					<input class="form-control" type="text" value="<?php echo $ptRow['address'];?>" name="person1address[]" id="person1address" />

	    								
	    							</div>
	    						</div>
	    					</div>
	    				</div>
						<?php } ?>



			    		<!-- <h2 class="fs-title">Authorized Buyer if any</h2> -->
			    		<div class="row">		
	    					<div class="col-sm-6">	    						

									<label  for="authorizedname">Name</label>
					<input class="form-control" type="text" value="<?php echo $athRow['authorize_name'];?>" name="authorizedname" id="authorizedname" />

	    					</div>
	    					<div class="col-sm-6">

									<label for="authorizedemployeeidnumber">
						Employee ID Number	</label>
					<input class="form-control" type="text" value="<?php echo $athRow['employee_id'];?>" name="authorizedemployeeidnumber" id="authorizedemployeeidnumber" />


	    						
	    					</div>
	    				</div>
	    				<div class="row">	    							
	    					<div class="col-sm-6">

								<label for="directcontactnumber">Direct Contact Number</label>
					<input class="form-control" type="text" value="<?php echo $athRow['auth_contactno'];?>" name="directcontactnumber" id="directcontactnumber" onkeypress="return IsNumeric(event);" maxlength="10" />

	    					</div>
	    					<div class="col-sm-6">

								<label  for="authorizedemailid">Email Id
					</label>
					<input class="form-control" type="email" value="<?php echo $athRow['auth_email'];?>" name="authorizedemailid" id="authorizedemailid" />

	    						
	    					</div>
	    				</div>


			    		<!-- <h2 class="fs-title">Documents Required</h2> -->
			    		<br>
			    		<div class="row">	    							
	    					<div class="col-sm-6">
	    						<div class=" form-group">
										<label>Business Registration Number</label>

			  						<input class="form-control" type="file" name="businessregistrationno" id="businessregistrationno" value="<?php echo $docRow['regitsrtaion_no'];?>">

								</div>
	    					</div>
	    					<div class="col-sm-6">
	    						<div class=" form-group">
										<label>Government approved ID Number</label>
			  						<input class="form-control" type="file" name="governmentapprovedid" id="governmentapprovedid" value="<?php echo $docRow['govt_id'];?>">


								</div>
	    					</div>
	    				</div>
	    				<div class="row">	    							
	    					<div class="col-sm-6">
	    						<div class=" form-group">
										<label>Pan Number</label>
			  						<input class="form-control" type="file" name="panno" id="panno" value="<?php echo $docRow['pan_no'];?>" accept=".png,.jpg,.jpeg,.pdf,.gif">


								</div>
	    					</div>
	    					<div class="col-sm-6">
	    						<div class="form-group">
											<label>VAT Number</label>
			  						<input class="form-control" type="file" name="vatno" id="vatno" value="<?php echo $docRow['vat_no'];?>" accept=".png,.jpg,.jpeg,.pdf,.gif">


								</div>
	    					</div>
	    				</div>
	    				<div class="row">	    							
	    					<div class="col-sm-6">
	    						<div class=" form-group">
										<label>TIN Number</label>

			  						<input class="form-control" type="file" name="tinno" id="tinno" value="<?php echo $docRow['tin_no'];?>" accept=".png,.jpg,.jpeg,.pdf,.gif">

								</div>
	    					</div>
	    					<div class="col-sm-6">
	    						<div class=" form-group">
													  						<label>GST Number / CST Number</label>

			  						<input class="form-control" type="file" name="gst" id="gst" value="<?php echo $docRow['cst_no'];?>" accept=".png,.jpg,.jpeg,.pdf,.gif">

								</div>
	    					</div>
							<div class="col-sm-6">
	    						<div class=" form-group">
										<label>Passport</label>
			  						<input class="form-control" type="file" name="passport" id="passport" value="<?php echo $docRow['passport'];?>" accept=".png,.jpg,.jpeg,.pdf,.gif">


								</div>
	    					</div>
	    				</div>


			    		<!-- <h2 class="fs-title">Refrences Details</h2> -->
						<?php
						$refCount=1;
						if(mysqli_num_rows($getreferenceDetails) > 0)
						{
						while($refRow=mysqli_fetch_assoc($getreferenceDetails))
						{
						?>
			    		<div class="row">	    							
	    					<div class="col-sm-6">
									<label  for="companyname1">Company Name</label>
								  <input class="form-control" type="text" value="<?php echo $refRow['companyname'];?>" name="companyname1[]" id="companyname<?php echo $refCount;?>" />

	    					</div>
	    					<div class="col-sm-6">
<label  for="contactperson1">
									  Contact Number
								  </label>
								  <input class="form-control" type="text" value="<?php echo $refRow['contactperson'];?>" name="contactperson1[]" id="contactperson<?php echo $refCount;?>" onkeypress="return IsNumeric(event);" maxlength="10" />

	    					</div>
	    				</div>
						<?php $refCount++;}}else{ ?>
						<div class="row">	    							
	    					<div class="col-sm-6">
					<label  for="companyname1">Company Name</label>
								  <input class="form-control" type="text"  name="companyname1[]" id="companyname1" />


	    					</div>
	    					<div class="col-sm-6">

									 <label for="contactperson1">Contact Number</label>
								  <input class="form-control" type="text"  name="contactperson1[]" id="contactperson1" onkeypress="return IsNumeric(event);" maxlength="10" />


	    					</div>
	    				</div>
						<div class="row">	    							
	    					<div class="col-sm-6">
  <label for="companyname1">Company Name </label>
								  <input class="form-control" type="text"  name="companyname1[]" id="companyname2" />

	    					</div>
	    					<div class="col-sm-6">
<label for="contactperson1">Contact Number</label>
								  <input class="form-control" type="text" name="contactperson1[]" id="contactperson2" onkeypress="return IsNumeric(event);" maxlength="10" />


	    					</div>
	    				</div>
						<div class="row">	    							
	    					<div class="col-sm-6">
						<label for="companyname1">Company Name</label>
								  <input class="form-control" type="text" name="companyname1[]" id="companyname3" />

	    					</div>
	    					<div class="col-sm-6">
 <label for="contactperson1">Contact Number </label>
								  <input class="form-control" type="text" name="contactperson1[]" id="contactperson3" onkeypress="return IsNumeric(event);" maxlength="10" />

	    					</div>
	    				</div>
						<?php } ?>
						<div class="text-center">

						<button type="submit" class="action-button">Submit</button>
						</div>

				</form>
	  
      
    </div>
  </section>
	<script type="text/javascript" src="../js/multi-step-form.js"></script>
	<script type="text/javascript" src="../js/parigemssignup.js"></script>
	<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
  <?php include "footer.php";?>