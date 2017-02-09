<?php
  include '../common/header.php';
  error_reporting(0);
  session_start();
  ?>
<body>
  <section class="main-section">
    <div class="container-fluid crumb_top">
      <ol class="breadcrumb" id="breadcrumb">
        <li><a href="../common/homepage.php">Home</a></li>
        <li class="active">Holded Diamonds</li>
      </ol>
	  <div id="toolbar">
          <select class="form-control">
            <option value="">Export Basic</option>
            <option value="all">Export All</option>
            <option value="selected">Export Selected</option>
          </select>
        </div>
      <h3 align="center">Holded Diamonds</h3>
	  <form action="holddiamonds.php" method="post">
      <div class="row">
	  <div class="col-sm-3">
					<div class="form-group">
				 		<label for="locationid">Filter By User</label>
						<select class="dropdownselect2"  name="user" id="partyid2" onchange="this.form.submit();">
		                    <option value="">Select User</option>
		                    <?php
		                        $getuserqry="select distinct userid, username from basic_details where usertype='USER' and userstatus='1'";
		                        $userres=mysqli_query($con,$getuserqry);
		                        while($usrrw=mysqli_fetch_assoc($userres)){
								  if($_POST['userid']==$usrrw['userid']){
		                            echo '<option value="'.$usrrw['userid'].'" selected>'.$usrrw['username'].'</option>';
								  }else{
		                            echo '<option value="'.$usrrw['userid'].'">'.$usrrw['username'].'</option>';
								  }
		                        }
		                    ?>
		                </select>
					</div>
				</div>
	  </div>
	  </form>
	  <form id="movieForm" action="unhold.php" method="post">
      <table class="table table-hover" id="table" data-height="400" data-show-columns="true"
	        data-toggle="table" data-search="true" data-show-export="true" data-pagination="true"
	        data-click-to-select="true" data-toolbar="#toolbar" data-show-refresh="true"
			data-show-toggle="true" data-show-columns="true">
        <thead>
          <tr>
			<th><input type="checkbox" id="check_all" ></th>
			<th data-sortable="true">PG Stock Id</th>
			<th data-sortable="true">Cert. No.</th>
			<th data-sortable="true">Shape</th>
			<th data-sortable="true">Size</th>
			<th data-sortable="true">Color</th>
			<th data-sortable="true">Clarity</th>
			<th data-sortable="true">Cut</th>
			<th data-sortable="true">Polish</th>
			<th data-sortable="true">Symmetry</th>
			<th data-sortable="true">Fluorescence</th>
			<th data-sortable="true">Rap $</th>
			<th data-sortable="true">&#177; Dis</th>
			<th data-sortable="true">P/C $</th>
			<th data-sortable="true">LESS</th>
			<th data-sortable="true">Final $</th>
			<th data-sortable="true">USD $</th>
			<!--<th data-sortable="true">STOCK ID</th>-->
			<th data-sortable="true">COMMENT</th>
			<th data-sortable="true">MEASUREMENT</th>
			<th data-sortable="true">TABLE</th>
			<th data-sortable="true">DEPTH</th>
			<th data-sortable="true">Date Added</th>
			<th data-sortable="true">Hold By</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i=1;
			if (isset($_POST['user'])) {
			  if($_POST['user']!=''){
			 $userqry=" and i.userid='".$_POST['user']."'";
			  }
		   }
		   else
		   {$userqry="";}
            $certificteqry1="select i.*,d.*,l.username,dp.rap,dp.final from  diamond_status i,diamond_master d,login l,diamond_purchase dp where 1 $userqry and d.diamond_id=dp.diamond_id and i.userid=l.userid and i.diamond_status='HOLD' and i.diamondid=d.diamond_id";
            $certiresult1=mysqli_query($con,$certificteqry1);
            while($row=mysqli_fetch_assoc($certiresult1))
            {
            $did=$row['diamond_id'];
							  $diamond_status=$row['diamond_status'];
							  $certificate_id=$row['certificate_id'];
							 $certificteqry="select * from certificate_master where certificateid=".$row['certificate_id'];
							 $certiresult=mysqli_query($con,$certificteqry);
							 while($crow=mysqli_fetch_assoc($certiresult))
							 {
							  $lab=$crow['certi_name'];
							  $certi_no=$crow['certi_no'];
							  $reportno=$crow['report_no'];
							  $certiimage='../signup/'.$crow['logo'];
							 }
							$final=$final+$row['price'];
                            $finalqty=$finalqty+$row['qty'];
							$kysymbol='';$kr=1;
							$keyquery="select * from diamond_keysymbol where diamond_id=$did";
                     $keyres=mysqli_query($con,$keyquery);
                     while($ksm=mysqli_fetch_assoc($keyres)){
					  if($kr==1)
					  {
                        $kysymbol=$ksm['kysymbol'];
					  }else{
                        $kysymbol=$kysymbol.','.$ksm['kysymbol'];
					  }
						$kr++;
                     }
						   if($diamond_status=='0')
							{
								$note='Out Of Stock';
							}
							else{$note='';//$class="";
							}
							
							$saleinvoice="select * from invoice_product where diamondid='$did' and pstatus='2'";
							$invoiceresult=mysqli_query($con,$saleinvoice);
							
							$getid1="select p.*,pt.companyname,pt.referenceno from purchaseinvoice_product pp,purchaseinvoice p,party pt where 1 $wvat $vat $hform $regular and p.purchase_invoiceid=pp.purchase_invoiceid and pt.partyid=p.partyid and  pp.diamond=$did";
	                    $result1=mysqli_query($con,$getid1);
	                    $vatrow=mysqli_fetch_assoc($result1);
						 if(mysqli_num_rows($invoiceresult) > 0)
							{
							  //$saleinvoicecss="style='background: #ff5555 !important;'";
							  $class="danger";
							}
						 else if(mysqli_num_rows($result1) > 0){
						    /*if($vatrow['ptype']=='wvat'){
								$class="success";
							}
							if($vatrow['ptype']=='vat'){
								$class="danger";
							}
							if($vatrow['ptype']=='hform'){
								$class="info";
							}
							if($vatrow['ptype']=='regular'){
								$class="warning";
							}*/
						}else{ $class='';$empty='0';}
						
						$getcut="SELECT cps.semi as semicut FROM `diamond_master` d,cut_polish_sym cps where d.cut=cps.title and d.diamond_id=$did";
						$getcutresult=mysqli_query($con,$getcut);
						$cutrow=mysqli_fetch_assoc($getcutresult);
						
						$getpolish="SELECT cps.semi as semipolish FROM `diamond_master` d,cut_polish_sym cps where  d.polish=cps.title and d.diamond_id=$did";
						$getpolishresult=mysqli_query($con,$getpolish);
						$polishrow=mysqli_fetch_assoc($getpolishresult);
						
						$getsymmetry="SELECT cps.semi as semisymmetry FROM `diamond_master` d,cut_polish_sym cps where  d.symmetry=cps.title and d.diamond_id=$did";
						$getsymmetryresult=mysqli_query($con,$getsymmetry);
						$symhrow=mysqli_fetch_assoc($getsymmetryresult);
						
						$getraprates="SELECT * FROM `diamond_sale` where diamond_id=$did";
						$getrapratesresult=mysqli_query($con,$getraprates);
						$raprow=mysqli_fetch_assoc($getrapratesresult);
						
						if($row['diameter_min']!='')
						{
						  $diameter_min=$row['diameter_min'].'X';
						}
						else{$diameter_min='';}
						if($row['diameter_max']!='')
						{
						  $diameter_max=$row['diameter_max'].'X';
						}
						else{$diameter_max='';}
						if($row['height']!='')
						{
						  $height=$row['height'];
						}
						else{$height='';}
						$measurement=$diameter_min.$diameter_max.$height;			  
			  
			         $firstDiscount=$raprow['discount1'];
						if($firstDiscount < 0)
						{
						  $explodefirstDiscount=explode('-',$firstDiscount);
						  $Discount='+'.$explodefirstDiscount[1]; 
						 //$Discount=$firstDiscount; 
						}
						else{
						 $Discount='-'.$firstDiscount; 
						}
						
						$finalValue=$raprow['final'];
						if($finalValue < 0)
						{
						  $explodeFinalDiscount=explode('-',$finalValue);
						  $final='+'.$explodeFinalDiscount[1]; 
						  //$final=$finalValue;
						}
						else{
						 $final='-'.$finalValue; 
						}
						
            echo "<tr class='$class'>";
		    echo '<td><input style="width:30px;" type="checkbox" name="check[]"  id="'.$did.'" value="'.$did.'" class="case"  /></td>';
            echo "<td>".$row['referenceno']."</td>";
			echo '<td><a  href="javascript:;" data-id='.$certificate_id.' onclick="showAjaxModal('.$certificate_id.');">'.$certi_no.'</a></td>';
			echo "<td>".$row['diamond_shape']."</td>";
			echo "<td>".$row['weight']."</td>";
			echo "<td>".$row['color']."</td>";
			echo "<td>".$row['clarity']."</td>";
			echo "<td class='center'>".$cutrow['semicut']."</td>";
			echo "<td class='center'>".$polishrow['semipolish']."</td>";
			echo "<td class='center'>".$symhrow['semisymmetry']."</td>";
			echo "<td>".$row['fluoresence']."</td>";
			echo "<td class='center'>$".$raprow['rap']."</td>";
			echo "<td class='center'>".$Discount."</td>";
			echo "<td class='center'>$".$raprow['pc']."</td>";
			echo "<td class='center'>".($raprow['discount3']+$raprow['discount4']+$raprow['discount5']+$raprow['discount6'])."</td>";
			echo "<td class='center'>".$final."</td>";
			echo "<td class='center'>$".$raprow['usd']."</td>";
			//echo "<td class='center'>".$row['purchase_stockid']."</td>";
			echo "<td class='center'>".$row['comments']."</td>";
			echo "<td class='center'>".$measurement."</td>";
			echo "<td>".$row['table']."%</td>";
			echo "<td>".$row['depth']."%</td>";
            echo "<td>".date('d-m-Y g:i: A',strtotime($row['holdtime']))."</td>";
            echo "<td>".$row['username']."</td>";
            echo "</tr>";
            }                           
            ?>
          
        </tbody>
      </table>
	  <br>
	  <center><button type="submit" class="btn btn-danger"  onclick="return atleast_onecheckbox1()" name="confirm">Unhold</button></center>
	  </form>
    </div>
  </section>
</body>
</html>
<script>
  function showAjaxModal(uid)
         {
    $.get('../search/viewcertificate.php?certi_id=' + uid, function(html){
                  $('#myModal .modal-body').html(html);
                  $('#myModal').modal('show', {backdrop: 'static'});
              });
   }
   function atleast_onecheckbox1() {
  abc=$("input[name='check[]']:checked").length;
   if ($("input[name='check[]']:checked").length === 0) { 
  bootbox.alert("Please Select Atleast One Item");
  return false;
  }
  else
  {
	return true;
  }
  }
  $(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});
  
</script>
<script type="text/javascript">
  setTimeout(function(){
    location = ''
  },60000)//1 min
</script>
<div class="modal fade" id="myModal" role="dialog" style="z-index: 10000;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content border-radius0">
      <div class="modal-body" style="padding: 0px;">
      </div>
    </div>
  </div>
</div>
<?php
include "../common/footer.php";
?>