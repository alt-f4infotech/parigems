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
      <li><a href="../payment/index.php">Home</a></li>
        <li class="active">Angadia Account Details</li>
   </ol>
   <fieldset class="scheduler-border" >
      <h3 align="center">Angadia Account Details</h3>
         <div class="row">
            <div class="col-sm-4 angadia_deposit_btn"  style="margin-top:-5%;margin-left:63%;">
            <a href="angadia_payment_receipt.php">
            <button type="button" class="btn btn-primary">ADD DEPOSIT</button>
            </a>
         </div>
         <div class="col-sm-4 angadia_expenses_btn"  style="margin-top:-5%;margin-left:75%;">
            <a href="angadia_debit_voucher.php">
            <button type="button" class="btn btn-primary">ADD EXPENSE</button>
            </a>
         </div>
		  <div class="col-sm-4 angadia_cash_btn"  style="margin-top:-5%;margin-left:87%;">
		 <a href="add_angadiacash.php">
            <button type="button" class="btn btn-primary">ADD CASH</button>
            </a>
		   </div>
          </div>
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
                  <!--<th data-field="Date" data-sortable="true" >Account Added Date</th>-->
                  <th data-field="Source" data-sortable="true" >Account Name</th>
                  <!--<th data-field="number" data-sortable="true" >Account Number</th>-->
                  <!--<th data-field="balance" data-sortable="true" >Starting Balance</th>-->
                  <th data-field="currentbalance" data-sortable="true" >Current Balance</th>
                  <th data-field="Description" data-sortable="true" >Description</th>
				   <?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
                  <th data-field="action" data-sortable="true" >Action</th>
               </tr>
            </thead>
            <?php
               $result = mysqli_query($dbh,"SELECT * FROM angadia_account");
               	while($row = mysqli_fetch_assoc($result))
               		{
               		$id=$row['id'];
               		$status=$row['status'];
               		$balance=$row['startingbalance'];
	
	           $cash="select sum(amount) as amount from angadia_kitty where txntype='CREDIT' and  status=1 and categoryid='$id'";
               $cashResult1 = mysqli_query($con,$cash);
				  while($row1=mysqli_fetch_assoc($cashResult1))
               {
               	$amount=$row1['amount'];	
               }
                $debitcash="select  sum(amount) as amount from angadia_kitty where  txntype='DEBIT' and  status=1 and categoryid='$id'";
               $debitcashResult1 = mysqli_query($con,$debitcash);
                while($row2=mysqli_fetch_assoc($debitcashResult1))
               {
               	$remainamount=$row2['amount'];
                }
				
               //$balance =$amount-$remainamount;
			   //echo $amount.'-'.$remainamount.'<br>';
	if($status=='0')
         	    {
         		$class='danger';
         		}
         		else{
         		$class='';
         		}
         		echo "<tr class='$class'>"; 
									
               		echo "<td></td>";
               		//echo "<td>" . date("d-m-Y", strtotime($row['entrydate'])) . "</td>";
               		echo "<td class='number'>" . $row['accountname'] . "</td>";
               		//echo "<td class='number'>" . $row['accountnumber'] . "</td>";
               		//echo "<td class='number'>" . $row['startingbalance'] . "</td>";
               		echo "<td class='number'>" . $balance . "</td>";
               		echo "<td>" . $row['description'] . "</td>";
					if($role=='SUPERADMIN'){
						$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
						$empname=mysqli_fetch_assoc($getempname);
					  echo "<td>".$empname['username']."</td>";
					  }
					if($status!='0')
					{ echo "<td><a href='view_angadia_voucher.php?id=".encrypt_decrypt('encrypt',$id)."' class='btn btn-success'>View Transactions</a><a onclick='deletecash($id);' class='btn btn-danger'>Delete</a></td>"; }
					else{ echo "<td class='center' style='text-align:center;'>Deleted</td>"; }
               		echo "</tr>";
               		}
               	
               		 ?>
         </table>
   </fieldset>
 </div>
   </section>
		
		 <script>
		 function deletecash(i)
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
   				 bootbox.alert('Account Deleted Successfully..!!',function(){
   				 window.location.reload();
				 });
   			}			 
   	}
   		 http2.open("GET","delete_account.php?id="+i, true);
   		 http2.send(null);
    } else {
  // bootbox.alert('Account is NOT Deleted');
    }
	});
    }
	</script>
<br>
<br>

<?php
   include "../common/footer.php";
   ?>