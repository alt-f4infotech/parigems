<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  
  	$queryStock1="SELECT l.* FROM invoice i,login l where l.userid=i.userid and  i.status='1' ";
  	$result1 = mysqli_query($con,$queryStock1);
  	
  ?>
  <section class="main-section">
	<div class="container-fluid crumb_top">
	  	<ol class="breadcrumb" id="breadcrumb" style="color: black">
	    	<li><a href="../common/homepage.php">Home</a></li>
	    	<li class="active">Pending Sale Orders</li>
	  	</ol>  
	  	<h3 align="center">Pending Sale Orders</h3>
	  	<?php
	    	if(mysqli_num_rows($result1) > 0){ ?>
			  <div id="toolbar">
			    <select class="form-control">
			      <option value="">Export Basic</option>
			      <option value="all">Export All</option>
			      <option value="selected">Export Selected</option>
			    </select>
			  </div>
    <form id="myform" method="post">
	  <table class="table table-striped" id="table" data-height="400" data-show-columns="true"
	    data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	    data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true"
	    data-show-columns="true">
	    <thead>
	      <tr>
	        <th><input type="checkbox" id="check_all" ></th>
	         <th data-sortable="true">Order No.</th>
	        <th data-sortable="true">Customer Name</th>
	        <th data-sortable="true">Order Date</th>
	        <th data-sortable="true">Total Stone</th>
	        <th data-sortable="true">Total Carat</th>
	        <th data-sortable="true">Total Amount</th>
	        <th data-sortable="true">Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php
	        $queryStock="SELECT sum(i.amount) as total,sum(i.qty) as qty,sum(d.weight) as carat,d.*,l.*,i.invoiceid FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' and i.deliverystatus='1' group by i.invoiceid order by i.invoiceid DESC";
			//echo $queryStock;
	        $result = mysqli_query($con,$queryStock);
	        $i=1;
	         while($row=mysqli_fetch_assoc($result))
	         {
	        	$user=$row['userid'];
				$caret=$row['carat'];
				$invoiceid=encrypt_decrypt('encrypt',$row['invoiceid']);
				$getinvoicedate="select date from invoice where invoiceid=".$row['invoiceid'];
				$dateresult=mysqli_query($con,$getinvoicedate);
				$row2=mysqli_fetch_assoc($dateresult);
				
				$validate="select * from saleinvoice where orderno LIKE '%".$row['invoiceid']."%' and status='1'";
				$validateresult=mysqli_query($con,$validate);
				//echo mysqli_num_rows($validateresult);
				if(mysqli_num_rows($validateresult) > 0){}else{
	        	   echo "<tr>";
	        		echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$row['invoiceid'].'" value="'.$row['invoiceid'].'" class="case"  /></td>';			
	        		echo "<td class='center' style='text-align:center;'>".$row['invoiceid']."</td>";
	        		echo "<td class='center' style='text-align:center;'>".$row['username']."</td>";
	          	    echo "<td>".date('d-m-Y g:i:s A',strtotime($row2['date']))."</td>";
	        		echo "<td>".$row['qty']."</td>";
	          	    echo "<td>".sprintf("%.2f",$caret)."</td>";
	        		echo "<td>".sprintf("%.2f",$row['total'])."</td>";
	        		echo "<td class='names'><a href='order.php?id=$invoiceid' class='btn btn-success'>View Order</a></td>";
	        		echo "</tr><input type='text' style='display: none' name='userid[]' value='$user'>";
				}
	        }
	        
	        ?>
	    </tbody>
	  </table>
      <center>
	  <button type="button" class="btn btn-primary"  name="confirm" onclick="return atleast_onecheckbox1()">Proceed To Invoice</button>
	  <button type="button" style='display: none;' data-toggle="modal" data-target="#saleinvoicemodal" id="confirm" >Proceed To Invoice</button>
	  <button type="submit" style='display: none;' id="proceed" >Proceed To Invoice</button>
	  </center>
	  
		<div class="modal fade" id="saleinvoicemodal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sale Invoice Type</h4>
         </div>
         <div class="modal-body">
            <div class="row" style="">
               <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <a onclick='$("#myform").attr("action", "saleinvoice_vat.php");$("#proceed").click();'  >
                  <img src="../images/with-vat.png" style="width: 100%;height: 100%;">
				  <center><label>With VAT</label></center>
                  </a>
               </div>
               <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a onclick='$("#myform").attr("action", "saleinvoice_hform.php");$("#proceed").click();'  >
                 <img src="../images/h-form.png" style="width: 100%;height: 100%;">
				 <center><label>H-Form</label></center>
                  </a>
               </div>
			   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <a onclick='$("#myform").attr("action", "saleinvoice_cash.php");$("#proceed").click();'  >
                  <img src="../images/regular-buying.png" style="width: 100%;height: 100%;">
				  <center><label>Cash</label></center>
                  </a>
               </div>
			   <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                 <a onclick='$("#myform").attr("action", "saleinvoice_hongkong.php");$("#proceed").click();'  >
                  <img src="../images/h-form.png" style="width: 100%;height: 100%;">
				  <center><label>Hongkong</label></center>
                  </a>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
      </form>
	  <?php }
	  else{ echo "<center><font size='6' color='red'>No Orders Found.</font></center>"; } ?>
	</div>
  </section>
  <script>

function atleast_onecheckbox1() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Atleast One Order");
  return false;
  }
  else
  {
	$("#confirm").click();
	//return true;
  }
  }
  
  $(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});
   
</script>
<?php
  include "../common/footer.php";
  ?>