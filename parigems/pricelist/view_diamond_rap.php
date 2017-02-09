<?php include '../common/header.php';
$encrypted_txt = encrypt_decrypt('decrypt', $_GET['id']);
$diamond_master="select * from diamond_master where diamond_id=".$encrypted_txt;
$res=mysqli_query($con,$diamond_master);
$row=mysqli_fetch_assoc($res);

$certi_master="select * from certificate_master where certificateid=".$row['certificate_id'];
$certires=mysqli_query($con,$certi_master);
$crow=mysqli_fetch_assoc($certires);

$rapquery="select * from diamond_purchase where diamond_id=".$row['diamond_id'];
$rapres=mysqli_query($con,$rapquery);
$rrow=mysqli_fetch_assoc($rapres);

$rapsalequery="select * from diamond_sale where diamond_id=".$row['diamond_id'];
$rapsaleres=mysqli_query($con,$rapsalequery);
$srrow=mysqli_fetch_assoc($rapsaleres);
?>

<section class="main-section">
	<div class="container-fluid">
		<h3>RAP Purchase Details</h3>
		<hr>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>Rap</label> : <?php echo $rrow['rap'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount1</label> : <?php echo $rrow['discount1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>PC</label> : <?php echo $rrow['pc'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount2</label> : <?php echo $rrow['discount2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Pad</label> : <?php echo $rrow['pad'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount3</label> : <?php echo $rrow['discount3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Extra Amount1</label> : <?php echo $rrow['extraamount1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount4</label> : <?php echo $rrow['discount4'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Extra Amount2</label> : <?php echo $rrow['extraamount2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount5</label> : <?php echo $rrow['discount5'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Extra Amount3</label> : <?php echo $rrow['extraamount3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount6</label> : <?php echo $rrow['discount6'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense1</label> : <?php echo $rrow['expense1'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount7</label> : <?php echo $rrow['discount7'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense2</label> : <?php echo $rrow['expense2'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount8</label> : <?php echo $rrow['discount8'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense3</label> : <?php echo $rrow['expense3'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Discount9</label> : <?php echo $rrow['discount9'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Expense4</label> : <?php echo $rrow['expense4'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Final</label> : <?php echo $rrow['final'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>USD</label> : <?php echo $rrow['usd'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Conv</label> : <?php echo $rrow['conv'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>Extra Conv</label> : <?php echo $rrow['extraconv'];?>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>INR</label> : <?php echo $rrow['inr'];?>
				</div>
			</div>
		</div>
		<h3>RAP Sale Details</h3>
		<hr>
		<form action="editsalerap.php" method="post">
		<div class="row">
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>RAP</label>
									<div class="row">
										<div class="col-sm-6">
											<input type="text" value="<?php echo $srrow['rap'];?>" name="slrap" id="slrap" class="form-control slcal1" required onkeypress="return IsNumeric(event);" >
										</div>
										<div class="col-sm-6">
											<input type="text" value="<?php echo $row['weight'];?>" name="weight" id="weight" class="form-control slcal1">
										</div>
									</div>								
									<input type="hidden" value="<?php echo $encrypted_txt;?>" name="diamond_id" id="diamond_id" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Discount %</label>
									<input type="text" value="<?php echo $srrow['discount1'];?>" name="sldiscount1" id="sldiscount1" class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>P/C</label>
									<input type="text" value="<?php echo $srrow['pc'];?>" tabindex="-1" name="slpc" id="slpc" class="form-control" required onkeypress="return IsNumeric(event);" readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>LESS</label>
									<input type="text" value="<?php echo $srrow['discount2'];?>" name="sldiscount2" id="sldiscount2" class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>P A D</label>
									<input type="text" value="<?php echo $srrow['pad'];?>" name="slpad" id="slpad" class="form-control slcal1" onkeypress="return IsNumeric(event);" tabindex="-1" readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>EXTRA1</label>
									<input type="text" value="<?php echo $srrow['discount3'];?>" name="sldiscount3" id="sldiscount3" class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>EXTRA Amount 1</label>
									<input type="text" value="<?php echo $srrow['extraamount1'];?>" name="slextraamt" id="slextraamt" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>EXTRA2</label>
									<input type="text" value="<?php echo $srrow['discount4'];?>" name="sldiscount4" id="sldiscount4" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>EXTRA Amount 2</label>
									<input type="text" value="<?php echo $srrow['extraamount2'];?>" name="slextraamt2" id="slextraamt2" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>EXTRA3</label>
									<input type="text" value="<?php echo $srrow['discount5'];?>" name="sldiscount5" id="sldiscount5" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>EXTRA Amount 3</label>
									<input type="text" value="<?php echo $srrow['extraamount3'];?>" name="slextraamt3" id="slextraamt3" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense 1</label>
									<input type="text" value="<?php echo $srrow['discount6'];?>" name="sldiscount6" id="sldiscount6" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 1</label>
									<input type="text" value="<?php echo $srrow['expense1'];?>" name="slexpamt1" id="slexpamt1" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense2</label>
									<input type="text" value="<?php echo $srrow['discount7'];?>" name="sldiscount7" id="sldiscount7" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 2</label>
									<input type="text" value="<?php echo $srrow['expense2'];?>" name="slexpamt2" id="slexpamt2" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense3</label>
									<input type="text" value="<?php echo $srrow['discount8'];?>" name="sldiscount8" id="sldiscount8" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 3</label>
									<input type="text" value="<?php echo $srrow['expense3'];?>" name="slexpamt3" id="slexpamt3" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense4</label>
									<input type="text" value="<?php echo $srrow['discount9'];?>" name="sldiscount9" id="sldiscount9" class="form-control slcal1" onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Expense Amount 4</label>
									<input type="text" value="<?php echo $srrow['expense4'];?>" name="slexpamt4" id="slexpamt4" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>FINAL</label>
									<input type="text" value="<?php echo $srrow['final'];?>" name="slfinal" id="slfinal" class="form-control slcal1" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>USD</label>
									<input type="text" value="<?php echo $srrow['usd'];?>" name="slusd" id="slusd" tabindex="-1" readonly class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Conv</label>
									<input type="text" value="<?php echo $srrow['conv'];?>" name="slconv" id="slconv" class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Extra Conv</label>
									<input type="text" value="<?php echo $srrow['extraconv'];?>" name="slextraconv" id="slextraconv"  class="form-control slcal1"  >
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>Total Conv</label>
									<input type="text" value="<?php echo $srrow['conv']+$srrow['extraconv'];?>" name="sltotalconv" id="sltotalconv" class="form-control slcal1"  readonly>
								</div>
							</div>
							<div class="col-sm-2">
	    						<div class=" form-group">
									<label>INR</label>
									<input type="text" value="<?php echo $srrow['inr'];?>" name="slinr" id="slinr" class="form-control" tabindex="-1" readonly onkeypress="return IsNumeric(event);" >
								</div>
							</div>
						</div>
		<button type="submit" class="btn btn-success">Submit</button>
				</form>
	</div>
</section>
<?php include '../common/footer.php';?>

