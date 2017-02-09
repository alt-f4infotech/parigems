<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  
  ?>
<body>
  <section class="main-section">
    <div class="container-fluid">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">View All Users</li>
      </ol>
	  
      <h3 align="center">View All Users</h3>
	  <form action="viewusers.php" method="post">
      <div class="row">
	  <div class="col-sm-3">
					<div class="form-group">
				 		<label for="locationid">Filter By Country</label>
						<select class="dropdownselect2"  name="country" id="partyid2" onchange="this.form.submit();">
		                    <option value="">Select Country</option>
		                    <?php
		                        $getcountry="select distinct country from basic_details";
		                        $countryres=mysqli_query($con,$getcountry);
		                        while($cntry=mysqli_fetch_assoc($countryres)){
								  if($_POST['country']==$cntry['country']){
		                            echo '<option value="'.$cntry['country'].'" selected>'.$cntry['country'].'</option>';
								  }else{
		                            echo '<option value="'.$cntry['country'].'">'.$cntry['country'].'</option>';
								  }
		                        }
		                    ?>
		                </select>
					</div>
				</div>
	  </div>
	  </form>
      <form id="movieForm" action="sendmailtoall.php"  method="post">
        <div id="toolbar">
          <select class="form-control">
            <option value="">Export Basic</option>
            <option value="all">Export All</option>
            <option value="selected">Export Selected</option>
          </select>
        </div>
		
        <table class="table table-bordered" id="table" data-height="400" data-show-columns="true"
          data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
          data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true"
          data-show-toggle="true" data-show-columns="true">
          <thead>
            <tr>
              <th data-field="state"></th>
              <th data-sortable="true">Sr.No.</th>
              <th data-sortable="true">User Name</th>
              <th data-sortable="true">Company Name</th>
              <th data-sortable="true">Contact Number</th>
              <th data-sortable="true">Address</th>
              <th data-sortable="true">City</th>
              <th data-sortable="true">Pincode</th>
              <th data-sortable="true">Country</th>
              <th data-sortable="true">Phoneno</th>
              <th data-sortable="true">Fax Number</th>
              <th data-sortable="true">Website</th>
              <th data-sortable="true">Email Id</th>
              <th data-sortable="true">Bankname</th>
              <th data-sortable="true">Branchname</th>
              <th data-sortable="true">Accountid</th>
              <th data-sortable="true">Countrytype</th>
              <th data-sortable="true">CST Number</th>
              <th data-sortable="true">VATTIN Number</th>
              <th data-sortable="true">PAN Number</th>
              <th data-sortable="true">Purchase Limit</th>
              <th data-sortable="true">Balance Amount</th>
              <th data-sortable="true">Status</th>
			  <?php if($role=='SUPERADMIN'){ ?>
			  <th id="superadmin" data-sortable="true">Approved By</th> 
			  <?php } ?>
			  <th data-sortable="true">Other Details</th>
              <th data-sortable="true">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
			if (isset($_POST['country'])) {
			  if($_POST['country']!=''){
			 $countryqry=" and b.country='".$_POST['country']."'";
			  }
		   }
		   else
		   {$countryqry="";}
              $i=1;
              $certificteqry1="select b.* from basic_details b,login l where 1 $countryqry and l.userid=b.userid and b.usertype='user'";
              $certiresult1=mysqli_query($con,$certificteqry1);
              while($row=mysqli_fetch_assoc($certiresult1))
              {
              $userid=$row['userid'];
              if($row['userstatus']=='1')
              {$status='Approved';}
              if($row['userstatus']=='2')
              {$status='Unapproved';}
              if($row['userstatus']=='0')
              {$status='Blocked';}
			  
			  $totalinvamount=0;
 $querySales3="select distinct i.invoiceid,i.total from invoice i where i.userid=$userid and i.status=1";
 $result3 = mysqli_query($con,$querySales3);
 if(mysqli_num_rows($result3) >0 ){
   while($row11=mysqli_fetch_assoc($result3))
   {
	$totalinvamount=$totalinvamount+$row11['total'];
   }
   $querySales33="select distinct p.receiptno,p.amount from payment_receipt p where p.partyid='$userid' and p.status=1";
   $result33 = mysqli_query($con,$querySales33);
   if(mysqli_num_rows($result3) >0 ){
    while($row113=mysqli_fetch_assoc($result33))
    {	
     $totalpayamount=$totalpayamount+$row113['amount'];
	}
   $balance= intval($totalinvamount - $totalpayamount);
   }else{ $balance= intval($totalpayamount); }
 }else{ $balance= 0; }
 
              echo "<tr class='$class'>";
              echo '<td><input type="checkbox" name="check[]" id="'.$userid.'" value="'.$userid.'"/></td>';
                echo "<td>".$i++."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$row['companyname']."</td>";
                echo "<td>".$row['phoneno']."</td>";
                echo "<td>".$row['office_address']."</td>";
                echo "<td>".$row['city']."</td>";
                echo "<td>".$row['pincode']."</td>";
                echo "<td>".$row['country']."</td>";
                echo "<td>".$row['phoneno']."</td>";
                echo "<td>".$row['fax_number']."</td>";
                echo "<td>".$row['website']."</td>";
                echo "<td>".$row['emailid']."</td>";
                echo "<td>".$row['bankname']."</td>";
                echo "<td>".$row['branchname']."</td>";
                echo "<td>".$row['accountid']."</td>";
                echo "<td>".$row['countrytype']."</td>";
                echo "<td>".$row['cstnumber']."</td>";
                echo "<td>".$row['vattinnumber']."</td>";
                echo "<td>".$row['pannumber']."</td>";
                echo "<td>".$row['amountlimit']."</td>";
                echo "<td>".$balance."</td>";
                echo "<td>".$status."</td>";
				if($role=='SUPERADMIN'){
					$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['approved_by']);
					$empname=mysqli_fetch_assoc($getempname);
                  echo "<td>".$empname['username']."</td>";
				  }
               echo "<td><a data-toggle='tooltip' title='View' href='javascript:;' data-id='$userid' class='btn btn-success' onclick='showAjaxModal($userid);'>View Details</a></td>";
               echo '<input type="hidden" name="emailid[]"   value="'.$row['emailid'].'"  />';
              echo '<input type="hidden" name="fname[]"   value="'.$row['username'].'"  />';
                
              if($row['userstatus']=='0'){ ?>
            <td><a class="btn btn-success"  onclick="unblock(<?php echo $userid;?>)" >Unblock</a></td>
            <?php }else{ ?>
            <td><a class="btn btn-danger"  onclick="block(<?php echo $userid;?>)" >Block</a></td>
            <?php }?>
            <!--<td><a class="btn btn-danger"  onclick="sendactioncart('remove','<?php echo $did;?>')" >View</a></td>-->
            <?php
              echo "</tr>";
                                }                           
                                ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-12">
            <label for="chk" class="btn btn-success"><input style="margin-right: 7px; margin-top: 0;" type="checkbox" id="chk" name="chk" value="chk" onclick="check_all(chk);" >Select All</label>
            <button type="button" class="btn btn-info"  onclick="return atleast_onecheckbox1()">Send Mail</button>
            <button style="display: none" type="button" class="btn btn-info" id="button" data-toggle="modal" data-target="#myModalmail" >Send Mail</button>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade opacity-8" id="myModalmail" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mail Content</h4>
              </div>
              <div class="modal-body">
                <input type="text"  class="form-control" placeholder="Subject" id="subject" name="subject" >
                <textarea id="message" class="form-control" name="message" >
                </textarea>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="return atleast_onecheckbox()" >Send Mail</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </form>
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