<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  
  ?>
<body>
  <section class="main-section">
    <div class="container-fluid crumb_top">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">View Pending Users</li>
      </ol>
      <h3 align="center">View Pending Users</h3>
      
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
            <th data-sortable="true">User Name</th>
            <th data-sortable="true">Company Name</th>
            <th data-sortable="true">Contact Number</th>
            <th data-sortable="true">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
            $certificteqry1="select b.* from basic_details b,login l where  b.userstatus='2' and l.userid=b.userid and l.loginstatus='2'";
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
              ?>
          <td><a class="btn btn-success"  onclick="approve(<?php echo $userid;?>,'<?php echo $row['username'];?>','<?php echo $row['companyname'];?>','<?php echo $row['phoneno'];?>')" >Approve</a>
            <a class="btn btn-danger"  onclick="reject(<?php echo $userid;?>,'<?php echo $row['username'];?>','<?php echo $row['companyname'];?>','<?php echo $row['phoneno'];?>')" >Reject</a>
            <a data-toggle='tooltip' title='View' href='javascript:;' data-id='<?php echo $userid;?>' class='btn btn-primary' onclick='showAjaxModal(<?php echo $userid;?>);'>View Details</a>
          </td>
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
<script type="text/javascript" src="../js/search.js"></script>
<script>
  function approve(id,name,cname,phone) {
      bootbox.confirm("Are you sure, you want to Approve <br>Userid:"+id+"<br>Username: "+name+"<br>Companyname: "+cname+"<br>Contact Number: "+phone+" ?", function(result) {
      if (result==true) {
      bootbox.prompt({
    title: "<small>Set Limit in Rs.( eg. 100000)<br>Note: If You do not want to set limit then keep 0 only.</small>",
    value: "0",
   
    callback: function(result1) {
      if (result1 === null) {
       var limit=result1;
      } else {
       var limit=result1;
    
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
            var respo=http2.responseText;
          if (respo==1) {
            bootbox.alert("User Approved Successfully.",function(){
              window.location.reload();
            });
                  
                  }
     
          }      
      }
    
         http2.open("GET","approveuser.php?userid="+id+"&limit="+limit, true);
         http2.send(null);
         }
    }
  });
      
     
      }
         });
          }
      
      function reject(id,name,cname,phone) {
      bootbox.confirm("Are you sure, you want to Delete <br>Userid:"+id+"<br>Username: "+name+"<br>Companyname: "+cname+"<br>Contact Number: "+phone+" ?", function(result) {
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
            var respo=http2.responseText;
        
          if (respo==1) {
                  window.location.reload();
                  }
     
          }      
      }
         http2.open("GET","rejectuser.php?userid="+id, true);
         http2.send(null);
      }
         });
          }
 function showAjaxModal(uid)
        {
		 $.get('viewuserdetails.php?userid=' + uid, function(html){
                 $('#myModal .modal-body').html(html);
                 $('#myModal').modal('show', {backdrop: 'static'});
             });
		}
</script>
<div class="modal fade view_user_detail_modal" id="myModal" role="dialog" style="z-index: 10000; margin-left: -253px;">
    <div class="modal-dialog college-edit-modal-dialog">
      <!-- Modal content-->
      <div class="modal-content view_user_detail border-radius0" style="width: 850px;">
	       <div class="modal-body" style="padding: 0px;"></div>
	    </div>
	  </div>
	</div>
<?php
include "../common/footer.php";
?>