<?php
   ob_start();
   error_reporting(0);
   session_start();
   
   include "../common/header.php";
   
   $dbh=$con;
   ?>
   <section class="main-section">
<div class="container crumb_top">
   <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li><a href="index.php">Payment</a></li>
      <li class="active">View All Expense Entry</li>
   </ol>
   <fieldset class="scheduler-border" >
      <h3 align="center">View All Expense Entry</h3>
	  
	  <form action="view_allexpense.php" method="post">
	  <div class="row">
	  <div class="col-sm-3">
	  <div class="form-group">
		 <label>By Party</label>
	 <select  name="partyName" id="partyName" class="dropdownselect2" >
                     <option value=""> Select Party </option>
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
	  </div>
	  <div class="col-sm-3"><br>
	  <div class="form-group">
	  <input type="submit"  name="submit" class="btn btn-success" value="Submit">
	  <input type="button" onclick="window.location.href='view_allexpense.php';" class="btn btn-success" value="Reset">
	  </div>
	  </div>
	  </div>
</form>
	  
         <div id="toolbar">
            <select class="form-control">
               <option value="">Export Basic</option>
               <option value="all">Export All</option>
               <option value="selected">Export Selected</option>
            </select>
         </div>
         <table id="table"
			data-height="550"
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
                  <th data-field="id" data-sortable="true" >Debit Voucher Id</th>
                  <th data-field="Date" data-sortable="true" >Date</th>
                  <th data-field="Amount" data-sortable="true" >Amount</th>
                  <th data-field="Source" data-sortable="true" >Party Name</th>
                  <th data-field="Description" data-sortable="true" >Description</th>
				  <?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
                  <th data-field="action" data-sortable="true" >Action</th>
               </tr>
            </thead>
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
               $result = mysqli_query($dbh,"SELECT * FROM angadia_voucher where 1  $qry $qry1 and type='DEBIT'  and partyname!=''");
               
               	while($row = mysqli_fetch_assoc($result))
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
				   $bankname='('.$brow['bankname'].')';
				   }
				   
         		echo "<tr class='$class'>"; 
               		echo "<td></td>";
               		echo "<td>" . $row['receiptno'] . "</td>";
               		echo "<td>" . date("d-m-Y", strtotime($row['date'])) . "</td>";
               		echo "<td class='number'>" . $row['amount'] . "</td>";
               		//echo "<td>" . $row['invoiceno'] . "</td>";
               		echo "<td>" . $row['partyname'] . "</td>";
               		echo "<td>" . $row['notes'] . "</td>";
					if($role=='SUPERADMIN'){
						$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
						$empname=mysqli_fetch_assoc($getempname);
					  echo "<td>".$empname['username']."</td>";
					  }
					if($status!='0')
            		{
               		echo "<td>
				<a href='view_expense_receipt.php?id=$id' class='btn btn-success'>View</a>
				<a onclick='deletedebit($id);' class='btn btn-danger'>Delete</a>
					</td>";
					}
					else
					{
					 echo "<td>
				<a href='view_expense_receipt.php?id=$id' class='btn btn-success'>View</a>
					</td>";
					}
               	
               		
               		echo "</tr>";
               		}
               	
            ?>
         </table>
		 
   </fieldset>
</div>
		 </section>
         <script>
        
			function deletedebit(i)
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
   				var respo=http2.responseText;if (respo==1) {
   				 bootbox.alert('Expense Entry Deleted Successfully..!!',function(){
   				 window.location.reload();
				 });
				}
   			}			 
   	}
   		 http2.open("GET","delete_expense.php?id="+i, true);
   		 http2.send(null);
    } else {
   bootbox.alert('Expense Entry is NOT Deleted');
    }
   });
    }
			
         </script>
<br>
<br>
<?php
   include "../common/footer.php";
   ?>