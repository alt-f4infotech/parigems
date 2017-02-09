<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/header.php";
   date_default_timezone_set('Asia/Kolkata');
   
   $cash="select
      sum(amount) as amount 
   from
      angadia_kitty 
   where
     txntype='CREDIT' and  status=1";
   									$cashResult1 = mysqli_query($con,$cash);
   									 while($row=mysqli_fetch_assoc($cashResult1))
   									{
   										$amount=$row['amount'];	
   									}
   									 
   									 $debitcash="select
      sum(amount) as amount 
   from
      angadia_kitty 
   where
     txntype='DEBIT' and  status=1";
   									$debitcashResult1 = mysqli_query($con,$debitcash);
   									 while($row2=mysqli_fetch_assoc($debitcashResult1))
   									{
   										$remainamount=$row2['amount'];	
   									 }
   									$cash = $amount-$remainamount;
    
   
   ?>
<section class="main-section">
   <div class="container">
   <br>
   <ol class="breadcrumb"  id="breadcrumb" style="color: black">
      <li><a href="../angadia/index.php">Home</a></li>
      <li><a href="view_angadia_voucher.php">Angadia Transactions Details</a></li>
      <li class="active">Add Expense Entry</li>
   </ol>
   <form action="insertexpense.php" method="post">
      <fieldset class="scheduler-border" >
         <center><legend class="scheduler-border">Add Expense Entry</legend></center>
         <div class="row">
            <!--<div class="col-xs-4">
               <label>Current Cash in Hand :</label>
               <input type="text" class="form-control" value=" <?php echo $cash;?>" disabled>
            </div>-->
            <div class="col-xs-4">
               <br>
              <a data-toggle='modal' data-target='#myModal1' class='btn btn-info'> Add Angadia Account </a>
            </div>
         </div>
        <div class="row">
         <div class="col-xs-12 col-sm-4 margin30" >
            <label>Date : </label>
            <input type="text" name="date" class="form-control datepicker" value="<?php echo date("d/m/Y");  ?>">										
         </div>
         <div class="col-xs-12 col-sm-4 margin30" >
            <label>Angadia Account: </label>
            <select name="accountid" id="category" class="dropdownselect2"  required>
               <option value="">Select Account</option>
               <?php 
                  $query = "SELECT * from angadia_account where status='1'";
                  $execute = mysqli_query($dbh,$query);
                  while ($row = mysqli_fetch_array($execute)) {
                   echo "<option value='".$row['id']."'>".$row['accountname']."</option>";
                     }
                  ?>
            </select>					
         </div>
		 <div class="col-xs-12 col-sm-4 margin30" >
			<label class="radio-inline">
				<input type="radio" name="party" onclick="document.getElementById('partydiv').style.opacity='0.3';document.getElementById('partydiv').style.pointerEvents = 'none';document.getElementById('otherdiv').style.opacity='1';document.getElementById('otherdiv').style.pointerEvents = 'auto';$('#partyName').val('');"  required>Dummy Party 
			</label>
			<label class="radio-inline">
				<input type="radio"  name="party" onclick="document.getElementById('partydiv').style.opacity='1';document.getElementById('partydiv').style.pointerEvents = 'auto';document.getElementById('otherdiv').style.opacity='0.3';document.getElementById('otherdiv').style.pointerEvents = 'none';$('#dummyparty').val('');" required>Party 
			</label>							
         </div>
		 </div>
		<div class="row">
          <div class="col-xs-12 col-sm-4 margin30" id="partydiv">
            <label>Party:</label>
            <select tabindex="1" name="partyName"  id="partyName" class="dropdownselect2" onchange="getpartyinvoices();">
                     <option value=""> Select Party </option>
                     <?php 
                        $query = "SELECT
                        * 
                        FROM
                        party
                        where
                       partystatus=1";
                        $execute = mysqli_query($con,$query);
                        while ($row = mysqli_fetch_array($execute))
                        {
                        echo "<option value='".$row['partyid']."'>".$row['companyname']."</option>";
                        }
                        ?>
                  </select>
         </div>
		  
		  <div class="col-xs-12 col-sm-4 margin30" id="otherdiv">
            <label>Dummy Party:</label>
            <input type="text" name="dummyparty" class="form-control dummypartyajax" data-type="partyname" id="dummyparty">
         </div>
        
         <div class="col-xs-12 col-sm-12 col-md-4 margin30" id="invoicediv">
         <label>Invoice List:</label>
 <select name="invoiceno" class="form-control">
   <option value="">Select Invoice</option>
 </select>
         </div>
        </div>
		<div class="row">
         <div class="col-xs-12 col-sm-12 col-md-4 margin30">
            <label>Amount : </label>
            <input type="number" name="amount" onkeypress="return IsNumeric(event);" class="form-control" required="true">
         </div>
         <div class="col-xs-12 col-sm-12 col-md-4 margin30" >
            <label>Transaction Description : </label>
            <textarea class="form-control" rows="5" name="transactionDescription" required="true"></textarea>
         </div>
		 <div class="col-xs-12 col-sm-4 margin30" >
            <label>Name: </label><input type="text" name="name" class="form-control">
         </div>
        </div>
         <div class="col-xs-12">
            <button name="addEntry" type="submit" class="btn btn-primary entry_btn_responsive">ADD ENTRY</button>
         </div>
      </fieldset>
   </form>
