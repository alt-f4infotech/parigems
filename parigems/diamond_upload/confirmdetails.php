<?php
include '../common/config.php';
ob_start();
   session_start();
   error_reporting(0);

?>
<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
<br>
	<fieldset>
	    				<div class="row">
							<!--<div class="col-md-3 col-sm-6">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">PG Stock ID:</label>
			  						<?php //echo $_GET['referenceno'];?>
			  					</div>
	    					</div>-->
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Lab Report:</label>
									<?php echo $_GET['certi_name'];?>
								</div>
							</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Certificate Number:</label>
			  						<?php echo $_GET['certi_no'];?>
								  </div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Certificate Date:</label>
	    							<?php echo $_GET['certi_date'];?>
								</div>
	    					</div>							
							
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Location:</label>
									<?php echo $_GET['location'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Diamond Shape:</label>
									<?php echo $_GET['diamond_shape1'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Size/Carat:</label>
			  						<?php echo $_GET['weight1'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Diamond Color:</label>
									<?php echo $_GET['color1'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Diamond Clarity:</label>
									<?php echo $_GET['clarity1'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Diamond Fluorescence:</label>
									<?php echo $_GET['fluoresence'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Diamond Tinge:</label>
									<?php echo $_GET['tinge'];?>
								</div>
	    					</div>
							
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Cut:</label>
									<?php echo $_GET['cut'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Polish:</label>
									<?php echo $_GET['polish'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Symmetry:</label>
									<?php echo $_GET['symmetry'];?>		
								</div>
	    					</div>
							
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">D1:</label>
			  						<?php echo $_GET['diameter_max'];?>
								</div>
	    					</div>	    				
	    					<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">D2:</label>
			  						<?php echo $_GET['diameter_min'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Height:</label>	    						
			  						<?php echo $_GET['height'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">DR:</label>
			  						<?php echo $_GET['dratio'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label style="font-weight: bold;">Table %:</label>
			  						<?php echo $_GET['table'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Depth %:</label>
			  						<?php echo $_GET['depth'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Girdle %:</label>
			  						<?php echo $_GET['girdlevalue'];?>
								</div>
	    					</div>	
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label style="font-weight: bold;">Girdle Condition:</label>
									<?php echo $_GET['giddle'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label style="font-weight: bold;">Girdle Min/Max:</label>
			  						<div class="row">
			  							<div class="col-sm-6">
			  								<?php echo $_GET['giddlemin'];?> - 
			  								<?php echo $_GET['giddlemax'];?>
			  							</div>
			  						</div>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">	    							
			  						<label style="font-weight: bold;">Culet:</label>
									<?php echo $_GET['cutlet'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Crown Angle &deg;:</label>
			  						<?php echo $_GET['crown_angle'];?>
								</div>
	    					</div>
	    					<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Crown Height %:</label>
			  						<?php echo $_GET['crown_height'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Pavilion Angle &deg;:</label>
			  						<?php echo $_GET['pavilion_angle'];?>
								</div>
	    					</div>
	    					<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Pavilion Depth %:</label>
			  						<?php echo $_GET['pavilion_height'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;"> Star Length %:</label>
			  						<?php echo $_GET['length'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Lower Half %:</label>
			  						<?php echo $_GET['lowerhalf'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">H & A / Others:</label>
			  						<?php echo $_GET['H_A'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Milky:</label>
									<?php echo $_GET['milky'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Black Inclusion:</label>
									<?php echo $_GET['black_inclusion'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Brown Inclusion:</label>
									<?php echo $_GET['brown_inclusion'];?>
								</div>
	    					</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Inclusion Visibility:</label>
			  						<?php echo $_GET['inclusive_visibility'];?>
								</div>
	    					</div>
							<div class="col-sm-12">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Key To Symbol:</label>
									<?php echo $_GET['keysymbol'];?>
								</div>
	    					</div>
	    					<div class="clearfix"></div>
							<div class="col-sm-6">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Additional Comments:</label>
			  						<?php echo $_GET['comments'];?>		  						
								</div>
	    					</div>
							<div class="col-sm-6">
	    						<div class=" form-group">
			  						<label style="font-weight: bold;">Video Link:</label>
			  						<?php echo $_GET['videolink'];?>		  						
								</div>
	    					</div>
							<div class="col-sm-6">
								<div class=" form-group">
							  		<label for="invoiceno">Purchase Stock Id:</label>
									<?php echo $_GET['purchase_stockid'];?>
								</div>
							</div>
							<div class="col-md-3 col-sm-4">
	    						<div class=" form-group">
	    							<label style="font-weight: bold;">Laser Inscript:</label>
	    							<?php echo $_GET['ledger'];?>
								</div>
	    					</div>
	    				</div>
						<div class="row">
							<div class="col-sm-12">
									<div class="col-sm-4">
										<label style="font-weight: bold;">Fancy Color Intensity:</label>
				  						<?php echo $_GET['fancyintensity'];?>
								     </div>
									<div class="col-sm-4">
										<label style="font-weight: bold;">Overtone / Modifier:</label>
										<?php echo $_GET['fancyovertone'];?>
								     </div>
									<div class="col-sm-4">
										<label style="font-weight: bold;">Fancy Color :</label>
				  						<?php echo $_GET['fancycolor1'];?>		
								     </div>
	    					</div>
						</div>
                        <h3 class="text-left">Purchase Details</h3>
						<hr>					
						<div class="row">
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label style="font-weight: bold;">Purchase Type:</label><br>
									<?php echo $_GET['rapratecarat'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Per Carat/RAP Rate:</label>
									<?php echo $_GET['rap'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount %:</label>
									<?php echo $_GET['discount1'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">P/C:</label>
									<?php echo $_GET['pc'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">LESS:</label>
									<?php echo $_GET['discount2'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">P A D:</label>
									<?php echo $_GET['pad'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount 1:</label>
									<?php echo $_GET['discount3'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">D A 1:</label>
									<?php echo $_GET['extraamt'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount 2:</label>
									<?php echo $_GET['discount4'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">D A 2:</label>
									<?php echo $_GET['extraamt2'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount 3:</label>
									<?php echo $_GET['discount5'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">D A 3:</label>
									<?php echo $_GET['extraamt3'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense 1:</label>
									<?php echo $_GET['discount6'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 1:</label>
									<?php echo $_GET['expamt1'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense2:</label>
									<?php echo $_GET['discount7'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 2:</label>
									<?php echo $_GET['expamt2'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense3:</label>
									<?php echo $_GET['discount8'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 3:</label>
									<?php echo $_GET['expamt3'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense4:</label>
									<?php echo $_GET['discount9'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 4:</label>
									<?php echo $_GET['expamt4'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">FINAL:</label>
									<?php echo $_GET['final'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">USD:</label>
									<?php echo $_GET['usd'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Conv:</label>
									<?php echo $_GET['conv'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Extra Conv:</label>
									<?php echo $_GET['extraconv'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Total Conv:</label>
									<?php echo $_GET['totalconv'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">INR:</label>
									<?php echo $_GET['inr'];?>
								</div>
							</div>
						</div>
						<hr>
						<h3>Selling Details</h3>
						<div class="row">
							<div class="col-md-2 col-sm-3 min-height74">
		    					<div class=" form-group">
									<label style="font-weight: bold;">Sale Type:</label><br>
									<?php echo $_GET['slrapratecarat'];?>
								</div>
							</div>
							
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Per Carat/RAP Rate:</label>
									<?php echo $_GET['slrap'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount %:</label>
									<?php echo $_GET['sldiscount1'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">P/C:</label>
									<?php echo $_GET['slpc'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">LESS:</label>
									<?php echo $_GET['sldiscount2'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">P A D:</label>
									<?php echo $_GET['slpad'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount 1:</label>
									<?php echo $_GET['sldiscount3'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">D A 1:</label>
									<?php echo $_GET['slextraamt'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount 2:</label>
									<?php echo $_GET['sldiscount4'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">D A 2:</label>
									<?php echo $_GET['slextraamt2'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Discount 3:</label>
									<?php echo $_GET['sldiscount5'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">D A 3:</label>
									<?php echo $_GET['slextraamt3'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense 1:</label>
									<?php echo $_GET['sldiscount6'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 1:</label>
									<?php echo $_GET['slexpamt1'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense2:</label>
									<?php echo $_GET['sldiscount7'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 2:</label>
									<?php echo $_GET['slexpamt2'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense3:</label>
									<?php echo $_GET['sldiscount8'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 3:</label>
									<?php echo $_GET['slexpamt3'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense4:</label>
									<?php echo $_GET['sldiscount9'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Expense Amount 4:</label>
									<?php echo $_GET['slexpamt4'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">FINAL:</label>
									<?php echo $_GET['slfinal'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">USD:</label>
									<?php echo $_GET['slusd'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Conv:</label>
									<?php echo $_GET['slconv'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Extra Conv:</label>
									<?php echo $_GET['slextraconv'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">Total Conv:</label>
									<?php echo $_GET['sltotalconv'];?>
								</div>
							</div>
							<div class="col-md-2 col-sm-3">
	    						<div class=" form-group">
									<label style="font-weight: bold;">INR:</label>
									<?php echo $_GET['slinr'];?>
								</div>
							</div>
						</div>
                        <button type="submit" class="btn btn-success">Submit</button>
                         <button data-dismiss="modal"  class="btn btn-primary">Cancel</button>
    </fieldset>
			
	