<?php
include '../common/config.php';
ob_start();
   session_start();
   error_reporting(0);
$certi_id=$_GET['certi_id'];
$certificteqry="select * from certificate_master where certificateid=$certi_id";
							 $certiresult=mysqli_query($con,$certificteqry);
							 while($crow=mysqli_fetch_assoc($certiresult))
							 {
							  $lab=$crow['certi_name'];
							  $certi_no=$crow['certi_no'];
							  $reportno=$crow['report_no'];
							  $logo=$crow['logo'];
							  $splitName = explode(".", $crow['logo']);
							   $type=$splitName[1];
							 }
?>
<div class="modal-body">
	<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>        
  <div class="clearfix"></div>
  <div class="form-horizontal">
  	<div class="row">
  		<div class="col-sm-12">
      <?php
					if($type=='jpg' || $type=='png' || $type=='gif'|| $type=='jpeg'){ ?>
        <img src="../diamond_upload/<?php echo $logo;?>" width="550px" height="600px">
		<?php }else{?>
		<embed src="../diamond_upload/<?php echo $logo;?>" width="550px" height="600px">
		<?php } ?>
  	  </div>
    </div>
  </div>
</div>