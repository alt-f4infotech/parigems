<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/config.php";;
$partycode=$_GET['partycode'];
$getpartyid="select * from party where partystatus='1'";
$partyres=mysqli_query($con,$getpartyid);
echo '<select name="partyid" id="partyid" onchange="getpartycode();" class="dropdownselect2" required>
<option value="">Select Party</option>';
while($p=mysqli_fetch_assoc($partyres)){
   if($partycode==$p['partyid'])
   {
  echo '<option value="'.$p['partyid'].'" selected>'.$p['companyname'].'</option>';
   }else{
  echo '<option value="'.$p['partyid'].'" >'.$p['companyname'].'</option>';
   }
}
echo '</select>';
?>