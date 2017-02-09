<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";;
 
?>

<section class="main-section">
  <div class="container-fluid crumb_top">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Purchase Entry(Without VAT)</li>
    </ol>
    <h2 class="text-center">Purchase Entry</h2>
    <form id="" action="insertpurchase.php" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="ptype" value="wvat">
  		<fieldset>
  			<div class="row">
  				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="partyid" class="col-sm-12">Select Party</label>
			  <div id="partyidDiv">
  			  		<select name="partyid" id="partyid" onchange="getpartycode();" class="dropdownselect2" required>
                <option value="">Select Party</option>
                <?php
                  $getpartyid="select * from party where partystatus='1'";
                  $partyres=mysqli_query($con,$getpartyid);
                  while($p=mysqli_fetch_assoc($partyres)){
                    echo '<option value="'.$p['partyid'].'">'.$p['companyname'].'</option>';
                  }
                ?>
              </select>
					</div>
  					</div>
  	    	</div>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="partyid" class="col-sm-12">Select Party Code</label>
			  <div id="partycodeDiv">
  			  		<select id="partycode" onchange="getpartyname();" class="dropdownselect2" required>
                <option value="">Select Party Code</option>
                <?php
                  $getpartyid="select * from party where partystatus='1'";
                  $partyres=mysqli_query($con,$getpartyid);
                  while($p=mysqli_fetch_assoc($partyres)){
                    echo '<option value="'.$p['partyid'].'">'.$p['referenceno'].'</option>';
                  }
                ?>
              </select>
			  </div>
  					</div>
  	    	</div>
  	    	<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="locationid" class="col-sm-12">Select Location</label>
  			  		<select name="locationid" id="locationid" class="dropdownselect2" required>
                <option value="">Select Location</option>
                <?php
                  $getlocationid="select * from location_master where locationstatus='1'";
                  $locationres=mysqli_query($con,$getlocationid);
                  while($loc=mysqli_fetch_assoc($locationres)){
                    echo '<option value="'.$loc['locationid'].'">'.$loc['locationname'].'</option>';
                  }
                ?>
              </select>			  						
  					</div>
  	    	</div>
			
  			</div>
  		  <div class="row">
          <div class="col-sm-4">
            <div class=" form-group">
              <label for="date">Date</label>
              <input class="form-control datepicker" type="text" name="date" id="date" required>
            </div>
          </div>
  				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Purchase Invoice Number</label>
  			  		<input class="form-control" onkeyup="checkinvoice();" type="text" name="invoiceno" id="invoiceno" required>
  			  	</div>
				<div id="checkinvoice" style="display: none" class="alert alert-danger">
   <strong>Error!</strong> Invoice Number already exists for this Party.
</div>
				<div id="checkparty" style="display: none" class="alert alert-danger">
   <strong>Error!</strong> Select Party
</div>	
  	    	</div>
				<!--<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Stock Id</label>
  			  		<input class="form-control" type="text" name="stockid" id="stockid" >
  			  	</div>
  	    	</div>-->
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Terms</label>
  			  		<input class="form-control" type="text" name="terms" id="terms" >
  			  	</div>
  	    	</div>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Due Date</label>
  			  		<input class="form-control datepicker" type="text" name="duedate" id="duedate" onchange="getreminderdate();">
  			  	</div>
  	    	</div>
				<div class="col-sm-4">
  	    		<div class=" form-group">
              <label for="invoiceno">Reminder Date</label>
  			  		<input class="form-control" type="text" name="reminderdate" id="reminderdate" readonly>
  			  	</div>
  	    	</div>
          <!--<div class="col-sm-4">
  	    		<div class=" form-group">
              <label>Is This Invoice</label><br>
              <label class="font-normal">
  			  		  <input type="checkbox" name="hform" id="hform" value="hform" >
  			  			&nbsp;HFORM
              </label>
  			  	</div>
  	    	</div>-->
  			</div>
        <table class="table table-bordered table-hover" id="table">
          <thead>
            <tr>
              <th><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th>Certificate Number</th>
              <th>Certificate Type</th>
              <th>Carat</th>
              <th>Description</th>
              <th>Pcs</th>
              <th>Qty(in Carat)</th>
              <th>Rate</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="case" type="checkbox"/></td>
              <td>
                <a data-toggle="tooltip"  href="javascript:;" data-id="1" onclick="showAjaxModal(1);">
                  <input type="hidden" name="certi[]" id="certi_1">
				  <input type="text" id="certino_1" class="form-control" required readonly placeholder="Click to Select Certificate">
                </a>
              </td>
              <td>
                <input type="text" name="certitype[]" id="certitype_1" class="form-control" required readonly>
              </td>
			  <td>
                <input type="text" name="caret[]" id="caret_1" class="form-control" readonly>
              </td>
              <td>
                <input type="text" name="description[]" id="description_1" class="form-control" required>
              </td>
              <td>  
                <input type="text" value="1" name="pcs[]" id="pcs_1" class="form-control"  onkeypress="return IsNumeric(event);" readonly>
              </td>
              <td>
                <input type="text" name="qty[]" id="qty_1" class="form-control d2"  onkeypress="return IsNumeric(event);" >
              </td>
              <td>
                <input type="text" name="rate[]" id="rate_1" class="form-control d2"   onkeypress="return IsNumeric(event);" >
              </td>
              <td>
                <input type="text" name="amount[]" id="amountt_1" class="form-control  totalgrossadd" readonly>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"></td>
              <td>
                <input class="form-control" type="hidden" name="vat" id="vat" value="0">
                <label for="discount">Discount</label>
                <input class="form-control d2" type="text" name="discount" id="discount" >                
              </td>
              <td>
                <label>Total Amount</label>
                <input class="form-control" type="text" name="total" id="total" required readonly>
              </td>
            </tr>
          </tfoot>
        </table>
        <div class='row'>
          <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
            <div class="form-group">
              <button class="btn btn-danger delete"   type="button">- Delete</button>
              <button class="btn btn-success addmore"  type="button">+ Add More</button>
            </div>
  	      </div>
  	    </div>
		<div class='row'>
          <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
            <div class="form-group">
			   <label>Notes:</label>
              <textarea class="form-control" name="notes" rows="5"></textarea>
            </div>
  	      </div>
  	    </div>
  			<center>
          <button type="submit" class="action-button">Submit</button>
        </center>
  		</fieldset>
  	</form>
  </div>
</section>

<div class="modal fade" id="certimodal" role="dialog" style="z-index: 10000;">
    		<div class="modal-dialog" style="width: 80%;">
      			<!-- Modal content-->
      			<div class="modal-content border-radius0">
	   				<div class="modal-body" style="padding: 0px;">
	   				</div>
	  			</div>
	  		</div>
	</div>
<?php
   include "../common/footer.php";
?>
<script src="../js/purchasewithouvat.js"></script>