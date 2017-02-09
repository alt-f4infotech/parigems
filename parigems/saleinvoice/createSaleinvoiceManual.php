<?php
include '../common/header.php';
?>
<section class="main-section">
  <div class="container-fluid crumb_top">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Manual Sale Invoice</li>
    </ol>
    <h2 class="text-center">Manual Sale Invoice</h2>
    <form action="insertsaleinvoiceManual.php" method="post">
  			<div class="row">
  				<div class="col-sm-4">
				 <div class="form-group">
					<label><b>Customer Name:</b></label>
                    <input type="text" name="customerName" class="form-control">
				</div>
				</div>
				<div class="col-sm-4">
				   <div class="form-group">
					<label><b>Company Name:</b></label>
                    <input type="text" name="companyName" class="form-control">
					</div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label><b>Contact Number:</b></label>
                    <input type="text" name="contactNumber" class="form-control">
				  </div>
				</div>
  			</div>
  		   <div class="row">
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>Address:</b></label>
                    <textarea name="address" class="form-control"></textarea>
				  </div>
				</div>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>Invoice Number:</b></label>
                    <input type="text" name="invoiceNumber" class="form-control">
				  </div>
				</div>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>Date:</b></label>
                    <input class="form-control datepicker" type="text" name="date" id="date" required>
				  </div>
			 </div>
  			</div>
			<div class="row">
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>PAN Number:</b></label>
                     <input type="text" name="pannumber" class="form-control">
				  </div>
				</div>
			   <div class="col-sm-4">
				  <div class="form-group">
					<label><b>CST Number:</b></label>
                     <input type="text" name="cstnumber" class="form-control">
				  </div>
				</div>
			 <div class="col-sm-4">
			      <div class="form-group">
					<label><b>VAT Number:</b></label>
                     <input type="text" name="vattinnumber" class="form-control">
				  </div>
			 </div>
  			</div><br>
        <table class="table table-bordered table-hover" id="table">
          <thead>
            <tr>
              <th><input id="check_all" class="formcontrol" type="checkbox"/></th>
              <th>Description</th>
              <th>Qty(in Carat)</th>
              <th>Rate (in $)</th>
              <th>Amount (in $)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="case" type="checkbox"/></td>
              <td><input type="text" name="description[]" id="description_1" class="form-control"></td>
			  <td><input type="text" name="carat[]" id="carat_1"  class="form-control d2" onkeypress="return IsNumeric(event);"></td>
              <td><input type="text" name="rate[]" id="rate_1" class="form-control d2" onkeypress="return IsNumeric(event);"></td>
              <td><input type="text" name="amount[]" id="amount_1" class="form-control totalgrossadd" onkeypress="return IsNumeric(event);"></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
			 <td colspan="3"></td>
			  <td><label>Subtotal (in $)</label></td>
			  <td>
                <input class="form-control" tabindex="-1" value="<?php echo sprintf("%.2f",$finaltotal);?>" type="text" name="subtotal" id="subtotal" required >
              </td>
			</tr>
			<tr>
			<td colspan="3"></td>
			  <td><label>Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="conversion" id="conversion" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();" >
              </td>
			</tr>
			<tr>
			<td colspan="3"></td>
			  <td><label>Extra Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="extraconversion" id="extraconversion" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();" >
              </td>
			</tr>
			<tr>
			 <td colspan="3"></td>
			  <td><label>Total Conversion</label></td>
			  <td>                
                <input class="form-control" type="text" name="totalconversion" id="totalconversion" readonly>
              </td>
			</tr>
			<tr>
			 <td colspan="3"></td>
			  <td>
                <label>Discount (in Rs.)</label>
			  </td>
			  <td>
                <input class="form-control"  type="text" name="discount" id="discount" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();"  >
              </td></tr>
			<tr>
			 <td colspan="3"></td>
			 <td>			   
                <label>VAT (in %)</label>
			  </td>
			 <td>			  
				 <input class="form-control" type="text" name="vat" id="vat" onkeypress="return IsNumeric(event);" onkeyup="calculateTotal();"  >
			 </td>
			</tr>
			<tr>
			 <td colspan="3"></td>
			  <td>			   
                <label>VAT Amount</label>
			  </td>
			  <td>
				 <input class="form-control" tabindex="-1" type="text" name="vatamount" id="vatamount" readonly>
              </td></tr>
			<tr>
			 <td colspan="3"></td>
			  <td><label>Roundoff</label></td>
			  <td>                
                <input class="form-control" type="text" value="<?php echo sprintf("%.2f",($finaltotal-round($finaltotal)));?>" name="roundoff" id="roundoff" readonly>
              </td>
			</tr>
			<tr>
			 <td colspan="3"></td>
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
   <script src="../js/saleinvoiceTemp.js"></script>
<?php
   include "../common/footer.php";
?>