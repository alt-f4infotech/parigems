<?php
  include "../common/header.php";
  //include "databaseConnection.php";
  $conn = $con;
  ?>
<head>
</head>
<?php
  $id = $_GET['id'];
  
  								
  								$result = mysqli_query($conn,"SELECT * FROM bankdetails where id=$id");
								$temp=0;$temp2=0;
  								while ($row = mysqli_fetch_assoc($result))
  								{
  									$selectedid = $id;
  
  									$date = $row['date'];
  									$partyName = $row['partyName'];
  									$credit = $row['credit'];
  									$debit = $row['debit'];
  									$transactionDescription = $row['transactionDescription'];
  									$temp=$temp+$row['credit'];
									$temp2=$temp2+$row['debit'];
									$temp3=$temp-$temp2;
  									$paymentType = $row['paymentType'];
  									$chequeNo = $row['chequeNo'];
  									$accountid = $row['accountid'];
  									
  									$result2 = mysqli_query($conn,"SELECT * FROM customer where customerid=$partyName");
  								while ($row2 = mysqli_fetch_assoc($result2))
  								{
  								$customername = $row2['customername'];	
  								}
  									
  								}
  								
  ?>
<section class="main-section">
    <div class="container-fluid">
  <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
    <li><a href="index.php">Bank Details</a></li>
    <li><a href="bankdetails.php">Bank Entries</a></li>
    <li class="active">View Bank Details</li>
  </ol>
  <fieldset class="scheduler-border" >
    <center>
      <legend class="scheduler-border">View Bank Details</legend>
    </center>
    <div class="row form-horizontal">
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">Date: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
            <?php echo date('d-m-Y',strtotime($date)); ?>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">Party Name: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
            <?php echo $partyName; ?>
          </div>
        </div>
      </div>      
      <div class='col-sm-6'>
        <div class="form-group">
          <label class="col-sm-4 control-label">Transaction Type: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
            <?php if($credit != 0)
              { echo 'Credit'; }else{ echo 'Debit';} ?>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">Amount</label>
          <div class="col-sm-8 control-label" style="text-align: left">
            <?php  if($credit != 0)
              { echo $credit; }else{ echo $debit; } ?>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">Payment Type: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
            <?php echo $paymentType;?>
          </div>
        </div>
      </div>
      <?php if($paymentType=='other'){ ?>	
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">	Transaction Id: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
          	<?php echo $chequeNo; ?>
          </div>
        </div>
      </div>
      <?php }else if($paymentType=='cheque'){ ?>
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">Cheque Number: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
          <?php echo $chequeNo; ?>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="col-sm-6">
        <div class="form-group">
          <label class="col-sm-4 control-label">Transaction Description: </label>
          <div class="col-sm-8 control-label" style="text-align: left">
          	<?php echo htmlspecialchars($transactionDescription);?>
          </div>
        </div>
      </div>
    </div>
  </fieldset>
</div>
</section>
<?php include "../common/footer.php"; ?>