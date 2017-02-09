<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  ?>
<section class="main-section">
 <div class="container-fluid crumb_top">
  <ol class="breadcrumb" id="breadcrumb">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Update Diamond Discount</li>
   </ol>
<h3 align="center">Update Diamond Discount</h3>
<form action="insertUpdate.php" method="post" onsubmit="return atleast_onediamond();">
<div class="table-responsive">
<table class="table table-striped" id="table" data-height="400" data-toggle="table">
    <thead>
       <tr>
        <th><input type="checkbox" id="check_all"></th>
        <th data-sortable="true">PG Stock Id</th>
        <th data-sortable="true">Cert.No.</th>
        <th data-sortable="true">Shape</th>
        <th data-sortable="true">Size</th>
        <th data-sortable="true">Color</th>
        <th data-sortable="true">Clarity</th>
        <th data-sortable="true">Cut</th>
        <th data-sortable="true">Pol</th>
        <th data-sortable="true">Sym</th>
        <th data-sortable="true">Flr</th>
        <th data-sortable="true">Rap $</th>
        <th data-sortable="true">Old Discount</th>
        <th data-sortable="true">New Discount</th>
     </tr> 
    </thead>
	<tbody>
    <?php
    $getAllDiamonds=mysqli_query($con,"select * from diamond_master dm,diamond_sale ds where dm.diamond_id=ds.diamond_id and dm.diamond_status='1'");
    while($row=mysqli_fetch_assoc($getAllDiamonds))
    {
     $diamondId=$row['diamond_id'];
     $certificate_id=$row['certificate_id'];
    $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
    $certiresult=mysqli_query($con,$certificteqry);
    while($crow=mysqli_fetch_assoc($certiresult))
    {
     $certi_no=$crow['certi_no'];
    }
    $firstDiscount=$row['discount1'];
    if($firstDiscount < 0)
    {
     $Discount=$firstDiscount; 
    }
    else{
     $Discount='-'.$firstDiscount; 
    }
   ?>
   <tr>
    <td><input type="checkbox" class="case" name="check[]" value="<?php echo $diamondId;?>"></td>
    <td><?php echo $row['referenceno'];?></td>
    <td><?php echo $certi_no;?></td>
    <td><?php echo $row['diamond_shape'];?></td>
    <td><?php echo $row['weight'];?></td>
    <td><?php echo $row['color'];?></td>
    <td><?php echo $row['clarity'];?></td>
    <td><?php echo $row['cut'];?></td>
    <td><?php echo $row['polish'];?></td>
    <td><?php echo $row['symmetry'];?></td>
    <td><?php echo $row['fluoresence'];?></td>
    <td><?php echo '$'.$row['rap'];?></td>
    <td><?php echo $Discount;?></td>
    <td>
        <input type="text" name="eachDiscount[]" class="form-control eachDiscount" onkeyup="disableDiscount(this.value);">
        <input type="text" name="diamondId[]" value="<?php echo $diamondId;?>" class="form-control" style="display: none;">
    </td>
   </tr>
   <?php } ?>
    </tbody>
 </table>
</div><br>
 <div class="row">
    <div class="col-sm-4"><label>Discount : </label><input type="text" id="discount" name="discount" value="0" class="form-control" onkeyup="disableEachDiscount();"></div>
    <div class="col-sm-4"><br><input type="submit" value="Update" class="btn btn-success"></div>
 </div>
 </form>
</section>
<script>
    function disableDiscount(value) {
        if (value!='') {
         $("#discount").prop("readonly","readonly");
        }
        else{
         $("#discount").prop("readonly","");
        }
    }
    function disableEachDiscount() {
        if ($("#discount").val()!='') {
        $(".eachDiscount").prop("readonly","readonly");
        }
        else{
          $(".eachDiscount").prop("readonly","");  
        }
    }
function atleast_onediamond()
{
    if ($("input[name='check[]']:checked").length === 0) { 
    bootbox.alert("Please Select Diamond");
    return false;
    }
    else
    {
      return true;
    }
}
</script>
<?php
include "../common/footer.php";
?>