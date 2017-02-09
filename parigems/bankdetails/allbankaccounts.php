<?php
include "../common/header.php";


$query = "SELECT b.id,b.bankname,b.bankbranch,b.accountnumber,b.accountname,b.ifsccode,b.startingbalance,sum(d.credit)-sum(d.debit) as balance,b.empid FROM bankaccounts b INNER JOIN bankdetails d where b.id=d.accountid and b.status=1 and d.Deleted='false' group by d.accountid";
$execute = mysqli_query($con,$query);
?>
<section class="main-section">
    <div class="container-fluid crumb_top">
			
	    <ol class="breadcrumb" id="breadcrumb" style="color: black">
  <li><a href="../common/homepage.php">Home</a></li>
    <li><a href="index.php">Bank Details</a></li>
	 <li class="active">Bank Accounts</li>
          
  </ol>
	<div class="container-fluid content">
      <h3 align="center">Bank Accounts</h3>
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
            data-click-to-select="true"
            data-toolbar="#toolbar"
            data-show-refresh="true"
            data-show-toggle="true"
            data-show-columns="true"
            data-url="../json/data1.json">
            <thead>
           
               <tr>
                 <th data-field="state" data-checkbox="true" ></th>
                  <th data-field="id" data-sortable="true" >Bank Name</th>
                  <th data-field="Date" data-sortable="true" >Bank Branch</th>
                  <th data-field="Amount" data-sortable="true" >Account Number</th>
                  <th data-field="ifsc" data-sortable="true" >IFSC Code</th>
                  <th data-field="Source" data-sortable="true" >Account Holder Name</th>
                  <th data-field="Description" data-sortable="true" >Starting Balance</th>
                  <th data-field="pay" data-sortable="true" >current Balance</th>
				  <?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
                  <th data-field="action" data-sortable="true" >Action</th>
                 
               </tr>
            </thead>
						
												 
							<?php
												 
								 while($row=mysqli_fetch_assoc($execute))
								 {
									  $id=$row['id'];  
										echo "<tr>";
										echo "<td></td>";
										//echo "<td class='center' style='text-align:center;'>".$row['id']."</td>";
										echo "<td class='center' style='text-align:center;'>".$row['bankname']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['bankbranch']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['accountnumber']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['ifsccode']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['accountname']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['startingbalance']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['balance']."</td>";
										if($role=='SUPERADMIN'){
											$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
											$empname=mysqli_fetch_assoc($getempname);
										  echo "<td>".$empname['username']."</td>";
										  }
										echo "<td class='center' style='text-align:center;'>
										<a href='viewbankdetails.php?id=$id' class='btn btn-success'>View</a>
										<a onclick='deleteacc($id);' class='btn btn-danger'> Delete</a>
										</td>";
										echo "</tr>";
								}
									?>
							  </table>
	 
		 </div>
		 </div>
</section>
     <script type="text/javascript" src="../../libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="../../libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
 <script type="text/javascript" src="../../libs/html2canvas/html2canvas.min.js"></script>
	<script>
		 function deleteacc(i)
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
   		 http2.open("GET","delete_bankaccount.php?id="+i, true);
   		 http2.send(null);
    }
		 });
        }
	</script>
<?php
include "../common/footer.php";
?>
		