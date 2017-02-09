<?php
  ob_start();
  error_reporting(0);
  session_start();
  include "../common/config.php";
  $id=$_GET['id'];
  $certino=$_GET['certino'];
  function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
  ?>
<div class="modal-body">
  <span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-sm-12">
      <center>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h3  class="control-label">Certificate List</h3>
              <div class="col-sm-12">
              <div class="table-responsive">
                <input type="button" onclick="$('#modalButton').click();" value="submit" class="btn btn-success">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Certificate Number</th>
                      <th>Certificate Type</th>
                      <th>Carat</th>
                      <th>Clarity</th>
                      <th>CUT</th>
                      <th>Polish</th>
                      <th>Symmetry</th>
                    </tr>
                  </thead>
                  <?php
                   $k=1;$error=0;
                    $getid="select d.* from diamond_master d,purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1' and pp.diamond=d.diamond_id";
                    $result=mysqli_query($con,$getid);
                      while($c=mysqli_fetch_assoc($result))
                     {
                    $getid1="select pp.* from purchaseinvoice_product_dummy pp,purchaseinvoice_dummy p where p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1' and pp.diamond=".$c['diamond_id'];
                    $result1=mysqli_query($con,$getid1);
                     if(mysqli_num_rows($result1) > 0)
                    {
                      $error=$error+1;
                    }
                    else{
                     $error=0;
                    $certi_master="select * from certificate_master where certificateid=".$c['certificate_id'];
                    $certires=mysqli_query($con,$certi_master);
                    while($crow=mysqli_fetch_assoc($certires)){
                      
                      $rapquery="select * from diamond_purchase where diamond_id=".$c['diamond_id'];
                      $rapres=mysqli_query($con,$rapquery);
                      $rrow=mysqli_fetch_assoc($rapres);
                      if($rrow['inr']=='0')
                      { $INR=$rrow['usd'];}else{ $INR=$rrow['inr']; }
                      $encrypted_txt = encrypt_decrypt('encrypt', $c['diamond_id']);
                    echo '<tr>';
                    echo '<td>';
                            if($certino== $c['diamond_id']){?>
                              <label class="radio-inline">
                                <input type="checkbox" name="certiid" id="certiid_<?php echo $k;?>" value="<?php echo $c['diamond_id'];?>" checked><?php echo $crow['certi_no'].'/'.$c['referenceno'];
                              echo '</label>';
                            }
                            else{?>
                              <label class="radio-inline">
                                <input type="checkbox" name="certiid" id="certiid_<?php echo $k;?>" value="<?php echo $c['diamond_id'];?>"><?php echo $crow['certi_no'].'/'.$c['referenceno'];
                              echo '</label>';
                            }
                    echo '</td>';
                    echo '<td><a href="../diamond_upload/view_diamond.php?id='.$encrypted_txt.'" target="_blank">'.$crow['certi_name'].'</a></td>';
                    echo '<td>'.$c['weight'].'</td>';
                    echo '<td>'.$c['clarity'].'</td>';
                    echo '<td>'.$c['cut'].'</td>';
                    echo '<td>'.$c['polish'].'</td>';
                    echo '<td>'.$c['symmetry'].'</td>';
                    echo '</tr>';
                    echo "<input type='text' value='".$crow['certi_no']."' style='display:none;' id='certi_no_$k'>";
                    echo "<input type='text' value='".$crow['certi_name']."' style='display:none;' id='certi_name_$k'>";
                    echo "<input type='text' value='".$c['weight']."' style='display:none;' id='weight_$k'>";
                    echo "<input type='text' value='".$c['clarity']."' style='display:none;' id='clarity_$k'>";
                    echo "<input type='text' value='".$c['cut']."' style='display:none;' id='cut_$k'>";
                    echo "<input type='text' value='".$c['polish']."' style='display:none;' id='polish_$k'>";
                    echo "<input type='text' value='".$c['symmetry']."' style='display:none;' id='symmetry_$k'>";
                    echo "<input type='text' value='".$INR."' style='display:none;' id='purchaserate_$k'>";
                    $k++;  }
                    }
                    }
                    if($error > 0)
                    {
                     // echo '<tr><td colspan="7">No Certificate Found.</td></tr>';
                    }
                                  ?>
                </table>
                <input type="button" value="submit" id="modalButton" data-dismiss="modal" onclick="putid(<?php echo $id;?>,<?php echo $k;?>)" class="btn btn-success">
              </div>
            </div>
            </div>
          </div>
        </div>
      </center>
    </div>
  </div>
</div>
<!--<script src="../js/purchaseregular2.js"></script>-->