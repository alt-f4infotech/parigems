<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   
?>
<section class="main-section">
   <div class="container crumb_top"> 
      <ol class="breadcrumb" id="breadcrumb" style="color: black">
         <li><a href="../common/homepage.php">Home</a></li>
         <li class="active">Add Location</li>
      </ol>
      <h3 class="text-left">Add Location</h3>
      <hr>
   	<div class="tab-content">
     		<div id="indian-registered-companies" class="tab-pane fade in active">
   			<form id="" action="insertlocation.php" method="post" enctype="multipart/form-data">
   	  			<fieldset>
                  <table class="table tablel table-bordered table-hover" id="table">
                     <thead>
                        <tr>
                           <th><input id="check_all" class="formcontrol" type="checkbox"/></th>
                           <th>Location Name</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td><input class="case" type="checkbox"/></td>
                           <td><input type="text" name="locationname[]" id="locationname_1" class="form-control location" required>
						   <div class="alert alert-danger" id="danger-alert_1" style="display: none;">
									<strong>Error!</strong> Location Already Exists
								  </div></td>
                           <tr>
                     </tbody>
                  </table>
                  <div class='row'>
                     <div class='col-xs-12 col-sm-6 col-md-3 col-lg-3'>
                        <div class="form-group">                        
                           <button class="btn btn-danger deletel" type="button">- Delete</button>
                           <button class="btn btn-success addmorel" type="button">+ Add More</button>
                        </div>
   	               </div>
   	            </div>
   			    	<center>
                     <button type="submit" class="action-button" id="submit">Submit</button>
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
<script src="../js/locationpurchase.js"></script>