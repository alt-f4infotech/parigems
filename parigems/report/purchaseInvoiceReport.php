<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  $id=$_GET['id'];
  
  ?>
  <section class="main-section">
    <form action="purchaseInvoiceReport.php" method="post">
      <div class="container-fluid crumb_top">
      <ol class="breadcrumb" id="breadcrumb" style="color: black">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Purchase Invoice Report</li>
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
          <label>Party Name</label>
          <select id="partyid2" name="partyid" class="dropdownselect2" >
            <option value=""> Select Party</option>
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
        $from=explode('/',$_POST['fromDate']);
        $fromDate=$from[2].'-'.$from[1].'-'.$from[0];
        $fromQry="and n.date between '$fromDate' and  '$today'";
       }
       else{
      $fromQry= "";    
       }
      if ($_POST['toDate']!="" && $_POST['fromDate']=="") {
       $to=explode('/',$_POST['toDate']);
        $toDate=$to[2].'-'.$to[1].'-'.$to[0];
         $toQry="and n.date between '$startdate' and  '$toDate'";
       }
       else{
        $toQry = "";
        }
        if ($_POST['toDate']!="" && $_POST['fromDate']!="") {
       $from=explode('/',$_POST['fromDate']);
        $fromDate=$from[2].'-'.$from[1].'-'.$from[0];
       
       $to=explode('/',$_POST['toDate']);
        $toDate=$to[2].'-'.$to[1].'-'.$to[0];
         $both="and n.date between '$fromDate' and  '$toDate'";
       }
       else{
        $both = "";
        }
        
        if ($_POST['partyid']!="") {
       $custname = $_POST['partyid'];
         $userqry="and p.partyid='$custname'";
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
       $amount = sprintf("%.2f",intval($_POST['amount']));
       $option = $_POST['option'];
       if($option=='less')
       {
         $subtotal="and n.total < '$amount'";
       }
       else if($option=='grt')
       {
         $subtotal="and n.total > '$amount'";
       }
       else
       {
      $subtotal="and n.total = '$amount'";
       }
       }
       else{
        $subtotal = "";
        }
  }
      
                
      $purchaseInvoice="SELECT d.*,i.*,p.*,n.date,n.total,n.invoiceno FROM diamond_master d,purchaseinvoice_product i,purchaseinvoice n,party p where 1 $fromQry $toQry $both $userqry  $subtotal $shapeqry $colorqry $caratqry and i.diamond=d.diamond_id and p.partyid=n.partyid and  n.purchasestatus='1' and n.purchase_invoiceid=i.purchase_invoiceid group by i.purchase_invoiceid";
   //echo $purchaseInvoice;
      $result = mysqli_query($con,$purchaseInvoice);
      ?>
    <div class="">
      <div id="toolbar">
        <select class="form-control">
          <option value="">Export Basic</option>
          <option value="all">Export All</option>
          <option value="selected">Export Selected</option>
        </select>
      </div>  
      <h3 align="center">Purchase Invoice Report</h3>
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
                echo "<td class='center' style='text-align:center;'>".date('d/m/Y',strtotime($row['date']))."</td>";
                echo "<td class='number'>".sprintf("%.2f",$row['total'])."</td>";
                echo "<td><a href='../purchase/view_purchaseinvoice.php?invoiceno=".encrypt_decrypt('encrypt',$row['purchase_invoiceid'])."' class='btn btn-success'>View</a></td>";
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