<?php
include '../common/config.php';
ob_start();
session_start();
error_reporting(0);
?>
<div class="modal-body">
  <span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-sm-6">
            <label>Reason of Cancellation:</label>
            <textarea class="form-control" name="cancelreason"></textarea>
    </div>
  </div><br>
  <button type="submit" name="cancel" class="btn btn-primary"  onclick="return atleast_onecheckbox1()" >Submit</button>
  <br><br>
</div>