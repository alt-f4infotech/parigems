<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  $id=$_GET['id'];
  
  ?>
  <section class="main-section">
    <form action="saleInvoiceReport.php" method="post">
      <div class="container-fluid crumb_top">
      <ol class="breadcrumb" id="breadcrumb" style="color: black">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Sale Invoice Report</li>
      </ol>
      <div class="row">
        <div class="form-group col-lg-2 col-md-6">
          <label>From</label>
          <input type="text" name="fromDate" class="form-control datepicker">
        </div>
        <div class="form-group col-lg-2 col-md-6">
          <label>To</label>
          <input type="text" name="toDate"  class="form-control datepicker">
        </div>
        <div class="form-group col-lg-2 col-md-6">
          <label>Customer Name</label>
          <select id="partyid2" name="userid" class="dropdownselect2" >
            <option value=""> Select Customer</option>
            <?php 
              $query = "SELECT
              * 
              FROM
               basic_details
              where
              userstatus=1 and usertype='USER'";
              $execute = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($execute))
              {
              echo "<option value='".$row['userid']."'>".$row['companyname']."</option>";
              }
              ?>
          </select>
        </div>
        <div class="form-group col-lg-2 col-md-6">
          <label>Diamond Shape</label>
          <select id="diamond_shape1" name="shape" class="dropdownselect2" >
            <option value=""> Select Shape </option>
            <?php 
              $query = "SELECT
              distinct(diamond_shape)
              FROM
               diamond_master
              where
              status=1";
              $execute = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($execute))
              {
              echo "<option value='".$row['diamond_shape']."'>".$row['diamond_shape']."</option>";
              }
              ?>
          </select>
        </div>
        <div class="form-group col-lg-2 col-md-6">
          <label>Diamond Color</label>
          <select id="color1" name="color" class="dropdownselect2" >
            <option value=""> Select Color </option>
            <?php 
              $query = "SELECT
              distinct(color)
              FROM
               diamond_master
              where
              status=1";
              $execute = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($execute))
              {
              echo "<option value='".$row['color']."'>".$row['color']."</option>";
              }
              ?>
          </select>
        </div>
        <div class="form-group col-lg-2 col-md-6">
          <label>Diamond Carat</label>
          <input type="text" name="carat" class="form-control">
        </div>
        <div class="form-group col-lg-2 col-md-6">
          <label>By Price</label>
          <div class="row">
            <div class="col-sm-6">
              <select class="form-control" id='option' name='option' style='color:black;'>
                <option value=''>Select Option</option>
                <option value='eq'>=</option>
                <option value='less'><</option>
                <option value='grt'>></option>
              </select>
            </div>
            <div class="col-sm-6">      
              <input type="text" data-type="customername" class="form-control custDetails" id="amount" name="amount"   placeholder="Price" onkeypress="return IsNumeric(event);" >
            </div>
          </div>
        </div>
        <div class="form-group col-lg-3 col-md-6" style="margin-top: 25px;">
          <center><button class="btn btn-success" name="go" type="submit">Go</button>
            <button class="btn btn-success"  onClick="reset();">RESET ALL</button>
          </center>
        </div>
      </div>
    </form>
    <?php
      $today= date("Y-m-d");
      $startdate= date("2016-01-01");
      if (isset($_POST['go'])) {        
      if ($_POST['fromDate']!="" && $_POST['toDate']=="") {
      $fromDate = $_POST['fromDate'];
      $from="and n.date between '$fromDate' and  '$today'";
       }
       else{
      $from= "";    
       }
      if ($_POST['toDate']!="" && $_POST['fromDate']=="") {
       $toDate = $_POST['toDate'];
         $to="and n.date between '$startdate' and  '$toDate'";
       }
       else{
        $to = "";
        }
        if ($_POST['toDate']!="" && $_POST['fromDate']!="") {
       $fromDate = $_POST['fromDate'];
       $toDate = $_POST['toDate'];
         $both="and n.date between '$fromDate' and  '$toDate'";
       }
       else{
        $both = "";
        }
        
        if ($_POST['userid']!="") {
       $custname = $_POST['userid'];
         $userqry="and n.userid='$custname'";
       }
       else{
        $userqry = "";
        }
      
      if ($_POST['shape']!="") {
       $shape = $_POST['shape'];
         $shapeqry="and d.diamond_shape='$shape'";
       }
       else{
        $shapeqry = "";
        }
        
        if ($_POST['color']!="") {
       $color = $_POST['color'];
         $colorqry="and d.color='$color'";
       }
       else{
        $colorqry = "";
        }
        
         if ($_POST['carat']!="") {
       $carat = $_POST['carat'];
         $caratqry="and d.weight='$carat'";
       }
       else{
        $caratqry = "";
        }
        
         if ($_POST['amount']!="") {
       $amount = intval(sprintf("%.2f",$_POST['amount']));
       $option = $_POST['option'];
       if($option=='less')
       {
         $subtotal="and n.finalTotal < '$amount'";
       }
       else if($option=='grt')
       {
         $subtotal="and n.finalTotal > '$amount'";
       }
       else
       {
      $subtotal="and n.finalTotal = '$amount'";
       }
       }
       else{
        $subtotal = "";
        }
  }
      
                
      $saleInvoice="SELECT d.*,i.*,l.*,n.date,n.finalTotal FROM diamond_master d,saleinvoice_product i,saleinvoice n,basic_details l where 1 $from $to $both $userqry  $subtotal $shapeqry $colorqry $caratqry and i.diamondid=d.diamond_id and l.userid=n.userid and  n.status='1' and n.invoiceno=i.invoiceno group by i.invoiceno";
     
      $result = mysqli_query($con,$saleInvoice);
      ?>
    <div class="">
      <div id="toolbar">
        <select class="form-control">
          <option value="">Export Basic</option>
          <option value="all">Export All</option>
          <option value="selected">Export Selected</option>
        </select>
      </div>  
      <h3 align="center">Sale Invoice Report</h3>
      <table class="table table-striped" id="table"
        data-height="400"
        data-show-columns="true"
        data-toggle="table"
        data-search="true"
        data-show-export="true"
        data-pagination="true"
        data-click-to-select="true"
        data-toolbar="#toolbar"
        data-show-refresh="true"
        data-show-toggle="true"
        data-show-columns="true"
        >
        <thead>
          <tr>
            <th data-field="state" data-checkbox="true" ></th>
            <th data-field="srno" data-sortable="true">Invoice Number</th>
            <th data-field="productname" data-sortable="true"  >Customer Name</th>
            <th data-field="date" data-sortable="true"  >Invoice Date</th>
            <th data-field="Amount" data-sortable="true"  >Amount</th>
            <th data-field="action" data-sortable="true"  >Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
             while($row=mysqli_fetch_assoc($result))
             {
              $user=$row['userid'];
              $diamondid=$row['diamondid'];
                 echo "<tr>";
                echo "<td class='center' style='text-align:center;'></td>";
                echo "<td class='number'>".$row['invoiceno']."</td>";                    
                echo "<td class='center' style='text-align:center;'>".$row['companyname']."</td>";
                echo "<td class='center' style='text-align:center;'>".$row['date']."</td>";
                echo "<td class='number'>".sprintf("%.2f",$row['finalTotal'])."</td>";
                echo "<td><a href='../saleinvoice/view_sale_invoice.php?id=".encrypt_decrypt('encrypt',$row['invoiceno'])."' class='btn btn-success'>View</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
      </table>
    </div>
</section>
<?php
  include "../common/footer.php";
  ?>