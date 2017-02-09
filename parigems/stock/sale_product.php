	
<?php
ob_start();
error_reporting(0);
session_start();
include"../common/header.php";
require_once '../common/config.php';
$idd=$_GET['id'];
?>
<head>

</head>
<form action="salesreport.php" method="post">
   <div class="container-fluid">
	
	 <ol class="breadcrumb" id="breadcrumb" style="color: black">
    <li><a href="../common/homepage.php">Home</a></li>
	<li><a href="stock.php">Stock Report</a></li>
	 <li class="active">Product Sales Report</li>
        </ol>   
        <h3 align="center">Product Sales Reports</h3>
		
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
								  <th data-field="srno" data-sortable="true"  >Sr.No</th>
								<th data-field="invoiceNo" data-sortable="true"  >Invoice No</th>
								  <th data-field="invoce date" data-sortable="true"> Invoice Date</th>
								  <th data-field="final amount" data-sortable="true" >Invoice Amount</th>
								  <th data-field="total quantity" data-sortable="true" >Quantity</th>
								   <th data-field="customer name" data-sortable="true" >Customer Name</th>
							  </tr>
						  </thead>
								<?php
								$select="select si.*,sp.*,c.* from invoice_product sp inner join invoice si inner join basic_details c where 1 $qry2 and  si.invoiceid=sp.invoiceid and si.userid=c.userid and sp.diamondid=$idd group by si.invoiceid";
								
								$result=mysqli_query($con,$select);
								$i=1;
								 while($row=mysqli_fetch_assoc($result))
								 {
									   $id= $row['userid'];
									   $invoiceno= $row['invoiceid'];
									   
									   $inlen=strlen($invoiceno);
			if($inlen==1){ $invv= '00'.$invoiceno;}
			else if($inlen==2){ $invv= '0'.$invoiceno;}
			else{$invv= ''.$invoiceno;}
									 $sold_qty="select
   SUM(sp.qty) as qty
from
   invoice_product sp 
inner join
   invoice si 
where
   sp.diamondid=".$idd." 
   and si.invoiceid=sp.invoiceid 
   and si.status!=0 and si.invoiceid=$invoiceno";
						
									$soldresult = mysqli_query($con,$sold_qty);
								         while($row1=mysqli_fetch_assoc($soldresult))
								       {
										   $sold_qtyy=$row1['qty'];
									   }
			
										echo "<tr>";
										echo "<td></td>";
										echo "<td>".$i++."</td>";
										echo "<td class='center' style='text-align:center;'>".$invv."</td>";
									   	echo "<td class='center' style='text-align:center;'>".date("d-m-Y", strtotime($row['date']))."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['total']."</td>";
										echo "<td class='center' style='text-align:center;'> ".$sold_qtyy."</td>";
										echo "<td class='center' style='text-align:center;'> ".$row['username']."</td>";
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
						
						
				
								
				
			</form>
			
			</div>
			<script type="text/javascript" src="../../libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="../../libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
 <script type="text/javascript" src="../../libs/html2canvas/html2canvas.min.js"></script>
	<script type="text/javaScript">

    function doExport(selector, params) {
      var options = {
        //ignoreRow: [1,11,12,-2],
        //ignoreColumn: [0,-1],
        tableName: 'Countries',
        worksheetName: 'Countries by population'
      };

      $.extend(true, options, params);

      $(selector).tableExport(options);
    }
    
    function DoOnCellHtmlData(cell, row, col, data) {
      var result = "";
      var html = $.parseHTML( data )

      $.each( html, function() {
        if ( typeof $(this).html() === 'undefined' )
          result += $(this).text();
        else if ( $(this).is("input") )
          result += $('#'+$(this).attr('id')).val();
        else if ( ! $(this).hasClass('no_export') )
          result += $(this).html();
      });
      
      return result;
    }

  </script>
	</div>
</div>
<br>
<br>
<?php
include "../common/footer.php";
?>
	