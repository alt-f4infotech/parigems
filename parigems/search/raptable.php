<?php
   include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
  
   ?>
 <section class="main-section">
   <div class="container-fluid crumb_top">
	  <ol class="breadcrumb" id="breadcrumb" style="color: black">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li class="active">Raptable</li>
	   </ol>
	  <div id="toolbar">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>
	<table class="table table-hover" id="table" data-height="400" data-show-columns="true"
	        data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	        data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true"
			data-show-toggle="true" data-show-columns="true">
      <thead>
        <tr>
          <th data-field="state" data-checkbox="true" ></th>
          <th data-sortable="true">Sr.No.</th>
          <th data-sortable="true">Range</th>
          <th data-sortable="true">Shape</th>
          <th data-sortable="true">Clarity</th>
          <th data-sortable="true">Color</th>
          <th data-sortable="true">Rate</th>
          <th data-sortable="true">Action</th>
        </tr>
      </thead>
      <tbody>
		 <?php
		 $i=1;
		 $query="select * from raptable";
		 $run=mysqli_query($con,$query);
		 while($row=mysqli_fetch_assoc($run))
		 {
			echo "<tr>";
			echo "<td></td>";
			echo "<td>".$i++."</td>";
			echo "<td>".$row['raprangestart'].'-'.$row['raprangeend']."</td>";
			echo "<td>".$row['shape']."</td>";
			echo "<td>".$row['clarity']."</td>";
			echo "<td>".$row['color']."</td>";
			echo "<td>".$row['rate']."</td>";
			echo "<td><a href='editraprate.php?id=".$row['id']."' class='btn btn-primary'>Edit</a></td>";
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