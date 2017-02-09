<?php
ob_start();
error_reporting(0);
include "../common/header.php";
$conn = $con;

$postid = $_POST['selectbank'];
$geactid = $_GET['accountid'];
if($geactid!='')
{
$getid=	$geactid;				
}
else
{
$getid=	$postid;						
}
$query="SELECT *
FROM bankdetails
WHERE Deleted = 'false'
  AND accountid ='$getid'
ORDER BY date";
$execute = mysqli_query($conn,$query);

$bankname2 = mysqli_query($con,"SELECT * FROM bankaccounts where id='$postid'");
$row2 = mysqli_fetch_assoc($bankname2);
?>

<section class="main-section">
    <div class="container-fluid">

					<ol class="breadcrumb" id="breadcrumb" style="color: black">
						<li><a href="../common/homepage.php">Home</a></li>
						<li><a href="index.php">Bank Details</a></li>
						<li class="active">Bank Entries</li>
					 </ol>
				
				<div class="container-fluid content">
				<h3 align="center">Bank Entries   <?php if(isset($_POST['selectbank'])){ echo 'of '.$row2['bankname']; }?></h3>


					<form action="getBankdetails.php" method="post">
					<div class="row">
						<div class="col-sm-4">
							<div class="input-group" style="margin-top: 10px;">
								<!-- <label>Click on any option </label> -->
								<select id="my_select" name="selectbank" class="dropdownselect2" onchange="send_option();" >
									<option>Select Bank</option>
								
									<?php $bankname = mysqli_query($con,"SELECT * FROM bankaccounts where status=1");
									while($row = mysqli_fetch_assoc($bankname)){
										echo "<option value=".$row['id']." >". $row['bankname']."</option>";
									}
									?>
								</select>
								<span class="input-group-addon" style="padding: 1px 0">
								<button type="submit" class="btn btn-primary " style="border:0; border-top-left-radius: 0; border-bottom-left-radius: 0">Go</button>
								</span>
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
								  <th data-field="date" data-sortable="true"  >Date</th>
								  <th data-field="party Name" data-sortable="true" >Party Name</th>
								  <th data-field="payment type" data-sortable="true">Payment Type</th>
								  <th data-field="cheque no" data-sortable="true">Cheque No.</th>
								  <th data-field="transaction no" data-sortable="true">Transaction Id</th>
								  <th data-field="credit" data-sortable="true"  >credit</th>
								  <th data-field="debit" data-sortable="true" >debit</th>
								  <th data-field="balance" data-sortable="true">Balance </th>
								  <th data-field="descrption" data-sortable="true">Description</th>
								  <?php if($role=='SUPERADMIN'){ ?>
									<th data-sortable="true">Added By</th> 
									<?php } ?>
								    <th data-field="modify" data-sortable="true">Action</th>								 
							  </tr>							  
						  </thead>
						 <?php
						 $temp=0;$temp2=0;
						 while($row = mysqli_fetch_assoc($execute))
                                                                                                                                                                                {
                $temp=$temp+$row['credit'];
                $temp2=$temp2+$row['debit'];
                $temp3=$temp-$temp2;
				$lastdate=date("d-m-Y",strtotime($row['date']));
				if($row['paymentType']=='other')
				{
				$transactionno=$row['chequeNo'];
				$chequeno='';
				}
				else if($row['paymentType']=='cheque')
				{
				$chequeno=$row['chequeNo'];
				$transactionno='';
				}else{
					$transactionno='';
					$chequeno='';
				}
                    echo "<tr>";
					echo "<td></td>";
					echo "<td>" .date("d-m-Y",strtotime($row['date'])). "</td>";
					echo "<td>" . $row['partyName'] . "</td>";
					echo "<td>" . $row['paymentType'] . "</td>";
					echo "<td>" . $chequeno . "</td>";
					echo "<td>" . $transactionno . "</td>";
					echo "<td>" . $row['credit'] . "</td>";
					echo "<td>" . $row['debit'] . "</td>";
					echo "<td>" . $temp3. "</td>";
					echo "<td>" . $row['transactionDescription'] . "</td>";
					if($role=='SUPERADMIN'){
						$getempname=mysqli_query($con,"select username from basic_details where userid=".$row['empid']);
						$empname=mysqli_fetch_assoc($getempname);
					  echo "<td>".$empname['username']."</td>";
					  }
					echo "<td>";
					if($row['transactionDescription']=='STARTING BALANCE')
					{}else{
					echo "<a href='showDetails.php?id=$row[id]' class='btn btn-success'>View</a><a href='editDetails.php?id=$row[id]'  class='btn btn-primary'>Edit</a><a onclick='deleteentry($row[id]);'  class='btn btn-danger'>Delete</a>"; }
					echo "</td>";
					echo "</tr>";
					}
					?>
								</table>
		<center><h4>Your Current Balance is : <?php echo no_to_words($temp3);?><?php if($lastdate!='01-01-1970'){?> on Date: <?php echo $lastdate; } ?> </h4></center>
							</div>
					 </div>
				
				</div>
</section>
				 <script type="text/javascript" src="../../libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="../../libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
 <script type="text/javascript" src="../../libs/html2canvas/html2canvas.min.js"></script>
	<br>
<br>
<br>
<script>
   function deleteentry(i)
   {
   bootbox.confirm("Do You Want to Delete This Bank Entry?", function(result) {
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
   		 http2.open("GET","delete_bank_entry.php?id="+i, true);
   		 http2.send(null);
    }
		 });
        }
</script>
		<?php
		include "../common/footer.php";
		?>