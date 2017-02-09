<?php include '../common/header.php';
  $gettotal="select SUM(total) as total from invoice where userid='$userid' and status='1'";
  $res=mysqli_query($con,$gettotal);
  $row=mysqli_fetch_assoc($res);
  $getpaytotal="select SUM(amount) as payamount from payment_receipt where partyid='$userid' and status='1'";
  $pres=mysqli_query($con,$getpaytotal);
  $prow=mysqli_fetch_assoc($pres);
  
   $totaldiamonds=mysqli_query($con,"select d.*,l.username from  diamond_master d,login l,certificate_master c,diamond_sale dp where 1 and d.diamond_id=dp.diamond_id and d.diamond_status='1' and  d.added_by=l.userid and c.certificateid=d.certificate_id  order by d.entrydate ASC");
?>
<?php
  if($role=='USER'){
	$getEmployeeName=mysqli_query($con,"select b.* from employee_user e,basic_details b where e.userid='$userid' and e.employeeId=b.userid and e.status='1'");
    if(mysqli_num_rows($getEmployeeName) > 0)
	{
	  $empRow=mysqli_fetch_assoc($getEmployeeName);
	  $employeeName=$empRow['username'];
	  $employeeNumber=$empRow['phoneno'];
	  $employeeEmail=$empRow['emailid'];
	}
?>
<body class="layout2">
  <section class="main-section">
    <div class="container-fluid">  
      <ul class="dashboard-ul">
		
        <!--<li class="yellow">
          <a href="../common/myprofile.php">
            <div class="list-top">
              <p class="margin0 pull-left">View Profile</p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-1.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/view-profile.png" alt="view-profile">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">View Profile</p>
              <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>-->
        <li class="yellow darkblue">
          <a href="../search/search.php">
            <div class="list-top">
              <?php
                      $count1=0;
                      $query1="SELECT distinct(d.diamond_id) FROM `diamond_master` d,diamond_sale dp WHERE 1 and d.diamond_id=dp.diamond_id and d.diamond_status='1'  and d.portalshow='portalyes'" ;
                      $result1=mysqli_query($con,$query1);
                     while($rw1=mysqli_fetch_assoc($result1))
                     {
                      $getraprates="SELECT * FROM `diamond_sale` where diamond_id=".$rw1['diamond_id'];
						$getrapratesresult=mysqli_query($con,$getraprates);
						$raprow=mysqli_fetch_assoc($getrapratesresult);
                        if($raprow['rap']!='0'){
                          $count1++;
                        }
                     }
                      ?>
              <p class="margin0 pull-left">Search Diamonds <span class="badge"><?php echo $count1;?></span></p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-2.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/search.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Search Diamonds</p>
              <span class="glyphicon glyphicon-arrow-right pull-right arrow_hide" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
        <li class="yellow dark lightred">
          <a href="../search/wishlist.php">
            <div class="list-top">
               <?php
                $count10=0;
                $query10="select i.*,d.*,dp.rap,dp.discount1,dp.discount2,dp.discount3,dp.final from wishlist i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id and i.diamondid=d.diamond_id and i.userid='$userid' and i.wishstatus='1'" ;
                $result10=mysqli_query($con,$query10);
               while($rw10=mysqli_fetch_assoc($result10))
               {
                    $count10++;
               }
                ?>
              <p class="margin0 pull-left">Watch List <span class="badge"><?php echo $count10;?></span></p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-4.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/wishlist.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Watch List</p>
              <span class="glyphicon glyphicon-arrow-right pull-right arrow_hide" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
       
	    <!--<li class="yellow lightred">
		  <a href="../search/matching_pair.php">
			<div class="list-top">
			  <p class="margin0 pull-left">Matching Pair Diamond</p>
			  <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-4.png">
			  <div class="clearfix"></div>
			</div>
			<div class="list-middle">
			  <img class="img-responsive" src="../images/user/search-matching-pair.png">
			</div>
			<div class="list-bottom">
			  <p class="margin0 pull-left">Matching Pair Diamond</p>
			  <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
			  <div class="clearfix"></div>
			</div>
		  </a>        
		</li>-->
       <li class="yellow parrotgreen">
          <a href="../search/holded.php">
            <div class="list-top">
			  <?php
			  $countHoldedDiamonds=mysqli_query($con,"select i.*,d.*,dp.rap,dp.discount1,dp.discount2,dp.discount3,dp.final from diamond_status i,diamond_master d,diamond_sale dp where d.diamond_id=dp.diamond_id and i.diamondid=d.diamond_id and i.userid='$userid' and i.diamond_status='HOLD'");
			  ?>
              <p class="margin0 pull-left">Holded Diamonds <span class="badge"><?php echo mysqli_num_rows($countHoldedDiamonds);?></span></p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-6.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
             <img class="img-responsive" src="../images/homepage_icon/holded-diamond.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">My Holded Diamonds</p>
              <span class="glyphicon glyphicon-arrow-right pull-right arrow_hide" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
	    <li class="yellow purple">
          <a href="../search/historyorder.php">
            <div class="list-top">
              <?php
                $count11=0;
                $query11="select * from invoice where userid='$userid' and status='1'" ;
                $result11=mysqli_query($con,$query11);
               while($rw11=mysqli_fetch_assoc($result11))
               {
				$certificteqry12="select sum(ip.amount) as total, SUM(ip.qty) as qty,SUM(d.weight) as weight,ip.deliverystatus from invoice_product ip,diamond_master d where ip.userid='$userid' and d.diamond_id=ip.diamondid and (ip.deliverystatus='1' OR ip.deliverystatus is NULL) and ip.invoiceid=".$rw11['invoiceid'];
	          $certiresult12=mysqli_query($con,$certificteqry12);
	          while($row2=mysqli_fetch_assoc($certiresult12))
	          {
	          $qty=$row2['qty'];
			  }
			  if($qty > 0)
			 { 
                    $count11++;
			 }
               }
                ?>
              <p class="margin0 pull-left">Order History <span class="badge"><?php echo $count11;?></span></p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-5.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/order-history.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Order History</p>
              <span class="glyphicon glyphicon-arrow-right pull-right arrow_hide" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
        <!--<li class="yellow parrotgreen">
          <a href="../report/myledger.php">
            <div class="list-top">
              <p class="margin0 pull-left">Ledger</p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-6.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/ledger.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Ledger</p>
              <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>-->
        <div class="clearfix"></div>
      </ul>
    </div>

  </section>
</body>
<?php 
  } 
