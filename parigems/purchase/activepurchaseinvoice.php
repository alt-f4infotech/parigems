<?php
  ob_start();
  error_reporting(0);
  session_start();
  include "../common/config.php";
  $id=$_GET['id'];
  
  $count=0;
 $checkdiamond="select * from purchaseinvoice_product where purchase_invoiceid='$id'";
 $result=mysqli_query($con,$checkdiamond);
 while($c=mysqli_fetch_assoc($result))
                     {
                    $getid1="select pp.* from purchaseinvoice_product pp,purchaseinvoice p where p.purchase_invoiceid=pp.purchase_invoiceid and p.purchasestatus='1' and pp.diamond=".$c['diamondid'];
                    $result1=mysqli_query($con,$getid1);
                     if(mysqli_num_rows($result1) > 0)
                    {
					  $count=$count+1;
                    }
                    else{ $count=0; }
					}
					if($count==0){
					$changestatus="update purchaseinvoice set purchasestatus='1' where purchase_invoiceid='$id'";
					if(mysqli_query($con,$changestatus))
					  {
						
						   echo str_replace(' ', '', 1);
					  }
					}
					 
 ?>