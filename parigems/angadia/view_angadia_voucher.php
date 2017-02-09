<?php
   ob_start();
   error_reporting(0);
   session_start();
   
   include "../common/header.php";
   $id=encrypt_decrypt('decrypt',$_GET['id']);
   if($id!='')
   {
	  $qry1=" and categoryid=$id";
	  
	  $result0 = mysqli_query($dbh,"SELECT * FROM angadia_kitty where 1 $qry1");
   $row0 = mysqli_fetch_assoc($result0);
   $select2="select * from  angadia_account where id=".$row0['categoryid'];
						 $result22 = mysqli_query($dbh,$select2);
                       	 while($row22= mysqli_fetch_assoc($result22))
               		     {
               			  $catname2=$row22['accountname'];
               		     }
   }else{
	  $qry1="";
   }
   $dbh=$con;
   
   ?>
   <section class="main-section">
<div class="container crumb_top">
   <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../payment/index.php">Home</a></li>
        <li><a href="../angadia/angadia_account.php">Angadia Accounts</a></li>
        <li class="active">Angadia Transactions Details</li>
   </ol>
   <fieldset class="scheduler-border" >
      <h3 align="center">Angadia Transactions Details <?php if($catname2!=''){ echo 'of '.$catname2;}?></h3>
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
                  <th data-field="Source" data-sortable="true" >Account Name</th>
                  <th data-field="fromaccount" data-sortable="true" >From</th>
                  <th data-field="to" data-sortable="true" >to</th>
                  <th data-field="Description" data-sortable="true" >Description</th>
                  <th data-field="name" data-sortable="true" >Name</th>
                  <th data-field="type" data-sortable="true" >Transaction Type</th>
				   <?php if($role=='SUPERADMIN'){ ?>
                 <th data-sortable="true">Added By</th> 
                 <?php } ?>
                  <th data-field="action" data-sortable="true" >Action</th>
               </tr>
            </thead>
            <?php
			$temp='ABC(Debit Voucher No.:3)';
			$kid0=explode(')',$temp);
			$kid1=explode(':',$kid0[0]);
			
               $result = mysqli_query($dbh,"SELECT * FROM angadia_kitty where 1 $qry1");
               	while($row = mysqli_fetch_assoc($result))
               		{
               			$id=$row['txnid'];
						$catid=$row['categoryid'];
						$txntype=$row['txntype'];
						$description=explode(':',$row['description']);
						$rcno=explode(')',$description[1]);
						
						if($txntype=='CREDIT')
						{
						   $getpayusers="select partyname,name from angadia_payment_receipt where accountid='$catid' and receiptno=".$rcno[0];
						   $run1=mysqli_query($dbh,$getpayusers);
						    if(mysqli_num_rows($run1) > 0){
						   $prow=mysqli_fetch_assoc($run1);
						   $from=$prow['partyname'];
						   $name=$prow['name'];
						   $r=$rcno[0];
						   }else{$from='';$to='';$r=0;}
						  $amounttotal=$amounttotal+$row['amount'];
						  $a=1;
						  
						}
						else if($txntype=='DEBIT')
						{
						   $getpayusers1="select partyname,name from angadia_voucher where accountid='$catid' and receiptno=".$rcno[0];
						   $run11=mysqli_query($dbh,$getpayusers1);
						   if(mysqli_num_rows($run11) > 0){
						   $prow1=mysqli_fetch_assoc($run11);
						   $to=$prow1['partyname'];
						   $name=$prow1['name'];
						  $r=$rcno[0];
						   }else{$to='';$form='';$r=0;}
						   $amounttotal=$amounttotal-$row['amount'];
						   $a=2;
						   
						}
						else{
						   $to='';$form='';$a=3;$r=0;
						}
						if($catid!='')
						{
               			 $select="select * from  angadia_account where id=$catid";
						 $result2 = mysqli_query($dbh,$select);
                       	 while($row2= mysqli_fetch_assoc($result2))
               		     {
               			  $catname=$row2['accountname'];
               		     }
						}
						else
						{
						   $catname='';
						}
               		$status=$row['status'];
	
	          if($txntype=='DEBIT')
         	    {
         		$class='danger';
         		}
         		if($txntype=='CREDIT')
				{
         		$class='';
         		}
				
         		echo "<tr class='$class'>"; 
									
               		echo "<td></td>";
               		echo "<td>" . date("d-m-Y", strtotime($row['date'])) . "</td>";
               		echo "<td class='number'>" . $row['amount'] . "</td>";
               		echo "<td>" . $catname. "</td>";
					if($txntype=='CREDIT'){
               		echo "<td>" . $from. "</td>";
					}else{
					echo "<td></td>"; 
					}
					if($txntype=='DEBIT'){
               		echo "<td>" . $to . "</td>";
					}else{
               		echo "<td></td>";
					}
					if($row['description']!=''){
               		echo "<td>" . $row['description'] . "</td>";
					}else{
               		echo "<td>" . $row['comments'] . "</td>";
					}
               		echo "<td>" . $name . "</td>";
               		echo "<td>" . $txntype . "</td>";
					if($role=='SUPERADMIN'){
						$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
						$empname=mysqli_fetch_assoc($getempname);
					  echo "<td>".$empname['username']."</td>";
					  }
					if($status!='0')
            		                        {
               		echo "<td><a onclick='deletecash($id,$a,$r);' class='btn btn-danger'>Delete</a></td>";
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
			<tr>
			   <td></td>
			   <td><b>Balance</b></td>
			   <td class='number'><b><?php echo $amounttotal;?></b></td>
			   
			</tr>
         </table>
   </fieldset>
 </div>
   </section>
		
		 <script>
		 function deletecash(i,a,r)
   {
	  alert(i);
	  alert(a);
	  alert(r);
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
                  bootbox.alert('Entry Deleted Successfully..!!',function(){
   				 window.location.reload();
				 });
                }
   				 
   			}			 
   	}
	
   		 http2.open("GET","delete_entry.php?id="+i+"&a="+a+"&r="+r, true);
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