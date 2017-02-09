<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  ?>
  <section class="main-section">
	<div class="container-fluid">
	  <ol class="breadcrumb" id="breadcrumb" style="color: black">
	    <li><a href="../common/homepage.php">Home</a></li>
	    <li class="active">Pricelist</li>
	  </ol>
	  <div id="toolbar">
	    <select class="form-control">
	      <option value="">Export Basic</option>
	      <option value="all">Export All</option>
	      <option value="selected">Export Selected</option>
	    </select>
	  </div> 
	  <h3 align="center">Pricelist</h3>
	  <table class="table table-hover" id="table"
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
	    >
	    <thead>
	      <tr>
	        <th data-field="state" data-checkbox="true" ></th>
	        <th data-sortable="true">Sr. No.</th>
	        <th data-sortable="true">Reference Number</th>
	        <th data-sortable="true">Certificate</th>
	        <th data-sortable="true">Date Added</th>
	        <th data-sortable="true">Caret</th>
	        <th data-sortable="true">Cut</th>
	        <th data-sortable="true">Polish</th>
	        <th data-sortable="true">Symmetry</th>
	        <th data-sortable="true">Discount</th>
	        <th data-sortable="true">Less</th>
	        <th data-sortable="true">Extra1</th>
	        <th data-sortable="true">Extra2</th>
	        <th data-sortable="true">Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php
	        $i=1;
	        $queryStock="SELECT * FROM `diamond_master`";
	                             $result = mysqli_query($con,$queryStock);	
	         while($row=mysqli_fetch_assoc($result))
	         {
	           $id=$row['diamond_id'];
	          $certi_master="select * from certificate_master where certificateid=".$row['certificate_id'];
	          $certires=mysqli_query($con,$certi_master);
	          $crow=mysqli_fetch_assoc($certires);
	          
	          $sale_details="select * from diamond_sale where diamond_id=$id";
	          $saleres=mysqli_query($con,$sale_details);
	          $slrow=mysqli_fetch_assoc($saleres);
	        
	        $statusqry="select * from invoice_product where diamondid=$id and pstatus=1";
	        $statusqryresult=mysqli_query($con,$statusqry);
	        $diamondstatusqry="select * from diamond_status where diamondid=$id and diamond_status='HOLD'";
	        $dstatusqryresult=mysqli_query($con,$diamondstatusqry);
	           if(mysqli_num_rows($dstatusqryresult) > 0)
	           {
	        $class="warning";
	        }
	        elseif(mysqli_num_rows($statusqryresult) > 0)
	        {
	        $class="danger";
	        }else
	        {
	        $class="";
	        }
	        	    echo "<tr class='$class'>";
	        		echo "<td></td>";
	        		echo "<td class='number'>".$i++."</td>";										
	        		echo "<td class='center'>".$row['referenceno']."</td>";
	        		echo "<td class='center'>".$crow['certi_name'].'-'.$crow['certi_no']."</td>";
	        		echo "<td class='center'>".$row['entrydate']."</td>";
	        		echo "<td class='center'>".$row['weight']."</td>";
	        		echo "<td class='center'>".$row['cut']."</td>";
	        		echo "<td class='center'>".$row['polish']."</td>";
	        		echo "<td class='center'>".$row['symmetry']."</td>";
	        		echo "<td class='center'>".$slrow['discount1']."</td>";
	        		echo "<td class='center'>".$slrow['discount2']."</td>";
	        		echo "<td class='center'>".$slrow['discount3']."</td>";
	        		echo "<td class='center'>".$slrow['discount4']."</td>";
					$encrypted_txt = encrypt_decrypt('encrypt', $id);
	        		echo "<td class='center'><a href='../pricelist/view_diamond_rap.php?id=$encrypted_txt' class='btn btn-info'>EDIT</a></td>";
	        		echo "</tr>";
	        }
	        ?>
	    </tbody>
	  </table>
	</div>
</section>
<?php
  include "../common/footer.php";
  ?>