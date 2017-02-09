<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/config.php";
   $userid=$_GET['userid'];
?>
<div class="modal-body">
			<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
      <div class="clearfix"></div>
      <br>
	<div class=""> 
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
		</div>
	</div>
</div>