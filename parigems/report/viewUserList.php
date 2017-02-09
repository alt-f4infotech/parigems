<?php
include '../common/config.php';
ob_start();
session_start();
error_reporting(0);

$getUserList=mysqli_query($con,"select * from basic_details where usertype='USER' and userstatus='1'");
?>
<div class="modal-body">
  <span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-sm-6">
            <label>Select User:</label>
            <select class="dropdownselect2" name="customer" id="customer">
                <option value="">Select User</option>
                <?php
                while($row=mysqli_fetch_assoc($getUserList))
                {?>
                <option value="<?php echo $row['userid'];?>"><?php echo $row['companyname'];?></option>
                <?php } ?>
            </select>
    </div>
  </div><br>
  <button type="submit" name="assign" class="btn btn-primary"  onclick="return atleast_onecheckbox1()" >Submit</button>
  <br><br>
</div>