else if($role!='ADJUST')
  {
?>
<body class="layout2">
  <section class="main-section main-section2">
    <div class="container-fluid">
      <div class="jcarousel-wrapper" id="jcarousel-wrapper2">
        <div class="jcarousel " id="jcarousel2">
          <ul class="main-ul">
            <li>
              <ul class="dashboard-ul">
                <li class="yellow">
                  <a href="../diamond_upload/diamond.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Upload Diamond</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-1.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/upload.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Go to Upload Diamond </p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
				<li class="yellow darkpink">
                  <a href="../report/diamond.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Diamonds <span class="badge"><?php echo mysqli_num_rows($totaldiamonds);?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-12.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/all-diamonds.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Go to Diamonds</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
				<li class="yellow lightred">
                  <a href="../stock/vieworder.php">
                    <div class="list-top">
                       <?php
                      $count3=0;
                      $query3="SELECT sum(i.amount) as total FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and  i.pstatus='2' group by i.invoiceid" ;
                      $result3=mysqli_query($con,$query3);
                     while($rw3=mysqli_fetch_assoc($result3))
                     {
                          $count3++;
                     }
                      ?>
                      <p class="margin0 pull-left">Orders <span class="badge"><?php echo $count3;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-4.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/order.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View All Orders </p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                 <li class="yellow skyblue">
                  <a href="../stock/viewpendingorder.php">
                    <div class="list-top">
                      <?php
                      $count6=0;
                      $query6="SELECT i.* FROM diamond_master d,invoice_product i,login l where i.diamondid=d.diamond_id and l.userid=i.userid and i.pstatus='2' and i.deliverystatus is NULL group by i.invoiceid" ;
                      $result6=mysqli_query($con,$query6);
                     while($rw6=mysqli_fetch_assoc($result6))
                     {
                          $count6++;
                     }
                      ?>
                      <p class="margin0 pull-left">Delivery Orders <span class="badge"><?php echo $count6;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-8.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/pending-orders.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Pending Delivery Orders</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
			  
			  <!-- <div class="clearfix"></div>-->
			   
			  <li class="yellow parrotgreen">
                  <a href="../saleinvoice/index.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Sale Invoice</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-6.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/report.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Create Sale Invoice</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
			  
			    <li class="yellow dark lightred">
                  <a href="../report/holddiamonds.php">
                    <div class="list-top">
                      <?php
                      $count5=0;
                      $query5="select i.* from  diamond_status i,diamond_master d,login l,diamond_purchase dp where d.diamond_id=dp.diamond_id and i.userid=l.userid and i.diamond_status='HOLD' and i.diamondid=d.diamond_id" ;
                      $result5=mysqli_query($con,$query5);
                     while($rw5=mysqli_fetch_assoc($result5))
                     {
                          $count5++;
                     }
                      ?>
                      <p class="margin0 pull-left">Holded Diamonds <span class="badge"><?php echo $count5;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-4.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/holded-diamond.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View Holded Diamonds</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
			  
			  <li class="yellow darkpurple">
                 <a href="../bankdetails/">
                    <div class="list-top">
                      <p class="margin0 pull-left">Bank</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-15.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/view-all-subadmin.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Add Bank Details</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>         
               <li class="yellow skyblue">
                  <a href="../report/pendingPurchase.php">
                    <div class="list-top">
                      <?php
                      $queryPurchase=mysqli_query($con,"select d.*,l.username from  diamond_master d,login l,certificate_master c where 1 and d.diamond_status='1' and  d.added_by=l.userid and c.certificateid=d.certificate_id and d.instock='instockno' order by d.entrydate ASC") ;
                      ?>
                      <p class="margin0 pull-left">Pending Purchase <span class="badge"><?php echo mysqli_num_rows($queryPurchase);?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-8.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/pending-orders.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">P.Pending Delivery</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
			   
			  </ul>
			</li>
				<li>
				  <ul class="dashboard-ul">
				<li class="yellow darkgreen">
                  <a href="../stock/stock.php">
                    <div class="list-top">
                      <?php
                      $count2=0;
                      $query2="SELECT distinct(d.diamond_id) ,l.username from  diamond_master d,login l WHERE d.added_by=l.userid and d.diamond_status='1'" ;
                      $result2=mysqli_query($con,$query2);
                     while($rw2=mysqli_fetch_assoc($result2))
                     {
                          $count2++;
                     }
                      ?>
                      <p class="margin0 pull-left">All Stock <span class="badge"><?php echo $count2;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-3.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/stock.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View All Stock </p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                
                <li class="yellow purple">
                  <a href="../admin/viewusers.php">
                    <div class="list-top">
                       <?php
                      $count4=0;
                      $query4="select b.* from basic_details b,login l where l.userid=b.userid and b.usertype='user'" ;
                      $result4=mysqli_query($con,$query4);
                     while($rw4=mysqli_fetch_assoc($result4))
                     {
                          $count4++;
                     }
                      ?>
                      <p class="margin0 pull-left">All Users <span class="badge"><?php echo $count4;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-5.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/members.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View All Users </p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
               
                <!--<li class="yellow parrotgreen">
                  <a href="../report/saleInvoiceReport.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Report</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-6.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/report.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Go to Report</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>-->
                
               
                <li class="yellow grey">
                  <a href="../admin/pendingusers.php">
                    <div class="list-top">
                      <?php
                      $count7=0;
                      $query7="select b.* from basic_details b,login l where  b.userstatus='2' and l.userid=b.userid and l.loginstatus='2'" ;
                      $result7=mysqli_query($con,$query7);
                     while($rw7=mysqli_fetch_assoc($result7))
                     {
                          $count7++;
                     }
                      ?>
                      <p class="margin0 pull-left">Pending Users <span class="badge"><?php echo $count7;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-9.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/pending-user.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View Pending Users</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                <li class="yellow orange">
                  <a href="../admin/modifyusers.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Modify Users</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-10.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/modify-user.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View Modify Users</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                <li class="yellow lightskyblue">
                  <a href="../admin/countryusers.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Modify Users Country</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-11.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/modify-user-country.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Modify Users Country </p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                <li class="yellow darkpink">
                  <a href="../report/viewalldiamonds.php">
                    <div class="list-top">
                      <?php
                      $count8=0;
                      $query8="SELECT distinct(d.diamond_id) ,l.username from  diamond_master d,login l WHERE d.added_by=l.userid" ;
                      $result8=mysqli_query($con,$query8);
                     while($rw8=mysqli_fetch_assoc($result8))
                     {
                          $count8++;
                     }
                      ?>
                      <p class="margin0 pull-left">All Diamonds <span class="badge"><?php echo $count8;?></span></p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-12.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/all-diamonds.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View All Diamonds </p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                
                <?php if($role=='ADMIN' || $role=='SUPERADMIN'){ ?>
                <li class="yellow darkyellow">
                  <a href="../admin/addsubadmin.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Add Sub Admin</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-14.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/sub-admin.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">Sub Admin</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                <li class="yellow darkpurple">
                  <a href="../admin/viewsubadmin.php">
                    <div class="list-top">
                      <p class="margin0 pull-left">Sub Admin</p>
                      <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-15.png">
                      <div class="clearfix"></div>
                    </div>
                    <div class="list-middle">
                      <img class="img-responsive" src="../images/homepage_icon/view-all-subadmin.png">
                    </div>
                    <div class="list-bottom">
                      <p class="margin0 pull-left">View Sub Admin</p>
                      <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
                      <div class="clearfix"></div>
                    </div>
                  </a>        
                </li>
                <?php } ?>
				<li class="yellow lightred">
				  <a href="../search/matching_pair.php">
					<div class="list-top">
					  <p class="margin0 pull-left">Matching Pair Diamond</p>
					  <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-4.png">
					  <div class="clearfix"></div>
					</div>
					<div class="list-middle">
					  <img class="img-responsive" src="../images/user/search-matching-pair.png">
					</div>
					<div class="list-bottom">
					  <p class="margin0 pull-left">Matching Pair Diamond</p>
					  <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
					  <div class="clearfix"></div>
					</div>
				  </a>        
				</li>
              </ul>
            </li>
		  </ul>
        </div>

        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
        <a href="#" class="jcarousel-control-next">&rsaquo;</a>

       <!--  <p class="jcarousel-pagination"></p> -->
      </div>
      
    </div>
  </section>
  <script type="text/javascript" src="../js/jquery.jcarousel.min.js"></script>
  <script type="text/javascript" src="../js/jcarousel.responsive.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var  width=window.innerWidth;
      if (width <= 991) {       
        $("#jcarousel-wrapper2").removeClass("jcarousel-wrapper");
        $("#jcarousel2").removeClass("jcarousel");
      }
    });
  </script>
