<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/config.php";
   $userid=$_GET['userid'];
   $userqry1="select b.* from basic_details b,login l where  l.userid=b.userid and b.usertype='user' and b.userid='$userid'";
   $result1=mysqli_query($con,$userqry1);
   $row=mysqli_fetch_assoc($result1);
?>
<div class="modal-body">
			<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
      <div class="clearfix"></div>
      <br>
	  <h4>Basic Details</h4>
	  <div class="row">
		 <div class="col-sm-4">
			<label><b>Userid:</b></label> <?php echo $row['userid'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Username:</b></label> <?php echo $row['username'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Company Name:</b></label> <?php echo $row['companyname'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Address:</b></label> <?php echo $row['office_address'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>City:</b></label> <?php echo $row['city'];?>
		 </div>
		  <div class="col-sm-4">
			<label><b>Pincode:</b></label> <?php echo $row['pincode'];?>
		 </div>
		   <div class="col-sm-4">
			<label><b>Country:</b></label> <?php echo $row['country'];?>
		 </div>
         <div class="col-sm-4">
			<label><b>Phoneno:</b></label> <?php echo $row['phoneno'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Fax Number:</b></label> <?php echo $row['fax_number'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Website:</b></label> <?php echo $row['website'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Email Id:</b></label> <?php echo $row['emailid'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Bankname:</b></label> <?php echo $row['bankname'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Branchname:</b></label> <?php echo $row['branchname'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Accountid:</b></label> <?php echo $row['accountid'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>Countrytype:</b></label> <?php echo $row['countrytype'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>CST Number:</b></label> <?php echo $row['cstnumber'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>VATTIN Number:</b></label> <?php echo $row['vattinnumber'];?>
		 </div>
		 <div class="col-sm-4">
			<label><b>PAN Number:</b></label> <?php echo $row['pannumber'];?>
		 </div>
	  </div>
		<div class="tab-content">
            <h4>Authorized Details</h4>
	  		<div class="table-responsive">
	                    <table class="table table1 table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
									<th>Authorize Name</th>
				                  	<th>Employee Id</th>
				                  	<th>Authorize Contactno</th>
									<th>Authorize Email</th>
				               	</tr>
				            </thead>
				            <tbody>
							  <?php
							  $getdetails1="select * from authorized_buyer where auth_status=1 and userid='$userid'";
							  $result1=mysqli_query($con,$getdetails1);
							  while($row1=mysqli_fetch_assoc($result1)){
                              ?>
				                	<tr>
				                  	<td><?php echo $row1['authorize_name'];?></td>
				                  	<td><?php echo $row1['employee_id'];?></td>
				                  	<td><?php echo $row1['auth_contactno'];?></td>
				                  	<td><?php echo $row1['auth_email'];?></td>
				                   </tr>
						    <?php } ?>
				            </tbody>
	                    </table>
            </div>
						<h4>Business Details</h4>
                        <div class="table-responsive">
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th>Business Type</th>
				               	</tr>
				            </thead>
				            <tbody>
							  <?php
							  $getdetails2="select * from  nature_business where  userid='$userid'";
							  $result2=mysqli_query($con,$getdetails2);
							  while($row2=mysqli_fetch_assoc($result2)){
                              ?>
				               	<tr>
				                  	<td><?php echo $row2['activity_type'];?></td>
				                </tr>
								<?php } ?>
				            </tbody>
	                    </table> 
	  		           </div>
						
						<h4>Partner Details</h4>
                        <div class="table-responsive">
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th>Partner Name</th>
				                  	<th>Partner Designation</th>
				                  	<th>Partner Address</th>
				               	</tr>
				            </thead>
				            <tbody>
							  <?php
							  $getdetails3="select * from  partner_details where  userid='$userid' and partnerstatus='1'";
							  $result3=mysqli_query($con,$getdetails3);
							  while($row3=mysqli_fetch_assoc($result3)){
                              ?>
				               	<tr>
				                  	<td><?php echo $row3['partnername'];?></td>
				                  	<td><?php echo $row3['designation'];?></td>
				                  	<td><?php echo $row3['address'];?></td>
				                </tr>
								<?php } ?>
				            </tbody>
	                    </table> 
	  		           </div>
						
						<h4>Bank Details</h4>
                        <div class="table-responsive">
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th>Bank Name</th>
				                  	<th>Branch Name</th>
				                  	<th>Bank Account Number</th>
				               	</tr>
				            </thead>
				            <tbody>
							  <?php
							  $getdetails4="select * from user_bankaccounts where  userid='$userid' and bankstatus='1'";
							  $result4=mysqli_query($con,$getdetails4);
							  while($row4=mysqli_fetch_assoc($result4)){
                              ?>
				               	<tr>
				                  	<td><?php echo $row4['bankname'];?></td>
				                  	<td><?php echo $row['branchname'];?></td>
				                  	<td><?php echo $row4['bankaccno'];?></td>
				                </tr>
								<?php } ?>
				            </tbody>
	                    </table> 
	  		           </div>
						
						<h4>Reference Details</h4>
                        <div class="table-responsive">
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th>Company Name</th>
				                  	<th>Contact Number</th>
				               	</tr>
				            </thead>
				            <tbody>
							  <?php
							  $getdetails5="SELECT * FROM `references` where  userid='$userid' and referencestatus='1'";
							  $result5=mysqli_query($con,$getdetails5);
							  while($row5=mysqli_fetch_assoc($result5)){
                              ?>
				               	<tr>
				                  	<td><?php echo $row5['companyname'];?></td>
				                  	<td><?php echo $row5['contactperson'];?></td>
				                </tr>
								<?php } ?>
				            </tbody>
	                    </table> 
	  		           </div>
	                    <h4>Document Details</h4>
                        <div class="table-responsive">
						<table class="table tablebank table-bordered table-hover" id="table">
							  <?php
							  $getdetails6="SELECT * FROM `documents` where  userid='$userid'";
							  $result6=mysqli_query($con,$getdetails6);
							  while($row6=mysqli_fetch_assoc($result6)){
                              ?>
				               	<tr>
				                  	<td>Business Registration Number</td>
				                  	<td><a href='../signup/<?php echo $row6['regitsrtaion_no'];?>' download="Business Registration Number" title="Download Business Registration Number"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['regitsrtaion_no'];?>'  title="View Business Registration Number"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<tr>
				                  	<td>Government approved ID Number</td>
				                  	<td>
									<a href='../signup/<?php echo $row6['govt_id'];?>' download="Government approved ID Number" title="Download Government approved ID Number"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['govt_id'];?>'  title="View Government approved ID Number"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<tr>
				                  	<td>Pan Number</td>
				                  	<td>
									<a href='../signup/<?php echo $row6['pan_no'];?>' download="Pan Number" title="Download Pan Number"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['pan_no'];?>'  title="View Pan Number"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<tr>
				                  	<td>VAT Number</td>
				                  	<td>
									<a href='../signup/<?php echo $row6['vat_no'];?>' download="VAT Number" title="Download VAT Number"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['vat_no'];?>'  title="View VAT Number"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<tr>
				                  	<td>TIN Number</td>
				                  	<td>
									<a href='../signup/<?php echo $row6['tin_no'];?>' download="TIN Number" title="Download TIN Number"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['tin_no'];?>'  title="View TIN Number"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<tr>
				                  	<td>GST Number / CST Number</td>
				                  	<td>
									<a href='../signup/<?php echo $row6['cst_no'];?>' download="GST Number / CST Number" title="Download GST Number / CST Number"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['cst_no'];?>'  title="View GST Number / CST Number"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<tr>
				                  	<td>Passport</td>
				                  	<td>
									<a href='../signup/<?php echo $row6['passport'];?>' download="Passport" title="Download Passport"  class="link"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
									<a href='../signup/<?php echo $row6['passport'];?>'  title="View Passport"  class="link" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a></td>
				                </tr>
								<?php } ?>
	                    </table> 
	  		           </div>
		</div>
</div>