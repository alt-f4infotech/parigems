<?php include '../common/header.php';
$getid = encrypt_decrypt('decrypt', $_GET['id']);
$diamond_master="select * from diamond_master where diamond_id=".$getid;
$res=mysqli_query($con,$diamond_master);
$row=mysqli_fetch_assoc($res);

$certi_master="select * from certificate_master where certificateid=".$row['certificate_id'];
$certires=mysqli_query($con,$certi_master);
$crow=mysqli_fetch_assoc($certires);

$keyquery="select * from diamond_keysymbol where diamond_id=".$row['diamond_id'];
$keyres=mysqli_query($con,$keyquery);

$rapquery="select * from diamond_purchase where diamond_id=".$row['diamond_id'];
$rapres=mysqli_query($con,$rapquery);
$rrow=mysqli_fetch_assoc($rapres);

$rapsalequery="select * from diamond_sale where diamond_id=".$row['diamond_id'];
$rapsaleres=mysqli_query($con,$rapsalequery);
$srrow=mysqli_fetch_assoc($rapsaleres);
?>
<section class="main-section">
    <div class="container-fluid">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li><a href="../stock/stock.php">Stock</a></li>
        <li class="active">Diamond Details</li>
      </ol>
		<h3>Diamond Details</h3>
		<hr>
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					<label>PG Stock ID</label> : <?php echo $row['referenceno'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Lab Report</label> : <?php echo $crow['certi_name'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Certificate Number</label> : <?php echo $crow['certi_no'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Certificate Date</label> : <?php echo date('d-m-Y',strtotime($crow['certi_date']));?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Certificate Image</label> : <a  onclick="showAjaxModal(<?php echo $row['certificate_id'];?>);" >View Certificate</a></label>
				</div>
			</div>
		    <div class="col-sm-2">
				<div class="form-group">
					<label>Location</label> : <?php echo $row['location'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Diamond Shape</label> : <?php echo $row['diamond_shape'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Size/Carat</label> : <?php echo $row['weight'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Diamond Color</label> : <?php echo $row['color'];?>
				</div>
			</div>			
			<div class="col-sm-2">
				<div class="form-group">
					<label>Diamond Clarity</label> : <?php echo $row['clarity'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Fluorescence</label> : <?php echo $row['fluoresence'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Diamond Tinge</label> : <?php echo $row['tinge'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Cut</label> : <?php echo $row['cut'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Polish</label> : <?php echo $row['polish'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Symmetry</label> : <?php echo $row['symmetry'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>D1</label> : <?php echo $row['diameter_max'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>D2</label> : <?php echo $row['diameter_min'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Height</label> : <?php echo $row['height'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Diameter Ratio(DR)</label> : <?php echo $row['diameter_ratio'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Table </label> : <?php echo $row['table'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Depth </label> : <?php echo $row['depth'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Girdle </label> : <?php echo $row['girdlevalue'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Girdle Condition</label> : <?php echo $row['giddle'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Girdle Min-Max</label> : <?php echo $row['girdlemin'];?>-<?php echo $row['girdlemax'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Culet</label> : <?php echo $row['cutlet'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Crown Angle</label> : <?php echo $row['crown_angle'];?> &deg;
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Crown Height </label> : <?php echo $row['crown_height'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Pavilion Angle</label> : <?php echo $row['pavilion_angle'];?> &deg;
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Pavilion Depth </label> : <?php echo $row['pavilion_height'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Star Length </label> : <?php echo $row['length'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Lower Half </label> : <?php echo $row['lower_half'];?>%
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>H & A / Other</label> : <?php echo $row['H_A'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Milky</label> : <?php echo $row['milky'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Black Inclusion</label> : <?php echo $row['black_inclusion'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Brown Inclusion</label> : <?php echo $row['brown_inclusion'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Inclusive Visibility</label> : <?php echo $row['inclusive_visibility'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Type II A</label> : <?php echo $row['type_IIA'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Type II B</label> : <?php echo $row['type_IIB'];?>
				</div>
			</div>	
			
	</div>
			<h3>Key to Symbol Details</h3>
		<hr>
		<div class="row">
			<?php
				while($krow=mysqli_fetch_assoc($keyres)){ 
			?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php
						echo $krow['kysymbol'];	
					?>
				</div>
			</div>
			<?php
				}
			?>
		</div>
		<hr>
		<div class="row">			
			<div class="col-sm-3">
				<div class="form-group">
					<label>Additional  Comments</label> : <?php echo $row['comments'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Video Link</label> : <?php echo $row['videolink'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Purchase Stock Id</label> : <?php echo $row['purchase_stockid'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Laser Inscript</label> : <?php echo $row['isledger'];?>
				</div>
			</div>
			<?php if($row['isfancy']=='yes'){ ?>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Fancy Color Intensity</label> : <?php echo $row['fancyintensity'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Overtone / Modifier</label> : <?php echo $row['fancyovertone'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Fancy Color </label> : <?php echo $row['fancycolor1'];?>
				</div>
			</div>
			<?php } ?>
		</div>
		<h3>Purchase RAP Details</h3>
		<hr>
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					<label>Purchase Type</label> : <?php echo $rrow['ratetype'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Per Carat/RAP Rate</label> : <?php echo $rrow['rap'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Discount</label> : <?php echo $rrow['discount1'];?> %
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>P/C</label> : <?php echo $rrow['pc'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>LESS</label> : <?php echo $rrow['discount2'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>P A D</label> : <?php echo $rrow['pad'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA1</label> : <?php echo $rrow['discount3'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA Amount1</label> : <?php echo $rrow['extraamount1'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA2</label> : <?php echo $rrow['discount4'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Amount2</label> : <?php echo $rrow['extraamount2'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA3</label> : <?php echo $rrow['discount5'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Amount3</label> : <?php echo $rrow['extraamount3'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense1</label> : <?php echo $rrow['discount6'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount1</label> : <?php echo $rrow['expense1'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense2</label> : <?php echo $rrow['discount7'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount2</label> : <?php echo $rrow['expense2'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense3</label> : <?php echo $rrow['discount8'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount3</label> : <?php echo $rrow['expense3'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense4</label> : <?php echo $rrow['discount9'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount4</label> : <?php echo $rrow['expense4'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>FINAL</label> : <?php echo $rrow['final'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>USD</label> : <?php echo $rrow['usd'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Conv</label> : <?php echo $rrow['conv'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Conv</label> : <?php echo $rrow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Total Conv</label> : <?php echo $rrow['conv']+$rrow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>INR</label> : <?php echo $rrow['inr'];?>
				</div>
			</div>
		</div>
		<h3>Sell RAP Details</h3>
		<hr>
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					<label>Sell Type</label> : <?php echo $srrow['ratetype'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Per Carat/RAP Rate</label> : <?php echo $srrow['rap'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Discount</label> : <?php echo $srrow['discount1'];?> %
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>P/C</label> : <?php echo $srrow['pc'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>LESS</label> : <?php echo $srrow['discount2'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>P A D</label> : <?php echo $srrow['pad'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA1</label> : <?php echo $srrow['discount3'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Amount1</label> : <?php echo $srrow['extraamount1'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA2</label> : <?php echo $srrow['discount4'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Amount2</label> : <?php echo $srrow['extraamount2'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>EXTRA3</label> : <?php echo $srrow['discount5'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Amount3</label> : <?php echo $srrow['extraamount3'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense1</label> : <?php echo $srrow['discount6'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount1</label> : <?php echo $srrow['expense1'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense2</label> : <?php echo $srrow['discount7'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount2</label> : <?php echo $srrow['expense2'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense3</label> : <?php echo $srrow['discount8'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount3</label> : <?php echo $srrow['expense3'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense4</label> : <?php echo $srrow['discount9'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Expense Amount4</label> : <?php echo $srrow['expense4'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>FINAL</label> : <?php echo $srrow['final'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>USD</label> : <?php echo $srrow['usd'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Conv</label> : <?php echo $srrow['conv'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Extra Conv</label> : <?php echo $srrow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>Total Conv</label> : <?php echo $srrow['conv']+$srrow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label>INR</label> : <?php echo $srrow['inr'];?>
				</div>
			</div>
		</div>
	
	</div>
</section>
<script>
		function showAjaxModal(uid)
        {
		
		 $.get('viewcertificateimage.php?id=' + uid, function(html){
                 $('#myModal .modal-body').html(html);
                 $('#myModal').modal('show', {backdrop: 'static'});
             });
		}
	</script>
	<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;min-height: 1000px;">
    <div class="modal-dialog college-edit-modal-dialog">
      <!-- Modal content-->
      <div class="modal-content border-radius0">
	       <div class="modal-body" style="z-index: 10000;min-height: 1000px;"></div>
	    </div>
	  </div>
	</div>
<?php include '../common/footer.php';?>

