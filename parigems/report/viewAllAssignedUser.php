<?php
  include '../common/header.php';
?>
<section class="main-section">
<div class="container-fluid crumb_top">
<ol class="breadcrumb" id="breadcrumb">
    <li><a href="../common/homepage.php">Home</a></li>
    <li class="active">View Assigned Users</li>
 </ol>
<h3 align="center">View Assigned Users</h3>
<div class="table-responsive">
<table class="table table-striped" id="table" data-height="400" data-show-columns="true" data-toggle="table" data-search="true" data-show-export="true">
<thead>
  <tr>
     <th data-sortable="true">User Name</th>
      <th data-sortable="true">Employee Name</th>
  </tr>
</thead>
<tbody>
<?php
$userList=mysqli_query($con,"select b.companyname,e.employeeId from employee_user e,basic_details b where e.userid=b.userid and e.status='1'");
while($row=mysqli_fetch_assoc($userList))
{
    $employeeQry=mysqli_query($con,"select * from basic_details where userid=".$row['employeeId']);
    $empRow=mysqli_fetch_assoc($employeeQry);
    if($empRow['companyname']!='')
    {
        $empName=$empRow['companyname'];
    }
    else{
       $empName=$empRow['username']; 
    }
    
    if($row['companyname']!='')
    {
        $userName=$row['companyname'];
    }
    else{
       $userName=$row['username']; 
    }
    echo "<tr>";
    echo "<td>".$userName."</td>";
    echo "<td>".$empName."</td>";
    echo "</tr>";
} ?>
</tbody>
</table>
</div>
</div>
 </section>
<?php
include "../common/footer.php";
?>