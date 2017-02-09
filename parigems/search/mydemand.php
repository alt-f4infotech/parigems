<?php
include '../common/header.php';
error_reporting(0);
session_start();
?>
<body>
  <section class="main-section">
    <div class="container-fluid">
  		<ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">My Demands</li>
      </ol>
      <h3 align="center">My Demands</h3>
      <!--<a data-toggle='modal'  class='btn btn-primary' data-target='#modal1' style='cursor:pointer;'>Add Demand</a>-->
      <a href="senddemand.php"  class='btn btn-primary'  style='cursor:pointer;'>Add Demand</a>
  	  <div id="toolbar">
        <select class="form-control">
          <option value="">Export Basic</option>
          <option value="all">Export All</option>
          <option value="selected">Export Selected</option>
        </select>
      </div>
      <table class="table table-bordered " id="table" data-height="400" data-show-columns="true" 
        data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
        data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true"
  			data-show-toggle="true" data-show-columns="true">
  			<thead>
  			  <tr>
  			    <th data-field="state" data-checkbox="true"></th>
            <th data-sortable="true">Sr.No.</th>
            <th data-sortable="true">Demands</th>
            <th data-sortable="true">Date</th>
            <th data-sortable="true">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
            $getdemand="select * from mydemand where userid=$userid";
            $result=mysqli_query($con,$getdemand);
            while($row=mysqli_fetch_assoc($result)){
  						$demandstatus=$row['deamndstatus'];
  						$id=$row['deamndid'];
  						$description=strlen($row['description']);
  						if($description > 50){$extra="...";}
						if($demandstatus=='1'){
						  $class="";
						}
						else
						{
						   $class="class='danger'";
						}
  						echo "<tr $class>";
                echo'<td></td>';
  							echo '<td>'.$i++.'</td>';
               	echo "<td>".substr($row['description'],0,50).$extra."</td>";
               	echo "<td>".date('d-m-Y',strtotime($row['entry']))."</td><td>";
  							if($demandstatus=='1'){
                 	echo "<a onclick='demand(1,$id);' class='btn btn-danger' >Delete</a>";
  							}
  							else{
  							  echo "Deleted";
  							}
  							echo "&nbsp;<a data-toggle='modal'  class='btn btn-info' data-target='#modall$id' style='cursor:pointer;'>View</a></td>";
  						echo "</tr>";
  					  ?>						
  						<div class="modal fade opacity-8" id="modall<?php echo $id;?>">
                <div class="modal-dialog" >
                  <div class="modal-content">
  				          <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><center>View Demand</center></h4>
                    </div>
                    <div class="modal-body">
  			              <div class="row">
							<div class="col-sm-12">
							  <?php echo nl2br($row['description']);
							  ?>
							</div>
						  </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }
          ?>
        </tbody>
      </table>
    </div>
  </section>    
</body>
</html>
<div class="modal fade opacity-8" id="modal1">
  <div class="modal-dialog" >
    <div class="modal-content">
  		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Demands</h4>
      </div>
      <div class="modal-body">
	      <form  action="insertdemand.php" method="post" enctype="multipart/form-data">
			    <div class="row">
            <div class="col-sm-12">
		  	      <div class="form-group">
                <textarea class="form-control"  name="deamnd" id="deamnd" rows="5" required></textarea> 
              </div>
            </div>
			    </div>
		      <input type="submit" name="submit" class="btn btn-success" value="Submit" />
        </form>
      </div>
    </div>
  </div>
</div>
 <script>
	function demand(s,i)
   {
   bootbox.confirm("Are you sure?", function(result) {
    if (result== true) {
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
   				 bootbox.alert('Deamnd Updated Successfully..!!', function() {
   				 window.location.reload();
				 });
   			}			 
   	}
   		 http2.open("GET","delete_deamnd.php?id="+i+"&status="+s, true);
   		 http2.send(null);
    } else {
    
    }
	}); 
    }
</script>