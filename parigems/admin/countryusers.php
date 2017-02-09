<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  
  ?>
<body>
  <section class="main-section">
    <div class="container-fluid crumb_tp">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Modify Users Countrywise</li>
      </ol>
      <h3 align="center">Modify Users Countrywise</h3>
      
      <form id="movieForm" action="setuserdiscountcountry.php"  method="post">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <select class="countries form-control" id="countryId" name="country" required>
                <option value="">Select Country</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input type="text"  class="form-control" placeholder="Discount" id="discount" name="discount" required>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Set Discount</button>
      </form>
      <table class="table table-bordered" id="table" data-height="400"
        data-show-columns="true"
        data-toggle="table"
        data-search="true"
        data-show-export="true"
        data-pagination="true"
        data-click-to-select="true"
        data-toolbar="#toolbar"
        data-show-refresh="true"
        data-show-toggle="true"
        data-show-columns="true">
        <thead>
          <tr>
            <th data-field="state"></th>
            <th data-sortable="true">Sr.No.</th>
            <th data-sortable="true">Country</th>
            <th data-sortable="true">Discount</th>
            <th data-sortable="true">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
            $certificteqry1="select * from country_discount";
            $certiresult1=mysqli_query($con,$certificteqry1);
            while($row=mysqli_fetch_assoc($certiresult1))
            {
            $countryid=$row['countryid'];
            echo "<tr class='$class'>";
            echo '<td><input type="checkbox" name="check[]" /></td>';
              echo "<td>".$i++."</td>";
              echo "<td>".$row['countryname']."</td>";
              echo "<td>".$row['discount']."</td>";
              ?>
          <td><a class="btn btn-success"  data-toggle="modal" data-target="#myModalmail<?php echo $countryid;?>" >Edit</a></td>
          <?php
            echo "</tr>";
                                ?>
          <div class="modal fade opacity-8" id="myModalmail<?php echo $countryid;?>" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <form id="movieForm" action="setuserdiscountcountry.php"  method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Discount</h4>
                </div>
                <div class="modal-body">
                  <input type="text"  class="form-control" placeholder="Discount" id="discount" value="<?php echo $row['discount'];?>" name="discount" >
                  <input type="hidden"  value="<?php echo $row['countryname'];?>" name="country" >
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Set Discount</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
            <?php }?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
<script type="text/javascript" src="../js/search.js"></script>
<?php
include "../common/footer.php";
?>