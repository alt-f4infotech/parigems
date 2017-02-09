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
<section class="main-section ">
	<div class="container crumb_top"> 
	   <ol class="breadcrumb" id="breadcrumb" style="color: black">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li><a href="viewallparty.php">View All Party</a></li>
	      <li class="active">View Party</li>
	   </ol>
	   <h3 class="text-left">View Party</h3>
	   <hr>
		<div class="tab-content">
	  		<div id="indian-registered-companies" class="tab-pane fade in active">
					<fieldset>
		   				<div class="row">
						   <div class="col-sm-6">
		   						<div class="form-group">	   							
			  						<label for="companyname">Company Reference Number : </label>
			  						<?php echo $row1['referenceno'];?>
								</div>
		    				</div>
							<div class="col-sm-6">
		   						<div class="form-group">	   							
			  						<label for="companyname">Company Name : </label>
			  						<?php echo $row1['companyname'];?>
								</div>
		    				</div>
		    				<div class="col-sm-12">
		    					<div class="form-group">
				  					<label for="companyaddress">Company Address : </label>
				  					<?php echo $row1['compnayaddress'];?>
								</div>
		    				</div>
		    			</div>
						<div class="row">
	                    	<div class="col-sm-3">								
				  				<label for="contactnumber">Primary Landline Number : </label>
		    					<div class="form-group">
				  					<?php echo $row1['contactnumber'];?>
								</div>
		    				</div>
							<div class="col-sm-3">								
				  				<label for="contactnumber">Secondary Landline Number : </label>
		    					<div class="form-group">
				  					<?php echo $row1['contactnumber2'];?>
								</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="email">Primary Email ID : </label>
				  					<?php echo $row1['email'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="email">Secondary Email ID : </label>
				  					<?php echo $row1['email2'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Website : </label>
				  					<?php echo $row1['website'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Rapnet Id : </label>
				  					<?php echo $row1['rapnetid'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Skype Id : </label>
				  					<?php echo $row1['skypid'];?>
				  				</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contactperson">Contact Person : </label>
				  					<?php echo $row1['contactperson'];?>
				  				</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Contact Person Number : </label>
				  					<?php echo $row1['contact'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Broker Name : </label>
				  					<?php echo $row1['brokername'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">Broker Contact Number : </label>
				  					<?php echo $row1['brokercontact'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="cstnumber">CST Number : </label>
				  					<?php echo $row1['cst'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="vattin">VATTIN Number : </label>
				  					<?php echo $row1['vattin'];?>
								</div>
		    				</div>
		    				<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="pannumber">PAN Number : </label>
				  					<?php echo $row1['pan'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">CIN Number : </label>
				  					<?php echo $row1['cinnumber'];?>
				  				</div>
		    				</div>
							<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">IEC Code : </label>
				  					<?php echo $row1['ieccode'];?>
				  				</div>
		    				</div>
						<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">GST Number : </label>
				  					<?php echo $row1['gstnumber'];?>
				  				</div>
		    				</div>
						<div class="col-sm-3">
		    					<div class=" form-group">
				  					<label for="contact">RBI Code : </label>
				  					<?php echo $row1['rbicode'];?>
				  				</div>
		    				</div>
						</div>
						<h3>Bank Details</h3>
	                    <table class="table table1 table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
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
				                  	<td><?php echo $row2['bankname'];?></td>
									<td><?php echo $row2['bankaddr'];?></td>
				                  	<td><?php echo $row2['branch'];?></td>
				                  	<td><?php echo $row2['bank_ifccode'];?></td>
				                  	<td><?php echo $row2['swiftcode'];?></td>
				                  	<td><?php echo $row2['account_number'];?></td>
									<td><?php echo $row2['benificiary'];?></td>
				                  	<td><?php echo $row2['accdescription'];?></td>
				                  	<td><?php echo $row2['country'];?></td>
				                   <tr>
						    <?php $i++;} ?>
				            </tbody>
	                    </table>
						<h3>Intermediary Details</h3>
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
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
				                  	<td><?php echo $row3['bankname2'];?></td>
				                  	<td><?php echo $row3['swiftcode2'];?></td>
				                <tr>
								<?php $j++;} ?>
				            </tbody>
	                    </table>
				  	</fieldset>
	  		</div>
		</div>
	</div>
</section>
<?php
   include "../common/footer.php";
?>