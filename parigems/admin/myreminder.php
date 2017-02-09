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
        <li class="active">My Reminder</li>
      </ol>
      <form id="movieForm" action="insertmynotification.php"  method="post">
        <div class="row">
          <div class="col-sm-6">
            <label>Message</label>
                <textarea id="message" class="form-control" name="message" required></textarea>
          </div>
          <div class="col-sm-6">
            <label>Reminder Date & Time</label>
                <div class="row">
				  <div class="col-sm-3"><input class="form-control datepicker" type="text" name="date" id="date" required></div>
				  <div class="col-sm-3"><input class="form-control" type="time" name="time"></div>
				</div>
          </div>
        </div><br>
        <div class="row">
          <center><button type="submit" class="btn btn-success">Submit</button></center>
        </div>
      </form>
		</div>
   
   <div id="add" class="tab-pane fade">
	
        <table class="table table-bordered" id="table" data-height="400" data-show-columns="true"
          data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
          data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true"
          data-show-toggle="true" data-show-columns="true">
          <thead>
            <tr>
              <th data-field="state"></th>
              <th data-sortable="true">Sr.No.</th>
              <th data-sortable="true">Message</th>
              <th data-sortable="true">Created At</th>
              <th data-sortable="true">Created By</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i=1;
              $certificteqry1="select n.*,l.username from  notification n,login l where  l.userid=n.userid and n.status='1'";
              $certiresult1=mysqli_query($con,$certificteqry1);
              while($row=mysqli_fetch_assoc($certiresult1))
              {
                $id=$row['id'];
                echo "<tr>";
                echo '<td></td>';
                echo "<td>".$i++."</td>";
                echo "<td>".$row['message']."</td>";
                echo "<td>".date('d-m-Y',strtotime($row['entrydate']))."</td>";
                echo "<td>".$row['username']."</td>";
             ?>
            <?php
              echo "</tr>";
			}                           
			?>
          </tbody>
        </table>
   </div>
    </div>
	  
  </section>
</body>
</html>
<script type="text/javascript" src="../js/search.js"></script>
<script>
  $( document ).ready(function() {
     $('#myModal').on('hidden.bs.modal', function () {
           $(this).removeData('bs.modal');
     });
  });
  function atleast_onecheckbox1() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Atleast One User");
  return false;
  }
  else
  {
  document.getElementById('button').click();
  
  }
  }
  
  function atleast_onecheckbox() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Atleast One User");
  return false;
  }
  else
  {
  var subject=document.getElementById('subject').value;
  var message=document.getElementsByName('message');
  if (subject=='')
  {
  bootbox.alert("Please Add Subject");
    return false;
    
   }
  if (message=='')
  {
  
  bootbox.alert("Please Add Messege");
     return false;
   }
  else
  {
  return true;
  }
  }
  }
  
  function check_all(chk)
  {
  
  var cbox=document.getElementsByName('check[]');
  var chk=document.getElementById('chk');
  if(chk.checked==true )
  {
  for (var i =0; i <cbox.length ; i++)
  {
  cbox[i].checked=true;
  }
  } 
  else if(chk.checked==false )
  {
  for (var i =0; i <cbox.length ; i++)
  {
    cbox[i].checked=false;
   
  }
  }
  }
  
  function block(i) {
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
        var respo=http2.responseText;
  
  if (respo==1) {
              window.location.reload();
              }
  
      }      
  }
     http2.open("GET","deleteuser.php?userid="+i, true);
     http2.send(null);
  }
  });
      }
  
  function unblock(i) {
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
        var respo=http2.responseText;
  
  if (respo==1) {
              window.location.reload();
              }
  
      }      
  }
     http2.open("GET","unblockuser.php?userid="+i, true);
     http2.send(null);
  }
  });
      }
      
      function showAjaxModal(uid)
        {
		 $.get('viewuserotherdetails.php?userid=' + uid, function(html){
                 $('#myModal .modal-body').html(html);
                 $('#myModal').modal('show', {backdrop: 'static'});
             });
		}
</script>
<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
    <div class="modal-dialog college-edit-modal-dialog">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
	       <div class="modal-body" style="padding: 0px;"></div>
	    </div>
	  </div>
	</div>
<?php
include "../common/footer.php";
?>