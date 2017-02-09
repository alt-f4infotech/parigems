<?php
include "../common/header.php";

?>
	<section class="main-section">
    <div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb" style="color: black">
			<li><a href="../common/homepage.php">Home</a></li>
			<li><a href="index.php">Bank Details</a></li>
			<li class="active">Bank Entries</li>
		</ol>
		<div class="container-fluid content">
			<h3 align="center">Bank Entries</h3>
				
				<form action="getBankdetails.php" method="post">
					<div class="row">
						<div class="col-sm-4">
							<div class="input-group" style="margin-top: 10px;">
								<!-- <label>Click on any option </label> -->
								<select id="my_select" name="selectbank" class="dropdownselect2" onchange="send_option();" >
									<option>Select Bank</option>
								
									<?php $bankname = mysqli_query($con,"SELECT * FROM bankaccounts where status=1");
									while($row = mysqli_fetch_assoc($bankname)){
										echo "<option value=".$row['id']." >". $row['bankname']."</option>";
									}
									?>
								</select>
								<span class="input-group-addon" style="padding: 1px 0">
								<button type="submit" class="btn btn-primary " style="border:0; border-top-left-radius: 0; border-bottom-left-radius: 0">Go</button>
								</span>
							</div>
						</div>
					</div>
					
				</form>
				
			<form class="form-inline">
					<input type="hidden" name="bankDetailsHomePage" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
					
		
								<div class="table-responsive">
									
									<div id="toolbar">
         <select class="form-control">
            <option value="">Export Basic</option>
            <option value="all">Export All</option>
            <option value="selected">Export Selected</option>
         </select>
      </div>	
									  <table id="table"
               data-toggle="table"
			   data-search="true"
               data-show-export="true"
               data-pagination="true"
               data-click-to-select="true"
               data-toolbar="#toolbar"
			   data-show-refresh="true"
			   data-show-toggle="true"
			   data-show-columns="true"
               data-url="../json/data1.json">
						 <thead>
							  <tr>
								<th data-field="state" data-checkbox="true" ></th>
								  <th data-field="date" data-sortable="true"  >Date</th>
								  <th data-field="party Name" data-sortable="true" >Party Name</th>
								  <th data-field="payment type" data-sortable="true">Payment Type</th>
								  <th data-field="cheque no" data-sortable="true">Cheque No.</th>
								  <th data-field="credit" data-sortable="true"  >Credit</th>
								  <th data-field="debit" data-sortable="true" >Debit</th>
								  <th data-field="balance" data-sortable="true">Balance </th>
								  <th data-field="descrption" data-sortable="true">Description</th>
								    <th data-field="modify" data-sortable="true">Modify<br>Delete Details</th>
								  <th data-field="action">Action</th>
							  </tr>
							  
						  </thead>
								
										<tbody>
											
										
										
										</tbody>
								</table>
								</div>

					
			</form>
								 </div>
			</div>
			 </div>
   <br>
   <br>
	</section>
<?php
include "../common/footer.php";
?>
	