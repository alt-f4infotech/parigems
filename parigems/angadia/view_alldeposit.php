<?php
   ob_start();
   error_reporting(0);
   session_start();
   include"../common/header.php";
   
   ?>
   <section class="main-section">
   <div class="container crumb_top" >
      <ol class="breadcrumb" id="breadcrumb" style="color: black">
         <li><a href="../common/homepage.php">Home</a></li>
         <li><a href="index.php">Payment</a></li>
         <li class="active">View All Deposit Entry</li>
      </ol>
      <h3 align="center">View All Deposit Entry</h3>
	  <form action="view_alldeposit.php" method="post">
	  <div class="row">
	  <div class="col-sm-3">
                  <div class="form-group">
                     <label>Party Name :</label>
                        <select tabindex="1" name="partyName" id="partyName"  class="dropdownselect2" >
                           <option value=""> Select Party </option>
                           <?php 
                              $query = "SELECT * FROM basic_details where userstatus=1 and usertype='user'";
                              $execute = mysqli_query($con,$query);
                              while ($row = mysqli_fetch_array($execute)){
                                 echo "<option value='".$row['userid']."'>".$row['username']."</option>";
                              }
                           ?>
                        </select>
                  </div>
               </div>
	  <div class="col-sm-4"><br>
	  <div class="form-group">
		  <input type="submit"  name="submit" class="btn btn-success" value="Submit">
	  <input type="button" onclick="window.location.href='view_alldeposit.php';" class="btn btn-success" value="Reset">
	  </div>
	  </div>
	  </div>
</form>
<?php
if(isset($_POST['submit']))
{
   if($_POST['paytype']!='')
   {
	  $qry=" and paytype='".$_POST['paytype']."'";
   }
   else
   {
	  $qry="";
   }
   
   if($_POST['partyName']!='')
   {
	  $qry1=" and partyid='".$_POST['partyName']."'";
   }
   else
   {
	  $qry1="";
   }
}
   $query="SELECT * FROM  angadia_payment_receipt where 1 $qry $qry1 and type='CREDIT' and partyname!=''";
   $result = mysqli_query($con,$query);
   ?>
<div id="toolbar">
<select class="form-control">
<option value="">Export Basic</option>
<option value="all">Export All</option>
<option value="selected">Export Selected</option>
</select>
</div>

<table id="table"
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
   data-url="../json/data1.json">
<thead>
<tr>
<th data-field="state" data-checkbox="true" ></th>
<th   data-field="id" data-sortable="true" >Sr.No.</th>
<th   data-field="name" data-sortable="true" >Party name</th>
<th   data-field="paid" data-sortable="true" >Paid Amount</th>
<th   data-field="date" data-sortable="true" >Date</th>
<?php if($role=='SUPERADMIN'){ ?>
<th data-sortable="true">Added By</th> 
<?php } ?>
<th   data-field="view" data-sortable="true" >Action</th>
</tr>
</thead>
<?php
   $i=1;
    while($row=mysqli_fetch_assoc($result))
    {
   	$id=$row['receiptno'];
   	$status=$row['status'];
	
	if($status=='0')
         	    {
         		$class='danger';
         		}
         		else{
         		$class='';
         		}
				
				$banknameqry = mysqli_query($conn,"SELECT * FROM angadia_account where status=1 and id=".$row['accountid']);
			   while($brow = mysqli_fetch_assoc($banknameqry)){
				   $bankname=$bankname='('.$brow['accountname'].')';
				   }
         		echo "<tr class='$class'>"; 
   			echo "<td></td>";											
   			echo "<td class='center' style='text-align:center;'>".$i++."</td>";
   			echo "<td class='center' style='text-align:center;'>".$row['partyname']."</td>";
   			echo "<td class='number'>".$row['amount']."</td>";
   			echo "<td class='center' style='text-align:center;'>".date("d-m-Y",strtotime($row['date']))."</td>";
			if($role=='SUPERADMIN'){
			$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
			$empname=mysqli_fetch_assoc($getempname);
		  echo "<td>".$empname['username']."</td>";
		  }
			if($status!='0')
            		{
   			echo "<td class='center' style='text-align:center;'>
   			<a href='view_deposit_receipt.php?id=$id' class='btn btn-success'>View</a>&nbsp;&nbsp;
   		<a onclick='deletepayment($id);' class='btn btn-danger'>Delete</a>
   			</td>";
					}
					else
					{
					echo "<td class='center' style='text-align:center;'>
   			<a href='view_deposit_receipt.php?id=$id' class='btn btn-success'>View</a>
   			</td>"; 
					}
   		echo "</tr>";
   }
   
   ?>
</table>
<script>
  
   function deletepayment(i)
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
   				var respo=http2.responseText;
				if (respo==1) {
                  bootbox.alert('Deposit Entry Deleted Successfully..!!',function(){
   				 window.location.reload();
				 });
                }
   				 
   			}			 
   	}
   		 http2.open("GET","delete_deposit.php?id="+i, true);
   		 http2.send(null);
    } else {
   bootbox.alert('Deposit Entry is NOT Deleted');
        
    }
   });
    }
</script>
</div>
</section>
<br>
<br>
<?php
   include "../common/footer.php";
   ?>