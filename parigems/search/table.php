<?php
   include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
   $rec_limit = 10;
       
         /* Get total number of records */
         $sql = "SELECT count(id) FROM raptable ";
         $retval = mysqli_query($con,$sql);
         
         if(! $retval ) {
            die('Could not get data1: ' . mysqli_error());
         }
         $row = mysqli_fetch_array($retval, MYSQLI_NUM );
         $rec_count = $row[0];
         
         if( $_GET['page']!='' ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         
         $left_rec = $rec_count - ($page * $rec_limit);
         $sql = "SELECT * ". 
            "FROM raptable ".
            "LIMIT $offset, $rec_limit";
         $retval = mysqli_query($con,$sql);
         
         if(! $retval ) {
            die('Could not get data2: ' . mysqli_error());
         }
         ?>
         <link rel="stylesheet" type="text/css" href="pagination.css" />
         <section class="main-section">
   <div class="container-fluid">
	  <ol class="breadcrumb" id="breadcrumb" style="color: black">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li class="active">Raptable</li>
	   </ol>
	<table class="table table-bordered" id="table" data-height="400" data-show-columns="false" data-toggle="table" data-search="false" data-show-export="false" data-pagination="true" data-click-to-select="false" data-toolbar="#toolbar" data-show-refresh="false" data-show-toggle="false"
      data-show-columns="true">
      <thead>
        <tr>
          <th data-field="state" data-checkbox="true" ></th>
          <th data-sortable="true">Sr.No.</th>
          <th data-sortable="true">Shape</th>
          <th data-sortable="true">Clarity</th>
          <th data-sortable="true">Color</th>
          <th data-sortable="true">Rate</th>
          <th data-sortable="true">Action</th>
        </tr>
      </thead>
      <tbody>
		 <?php
         while($row = mysqli_fetch_assoc($retval)) {
            echo "<tr>";
			echo "<td></td>";
			echo "<td>".$offset++."</td>";
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
   
         <?php
         
         $total_pages = ceil($rec_count / $rec_limit);//total pages we going to have
         $reload = $_SERVER['PHP_SELF'] . "?page=" . $total_pages;
    echo '<div class="pagination"><ul>';
    if ($total_pages > 1) {
        echo paginate($reload, $page, $total_pages);
    }
    echo "</ul></div>";
    $tpages=$total_pages;
    function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page=$last\">Last 10 Records</a>";
            $pmin=($page>$adjacents)?($page - $adjacents):1;
    $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li><a href=\"$_PHP_SELF?page=".$i."\">".$i."</a></li>\n";
        }
       elseif ($i == $page-1) {
            $out.= "<li class=\"active\"><a href=\"$_PHP_SELF?page=".$i."\">".$i."</a></li>\n";
        } 
        elseif ($i == 1) {
            $out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
        } else {
            $out.= "<li><a href=\"$_PHP_SELF?page=".$i."\">".$i. "</a>\n</li>";
        }
    }
    
    if ($page<=($tpages - $adjacents)) {
        $out.= "<a style='font-size:11px' href=\"$_PHP_SELF?page=".$tpages."\">" .$tpages."</a>\n";
    }
    echo $out;
            echo "<a href = \"$_PHP_SELF?page=$page\">Next 10 Records</a>";
         }else if( $page == 0 ) {
            echo "<a href = \"$_PHP_SELF?page=$page\">Next 10 Records</a>";
         }else if( $left_rec < $rec_limit ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page=$last\">Last 10 Records</a>";
         }
    
    
}
         mysqli_close($con);
      ?>
      </div>
 </section>