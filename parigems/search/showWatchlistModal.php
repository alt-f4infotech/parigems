<?php
ob_start();
session_start();
include '../common/config.php';
error_reporting(0);
$userid = $_SESSION['userid'];
?>
<span data-dismiss="modal" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>        
<div class="clearfix"></div>
<div class="row">
<form action="insertWatchlist.php" method="post">
<h4 class="text-center"><b>Watchlist</b></h4>
<hr>
   <div class="col-sm-12 form-group text-center">	  
	  <label><input type ="radio" name="showWatchlistDivName" value="existingWatchlist" onclick="showWatchlistDiv();" required> Existing Watchlist</label>
	  <label><input type ="radio" name="showWatchlistDivName" value="newWatchlist"  onclick="showWatchlistDiv();" required> New Watchlist</label>
   </div>
   <div class="col-xs-12 text-center">
   <div class="col-xs-6 form-group" style="display:none" id="existingWatchlistDIV">	  
	 <select class="form-control" name="existingValue" id="existingValue">
	  <option value="">Select Watchlist</option>
	  <?php
	  $getExistingWatchlist=mysqli_query($con,"select distinct watchlistName from wishlist where userid='$userid'");
	  while($row=mysqli_fetch_assoc($getExistingWatchlist))
	  {
		 if($row['watchlistName']!='')
		 {
		  echo '<option value="'.$row['watchlistName'].'">'.$row['watchlistName'].'</option>';
		 }
	  }
	  ?>
	 </select>
   </div>
   <div class="col-xs-6 form-group" style="display:none" id="newWatchlistDIV">	  
	 <input type="text" class="form-control" name="newValue" id="newValue">
   </div>
   <div class="col-xs-6">
    <div class="form-group">	  
	 <input type="submit" class="btn btn-success" value="submit">
   </div>
   </div>
   </div>
</form>
</div>
<script>
   

function showWatchlistDiv() {    
   showWatchlist=$("input[name='showWatchlistDivName']:checked"). val();
   if (showWatchlist=='existingWatchlist') {
    $("#existingWatchlistDIV").css("display","block");
    $("#newWatchlistDIV").css("display","none");
    $("#existingValue").attr("required", true);
    $("#newValue").attr("required", false);
   }
   else if (showWatchlist=='newWatchlist')
   {
   $("#existingWatchlistDIV").css("display","none"); 
   $("#newWatchlistDIV").css("display","block"); 
    $("#existingValue").attr("required", false);
    $("#newValue").attr("required", true);
   }
   else
   {
    $("#existingWatchlistDIV").css("display","none"); 
    $("#newWatchlistDIV").css("display","none"); 
    $("#existingValue").attr("required", false);
    $("#newValue").attr("required", false);
   }
}
</script>