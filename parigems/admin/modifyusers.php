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
        <li class="active">Modify Users</li>
      </ol>
      <h3 align="center">Modify Users</h3>
      <div id="toolbar">
        <select class="form-control">
          <option value="">Export Basic</option>
          <option value="all">Export All</option>
          <option value="selected">Export Selected</option>
        </select>
      </div>
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
            <th data-sortable="true">Name</th>
            <th data-sortable="true">Company Name</th>
            <th data-sortable="true">Contact Number</th>
            <th data-sortable="true">Discount</th>
            <th data-sortable="true">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
            $certificteqry1="select b.* from basic_details b,login l where  b.userstatus='1' and l.userid=b.userid and l.loginstatus='1' and b.usertype='USER'";
            //echo $certificteqry1;
            $certiresult1=mysqli_query($con,$certificteqry1);
            while($row=mysqli_fetch_assoc($certiresult1))
            {
            $userid=$row['userid'];
            
            echo "<tr class='$class'>";
            echo '<td><input type="checkbox" name="check[]" id="'.$userid.'" value="'.$userid.'"/></td>';
              echo "<td>".$i++."</td>";
              echo "<td>".$row['username']."</td>";
              echo "<td>".$row['companyname']."</td>";
              echo "<td>".$row['phoneno']."</td>";
              echo "<td>".$row['userdiscount']."</td>";
              ?>
          <td><a class="btn btn-success"  data-toggle="modal" data-target="#myModalmail<?php echo $userid;?>" >Set Discount</a></td>
          <?php
            echo "</tr>";
                                                        
                              ?>
          <div class="modal fade opacity-8" id="myModalmail<?php echo $userid;?>" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <form id="movieForm" action="setuserdiscount.php"  method="post">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Discount</h4>
                  </div>
                  <div class="modal-body">
                    <input type="text"  class="form-control" placeholder="Discount" id="discount" value="<?php echo $row['userdiscount'];?>" name="discount" >
                    <input type="hidden"  value="<?php echo $userid;?>" name="userid" >
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
      </div>
    </div>
  </section>
</body>
</html>
<script type="text/javascript" src="../js/search.js"></script>
<?php
include "../common/footer.php";
?>