</body>
<?php }else{ ?>
<body class="layout2">
  <section class="main-section">
    <div class="container-fluid">  
      <ul class="dashboard-ul">
		 <li class="yellow darkgreen">
          <a  href="#" data-toggle="modal" data-target="#saleInvoiceModal">
            <div class="list-top">
              <p class="margin0 pull-left">Dummy Sale Invoice</p>
               <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-3.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/homepage_icon/stock.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Create Dummy Sale</p>
              <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
        
        <li class="yellow darkblue">
          <a href="../saleinvoice/viewallDummysaleinvoice.php">
            <div class="list-top">
              <p class="margin0 pull-left">Dummy Sale Invoice</p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-2.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/search.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">View Dummy Sale Invoice</p>
              <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
		
		 <li class="yellow darkgreen">
          <a  href="#" data-toggle="modal" data-target="#dummyPurchaseInvoiceModal">
            <div class="list-top">
              <p class="margin0 pull-left">Dummy Purcahse</p>
               <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-3.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/homepage_icon/stock.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Dummy Purcahse</p>
              <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
        
        <li class="yellow darkblue">
          <a href="../dummy_purchase/viewallDummypurchase.php">
            <div class="list-top">
              <p class="margin0 pull-left">View Dummy Purcahse</p>
              <img class="img-responsive pull-right pg" src="../images/branding-logo/branding-logo-2.png">
              <div class="clearfix"></div>
            </div>
            <div class="list-middle">
              <img class="img-responsive" src="../images/user/search.png">
            </div>
            <div class="list-bottom">
              <p class="margin0 pull-left">Dummy Purcahse Invoice</p>
              <span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span>
              <div class="clearfix"></div>
            </div>
          </a>        
        </li>
 
        <div class="clearfix"></div>
      </ul>
    </div>
  </section>
</body>
<?php } ?>
<?php include '../common/footer.php';?>