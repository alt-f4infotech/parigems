<?php
   include "../common/header.php";
   ob_start();
   session_start();
   error_reporting(0);
		 $query="select * from raptable where id=".$_GET['id'];
		 $run=mysqli_query($con,$query);
		 $row=mysqli_fetch_assoc($run);
   ?>
 <section class="main-section">
   <div class="container-fluid crumb_top">
	  <ol class="breadcrumb" id="breadcrumb" style="color: black">
	      <li><a href="../common/homepage.php">Home</a></li>
	      <li><a href="../search/raptable.php">Raptable</a></li>
	      <li class="active">Edit Raprate</li>
	   </ol>
	<form action="updateraprate.php" method="post">
        <input class="form-control" value="<?php echo $_GET['id'];?>" type="hidden" name="id" >
        <fieldset>
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class=" form-group">
                        <label>Shape</label>
                        <input class="form-control" type="text" value="<?php echo $row['shape'];?>" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class=" form-group">
                        <label>Clarity</label>
                        <input class="form-control" type="text" value="<?php echo $row['clarity'];?>" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class=" form-group">
                        <label>Color</label>
                        <input class="form-control" type="text" value="<?php echo $row['color'];?>" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class=" form-group">
                        <label>Range</label>
                        <input class="form-control" type="text" value="<?php echo $row['raprangestart'].'-'.$row['raprangeend'];?>" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class=" form-group">
                        <label>Rap Rate</label>
                        <input class="form-control" type="text" value="<?php echo $row['rate'];?>" name="rate" onkeypress="return IsNumeric(event);">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </fieldset>
    </form>
   </div>
 </section>