<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/config.php";
   $partyid=$_GET['partyid'];
   $getdetails1="select * from party where partystatus=1 and partyid='$partyid'";
   $result1=mysqli_query($con,$getdetails1);
   $row1=mysqli_fetch_assoc($result1);
?>
<div class="modal-body">
			<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
      <div class="clearfix"></div>
      <br>
	<div class=""> 
	   <h3 class="text-left">View Bank Details</h3>
	   <hr>
		<div class="tab-content">
            <h4>Bank Details</h4>
	  		<div class="table-responsive">
	                    <table class="table table1 table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th></th>
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
				                	<td><?php echo $i;?></td>
				                  	<td><?php echo $row2['bankname'];?></td>
									<td><?php echo $row2['bankaddr'];?></td>
				                  	<td><?php echo $row2['branch'];?></td>
				                  	<td><?php echo $row2['bank_ifccode'];?></td>
				                  	<td><?php echo $row2['swiftcode'];?></td>
				                  	<td><?php echo $row2['account_number'];?></td>
									<td><?php echo $row2['benificiary'];?></td>
				                  	<td><?php echo $row2['accdescription'];?></td>
				                  	<td><?php echo $row2['country'];?></td>
				                   </tr>
						    <?php $i++;} ?>
				            </tbody>
	                    </table>
            </div>
						<h4>Intermediary Details</h4>
                        <div class="table-responsive">
						<table class="table tablebank table-bordered table-hover" id="table">
				            <thead>
				               	<tr>
				                  	<th></th>
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
				                	<td><?php echo $j;?></td>
				                  	<td><?php echo $row3['bankname2'];?></td>
				                  	<td><?php echo $row3['swiftcode2'];?></td>
				                </tr>
								<?php $j++;} ?>
				            </tbody>
	                    </table>
		  				
	  		</div>
		</div>
	</div>
</div>