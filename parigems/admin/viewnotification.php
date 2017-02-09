<?php
  include '../common/header.php';
  
  ?>
<body>
  <section class="main-section">
    <div class="container-fluid">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Notification</li>
      </ol>
	 <ul id="myTab" class="nav nav-tabs nav-tabs-bg">
      <li class="active"><a href="#view" data-target="#view" data-toggle="tab">View Pending Notifications</a></li>
      <li><a href="#add" data-target="#add" data-toggle="tab" id="secondtabmenu">View All Notifications</a></li>	  
    </ul><br>
	 <div id="myTabContent" class="tab-content tab-content2">
		<div id="view" class="tab-pane fade in active">
      <table class="table table-bordered" id="table" data-height="400" >
          <thead>
            <tr>
              <th data-sortable="true">Sent Date</th>
              <th data-sortable="true">Message</th>
              <th data-sortable="true">From</th>
              <th data-sortable="true">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
			$i=1;              
              $getnotification="select n.*,l.username,u.nid from  notification n,notification_user u,login l where l.userid=n.userid and n.id=u.notificationid and n.status='1' and u.userid='$userid'";
              $result1=mysqli_query($con,$getnotification);
              while($row=mysqli_fetch_assoc($result1))
              {
                $id=$row['id'];
				$purchase_invoiceno=$row['purchase_invoiceno'];
			  
			  $querypurchase="SELECT p.*,pt.* FROM purchaseinvoice p, party pt where  p.partyid=pt.partyid and p.purchase_invoiceid='$purchase_invoiceno'";
              $result = mysqli_query($con,$querypurchase);
			  $row11=mysqli_fetch_assoc($result);
			  
			   $paymentinvoice="select sum(amount) as amount from debit_voucher where invoiceno='$purchase_invoiceno' and status='1'";
			   $receiptres=mysqli_query($con,$paymentinvoice);
			   if(mysqli_num_rows($receiptres) > 0 ){
			   $payrow=mysqli_fetch_assoc($receiptres);
			   $paidamount=$payrow['amount'];
			   }
   
			  if($purchase_invoiceno!='')
			  {
			   $balance=$row11['total']-$paidamount;
			  $info='<br>Type : Purchase Reminder<br>Party: '.$row11['companyname'].'<br>Invoice Number: PI-'.$row11['invoiceno'].'<br>Balance Amount:'.sprintf("%.2f",$balance);
			  }else{$info='';}
			  
                echo "<tr>";
                echo "<td>".date('d-m-Y g:i A',strtotime($row['entrydate']))."</td>";
                echo "<td>".$row['message'].$info."</td>";
                echo "<td>".$row['username']."</td>";
                echo '<td><button class="btn btn-danger" onclick="removenotification('.$id.')"><i class="fa fa-trash"></i></button></td>';
             ?>
            <?php
              echo "</tr>";
			}                           
			?>
          </tbody>
        </table>
      
    </div>
		<div id="add" class="tab-pane fade">
        <table class="table table-bordered" id="table" data-height="400" >
          <thead>
            <tr>
              <th data-sortable="true">Sent Date</th>
              <th data-sortable="true">Message</th>
              <th data-sortable="true">From</th>
              <th data-sortable="true">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
			$i=1;              
              $getnotification="select n.*,l.username,u.nid from  notification n,notification_user u,login l where l.userid=n.userid and n.id=u.notificationid  and u.userid='$userid' order by n.id DESC";
              $result1=mysqli_query($con,$getnotification);
              while($row=mysqli_fetch_assoc($result1))
              {
                $id=$row['id'];
                $status=$row['status'];
				if($status=='1')
				{
				  $status='Pending';
				  $class='class="danger"';
				}else{
				  $status='Read';
				  $class='class=""';
				}
				
				$purchase_invoiceno=$row['purchase_invoiceno'];
			  
			  $querypurchase="SELECT p.*,pt.* FROM purchaseinvoice p, party pt where  p.partyid=pt.partyid and p.purchase_invoiceid='$purchase_invoiceno'";
              $result = mysqli_query($con,$querypurchase);
			  $row11=mysqli_fetch_assoc($result);
			  
			   $paymentinvoice="select sum(amount) as amount from debit_voucher where invoiceno='$purchase_invoiceno' and status='1'";
			   $receiptres=mysqli_query($con,$paymentinvoice);
			   if(mysqli_num_rows($receiptres) > 0 ){
			   $payrow=mysqli_fetch_assoc($receiptres);
			   $paidamount=$payrow['amount'];
			   }
   
			  if($purchase_invoiceno!='')
			  {
			   $balance=$row11['total']-$paidamount;
			   $info='<br>Type : Purchase Reminder<br>Party: '.$row11['companyname'].'<br>Invoice Number: PI-'.$row11['invoiceno'].'<br>Balance Amount:'.sprintf("%.2f",$balance);
			   }else{$info='';}
			  
                echo "<tr $class>";
                echo "<td>".date('d-m-Y g:i A',strtotime($row['entrydate']))."</td>";
                echo "<td>".$row['message'].$info."</td>";
                echo "<td>".$row['username']."</td>";
                echo "<td>".$status."</td>";
             ?>
            <?php
              echo "</tr>";
			}                           
			?>
          </tbody>
        </table>
   </div>
    </div>
	 </div>
	</div>
  </section>
</body>
</html>
<script>
  function removenotification(id) {
	bootbox.confirm("Are you sure..?", function(result) {
  if (result==true) {
         $.ajax({
    url:"../admin/removenotification.php?id="+id,  
    success:function(data) {
	if(data==1){
	  window.location.reload();
	}
    }
  });
  }
	});
      }
</script>
<?php
include "../common/footer.php";
?>