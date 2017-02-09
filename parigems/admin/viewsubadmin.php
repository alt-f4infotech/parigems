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
        <li class="active">View All Sub-Admin</li>
      </ol>
      <div id="toolbar">
          <select class="form-control">
            <option value="">Export Basic</option>
            <option value="all">Export All</option>
            <option value="selected">Export Selected</option>
          </select>
        </div>
      <h3 align="center">View All Sub-Admin</h3>
      <table class="table table-bordered" id="table" data-height="400" data-show-columns="false"
        data-toggle="table" data-search="false" data-show-export="false" data-pagination="true"
        data-click-to-select="false" data-toolbar="#toolbar" data-show-refresh="false" data-show-toggle="false" data-show-columns="true">
        <thead>
          <tr>
            <th data-field="state" data-checkbox="true" ></th>
            <th data-sortable="true">Sr.No.</th>
            <th data-sortable="true">Username</th>
            <th data-sortable="true">Contact Number</th>
            <th data-sortable="true">Email Id</th>
            <?php if($role=='SUPERADMIN'){ ?>
              <th data-sortable="true">Added By</th>
            <?php } ?>
            <!--<th data-sortable="true">Action</th>-->
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
            $certificteqry1="select * from basic_details where userstatus='1' and usertype='SUBADMIN'";
            $certiresult1=mysqli_query($con,$certificteqry1);
            while($row=mysqli_fetch_assoc($certiresult1))
            {
            
            echo "<tr>";
            ?>
          <td></td>
          <?php
            echo "<td>".$i++."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['phoneno']."</td>";
            echo "<td>".$row['emailid']."</td>";
            if($role=='SUPERADMIN'){
              $getempname=mysqli_query($con,"select username from basic_details where userid=".$row['approved_by']);
              $empname=mysqli_fetch_assoc($getempname);
            echo "<td>".$empname['username']."</td>";
            }
            ?>
          <!--<td></td>-->
          <?php
            echo "</tr>";
            }                           
            ?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
<script>
  function showAjaxModal(uid)
         {
    $.get('../search/viewcertificate.php?certi_id=' + uid, function(html){
                  $('#myModal .modal-body').html(html);
                  $('#myModal').modal('show', {backdrop: 'static'});
              });
   }
   function unhold(i)
  {
   bootbox.confirm("Are you sure?", function(result) {
   if (result==true) {
      
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
                if (respoo==1)
                {
                  bootbox.alert("Diamond has been released.",function(){
                  window.location.reload();
        });
                }
                }
        }      
         var res="&did="+i;
       http2.open("GET","unhold.php?res="+res, true);
       http2.send(null);
   }
   });
  }
</script>
<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
  <div class="modal-dialog">
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