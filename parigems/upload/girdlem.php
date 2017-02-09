<?php
include '../common/header.php';
error_reporting(0);
session_start();

?>

<section class="main-section">
    <div class="container-fluid crumb_top">
		<ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">View Girdle</li>
   </ol>
		<ul id="myTab" class="nav nav-tabs nav-tabs-bg">
        	<li class="active"><a href="#view"  data-target="#view" data-toggle="tab">View Girdle</a></li>
        	<li><a href="#add" data-target="#add" data-toggle="tab" >Add Girdle</a></li>
    	</ul>
		<div id="myTabContent" class="tab-content tab-content2">
			<div id="view" class="tab-pane fade in active">
	<div id="toolbar">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>	
                  <table class="table table-bordered" id="table" data-height="400"
		        data-show-columns="true"
               data-toggle="table"
			   data-search="true"
               data-show-export="true"
               data-pagination="true"
               data-click-to-select="true"
               data-toolbar="#toolbar"
			   data-show-refresh="true"
			   data-show-toggle="true"
			   data-show-columns="true">
						<thead>
						  <tr>
						  <th data-field="state" data-checkbox="true" ></th>
                           <th data-sortable="true">Sr.No.</th>
                           <th data-sortable="true">Girdle Name</th>
                           <th data-sortable="true">Status</th>
                           <th data-sortable="true">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i=1;
							 $certificteqry1="select * from girdle_min_max";
							 $certiresult1=mysqli_query($con,$certificteqry1);
							 while($row=mysqli_fetch_assoc($certiresult1))
							 {
							  $id=$row['id'];
							  $status=$row['status'];
							  if($status=='0'){$status1='Deactive';}
							  if($status=='1'){$status1='Active';}
						    echo "<tr>";
							echo '<td></td>';
                           	echo "<td>".$i++."</td>";
                           	echo "<td>".$row['girldle_min']."</td>";
                           	echo "<td>".$status1."</td>";
							if($status=='0'){ ?>
						<td><a class="btn btn-success"  onclick="unblock(<?php echo $id;?>)" >Active</a></td>
						<?php }else{ ?>
						<td><a class="btn btn-danger"  onclick="block(<?php echo $id;?>)" >Deactive</a></td>
                        <?php }?>
                           <?php
						   echo "</tr>";
                           }                           
                           ?>
                        </tbody>
                  </table>
			</div>
			<div id="add" class="tab-pane fade">
				<br>
				<form id="msform" class="form-horizontal" action="insertgirdlem.php" enctype="multipart/form-data" method="post" >
      <fieldset >
        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">                  
                  <label class="control-label col-sm-2">Girdle Name</label>
                  <div class="col-sm-10">   
                    <input type="text" name="name" id="name" onblur="optionvalidate('girdlem');" tabindex="1" required class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href="../common/homepage.php" >
          <input type="button" class="action-button" value="Cancel"/>
        </a>
        <input type="submit" name="submit" class="submit action-button" value="Save" />
      </fieldset>
    </form>
			</div>
		</div>
</div>
</section>
<script>
function block(i) {
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
                window.location.reload();
                }
   
   			}			 
   	}
   		 http2.open("GET","deletegirdlem.php?id="+i, true);
   		 http2.send(null);
    }
		 });
        }
		
		function unblock(i) {
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
                window.location.reload();
                }
   
   			}			 
   	}
   		 http2.open("GET","unblockgirdlem.php?id="+i, true);
   		 http2.send(null);
    }
			 });
        }
  </script>
  <?php
include "../common/footer.php";
?>