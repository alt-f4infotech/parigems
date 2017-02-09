<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  ?>
<section class="main-section">
<div class="container-fluid crumb_top">
<ol class="breadcrumb" id="breadcrumb">
  <li><a href="../common/homepage.php">Home</a></li>
  <li class="active">Assign Users</li>
</ol>
<h3 align="center">Assign Users</h3>
<form action="insertAssignUser.php" method="post">
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Select Employee</label>
            <select class="dropdownselect2" id="partyid2" name="employeeId" required>
                <option value="">Select Employee</option>
                <?php
                $employeeQry=mysqli_query($con,"select * from basic_details where usertype='SUBADMIN' and userstatus='1'");
                while($empRow=mysqli_fetch_assoc($employeeQry))
                {
                    if($empRow['companyname']!='')
                    {
                        $empName=$empRow['companyname'];
                    }
                    else{
                       $empName=$empRow['username']; 
                    }
                 echo '<option value="'.$empRow['userid'].'">'.$empName.'</option>';   
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Select Users</label><br>
            <?php
                $userQry=mysqli_query($con,"select * from basic_details where usertype='USER' and userstatus='1'");
                while($userRow=mysqli_fetch_assoc($userQry))
                {
                    $validate=mysqli_query($con,"select * from employee_user where userid='".$userRow['userid']."' and status='1'");
                    if(mysqli_num_rows($validate) > 0)
                    { }else
                    {
                        if($userRow['companyname']!='')
                    {
                        $userName=$userRow['companyname'];
                    }
                    else{
                       $userName=$userRow['username']; 
                    }
                    
                     echo '<label><input type="checkbox" name="userId[]" value="'.$userRow['userid'].'" required style="margin-left:5px;"> '.$userName.'</label>';
                    }
                }
            ?>
        </div>
    </div>
</div>
<div class="row">
   <center><input type="submit" class="btn btn-success" value="Submit"></center> 
</div>
</form>
</div>
 </section>
</body>
</html>
<?php
include "../common/footer.php";
?>