</div>
</section>
<div class="modal fade" id="myModal1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
           <form method="post" action="insertangadia_account.php" class="form-horizontal">
	
<center> <legend class="scheduler-border">Add Angadia Account</legend></center>
		
		<div class="row" style="margin-top:5%">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control " id="accountname" name="accountname" tabindex="1" placeholder="Account Name"  required >
					</div>
				</div>
            </div>
            <!--<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Account Number</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" onkeypress="return IsNumeric(event);"  name="accnumber" id="accnumber" tabindex="5" placeholder="Account Number"  required>
					</div>
				</div>
			</div>-->
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Starting Balance</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" name="startingbalance"  onkeypress="return IsNumeric(event);"  id="startingbalance" tabindex="7" placeholder="Starting Balance" required>
					</div>
				</div>
			</div>
		</div>
        <div class="row" style="margin-top:5%">
			
            <div class="col-sm-12">
				<div class="form-group">
					<label class="col-sm-4 control-label">Description</label>
					<div class="col-sm-8">
						<textarea class="form-control" name="description" rows="3"></textarea>
					</div>
				</div>
			</div>
		</div>			
		
		<div class="text-center">
			<button type="submit" class="btn btn-primary" value="Submit">Add Account</button>
			<button type="reset" class="btn btn-success" value="Reset">Reset</button>
		</div>
	
	</form>
         </div>
      </div>
   </div>
</div>
<script>
   function getpartyinvoices() {
    var partyName=document.getElementById('partyName').value;
  if (window.XMLHttpRequest)
   	{// code for IE7+, Firefox, Chrome, Opera, Safari
    http2=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
    http2=new ActiveXObject("Microsoft.XMLHTTP");
   }
   http2.onreadystatechange=function()
   {
   
   if (http2.readyState==4 )
   		 {
   				var respoo=http2.responseText;
                document.getElementById('invoicediv').innerHTML=respoo;
                }
   			}
			
		http2.open("GET","getpartyinvoices.php?partyid="+partyName, true);
   		 http2.send(null);
   }
   
   //ajax call for Party details
$(document).on('focus','.dummypartyajax',function(){
	type = $(this).data('type');
	
	if(type =='partyname' )autoTypeNo=2;
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'dummypartyajaxdebit.php',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {
                   
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");
			$('#dummyparty').val(names[2]);
		}		      	
	});

});
</script>
<?php
  
   include "../common/footer.php";
   
   ?>