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
        <li class="active">Cash in Hand Details</li>
   </ol>
   <fieldset class="scheduler-border" >
      <h3 align="center">Cash in Hand Details</h3>
         <div class="form-group current_cash_in_hand " style="width: 20%;">
            <label>Current Cash In Hand : </label>
            <?php
               $cash="select sum(amount) as amount from kitty where txntype='CREDIT' and  status=1";
               $cashResult1 = mysqli_query($con,$cash);
                while($row=mysqli_fetch_assoc($cashResult1))
               {
               	$amount=$row['amount'];	
               }
                
                $debitcash="select  sum(amount) as amount from kitty where  txntype='DEBIT' and  status=1 ";
               $debitcashResult1 = mysqli_query($con,$debitcash);
                while($row2=mysqli_fetch_assoc($debitcashResult1))
               {
               	$remainamount=$row2['amount'];	
                }
               $cash = $amount-$remainamount;
               ?>
            <input type="text" class="form-control" id="" value="<?php echo $cash;?>" disabled >
         </div>
         <div class="form-group add_debit_btn " style="margin-top:-5%;margin-left:72%;">
            <a href="debit_voucher.php">
            <button type="button" class="btn btn-primary">ADD DEBIT ENTRY</button>
            </a>
			
         </div>
		  <div class="form-group add_cash_btn "  style="margin-top:-4.2%;margin-left:87%;">
		 <a href="add_cash.php">
            <button type="button" class="btn btn-primary">ADD CASH</button>
            </a>
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
                  <th data-field="Date" data-sortable="true" >Date</th>
                  <th data-field="Amount" data-sortable="true" >Amount</th>
                  <th data-field="Source" data-sortable="true" >Category</th>
                  <th data-field="Description" data-sortable="true" >Description</th>
                  <th data-field="type" data-sortable="true" >Transaction Type</th>
				  <?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
                  <th data-field="action" data-sortable="true" >Action</th>
               </tr>
            </thead>
            <?php
               $result = mysqli_query($dbh,"SELECT * FROM kitty");
               	while($row = mysqli_fetch_assoc($result))
               		{
               			$id=$row['txnid'];
						$catid=$row['categoryid'];
						if($catid!='')
						{
               			 $select="select * from  debit_category where catid=$catid";
						 $result2 = mysqli_query($dbh,$select);
                       	 while($row2= mysqli_fetch_assoc($result2))
               		     {
               			  $catname=$row2['name'];
               		     }
						}
						else
						{
						   $catname='';
						}
               		$status=$row['status'];
	
	if($status=='0')
         	    {
         		$class='danger';
         		}
         		else{
         		$class='';
         		}
         		echo "<tr class='$class'>"; 
									
               		echo "<td></td>";
               		echo "<td>" . date("d-m-Y", strtotime($row['date'])) . "</td>";
               		echo "<td class='number'>" . $row['amount'] . "</td>";
               		echo "<td>" . $catname. "</td>";
               		echo "<td>" . $row['description'] . "</td>";
               		echo "<td>" . $row['txntype'] . "</td>";
					if($role=='SUPERADMIN'){
					 $getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
					 $empname=mysqli_fetch_assoc($getempname);
				   echo "<td>".$empname['username']."</td>";
				   }
					if($status!='0')
            		                        {
               		echo "<td><a onclick='deletecash($id);' class='btn btn-danger'>Delete</a></td>";
											}
											else
											{
											 	echo "<td class='center' style='text-align:center;'>
											Deleted
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
            var $table = $('#table');
            $(function () {
                $('#toolbar').find('select').change(function () {
                    $table.bootstrapTable('refreshOptions', {
                        exportDataType: $(this).val()
                    });
                });
            })
         </script>
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
   				 bootbox.alert('Entry Deleted Successfully..!!',function(){
   				 window.location.reload();
				 });
   			}			 
   	}
   		 http2.open("GET","delete_cash.php?id="+i, true);
   		 http2.send(null);
    } else {
   bootbox.alert('Entry is NOT Deleted');
    }
	});
    }
	</script>
 
<br>
<br>

<?php
   include "../common/footer.php";
   ?>