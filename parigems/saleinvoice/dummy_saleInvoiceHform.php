<?php
include '../common/header.php';
?>
   <section class="main-section">
  <div class="container-fluid">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Dummy Sale Invoice H-Form</li>
    </ol>
    <h2 class="text-center">Dummy Sale Invoice H-Form</h2>
    <form action="insertDummySaleinvoiceHform.php" method="post">
	  <input type="hidden" name="invoiceType" value="HForm">
  			<div class="row">
  				<div class="col-sm-4">
				 <div class="form-group">
					<label><b>Customer Name:</b></label><input type="text" name="customerName" class="form-control customerName" id="username" data-type="username" required>
				</div>
				</div>
				<div class="col-sm-4">
				   <div class="form-group">
					<label><b>Company Name:</b></label><input type="text" name="companyName" class="form-control customerName" id="companyName" data-type="companyname" >
					</div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label><b>Contact Number:</b></label><input type="text" name="contactNumber" class="form-control customerName" id="phoneno" data-type="phoneno" required>
				  </div>
				</div>
  			</div>
  		   <div class="row">
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>Address:</b></label><input type="text" name="address" class="form-control" id="address">
				  </div>
				</div>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>CST Number:</b></label><input type="text" name="cstnumber" class="form-control" id="cstnumber">
				  </div>
				</div>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>VAT TIN Number:</b></label><input type="text" name="vattinnumber" class="form-control" id="vattinnumber">
				  </div>
				</div>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>PAN Number:</b></label><input type="text" name="pannumber" class="form-control" id="pannumber">
				  </div>
				</div>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>Date:</b></label><input class="form-control datepicker" type="text" name="date" id="date" required>
				  </div>
			 </div>
  			</div><br>
       
	   <div class="row">
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Exporters Reference Number</b></label><input type="text" name="exporters_reference" class="form-control">
				  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Buyers & Order No. & Date</b></label><input type="text" name="buyer_order" class="form-control">
				  </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-12">
			  <div class="form-group">
					<label><b>Other Reference(s)</b></label><textarea class="form-control" name="other_reference"></textarea>
				  </div>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Consignee</b></label><textarea class="form-control" name="consignee"></textarea>
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
					<label><b>Buyer (Other than Consignee)</b></label><textarea class="form-control" name="other_consignee"></textarea>
			  </div>
			</div>
		  </div>
		</div>
	   </div>
	   <div class="row">
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Pre Carriage By</b></label><input type="text" name="pre_carriage_by" class="form-control"></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Place Of receipt By Precarrier</b></label><input type="text" name="place_of_receipt" class="form-control"></div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Vessel/Flight No.</b></label><input type="text" name="flight_no" class="form-control"></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Port Of Loading</b></label><input type="text" name="port_of_loading" class="form-control"></div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Port Of Discharge</b></label><input type="text" name="port_of_discharge" class="form-control"></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Final Destination</b></label><input type="text" name="final_destination" class="form-control"></div>
			</div>
		  </div>
		</div>
		<div class="col-sm-6">
		  <div class="row">
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Country Of Origin Of Goods</b></label><input type="text" class="form-control" name="country_of_origin_goods"></div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group"><label><b>Country Of Final Destination</b></label><input type="text" class="form-control" name="country_of_final_destination"></div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-12">
			  <div class="form-group"><label><b>Terms Of Delivery & Payment</b></label><textarea class="form-control" name="terms_of_delivery_payment"></textarea></div>
			</div>
		  </div>
		</div>
	   </div>
	    <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th>Certificate Number</th>
              <th>Certificate Type</th>
              <th>Description</th>
              <th>Qty(in Carat)</th>
              <th>Rate (in $)</th>
              <th>Amount (in $)</th>
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
              <td><input type="text" name="certitype[]" id="certitype_1" class="form-control" required readonly></td>
              <td><input type="text" name="description[]" id="description_1" class="form-control"></td>
			  <td><input type="text" name="carat[]" id="carat_1" class="form-control"  onkeypress="return IsNumeric(event);"></td>
              <td><input type="text" name="rate[]" id="rate_1" class="form-control eachAmount"  onkeypress="return IsNumeric(event);"></td>
              <td><input type="text" name="amount[]" id="amount_1" class="form-control totalgrossadd"  onkeypress="return IsNumeric(event);"></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
			 <td colspan="5"></td>
			  <td><label>Subtotal (in $)</label></td>
			  <td>
                <input class="form-control" tabindex="-1" type="text" name="subtotal" id="subtotal" required readonly>
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td>
                <label>Discount (in Rs.)</label>
			  </td>
			  <td>
                <input class="form-control"  type="text" name="discount" id="discount" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();"  >
				<input type="hidden" name="vat" id="vat" value="0"><input type="hidden" name="vatamount" id="vatamount" value="0">
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="conversion" id="conversion" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();" >
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Extra Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="extraconversion" id="extraconversion" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();" >
              </td>
			</tr>
			<tr>
			 <td colspan="5"></td>
			  <td><label>Total Amount (in Rs.)</label></td>
              <td>
                <input class="form-control" tabindex="-1" value="<?php echo sprintf("%.2f",round($finaltotal));?>" type="text" name="total" id="total" required readonly>
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
          <div class='col-sm-6'>
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
    		<div class="modal-dialog"  style="width: 80%;">
      			<!-- Modal content-->
      			<div class="modal-content border-radius0">
	   				<div class="modal-body" style="padding: 0px;">
	   				</div>
	  			</div>
	  		</div>
	</div>
   <script src="../js/dummy_saleinvoice.js"></script>