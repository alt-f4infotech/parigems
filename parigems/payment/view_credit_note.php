<?php
   ob_start();
   error_reporting(0);
   session_start();
   
   include "../common/header.php";
   
   $dbh=$con;
   ?>
<div class="container">
   <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
    
      <li class="active">Credit Note Details</li>
   </ol>
   <fieldset class="scheduler-border" >
      <h3 align="center">Credit Note Details</h3>
      <form class="">
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
                  <th data-field="srno1" data-sortable="true" >Sr.No.</th>
                  <th data-field="invoice1" data-sortable="true" >Invoice Number</th>
                  <th data-field="customer1" data-sortable="true" >Customer Name</th>
                  <th data-field="Date11" data-sortable="true" >Date</th>
                  <th data-field="Amount1" data-sortable="true" >Amount</th>
                  <th data-field="action" data-sortable="true" >Action</th>
               </tr>
            </thead>
            <?php
               $sr=1;
               			 $select="select
               cd.*,
               c.* 
               from
               creditnote cd 
               inner join
               customer c 
               where
               c.customerid=cd.customerid";
               			
               			 $result2 = mysqli_query($dbh,$select);
               
               	while($row= mysqli_fetch_assoc($result2))
               		{
               		$id=$row['id'];
               		 $invoiceno=$row['invoiceno'];
               $inlen=strlen($invoiceno);
               if($inlen==1){ $invv= 'S/00'.$invoiceno;}
               else if($inlen==2){  $invv= 'S/0'.$invoiceno;}
               else{ $invv= 'S/'.$invoiceno;}
               		echo "<tr>";
               		echo "<td></td>";
               		echo "<td>".$sr++."</td>";
               		echo "<td>" .$invv. "</td>";
               		echo "<td>" .$row['customername']. "</td>";
               		echo "<td>" .$row['date']. "</td>";
               		echo "<td>" .$row['amount']. "</td>";
               		echo "<td><a href='viewCredit.php?id=$id'>View</a></td>";
               		
               		echo "</tr>";
               		}
               											
               		 ?>
         </table>
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
     
</div>
</fieldset>
</form>
</div>
</div>
<br>
<br>
<?php
   include "../common/footer.php";
   ?>