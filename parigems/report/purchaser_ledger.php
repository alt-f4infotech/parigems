<?php
  ob_start();
  error_reporting(0);
  session_start();
  include"../common/header.php";
  
  ?>
<head>
  <style>
    @media print {
    body {
    background: white;       
    padding: 0;
    }
    }
    table#recTable1{width:100%;margin-top:3px;}
    table#recTable{width:100%;margin-top:-2px;}
    #recTable tr td th{height:20px;}
    }
  </style>
</head>
<section class="main-section">
  <div class="container crumb_top">
    <ol class="breadcrumb" id="breadcrumb" style="color: black">
      <li><a href="../common/homepage.php">Home</a></li>
      <li class="active">Purchaser Ledger Report</li>
    </ol>
    <div class="row">
      <div class="form-group col-lg-4">
        <label>From</label>
        <input type="text" name="fromDate" id="fromDate" class="form-control datepicker">
      </div>
      <div class="form-group col-lg-4">
        <label>To</label>
        <input type="text" name="toDate" id="toDate"  class="form-control datepicker">
      </div>
      <div class="row">
        <div class="form-group col-lg-4 margin_dropdown">
          <label>Party Name</label>
          <select  name="purchasrname"  id="purchasrname" class="dropdownselect2" required>
            <option value=""> Select Party </option>
            <?php 
              $query = "SELECT
              distinct p.partyid,p.companyname
              FROM
               party p, purchaseinvoice pi
              where
             p.partyid=pi.partyid and p.partystatus='1' and pi.purchasestatus='1'";
              $execute = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($execute))
              {
              echo "<option  value='".$row['partyid']."'>".$row['companyname']."</option>";
              }
              ?>
          </select>
        </div>
      </div>
    </div>
    <div class="form-group col-lg-12">
      <center><button class="btn btn-success" onclick="showdiv();" name="go">Go</button>
        <button class="btn btn-success"  onClick="reset();">RESET ALL</button>
      </center>
    </div>
  </div>
  <div class="container" id="container">
  </div>
</section>
<body class="print-mode print-paper-a4">
  <div class="print-papers print-preview" id="printdiv3">
    <div class="visible-print-inline col-xs-12" >
      <div  style="height: 130px;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;margin-top:-90px;" >
        <table  id="recTable1">
          <tr>
            <td>
              <div id="printhead" style="margin-left: -35px;">
                <center>
                  <h6 style="margin-left:6%;">Subject to Vasai Jurisdiction <span style="float: right;font-size:10px;" >&nbsp;</span></h6>
                  </h6>
                  <h3 align="left" style="margin:0px;"><img src="../../images/nakoda_1.png" style="height: 15%;width: 18%;margin:-40px 30px 0px 60px;">NAKODA TRADERS</h3>
                  <p style="line-height:100%;font-size: 12px;"><u>Wholeseller Dealer</u><br>Suger,Edible Oil,Chakki Fresh Atta,Maida,Suji & Besan<br><br>Shop No. 1,Dev Krupa Society,Near Vidhya Vihar School,Virat Nagar,Virar(W).<br>Mobile No.: 9158838837 / 9158881110</p>
                </center>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <div style="min-height:700px;border-left:1px solid black;border-right:1px solid black;" id="printdiv2">
      </div>
      <table id="recTable2" border="1" >
        <tr>
          <td>
            <div>
              <span class="col-xs-8" style="font-size: 10px">FSSI NO. 11515019000281, 11516019000245<br> VAT TIN NO. 27370344046V w.e.f 01-04-06<br>CAT TIN NO. 27370344046C w.e.f 01-04-06</span>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div>
              <span class="col-xs-8" style="font-size: 8px">"I/We hereby certify that my/our registration certificate undet the maharashtra value added tax act 2002 is in force on the date on which the sales of goods specified in this tax invoice is made by me/us and that the transaction of sale covered by this tax invoice has been effectd by me/us and it shall be accounted in the run over of sales while filling of return and the due tax if any payable on this sale has been paid or shall be paid."</span>
              <span style="float: right">
              For Nakoda Traders</span>
              <span style="float: right;margin-top: 5%"">Partner & Authorised Sign.</span>
              <span class="col-xs-8" style="float: left;font-size:10px;">
              <b>NOTE: Good sold once will not taken back.</b></span>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</body>
<div style="float: center;display:none;" id="showprintbtn" class="form-group">
  <center>
    <!--<button  class="btn btn-danger delete"  onclick="printDiv()">Print</button>-->
  </center>
</div>
<script>
  function printDiv() {
              //Get the HTML of div
              var divElements = document.getElementById('printdiv3').innerHTML;
              //Get the HTML of whole page
              var oldPage = document.body.innerHTML;
    
              //Reset the page's HTML with div's HTML only
              document.body.innerHTML = 
                "<html><head><title></title></head><body>" + 
                divElements + "</body>";
    
              //Print Page
      //document.getElementById('print').style.display='none';
              window.print();
    
              //Restore orignal HTML
              document.body.innerHTML = oldPage;
          }
  
  function reset() {
  
  window.location.href="purchaser_ledger.php";
  }
  function showdiv()
  {
  var fromDate=document.getElementById('fromDate').value;
  var toDate=document.getElementById('toDate').value;
  var purchasrname=document.getElementById('purchasrname').value;
  if (purchasrname!='') {
    if (fromDate > toDate) {
     bootbox.alert('Select Date Properly');
    }
    else
    {
      if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  http2=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
  http2=new ActiveXObject("Microsoft.XMLHTTP");
  }
  http2.onreadystatechange=function()
  {
  
  if (http2.readyState==4 )
     {
        var respo=http2.responseText;
        document.getElementById('showprintbtn').style.display='block';
        document.getElementById('container').innerHTML=respo;
        document.getElementById('printdiv2').innerHTML=respo;
        
  
      }      
  }
  
  var res="&fromDate="+fromDate+"&toDate="+toDate+"&purchasrname="+purchasrname;
     http2.open("GET","show_purchaseledger.php?res="+res, true);
     http2.send(null);
                    }
  }
  else
  {
  bootbox.alert('Select Purchaser Name');
  }
  }
</script>